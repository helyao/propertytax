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
//        $username = $this->input->post('hidusernm');
//        $password = $this->input->post('hidpasswd');
        $email = $this->input->post('hidemail');
        $this->load->view('login/emailsuccess', array('email' => $email));
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


    // Just for test
    public function test() {
        $this->load->helper(array('form', 'url'));
        $username = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        echo 'email = '.urldecode($email).' & username = '.$username.' & password = '.$password;
    }

    // Used for verify sign-up Email
    public function checklink() {
        $this->load->model('Auth_model');
        $email = urldecode($_GET['email']);
        $verify = $_GET['verify'];
        echo 'email = '.$email.' & verify = '.$verify;
        if ($this->Auth_model->logupVerifyCheck($email, $verify)) {
            echo 'success';
        }
        else {
            echo 'failed';
        }
    }

}