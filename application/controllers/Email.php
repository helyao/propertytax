<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/1/2017
 * Time: 12:43 PM
 */

class Email extends CI_Controller {
    public function test() {
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
        $this->email->from('admin@payfairtax.com', 'payfairtax.com');
        $this->email->to('18612455872@163.com');
        $this->email->subject('Your registration on www.payfairtax.com');
        $data = array(
            'urlstring' => 'www.baidu.com'
        );
        $body = $this->load->view('email/register', $data, TRUE);
        $this->email->message($body);
        if( ! $this->email->send()){
            echo $this->email->print_debugger();
        }else{
            echo 'ok';
        }
    }

}