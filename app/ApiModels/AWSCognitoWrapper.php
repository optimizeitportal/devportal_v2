<?php
namespace App\ApiModels;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class AWSCognitoWrapper
{

    private const SES_NAME = 'optimizeit';
    private const TOKEN_NAME = 'cogidtk';

    private static $region;
    private static $client_id;
    private static $userpool_id;

    private static $client;

    private static $user = null;

    /**
     * Function : initialize()
     * Purpose  : initialize the region,client id , userpool id and client.
     * Return   : void.
     */
    public static function initialize(): void
    {
        self::$region = env('AWS_REGION');
        self::$client_id = env('AWS_CLIENT_ID');
        self::$userpool_id = env('AWS_USER_POOL_ID');

        self::$client = new CognitoIdentityProviderClient([
            'version' => '2016-04-18',
            'region' => self::$region,
        ]);

        try {
            self::$user = self::$client->getUser([
                'AccessToken' => self::getAuthenticationSession(),
            ]);

        } catch (\Exception $e) {
            // an exception indicates the accesstoken is incorrect - self::$user will still be null
        }
    }

    /**
     * Function : authenticate()
     * Param    : $username, $password
     * Purpose  : To check auth credentials and login
     * Return   : null|errors.
     */
    public static function authenticate(string $username, string $password): string
    {
        self::initialize();
        try {
            $result = self::$client->InitiateAuth([
                'AuthFlow' => 'USER_PASSWORD_AUTH',
                'ClientId' => self::$client_id,
                'UserPoolId' => self::$userpool_id,
                'AuthParameters' => [
                    'USERNAME' => $username,
                    'PASSWORD' => $password,
                ],
            ]);

        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); //error message
        }
        session()->put('login_time',time()); // To save user logged in time in session.
        session()->put('ExpiresIn',$result->get('AuthenticationResult')['ExpiresIn']);// To auth exprire time in session.
        self::setAuthToken($result->get('AuthenticationResult')['IdToken']);
        self::setAuthenticationSession($result->get('AuthenticationResult')['AccessToken']);

        return '';
    }

    /**
     * Function : signup()
     * Param    :  $username,  $email,  $password
     * Purpose  : To save the user details in cognito.
     * Return   : null|errors.
     */
    public static function signup(string $username, string $email, string $password): string
    {
        self::initialize();
        try {
            $result = self::$client->signUp([
                'ClientId' => self::$client_id,
                'Username' => $email,
                'Password' => $password,
                'UserAttributes' => [
                    [
                        'Name' => 'name',
                        'Value' => $username,
                    ],
                    [
                        'Name' => 'email',
                        'Value' => $email,
                    ],
                ],
            ]);
        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); // error message
        }

        return '';
    }

    /**
     * Function : confirmSignup()
     * Param    : $username,  $code
     * Purpose  : To check the conformation code is valid.
     * Return   : null|errors.
     */
    public static function confirmSignup(string $username, string $code): string
    {
        self::initialize();
        try {
            $result = self::$client->confirmSignUp([
                'ClientId' => self::$client_id,
                'Username' => $username,
                'ConfirmationCode' => $code,
            ]);
        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); // error message
        }

        return '';
    }

    /**
     * Function : resendCode()
     * Param    : $username,  $code
     * Purpose  : To resend the conformation code to mail.
     * Return   : null|errors.
     */
    public static function resendCode(string $username): string
    {
        self::initialize();
        try {
            $result = self::$client->resendConfirmationCode([
                'ClientId' => self::$client_id,
                'Username' => $username,
            ]);
        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); // error message
        }

        return '';
    }

    /**
     * Function : getAuthenticationSession()
     * Purpose  : To get the logged in user access token from session.
     * Return   : null|errors.
     */
    private static function getAuthenticationSession(): string
    {
        return session('optimizeit') ?? '';
    }

    /**
     * Function : sendPasswordResetMail()
     * Param    : $username
     * Purpose  : send the forgot password code to mail.
     * Return   : null|errors.
     */
    public static function sendPasswordResetMail(string $username): string
    {
        self::initialize();
        try {
            self::$client->forgotPassword([
                'ClientId' => self::$client_id,
                'Username' => $username,
            ]);
        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); // error message
        }

        return '';
    }

    /**
     * Function : resetPassword()
     * Param    : $code, $password, $username
     * Purpose  : To check conformation code for forgot password and change password.
     * Return   : null|errors.
     */
    public static function resetPassword(string $code, string $password, string $username): string
    {
        self::initialize();
        try {
            self::$client->confirmForgotPassword([
                'ClientId' => self::$client_id,
                'ConfirmationCode' => $code,
                'Password' => $password,
                'Username' => $username,
            ]);
        } catch (\Exception$e) {
            return $e->getAwsErrorMessage(); // error message
        }

        return '';
    }

    /**
     * Function : setAuthenticationSession()
     * Purpose  : Save the access token in session.
     * Return   : null|errors.
     */
    private static function setAuthenticationSession(string $accessToken): void
    {
        session()->put('optimizeit',$accessToken);
    }

    /**
     * Function : setAuthToken()
     * Purpose  : Save the Auth token in session.
     * Return   : null|errors.
     */
    private static function setAuthToken(string $idToken): void
    {
        session()->put('cogidtk', $idToken);
    }

    /**
     * Function : getAuthToken()
     * Purpose  : get the Auth token from session.
     * Return   : null|errors.
     */
    private static function getAuthToken(): string
    {
        return session('cogidtk') ?? '';
    }

    /**
     * Function : isAuthenticated()
     * Purpose  : Check the user is authenticated.
     * Return   : null|errors.
     */
    public static function isAuthenticated(): bool
    {
        self::initialize();
        return null !== self::$user;
    }

    /**
     * Function : getUser()
     * Purpose  : get the athenticated user details.
     * Return   : null|errors.
     */
    public static function getUser(): array
    {
        self::initialize();
        return self::$user["UserAttributes"];
    }


}
