<?php

namespace App\Http\Controllers;

use App\ApiModels\API_repository;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function cms1500_form(Request $request){
        // Read the JSON file 
        $json = file_get_contents(public_path('json/Sample_json_for_EDI.json'));
        
        // Decode the JSON file
        $json_data = json_decode($json,true);
        
        // Display data
        $table_data =[];
        $datas = $request->input('data');
        // dd(json_encode($datas));
        // foreach($json_data['form_data'] as $key => &$val){
        //     foreach($datas as $k => $v ){
        //         if($k == $val){
        //             $val = isset($v['field_value']) ? $v['field_value'] : null;
        //         }
        //     }
        // }

        // foreach($json_data['form_data']['box_24'][0] as $table_key =>  &$table_val){
        //     foreach($datas as $k => $v ){
        //         if($k == $table_val){
        //             $table_val = isset($v['field_value']) ? $v['field_value'] : null;
        //         }
        //     }
        // }
        
        foreach($datas as &$data){
            if(isset($data['field_name'])){
                $data['field_name'] = preg_replace('!\s+!',' ',$data['field_name']);
            }
        }
        // dd(json_encode($json_data));
        $file_name = "CMS1500_".session('account_id') . "_" . time() . date('dm') . ".pdf"; 
        // $res = API_repository::create_dynamo_entry("cms_1500",[
        //     'file_name'=>[ "S" => $file_name],
        //     'user_id'=>[ "S" => session('account_id')],
        //     'data' => [ "S" => json_encode($json_data)]
        // ]);
        $res = API_repository::create_dynamo_entry("cms_1500",[
            'file_name'=>[ "S" => $file_name],
            'user_id'=>[ "S" => session('account_id')],
            'data' => [ "S" => json_encode($datas ,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)]
        ]);
        $request->session()->put('uploaded_cms1500_filename', $file_name);
        return back();
    }

    public function get_cms1500_json(Request $request){
        // dd(session('uploaded_cms1500_filename'));
       $data = API_repository::get_dynamo_items("cms_1500",[
            'file_name'=>["S"=>session('uploaded_cms1500_filename')]
       ]);
    //    dd($data);
       dd(json_decode($data['Item']['data']['S'],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    public function cms1450_form(Request $request){
        $datas = $request->input('data');
        // dd(json_encode($datas ,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        // dd($datas);
        $table_data =[];
        $datas = $request->input('data');
        
        foreach($datas as &$data){
            if(isset($data['field_name'])){
                $data['field_name'] = preg_replace('!\s+!',' ',$data['field_name']);
            }
        }
        
        $file_name = "CMS1450_".session('account_id') . "_" . time() . date('dm') . ".pdf"; 
  
        $res = API_repository::create_dynamo_entry("cms_1450",[
            'file_name'=>[ "S" => $file_name],
            'user_id'=>[ "S" => session('account_id')],
            'data' => [ "S" => json_encode($datas ,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)]
        ]);
        $request->session()->put('uploaded_cms1450_filename', $file_name);
        return back();
    }
    public function ada_dental(Request $request){
        $datas = $request->input('data');
        // dd(json_encode($datas ,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        // dd($datas);
        $table_data =[];
        $datas = $request->input('data');
        
        foreach($datas as &$data){
            if(isset($data['field_name'])){
                $data['field_name'] = preg_replace('!\s+!',' ',$data['field_name']);
            }
        }
        
        $file_name = "ADA_DENTAL_".session('account_id') . "_" . time() . date('dm') . ".pdf"; 
  
        $res = API_repository::create_dynamo_entry("ada_dental",[
            'file_name'=>[ "S" => $file_name],
            'user_id'=>[ "S" => session('account_id')],
            'data' => [ "S" => json_encode($datas ,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)]
        ]);
        $request->session()->put('uploaded_ada_filename', $file_name);
        return back();
    }


}