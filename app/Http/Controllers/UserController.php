<?php

namespace App\Http\Controllers;

use App\ApiModels\API_repository;
use App\ApiModels\AWSCognitoWrapper as AWS;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     *
     * Function : login()
     * Param    : Request $request
     * Purpose  : validate login information and navigate to dashboard if valid
     * Return   : if valid go to dashboard or show errors.
     *
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); //validation

        $error = AWS::authenticate($request->email, $request->password); // To check login credentials and login
        if (empty($error)) {
            $user = AWS::getUser(); // get the Logged in cognito User details
            $user_details = API_repository::user_details($user[0]['Value']); //load the User details
            foreach ($user_details['Item'] as $key => $val) {
                session()->put($key, $val['S']); //Save the user details in session
            }
            return redirect('dashboard');

        }elseif(trim($error) == 'User is not confirmed.'){ //To Check the Loggdin User is Confirmed
           $err = AWS::resendCode($request->email); // resend the Conformation code to  mail
           session()->put('optpwd', $request->password); // save password in session. for While signup has completed, user will be Logged in.

           return redirect('/verify?email='.$request->email);
        }
        return back()->withErrors(['error' => $error]);
    }



    /**
     *
     * Function : register()
     * Param    : Request $request
     * Purpose  : To validate business email and signup the user.
     * Return   : if valid go to conformation or show errors;
     *
     */
    public function register(Request $request)
    {
        // validation
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $arrayval = array('gmail', 'yahoo', 'hotmail', 'live', 'aol', 'outlook', 'proton', 'zoho', 'icloud', 'gmx');
        $spem = @explode("@", $request->email);
        $dotsp = @explode(".", $spem[1]);
        $emsp = strtolower($dotsp[0]);

        // Check Business Eamil
        if (in_array($emsp, $arrayval)) {
            $emailerr = "A valid business email is required to sign-up.";
            return back()->withErrors(['email_error' => $emailerr]);
        }
        //sign up
        $error = AWS::signup($request->username, $request->email, $request->password);

        if (empty($error)) {
            // save password when confirmation success user will be authenticated.
            session()->put('optpwd', $request->password); // save password in session. for While signup has completed, user will be Logged in.

            return redirect('/verify?email='.$request->email);
        }
        return back()->withErrors(['error' => $error]);
    }

    /**
     *
     * Function : confirmation()
     * Param    : Request $request
     * Purpose  : To Check the conformation code for signup.
     * Return   : if valid go to dashboard or show errors;
     *
     */
    public function confirmation(Request $request)
    {
        // Check conformation code
        $error = AWS::confirmSignup($request->get('email'), $request->confirmation);

        if (empty($error)) { //conformation code is valid.
           $error1 = AWS::authenticate($request->get('email'), session('optpwd')); // To check login credentials and login
            if (empty($error1)) {
                $user = AWS::getUser(); // get the Logged in cognito User details
                $user_details = API_repository::user_details($user[0]['Value']);
                foreach ($user_details['Item'] as $key => $val) {
                    session()->put($key, $val['S']);
                }
            }
            return redirect('/dashboard');
        }
        return back()->withErrors(['error' => $error]);
    }

    /**
     *
     * Function : confirmation()
     * Param    : Request $request
     * Purpose  : Send conformation code to mail for forgot password .
     * Return   : if valid go to forgot conformation page or show errors;
     *
     */
    public function forgot_password_code(Request $request)
    {
        // Send conformation Code to Mail
        $error = AWS::sendPasswordResetMail($request->get('email'));
        if (empty($error)) {
            return redirect('/forgotpassword?email='.$request->get('email'))->with('enter_code',1);
        }
        return back()->withErrors(['error' => $error]);
    }

    /**
     *
     * Function : password_code_verify()
     * Param    : Request $request
     * Purpose  : To check the conformation for forgot password .
     * Return   : if valid go to dashboard or show errors;
     *
     */
    public function password_code_verify(Request $request)
    {
        $code = $request->code ?? '';
        $password = $request->password ?? '';
        $username = $request->username ?? '';
        // reset Password
        $error = AWS::resetPassword($code, $password, $username);
        if (empty($error)) {

            return redirect('/dashboard');
        }
        return back()->withErrors(['error' => $error]);
    }

    /**
     *
     * Function : logout()
     * Param    : Request $request
     * Purpose  : For Logout.
     * Return   : go to Login page;
     *
     */
    public function logout()
    {
        session()->forget('optimizeit');
        session()->forget('cogidtk');
        session()->flush();
        return redirect('/');
    }
}
