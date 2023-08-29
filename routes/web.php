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
        "login_time" => 1693303062,
        "ExpiresIn" => 3600,
        "cogidtk" => "eyJraWQiOiJMTFJLeGk5NExrZDFVaU1sTHdLN241WWNPUDd4ZWt4bzlqd2JzNFgwSnI4PSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiI4MjU2ZjYyZC04MWM1LTQzNGEtOWM2Yy03NDJhMDUyZWZlZmQiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfdHl6Z0FjbUJGIiwiY29nbml0bzp1c2VybmFtZSI6IjgyNTZmNjJkLTgxYzUtNDM0YS05YzZjLTc0MmEwNTJlZmVmZCIsIm9yaWdpbl9qdGkiOiJiNmJlZWNlNi1mM2U1LTQxZTktOWVjZC03NzZhMWIwNzk4NDgiLCJhdWQiOiIxbzZ2NWIzM2o4NzdoY2JiamQxb25iMnNpcSIsImV2ZW50X2lkIjoiMzQ0ZDExY2MtYzE3ZC00OThhLTkzYWEtNjIwNGYxYjUyYTRlIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE2OTMzMDMwNjIsIm5hbWUiOiJzdXJ5YSIsImV4cCI6MTY5MzMwNjY2MiwiaWF0IjoxNjkzMzAzMDYyLCJqdGkiOiI1YzI0YjU1ZC0xOWZkLTRlZDAtODRhMC03MTNiMTUzOWI4ZjYiLCJlbWFpbCI6InNiYWxha3Jpc2huYW5Ab3B0aW1pemVpdC5haSJ9.PvTyKwTbX7gx31cqApTtd6c7eCxVzCYOeHVM3djlXFbdpSsgeH_2Gm0FB8tJY2LUcvtz6v4mokRV1JZvPQXlU3TFBFsz6hdqFla1hlmK_lg6ghEsA52H7oqseslfFFGhCjtxeJHGaD_GXoJzncaxruzPX1jF-dymt2sEDGnGdXbhpHaafNgIq_qfokHs8J__Jjtx-JoZ2lI4RghH27cWZZbHLi-Jtls-5g5PLXr1AB-Jhgy6sXnLgsruXCCecG3_cQcUdFCFu42c-Ij1MyHJvx47wcmiTFr6rHYD4xJsHs80K1r1Bs5Cy_4HYV7mNAOpj6vsPvsHA77iRIWQHIhGFw",
        "optimizeit" => "eyJraWQiOiJBdEFcL2xaRVpPWDZpSmwyUCtsY0RWejl6RkZoK3FPZ3NvQkxKNSswcm15Yz0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiI4MjU2ZjYyZC04MWM1LTQzNGEtOWM2Yy03NDJhMDUyZWZlZmQiLCJpc3MiOiJodHRwczpcL1wvY29nbml0by1pZHAudXMtZWFzdC0xLmFtYXpvbmF3cy5jb21cL3VzLWVhc3QtMV90eXpnQWNtQkYiLCJjbGllbnRfaWQiOiIxbzZ2NWIzM2o4NzdoY2JiamQxb25iMnNpcSIsIm9yaWdpbl9qdGkiOiJiNmJlZWNlNi1mM2U1LTQxZTktOWVjZC03NzZhMWIwNzk4NDgiLCJldmVudF9pZCI6IjM0NGQxMWNjLWMxN2QtNDk4YS05M2FhLTYyMDRmMWI1MmE0ZSIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoiYXdzLmNvZ25pdG8uc2lnbmluLnVzZXIuYWRtaW4iLCJhdXRoX3RpbWUiOjE2OTMzMDMwNjIsImV4cCI6MTY5MzMwNjY2MiwiaWF0IjoxNjkzMzAzMDYyLCJqdGkiOiI3NWYwY2E3MC0yZWNmLTQzZjctYjFlNy04ODE1MjNhMzc4MDMiLCJ1c2VybmFtZSI6IjgyNTZmNjJkLTgxYzUtNDM0YS05YzZjLTc0MmEwNTJlZmVmZCJ9.wMzetoDWCG5dhA64IJ4-znV5xvOcnPmGrSMgspW4nDvyUzWGHpun1ghymBqbSb9VOPS_c2DSsdDxIiX5FYv56qGapaTCcTGJktoDtPXhCjsDx4Z75LqRldoPM5p-qg9Q05IIUGyBA1epxMFRF958YElm6H3W1Ezq2dK8JGFWzxtSH3QF5Bq9UXq3k5xePXSFQGmuCp2EukjHkme6H33OkRRRq0R4lDyqVgDlyn39HMY6xfF-KM3nLT3zwPWLLqNuRV9uKQyq5DCcWBWCKJs2bbJgoSg2OAtTizHIu6pOgMw9eY7zMRutC3tZqjqyV0Kjym_qGL1DcM3q5d4jD-CDQA",
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

