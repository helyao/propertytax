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

    // Just for test, need delete when release version
    public function emailsuccess() {    // When sign-up email is sent successfully
        $this->load->view('login/emailsuccess', array('email' => 'helyao@qq.com'));
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
    public function verify() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', array('required', 'max_length[50]', 'alpha_dash'));
        $this->form_validation->set_rules('password', 'password', array('required', 'min_length[6]', 'max_length[50]'));

        if (!$this->form_validation->run()) {
            // failed
            echo validation_errors();
        }
        else {
            // success
            echo 'Username = '.$_POST['username'];
            echo 'Password = '.$_POST['password'];
        }
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
        for ($i = 0; $i < 32; $i++) {
            $verifyStr .= chr(mt_rand(32, 126));
        }
        $verifyStr = urlencode($verifyStr);
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
            // echo 'Email has been sent, please login your email to verify.';
            // $emailaddr = 'mail.'.explode('@', $email)[1];
            $this->load->view('login/emailsuccess', array('email' => $email));
        }
        else {
            // Email sent failed
            // $this->load->view('login/emailfailed');
            // echo 'Email sent failed.';
        }
    }

    // Used for verify sign-up Email
    public function checklink() {
        $email = $_GET['email'];
        $verify = $_GET['verify'];
        echo 'email = '.urldecode($email).' & verify = '.$verify;
    }

}