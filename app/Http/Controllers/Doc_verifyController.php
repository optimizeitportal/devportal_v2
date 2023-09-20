<?php

namespace App\Http\Controllers;

use App\ApiModels\API_repository;
use Illuminate\Http\Request;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\FormProcessor\CMS1500FormProcessor;
class Doc_verifyController extends Controller
{

    /**
     * 
     * Function : doc_verify()
     * Purpose  : Load the sample documents List Doc verify page
     * Return   : view doc_verify
     * 
     */
    public function doc_verify()
    {
        $documents = API_repository::getSample_Document_list(); //Load Sample Documents in the Drop Down
        $uploaded_data = API_repository::getUploadedList(); // Load User Uploaded Documents List.
        $dashboard  = new DashbordController();
        $uploaded_lists = $dashboard->get_uploadList_tableFormat($uploaded_data, $filter='PROCESSED'); //Load the only PROCESSED data in processed select box
        return view('doc_verify', compact('documents','uploaded_lists'));
    }

    /**
     * 
     * Function : get_rawtext()
     * Param    : Request $request
     * Purpose  : Load the sample documents Raw text or uploaded doc Raw text.
     * Return   : view component --view('components.documents.raw_text');
     * 
     */
    public function get_rawtext(Request $request)
    {
        $raw_text = 0; // for file name is empty

        if ($request->file_name) {

            // check the sample document or user uploaded document
            if ($request->data_type == "sample") {
                $raw_text = API_repository::getDocument($request, 'text')->json(); //Load the sample document raw text
            } else {
                $raw_text = API_repository::getUploaded_document($request, 'text')->json(); //Load the uploaded document raw text
            }
        }
        echo view('components.documents.raw_text', compact('raw_text'));
    }

    /**
     * 
     * Function : get_image()
     * Param    : Request $request
     * Purpose  : Load the sample documents image or uploaded doc image.
     * Return   : Html img tag;
     * 
     */
    public function get_image(Request $request)
    {
        if ($request->file_name) {

            // check the sample document or user uploaded document
            if ($request->data_type == "sample") {
                $image = API_repository::getDocument($request, 'image')->body(); //Load the sample document image
            } else {
                $image = API_repository::getUploaded_document($request, 'image')->body(); //Load the uploaded document image
            }
            echo $image;
        } else {
            echo 'No Data available!';
        }
    }

     /**
     * 
     * Function : get_forms()
     * Param    : Request $request
     * Purpose  : Load the sample documents Forms data or uploaded doc Forms data.
     * Return   : view component --view('components.documents.form');
     * 
     */

    public function get_forms(Request $request)
    {
        $forms = 0; // for file name is empty
        if ($request->file_name) {

            // check the sample document or user uploaded document
            $pre_defind_cms1500 = json_decode(file_get_contents(public_path('json/pre_defined_cms1500.json')));

            // dd($pre_defind_cms1500);
            if ($request->data_type == "sample") {
                $forms = API_repository::getDocument($request, 'forms')->json(); //Load the sample document forms data
            } else {
                $forms = API_repository::getUploaded_document($request, 'forms')->json(); //Load the uploaded document forms data
            }
            
        }

        echo view('components.documents.form', compact('forms'));
    }

