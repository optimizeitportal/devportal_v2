<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashbordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(session('optimizeit')){
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('root');
Route::get('/opt_out', function () {
    return view('opt_out');
});
Route::post('/send_opt_out', function () {
    //  dd($_POST['email']);
    // $response = Http::post(env('DOCUMENT_STATUS_UPDATE_URL'),[
    //     'TableName'=>'opt_out_email_master',
    //     'Item'=>[
    //         'email_id'=>['S'=>$_POST['email'] ],
    //         'file_status'=>['S'=>"no"],
    //     ]
    // ]);
    // dd($response->body());
    // if($response->getStatusCode() !== 200 ){
    //     return back()->withErrors('error',"Somthing Went Wrong");
    // }
    return back();
});
Route::get('signup', function () {
    if(session('optimizeit')){
        return redirect('/dashboard');
    }
    return view('auth.register');
});
Route::get('verify', function () {
    if(session('optimizeit')){
        return redirect('/dashboard');
    }
    return view('auth.confirm');
});
Route::get('forgotpassword', function () {
    if(session('optimizeit')){
        return redirect('/dashboard');
    }
    return view('auth.forget_password');
});
Route::get('view-token', function () {
    echo 'ID Token: .<br>';
    echo session('cogidtk');
});
Route::post('login','UserController@login');
Route::post('register','UserController@register')->name('register');
Route::get('logout', 'UserController@logout');
Route::post('confirmation', 'UserController@confirmation');
Route::post('forgot_password_code', 'UserController@forgot_password_code');
Route::post('password_code_verify', 'UserController@password_code_verify');
Route::group(['middleware'=>"isLogin"],function () {
    // dashboard
    Route::get('dashboard', [DashbordController::class,'dashborad']);
    // Route::get('dashboard', function () {
    //     return view('dashboard');
    // });
    Route::get('analyze', function () {
        return view('analyze');
    });
    Route::post('get_uploaded_fileList',[DashbordController::class,'get_uploadedList_component']);

    // doc_verify
    Route::get('doc_verify', 'Doc_verifyController@doc_verify');
    Route::post('get_image', 'Doc_verifyController@get_image');
    Route::post('get_rawtext', 'Doc_verifyController@get_rawtext');
    Route::post('get_formdata', 'Doc_verifyController@get_forms');
    Route::post('get_tabledata', 'Doc_verifyController@get_table');
    Route::post('get_reports', 'Doc_verifyController@get_reports');
    Route::post('upload_document', 'Doc_verifyController@uploadDocument');
    Route::post('check_document_status', 'Doc_verifyController@check_document_status');
    Route::get('download_document', 'Doc_verifyController@download_document');
    Route::post('send_forms', 'Doc_verifyController@send_forms');
    Route::post('send_tables', 'Doc_verifyController@send_tables');
    Route::get('delete_account','UserController@deleteAccount');

    Route::post('cms1500_form','FormsController@cms1500_form');
    Route::get('chatbot','Doc_verifyController@chatbot');
    Route::get('get_cms1500','FormsController@get_cms1500_json');
    Route::get('cms1500', function () {
        return view('forms.cms_form');
    });

    Route::post('cms1450_form','FormsController@cms1450_form');
    Route::post('Ada_form','FormsController@ada_dental');
    Route::get('cms1450', function () {
        return view('forms.cms1450');
    });
    Route::get('ada_dental', function () {
        return view('forms.Ada_dental');
    });





});

Route::get('fake_login',function () {
    $array = [
        "login_time" => 1693307841,
        "ExpiresIn" => 3600,
        "cogidtk" => "eyJraWQiOiJMTFJLeGk5NExrZDFVaU1sTHdLN241WWNPUDd4ZWt4bzlqd2JzNFgwSnI4PSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiI4MjU2ZjYyZC04MWM1LTQzNGEtOWM2Yy03NDJhMDUyZWZlZmQiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfdHl6Z0FjbUJGIiwiY29nbml0bzp1c2VybmFtZSI6IjgyNTZmNjJkLTgxYzUtNDM0YS05YzZjLTc0MmEwNTJlZmVmZCIsIm9yaWdpbl9qdGkiOiI1MDRkYjQ2Yi0xZjE4LTQzOTYtOGQxYy05MDg4YjBhYWZkMDQiLCJhdWQiOiIxbzZ2NWIzM2o4NzdoY2JiamQxb25iMnNpcSIsImV2ZW50X2lkIjoiNDBjYzY3ZDMtMjJkMS00NjA4LWFmMmItZTQzMWJjMjg4MTA2IiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE2OTMzMDc4NDEsIm5hbWUiOiJzdXJ5YSIsImV4cCI6MTY5MzMxMTQ0MSwiaWF0IjoxNjkzMzA3ODQxLCJqdGkiOiIwYjMzMTM0Ny1kYzdkLTQ4MDQtYTBmNS1lNjk2NGMyYjE2NTIiLCJlbWFpbCI6InNiYWxha3Jpc2huYW5Ab3B0aW1pemVpdC5haSJ9.gMTFtXWJ3mTfkdEU9rF0P3eEfd7CtOBnQoORWO0d4ItK5TmH_uzI00CKGoGlj-YaJspNjFTNALLiKgiA6atWTJV-Vx3_xua4ZtzRzoX1y7jQPraQJHjfI5omAaAJ_6l_Iji9SN2tmSF1gB-4N4oU0ScCEkzsU3X8Z9ZlgJ-bUMDV4EjMfO1-F2K9KqM8f5HhxgOCOq5N5B5CO7G9F1DXUdV-T8WX45_FBVJOBOxZER7bhiSmSVeKtJVqikp2RJA_Ja141yi8I4UCvDUcMsyYDazWVVvfSzbX7HeV2eX1Tp0ZMdbjF2D_w9w-ZV-Un929khdRUIxvb0JNrRb26eZu6w",
        "optimizeit" => "eyJraWQiOiJBdEFcL2xaRVpPWDZpSmwyUCtsY0RWejl6RkZoK3FPZ3NvQkxKNSswcm15Yz0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiI4MjU2ZjYyZC04MWM1LTQzNGEtOWM2Yy03NDJhMDUyZWZlZmQiLCJpc3MiOiJodHRwczpcL1wvY29nbml0by1pZHAudXMtZWFzdC0xLmFtYXpvbmF3cy5jb21cL3VzLWVhc3QtMV90eXpnQWNtQkYiLCJjbGllbnRfaWQiOiIxbzZ2NWIzM2o4NzdoY2JiamQxb25iMnNpcSIsIm9yaWdpbl9qdGkiOiI1MDRkYjQ2Yi0xZjE4LTQzOTYtOGQxYy05MDg4YjBhYWZkMDQiLCJldmVudF9pZCI6IjQwY2M2N2QzLTIyZDEtNDYwOC1hZjJiLWU0MzFiYzI4ODEwNiIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoiYXdzLmNvZ25pdG8uc2lnbmluLnVzZXIuYWRtaW4iLCJhdXRoX3RpbWUiOjE2OTMzMDc4NDEsImV4cCI6MTY5MzMxMTQ0MSwiaWF0IjoxNjkzMzA3ODQxLCJqdGkiOiI3YjE4MTcxNS0wYmU2LTRlYzAtYjFmNy1lMDZiNmFhM2E4NzciLCJ1c2VybmFtZSI6IjgyNTZmNjJkLTgxYzUtNDM0YS05YzZjLTc0MmEwNTJlZmVmZCJ9.wL2r0nRHZYmSJmo3BFcdVCaWTtxMgVFvTQvT3qZiHJtk51xTxXIOFQAgcigN2pb1TvmafwX27DXUWtimoBMVBz6vo82w6vZHrIpz3ljBVvq-VilJgam_Edurt24g6b23NKFiPc3e0bVQK5p5lMQTKkEORIe8_LTskgSUvw3v-fc8gy_zA7fjKqEe5yUfVO7W8y8eMF5rvwn_fVPB-SotwtIqtw0BauuUJKywwYZCXc5qByQUDN9zpuZbR4QmlxrX0ccwofls2kkqdCN_Nv2t9f24F2C3oWTLWzFVlj7fTab5Zo5h-4QHpT7uokUZ97UBLfpnozxAOizPdaHcJpDZdg",
        "user_id" => "8256f62d-81c5-434a-9c6c-742a052efefd",
        "user_organization" => "optimizeit",
        "user_email" => "sbalakrishnan@optimizeit.ai",
        "onboard_date" => "2023-04-13",
        "account_id" => "2eJICUv8",
        "user_status" => "CONFIRMED",
        "user_name" => "surya",
    ];
    foreach($array as $k => $v){
        session()->put($k,$v);
    }
    return redirect('/');
});

