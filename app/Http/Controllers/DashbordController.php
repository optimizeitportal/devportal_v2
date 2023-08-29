<?php

namespace App\Http\Controllers;

use App\ApiModels\API_repository;
use Illuminate\Http\Request;

class DashbordController extends Controller
{

    /**
     * Function : dashborad()
     * Purpose  : Load the sample documents and the user uploaded documents
     * Return   : \resources\views\dashboard
     */
    public function dashborad()
    {
        $documents = API_repository::getSample_Document_list(); //Load Sample Documents in the Drop Down
        $uploaded_data = API_repository::getUploadedList(); // Load User Uploaded Documents List.
        $uploaded_list = $this->get_uploadList_tableFormat($uploaded_data); // Load User Uploaded Documents in the dashbord Table
        $doc_metrics = $this->get_doc_metrics($uploaded_list); // Load Document Metrics in dashbord

        // save the document metrics data in session
        session()->put('doc_metrics', $doc_metrics);

        return view('dashboard',compact('documents','uploaded_list','doc_metrics'));

    }


    /**
     *
     * Function : get_uploadedList_component()
     * Purpose  : For auto Reload the uploaded Files data in dashboard page every 5 sec.
     * Return   : view('components.documents.uploade_list') or noData
     *
     * Ajax Request
     *
     */
    public function get_uploadedList_component()
    {
        // get Uploaded List Data
        $uploaded_data = API_repository::getUploadedList(); // Load User Uploaded Documents List.
        $uploaded_list = $this->get_uploadList_tableFormat($uploaded_data); // Load User Uploaded Documents in the dashbord Table
        $doc_metrics = $this->get_doc_metrics($uploaded_list); // Load Document Metrics in dashbord
        $temp_doc_metrics =session('doc_metrics');
        $is_changed = false;

        // Check the doc_metrics session data and fetched data is same or not.
        if(isset($temp_doc_metrics) && $temp_doc_metrics !==null ){
            foreach($doc_metrics as $k => $v) {
                $is_changed =  $temp_doc_metrics[$k] !== $v ? true : false;
            }
        }elseif(isset($doc_metrics) && $doc_metrics !==null){
            $is_changed = true;
        }
        if($is_changed){  //if is Changed load the Table and doc metrics component
            echo view('components.documents.uploade_list', compact('doc_metrics','uploaded_list'));
            session()->put('doc_metrics', $doc_metrics);
        }else{
            echo "noData";
        }
    }

    /**
     *
     * Function : get_uploadList_tableFormat($uploaded_data)
     * Param    : $uploaded_data
     * Purpose  : Converting the Uploaded Document list into the Table required Format
     * Return   : array
     *
     */
    public function get_uploadList_tableFormat($uploaded_data , $filter=false) {

        $uploaded_list=[];
        foreach($uploaded_data as $k=> $list_val){

            $files = str_replace(session('account_id') . '/uploaded_files/', '', $list_val);
            // Format the document display name without the account id and date stamp.
            $file = explode('_', $files); // convert string to array
            //remove first 2 index
            unset($file[0]);
            unset($file[1]);
            // convert array to string
            $file_name =  implode('_', $file);

            // get uploaded document status from Api
            $data = json_decode(API_repository::getDocument_status($files));
            $uploaded_on = count((array)$data) !==0 && isset($data->Item->file_date) ? $data->Item->file_date->S :"";
            $status = count((array)$data) !==0 && isset($data->Item) && isset($data->Item->file_status) ? $data->Item->file_status->S : "";
            if($filter!==false && $status == $filter){  //Filter the documents based on processed status (UPLOADED,PROCESSED)
                $uploaded_list[]=[
                    'file_name'=>$file_name,
                    "files"=>$files,
                    "updated_on"=>date('d-M-Y h:i',strtotime($uploaded_on)),
                    "status"=>$status,
                    "file_date"=> $uploaded_on
                ];
            }
            if($filter==false){ // ($filter=false) filter is not apply
                $uploaded_list[]=[
                    'file_name'=>$file_name,
                    "files"=>$files,
                    "updated_on"=>date('d-M-Y h:i',strtotime($uploaded_on)),
                    "status"=>$status,
                    "file_date"=> $uploaded_on
                ];
            }
        }
        // Sort the document list in descending order of uploaded date/time by default
        usort($uploaded_list, function ($item1, $item2) {
            return $item2['file_date'] <=> $item1['file_date'];
        });

        return $uploaded_list;
    }

    /**
     *
     * Function : get_uploadList_tableFormat($uploaded_data)
     * Param    : $uploaded_data
     * Purpose  : Filtering the Uploaded list Document for required document Metrics
     * Return   : array
     *
     */
    public function get_doc_metrics($uploaded_list) {
        // Load document Metrics
        $doc_metrics = [
            'doc_count'=>count($uploaded_list),
            'processed'=>count(array_filter($uploaded_list,function($var){  // For processed
                $i = 0;
                if($var['status'] == 'PROCESSED'){  //Filter the PROCESSED data
                    $i++;
                }
                return $i;
            })),
            'extracted'=>count(array_filter($uploaded_list,function($var){  //For extracted
                $i = 0;
                if($var['status'] == 'PROCESSED'){ //Filter the PROCESSED data
                    $i++;
                }
                return $i;
            })),
            'Uploaded'=>count(array_filter($uploaded_list,function($var){  //For Uploaded
                $i = 0;
                if($var['status'] == 'UPLOADED'){ //Filter the UPLOADED data
                    $i++;
                }
                return $i;
            })),
        ];

        return $doc_metrics;
    }
}