    /**
     * 
     * Function : get_table()
     * Param    : Request $request
     * Purpose  : Load the sample documents tables data or uploaded doc tables data.
     * Return   : view component --view('components.documents.form');
     * 
     */
    public function get_table(Request $request)
    {
        $tables = []; // for file name is empty
        if ($request->file_name) {
            // check the sample document or user uploaded document
            $file_name = $request->file_name . "_page_" . $request->page_no;
            $tables = [];
            $merged_tables = [];
            if ($request->data_type == "sample") {
                $table_data = API_repository::getDocument($request, 'tables')->json(); //Load the sample document tables data
            } else {

                $table_data = API_repository::getUploaded_document($request, 'tables')->json(); //Load the uploaded document tables data
            }

            foreach ($table_data as $key => $table) {
                // check the page for request page no
                if (str_contains($key, "_page_" . $request->page_no)) {

                    $remove_prefix = str_replace($file_name, "", $key);
                    $replace = str_contains($key, 'merged_row') ? "_merged_row_" : "_row_";
                    // replaced the array key and decalre the custom key (_table_(n))
                    $table_index = str_replace($replace . $table['Row_Index'] . "_col_" . $table['Column_Index'], "", $remove_prefix);
                    // concatenate all repleced text.
                    $index = $file_name . $table_index . "_row_" . $table['Row_Index'] . "_col_" . $table['Column_Index'] . "";

                    // indichuval cell table
                    if (isset($table['Cell_Page']) && isset($table['Row_Index']) && isset($table['Column_Index']) && isset($table_data[$index])) {

                        if (isset($table['Cell_Type']) && current($table['Cell_Type']) == 'COLUMN_HEADER') {
                            // indichuval header
                            $tables[$table_index]['header'][$table['Row_Index']][$table['Column_Index']] = $table_data[$index];

                            $check_head_index = ($table['Column_Index'] - 1) == 0 ? 1 : $table['Column_Index'] - 1;

                            // check and insert the missing index for header
                            if (!isset($tables[$table_index]['header'][$table['Row_Index']][$check_head_index])) {

                                $index2 = $file_name . $table_index . "_row_" . $table['Row_Index'] . "_col_" . ($table['Column_Index'] - 1) . "";
                                $tables[$table_index]['header'][$table['Row_Index']][$check_head_index] = $table_data[$index2];

                                // key sort for inserted missing value.
                                ksort($tables[$table_index]['header'][$table['Row_Index']]);
                            }

                        } elseif (!str_contains($key, 'merged_row')) {
                            // indichuval body
                            $tables[$table_index]['body'][$table['Row_Index']][$table['Column_Index']] = $table_data[$index];
                        }
                    }

                    // merging cell table data
                    if (str_contains($key, 'merged_row')) {
                        // decalre the merged index
                        $merged_index = $file_name . $table_index . "_merged_row_" . $table['Row_Index'] . "_col_" . $table['Column_Index'] . "";

                        // merging header
                        if (isset($table['Merged_Cell_Type']) && current($table['Merged_Cell_Type']) == 'COLUMN_HEADER') {
                            $tables[$table_index]['header'][$table['Row_Index']][$table['Column_Index']] = $table_data[$merged_index];

                            $row_span = $table_data[$merged_index]['Row_Span'];
                            $col_span = $table_data[$merged_index]['Column_Span'];

                            // removing unnecessary data for (merging header) row data
                            for ($i = 1; $i < $row_span; $i++) {
                                unset($tables[$table_index]['header'][($table['Row_Index'] + $i)][$table['Column_Index']]);
                            }
                            // removing unnecessary data for (merging header) column data
                            for ($i = 1; $i < $col_span; $i++) {
                                unset($tables[$table_index]['header'][$table['Row_Index']][($table['Column_Index'] + $i)]);
                            }

                        } else {
                            // merging body
                            $tables[$table_index]['body'][$table['Row_Index']][$table['Column_Index']] = $table_data[$merged_index];

                            $row_span = $table_data[$merged_index]['Row_Span'];
                            $col_span = $table_data[$merged_index]['Column_Span'];

                            // removing unnecessary data for (merging body) row data
                            for ($i = 1; $i < $row_span; $i++) {
                                // echo $i.'<br>';
                                unset($tables[$table_index]['body'][($table['Row_Index'] + $i)][$table['Column_Index']]);
                            }

                            // removing unnecessary data for (merging body) column data
                            for ($i = 1; $i < $col_span; $i++) {
                                unset($tables[$table_index]['body'][$table['Row_Index']][($table['Column_Index'] + $i)]);
                            }
                        }

                    }
                }
            }
            // echo '<pre>';
            // print_r($tables);exit;

        }
        // dd(json_encode($tables));
        echo view('components.documents.table', ['table_new' => $tables, 'merged_table' => $merged_tables]);
        exit;

    }

    /**
     * 
     * Function : get_reports()
     * Param    : Request $request
     * Purpose  : Load the sample documents reports data or uploaded doc reports data.
     * Return   : view component --view('components.documents.report');
     * 
     */
    public function get_reports(Request $request)
    {
        echo "The Insights are coming soon";exit;
        $reports = 0; // for file name is empty
        if ($request->file_name) {

            // check the sample document or user uploaded document
            if ($request->data_type == "sample") {
                $reports = API_repository::getDocument($request, 'report')->body();  //Load the sample document reports data
            } else {
                $reports = API_repository::getUploaded_document($request, 'report')->body(); //Load the uploaded document reports data
            }
        }

        echo view("components.documents.report", compact('reports'));
    }

