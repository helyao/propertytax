<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/12/2017
 * Time: 12:11 AM
 * Used for sending e-mails to users when sign-up or get back password
 */

class Email_model extends CI_Model {
    private $VERIFY_BASE = 'http://localhost/texas/index.php/home/checklink';
    private $RESET_BASE = 'http://localhost/texas/index.php/home/resetlink';

    // Send Sign-up Email to $email
    public function signupEmail($user, $verify) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.payfairtax.com';
        $config['smtp_port'] = '26';
        $config['smtp_user'] = 'admin@payfairtax.com';
        $config['smtp_pass'] = 'Qwer@1234';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this -> load -> library('email');
        $this->email->initialize($config);
        $this->email->from('admin@payfairtax.com', 'PayFairTax');
        $this->email->to($user);
        $this->email->subject('Your registration on www.payfairtax.com');
        $verifyUrl = $this->VERIFY_BASE.'?email='.urlencode($user).'&verify='.$verify;
        // email/register is template for sign-up email
        $body = $this->load->view('email/register', array('urlstring' => $verifyUrl), TRUE);
        $this->email->message($body);
        if( ! $this->email->send()){    // send failed
            // echo $this->email->print_debugger();
            return false;
        }else{      // send successful
            return true;
        }
    }

    // Send Reset-password Email to $email
    public function resetEmail($user, $verify) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.payfairtax.com';
        $config['smtp_port'] = '26';
        $config['smtp_user'] = 'admin@payfairtax.com';
        $config['smtp_pass'] = 'Qwer@1234';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this -> load -> library('email');
        $this->email->initialize($config);
        $this->email->from('admin@payfairtax.com', 'PayFairTax');
        $this->email->to($user);
        $this->email->subject('Get back password on www.payfairtax.com');
        $verifyUrl = $this->RESET_BASE.'?email='.urlencode($user).'&verify='.$verify;
        // email/register is template for sign-up email
        $body = $this->load->view('email/reset', array('urlstring' => $verifyUrl), TRUE);
        $this->email->message($body);
        if( ! $this->email->send()){    // send failed
            // echo $this->email->print_debugger();
            return false;
        }else{      // send successful
            return true;
        }
    }

}