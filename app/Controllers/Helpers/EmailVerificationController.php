<?php 

namespace App\Controllers\Helpers;
require FCPATH . '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Controllers\BaseController;

class EmailVerificationController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    protected $sender = "jlnbrrnts32029@gmail.com";  //jlnbrrnts32029@gmail.com    
    protected $passkey = "fvkd ifio hrxt xtxe";


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- THIS PREVENTS LOADING MODELS AND MEMORY ISSUES ----- ##
## call this methods to load models
    // generating a random int number for verification code, then setting it temporarily in session for future access and use
    // then redirects to emailVerification() method
    public function sendEmailVerification($email){
        $token1 = rand(0, 999);
        $token2 = rand(0, 999);
        $verification = $token1 . $token2;
        $this->load->session->set([
            'verification' => $verification,
            'verification_expiry' => time() + 180 
        ]);            
        return $this->emailVerification($email, $verification);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## send email
    // setting email configuration before sending an email to the reciepient, then redirects to verificationpage() method
    private function emailVerification($email, $verification) {
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $this->sender;            
            $mail->Password   = $this->passkey;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                  
        
            //Recipients
            $mail->setFrom('flaviano.chriswendell105@gmail.com', 'Mailer');
            $mail->addAddress($email, 'INM-AUDIO email verification');     
        
            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'INM-AUDIO email verification';
            $mail->Body    = '<h3>' . $verification . '</h3> &nbsp; this is your verification code';
            $mail->AltBody = $verification . ' this is your verification code';

            $mail->send();
            return $this->verificationpage();
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## render page - verification page
    public function verificationPage() {
        return view('UserSide/verification');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check verification code
    ## check what type of account
    // check what type of account are trying to signup (admin or user), 
    // then redirects to Login_SignupController::checkIfVerificationCodeIsValid() method or redirects to AdminController::checkIfVerificationCodeIsValid() method
    public function checkAccount(){
        $this->load->requireMethod('logResCon');
        $this->load->requireMethod('homeCon');
        $this->load->requireMethod('adminCon');

        $verificationCode = $this->request->getPost('code');
        if($this->load->session->get('signupAccountType') == "admin_admin" || $this->load->session->get('signupAccountType') == "admin_user") {
            return $this->load->adminCon->checkIfVerificationCodeIsValid($verificationCode);
        }
        else if($this->load->session->get('signupAccountType') == "user") {
            return $this->load->logResCon->checkIfVerificationCodeIsValid($verificationCode);
        }
        else if($this->load->session->has('resetPassFor')) {
            return $this->load->logResCon->verifyCode($verificationCode);
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## resend verification code
    // resends verification code if time = 5 mins is greater than the current time, then redirects to verificationPage::verificationPage() method
    public function resendVerificationCode(){
       
        $expiryTime = $this->load->session->get('verification_expiry');
        if (time() >= $expiryTime) {
            $email = $this->load->session->get('email');
            if($this->load->session->get('resetPassFor')) {
                $this->sendEmailVerification($this->load->session->get('emailToReset'));
            }else {
                $this->sendEmailVerification($email);
            }
            
            $this->load->session->setFlashdata('success', 'A new verification email has been sent to '. $email);
        } else {
            $this->load->session->setFlashdata('userError', 'Please wait 5 mins before resending another verification code.');
        }   
        return redirect()->to('/account/verify-email');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## send notif that the password is successfully reset
    public function sendNotifPaswordReset() {
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $this->sender;  //jlnbrrnts32029@gmail.com               
            $mail->Password   = $this->passkey;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                  
        
            //Recipients
            $mail->setFrom('flaviano.chriswendell105@gmail.com', 'Mailer');
            $mail->addAddress($this->load->session->get('emailToReset'), 'INM-AUDIO email verification');     
        
            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'INM-AUDIO';
            $mail->Body    = 'Password Successfully reset';
            $mail->AltBody = 'Password Successfully reset';

            $mail->send();
            return $this->verificationpage();
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## sends an email if order is successfully placed
    public function sendNotifOrderPlaced($email) {
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $this->sender;  //jlnbrrnts32029@gmail.com               
            $mail->Password   = $this->passkey;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                  
        
            //Recipients
            $mail->setFrom($this->sender, 'Mailer');
            $mail->addAddress($email, 'INM-AUDIO email verification');     
        
            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'INM-AUDIO';
            $mail->Body    = 'ORDER PLACED - waiting for confirmation';
            $mail->AltBody = 'ORDER PLACED - waiting for confirmation';

            $mail->send();
            return redirect()->to('/donePurchase');
    }
}