    /**
     * 
     * Function : download_document()
     * Param    : Request $request
     * Purpose  : Download the user uploaded Document json file.
     * Return   : view component --view('components.documents.report');
     * 
     */
    public function download_document(Request $request)
    {
        $document = API_repository::download_document($request, 'download')->body(); //load the json file for Download
        // header('Content-type: application/csv');
        // header('Content-Disposition: attachment; filename=forms.csv');
        $file = explode('_', $request->file_name); // convert string to array
        //remove first 2 index
        unset($file[0]);
        unset($file[1]);
        $file_name =  implode('_', $file); // convert array to string (file name)
        
        header('Content-type: application/json');
        header('Content-Disposition: attachment; filename=' . $file_name); 
        echo $document; //download
        exit;

    }
    
    /**
     * 
     * Function : uploadDocument()
     * Param    : Request $request
     * Purpose  : Upload Document to the s3 bucket
     * Return   : string;
     * 
     */
    public function uploadDocument(Request $request)
    {
        if (($request->file('file')->getSize() / 1024) < 2048) { //Checking File Size

            $bucket = env('AWS_USER_UPLOAD_BUCKET');
            $filename = $request->file('file')->getClientOriginalName();
            //file name convert the (Ex:CMS1500-02-12.pdf to 2eJICUv8_16857091590206_CMS1500-02-12.pdf)
            $filename1 = str_replace(" ", "-", $filename);
            $keyname = preg_replace('/[^a-zA-Z0-9.]/m', '-', $filename1);
            $keyname = session('account_id') . "_" . time() . date('dm') . "_" . $keyname; //rename
            $filepath = $request->file('file')->getPathname();
            $content = file_get_contents($filepath); //load the document contents

            $response = API_repository::upload_Document($keyname, $content); //calling Uploaded API

            // Check the response 200
            if ($response !== 200) {
                echo "Error: Please Try Again";
            } else {
                echo "File(s) has been successfully uploaded.";
                session()->put('upload_file_name', $keyname); //save the rename file in session
                session()->put('upload_orginal_file_name', $filename); // Save the orginal file name in session
            }
        } else { 
            // if file size is greater than our requriment, return error msg
            echo "<i class='fas fa-exclamation-triangle'></i> File is too big. Max filesize is 2 MB.";
        }
    }
        
    /**
     * 
     * Function : check_document_status()
     * Param    : Request $request
     * Purpose  : Load the Uploaded Document Status.
     * Return   : json string;
     * 
     */
    public function check_document_status(Request $request)
    {
        $file_name = $request->file_name == null ? session('upload_file_name') : $request->file_name;
        $status = API_repository::getDocument_status($file_name);
        $status = json_decode($status);

        // get file name without extension (EX : test.jpg to test)
        $status->upload_file_name = pathinfo($file_name, PATHINFO_FILENAME);
        return json_encode($status);
    }
        
    /**
     * 
     * Function : send_forms()
     * Param    : Request $request
     * Purpose  : Updateing the Uploaded Forms Document into S3 bucket.
     * Return   : respone status code;
     * 
     */
    public function send_forms(Request $request)
    {
        $forms = unserialize($request->form_data);
        // dd($request->input);
        // $output = CMS1500FormProcessor::manipulateDates($forms);
        // $outputData = CMS1500FormProcessor::manipulateAddresses($output);
        // // Output the result
        // dd(json_encode($outputData, JSON_PRETTY_PRINT));
        
        foreach ($request->input as $key => $value) {
            $forms[$key][1]['Value_Text'] = $value['value'];
            $forms[$key][1]['select_for_data_contract'] = $value['element_selected'];
            if(isset($value['edited_lable'])){
                $forms[$key][0]['Alternative_Key_Text'] = $value['edited_lable'];
            }
        }
        $file_name = API_repository::build_file_name($request, 'forms');
        $res = API_repository::send_result($file_name, json_encode($forms));
        print_r($res);
    }


    
    
    /**
     * 
     * Function : send_tables()
     * Param    : Request $request
     * Purpose  : Updateing the Uploaded Tables Document into S3 bucket.
     * Return   : respone status code;
     * 
     */
    public function send_tables(Request $request)
    {
        $table = [];
        $table[] = unserialize($request->thead_data);
        $table += $request->table;
        // print_r($this->array2csv($table));
    }

    public function chatbot() {
        $json = file_get_contents(public_path('json/chatbot.json'));
        return $json;
        
    }

}
