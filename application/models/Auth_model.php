<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/6/2017
 * Time: 3:09 PM
 */

class Auth_model extends CI_Model {
    // Get the username number in the tax_user table
    public function uniqueUsername($user) {
        $exist = $this->db->select('count(*) as num')->from('tax_user')->where('username', $user)->get();
        return $exist->result()[0]->num;
    }

    // Get the email number in the tax_user table
    public function uniqueEmail($email) {
        $exist = $this->db->select('count(*) as num')->from('tax_user')->where('email', $email)->get();
        return $exist->result()[0]->num;
    }

    // Insert New User Info into tax_user table
    public function insertNewUser($data) {
        $this->db->insert('tax_user', $data);
    }

    // Insert Email Verification Info into tax_verify table
    public function insertVerifyStr($data) {
        $this->db->insert('tax_verify', $data);
    }



}