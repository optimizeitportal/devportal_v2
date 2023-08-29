<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('dashboard1', [DashbordController::class,'dashborad']);
    Route::get('dashboard', function () {
        return view('dashboard1');
    });
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
