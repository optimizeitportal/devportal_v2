<?php
namespace App\ApiModels;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class API_repository {

    /**
     * @var string
     */
    const auth_key = 'cogidtk';

    /**
     * 
     * Function : user_details()
     * Param    : $user_id
     * Purpose  : Fetch the logged in Users details
     * Return   : array
     * 
     */
    
    public static function user_details($user_id)
    {
        // dd($user_id);
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->post(env('USER_URL'),['TableName'=>'customer_user_master','Key'=>['user_id'=>['S'=>$user_id]]]);
        
        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }

        return $response->json();
    }

    /**
     * 
     * Function : getDocument()
     * Param    : $request,$name
     * Purpose  : Fetching Sample Documents ('raw text , forms , tables , reports ')
     * Return   : object
     * 
     */
    public static function getDocument($request,$name)
    {
        // Build file name 
        $file_name = self::build_file_name($request,$name);
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->get(env('DOCUMENT_URL').env('AWS_SAMPLE_OUTPUT_BUCKET').'?file='.env('AWS_SAMPLE_OUTPUT_FOLDER').'/'.$file_name);;
        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }
        return $response;
    }

    /**
     * 
     * Function : getUploadedList()
     * Purpose  : Fetch the users uploaded documents files List
     * Return   : array
     * 
     */
    public static function getUploadedList()
    {
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key) //Use logged in user auth key for API authentication
        ])->get(env('GET_UPLOADED_LIST').'?prefix='.session('account_id'));

        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }
        return $response->json();
    }

    /**
     * 
     * Function : getUploaded_document()
     * Param    : $request,$name
     * Purpose  : Fetch the user uploaded Documents ('raw text , forms , tables , reports ')
     * Return   : object
     * 
     */
    public static function getUploaded_document($request,$name)
    {

        // Build file name 
        $file_name = self::build_file_name($request,$name);
    
        // dd(env('DOCUMENT_URL').env('AWS_USER_DOWNLOAD_BUCKET').'?file='.session('account_id').'/'.$file_name);
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->get(env('DOCUMENT_URL').env('AWS_USER_DOWNLOAD_BUCKET').'?file='.session('account_id').'/'.$file_name);
        
        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }
        return $response;
    }

    /**
     * 
     * Function : download_document()
     * Param    : $request,$name
     * Purpose  : Fetch the json file for Download uploaded Documents.
     * Return   : object
     * 
     */
    public static function download_document($request,$name)
    {
        $file_name = $request->file_name;
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->get(env('DOWNLOAD_DOCUMENT_URL').env('AWS_USER_DOWNLOAD_BUCKET').'?file='.$file_name);
       
        return  $response;
    }

    /**
     * 
     * Function : build_file_name()
     * Param    : $request,$name
     * Purpose  : generate File name for fetch the sample doc and uploaded doc.
     * Return   : string
     * 
     */
    public static function build_file_name($request,$name){

        if(isset($request->build_file_name) && $request->build_file_name == 'false'){
            return $file_name = $request->file_name;
        }
        $extensions = '.json';
        if($name == "image") { $extensions = '.jpg'; }
        elseif ($name=='table') { $extensions = '.csv';}
        elseif ($name=='download') { $name="forms"; $extensions = '.csv';}
        elseif ($name=='tables') { 
            $extensions = '.json';
            $file_name = $request->file_name.'_'.$name;
            return $file_name.$extensions;
        }

        $request->page_no = $request->page_no==0 ?1 : $request->page_no;
        $file_name = $request->file_name.'_'.$name.'_'.$request->page_no;

        return $file_name.$extensions;
    }
    /**
     * Function : getSample_Document_list()
     * Purpose  : Fetch the sample documents list from sample document master json.
     * Return   : array
     * 
     */

    public static function getSample_Document_list()
    {
        $response = Http::withHeaders([
                'Authorization' => session(Self::auth_key)
            ])->get(env('GET_SAMPLE_DOCS_LIST') . env('AWS_SAMPLE_BUCKET') . '/' . env('AWS_SAMPLE_FILE_LIST'));

        return $response->json();
    }

    /**
     * 
     * Function : upload_Document()
     * Param    : $file_name , $content
     * Purpose  : Using API For upload document into the S3 bucket.
     * Return   : int
     * 
     */
    public static function upload_Document($file_name , $content)
    {
        $url = env('DOCUMENT_UPLOAD_URL') . env('AWS_USER_UPLOAD_BUCKET') . '/' . $file_name;
        $curl_headers = [ 'Authorization: ' . session(Self::auth_key) ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_headers);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $http_code;
    }
    
    /**
     * 
     * Function : upload_Document()
     * Param    : $file_name , $content
     * Purpose  : Using API For update edited file into the s3 bucket. Only uploaded documents can editable.
     * Return   : int
     * 
     */
    public static function send_result($file_name , $content)
    {
        $url = env('DOCUMENT_UPLOAD_URL') . env('AWS_USER_UPLOAD_CHANGES_BUCKET') .'/'. $file_name;
        $curl_headers = [ 'Authorization: ' . session(Self::auth_key) ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_headers);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $response =  curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $http_code;
    }


    /**
     * Document Status update
     * 
     * @param mixed $file_name
     * 
     * @return object
     */
    /**
     * 
     * Function : updateDocument_status()
     * Param    : $file_name , $content
     * Purpose  : Using API For insert file name in dynamodb.
     * Return   : array
     * 
     */
    public static function updateDocument_status($file_name)
    {
        $date = date('d-M-Y');
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->post(env('DOCUMENT_STATUS_UPDATE_URL'),[
            'TableName'=>'processed_file_details',
            'Item'=>[
                'file_name'=>['S'=>$file_name ],
                // 'file_status'=>['S'=>"uploaded"],
                // 'doc_date'=>['S'=>$date],
            ]
        ]);
        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }
        return $response;
    }

    /**
     * 
     * Function : getDocument_status()
     * Param    : $file_name
     * Purpose  : Using API For Fetch the Uploaded document status from dynamodb.
     * Return   : string
     * 
     */
    public static function getDocument_status($file_name)
    {
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->post(env('GET_DOCUMENT_STATUS_URL'),[
            'TableName'=>'processed_file_details',
            'Key'=>[
                'file_name'=>['S'=>$file_name],
            ]
        ]);

        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }

        return $response->body();
    }

    /**
     * 
     * Function : getDocument_status()
     * Param    : $table_name,$items
     * Purpose  : Using API For Fetch the dats's from dynamodb.
     * Return   : string
     * 
     */
    public static function get_dynamo_items($table_name,$items=[])
    {
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->post(env('GET_DOCUMENT_STATUS_URL'),[
            'TableName'=>$table_name,
            'Key'=>$items
        ]);

        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }

        return $response->json();
    }
    /**
     * 
     * Function : store_dataTodynamo()
     * Param    : $table_name,$items
     * Purpose  : Using API For creating dynomoDb entries.
     * Return   : string
     * 
     */
    public static function create_dynamo_entry($table_name,$items=[])
    {
        $response = Http::withHeaders([
            'Authorization' => session(Self::auth_key)
        ])->post(env('CREATE_DYNAMO_ENTRY'),[
            'TableName'=>$table_name,
            'Item'=>$items
        ]);

        if($response->getStatusCode() !== 200 ){
            return back()->withErrors('error',"Somthing Went Wrong");
        }

        return $response->body();
    }


}
