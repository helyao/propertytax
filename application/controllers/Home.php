<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/29/2017
 * Time: 1:12 PM
 */

//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Methods: GET, OPTIONS");

class Home extends CI_Controller {

    // ------ Pages ------
    // main page
    public function index() {
        $this->load->view('home/index');
    }

    // login, get back password, sign-up page
    public function login() {       // Login
        $this->load->view('login/login');
    }
    public function forgot() {      // Password Get-back
        $this->load->view('login/forgot');
    }
    public function signup() {      // Sign up
        $this->load->view('login/signup');
    }

    // email sent successfully
    public function emailsuccess() {    // When sign-up email is sent successfully
//        $username = $this->input->post('hidusernm');
//        $password = $this->input->post('hidpasswd');
        $email = $this->input->post('hidemail');
        $this->load->view('login/emailsuccess', array('email' => $email));
    }

    // reset password successfully
    public function resetsuccess() {
        $this->load->view('login/resetsuccess');
    }

    // ------ APIs ------
    // autocomplete address info
    public function autocomplete() {
        $this->load->model('Property_model');
        $res = $this->Property_model->matchAddr($_GET['term']);
        foreach ($res as $row) {
            $data[] = $row->address;
        }
        echo json_encode($data);
    }

    // user authentication
    public function userLogin() {
        $this->load->model('Auth_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', array('required', 'max_length[50]', 'alpha_dash'));
        $this->form_validation->set_rules('password', 'password', array('required', 'min_length[6]', 'max_length[50]'));

        if (!$this->form_validation->run()) {
            // failed
//            echo validation_errors();
            echo false;
        }
        else {
            // success
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $userId = $this->Auth_model->resolveUserLogin($username, $password);

            if ($userId > 0) {
                $_SESSION['userid'] = (int)$userId;
                $_SESSION['username'] = (string)$username;
                $_SESSION['loggin'] = (bool)true;

                echo true;
            }
            else {
                echo false;
            }
        }
    }

    public function test() {
        echo 'username = '.$_SESSION['username'];
    }

    // username unique judge
    public function uniqueName() {
        $name = $_GET['user'];
        $this->load->model('Auth_model');
        echo $this->Auth_model->uniqueUsername($name);
    }

    // email unique judge
    public function uniqueEmail() {
        $email = $_GET['email'];
        $this->load->model('Auth_model');
        echo $this->Auth_model->uniqueEmail($email);
    }

    // user sign-up handler
    public function newuser() {
        $this->load->model('Auth_model');
        $this->load->model('Email_model');
        # Step1: Get form data
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        # Step2: Restore form data
        $userinfo = array(
            'username' => $username,
            'password' => $password,
            'email' => $email
        );
        $this->Auth_model->insertNewUser($userinfo);
        # Step3: Insert Verification Information
        $verifyStr = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for ($i = 0; $i < 32; $i++) {
            $verifyStr .= $chars[mt_rand(0, (strlen($chars)-1))];
        }
        $nowstamp = new DateTime();
        $verifyinfo = array(
            'email' => $email,
            'create_on' => $nowstamp->format('Y-m-d H:i:s'),
            'verify_string' => $verifyStr
        );
        $this->Auth_model->insertVerifyStr($verifyinfo);
        # Step4: Send Verification Email and Jump to E-mail Sent Status page
        $flagEmail = $this->Email_model->signupEmail($email, $verifyStr);
        if ($flagEmail) {
            // Email sent successfully
            echo true;
        }
        else {
            // Email sent failed
            echo false;
        }
    }

    // Get back user's password
    public function resetPassword() {
        $this->load->model('Auth_model');
        $this->load->model('Email_model');
        # Step1: Get form data
        $email = $_POST['email'];
        # Step2: Insert Verification Information
        $verifyStr = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for ($i = 0; $i < 32; $i++) {
            $verifyStr .= $chars[mt_rand(0, (strlen($chars)-1))];
        }
        $nowstamp = new DateTime();
        $verifyinfo = array(
            'email' => $email,
            'create_on' => $nowstamp->format('Y-m-d H:i:s'),
            'verify_string' => $verifyStr
        );
        $this->Auth_model->insertVerifyStr($verifyinfo);
        # Step3: Send Verification Email and Jump to E-mail Sent Status page
        $flagEmail = $this->Email_model->resetEmail($email, $verifyStr);
        if ($flagEmail) {
            // Email sent successfully
            echo true;
        }
        else {
            // Email sent failed
            echo false;
        }
    }

    // Set new password
    public function newpasswd() {
        $this->load->model('Auth_model');
        # Step1: Get form data
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $verify = $_POST['verify'];
        # Step2: update password
        if($this->Auth_model->updatePassword($email, $password, $verify)) {
            echo true;
        }
        else {
            echo false;
        }
    }

    // Used for verify sign-up Email
    public function checklink() {
        $this->load->model('Auth_model');
        $email = urldecode($_GET['email']);
        $verify = $_GET['verify'];
//        echo 'email = '.$email.' & verify = '.$verify;
        if ($this->Auth_model->logupVerifyCheck($email, $verify)) {
            $this->load->view('login/verifysuccess');
        }
        else {
            echo 'Failed, please retry it.';
        }
    }

    // Used for verify reset password Email
    public function resetlink() {
        $this->load->model('Auth_model');
        $email = urldecode($_GET['email']);
        $verify = $_GET['verify'];
        if ($this->Auth_model->resetVerifyCheck($email, $verify)) {
            $username = $this->Auth_model->getUsername($email);
            $this->load->view('login/resetpassword', array('username' => $username, 'email' => $email, 'verify' => $verify));
        }
        else {
            echo 'Failed, please retry it.';
        }
    }
}