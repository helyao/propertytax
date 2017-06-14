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

    // Check log-up verification string
    public function logupVerifyCheck($email, $verify) {
        // Step1. Check whether the email and verfiy is existed
        $exist = $this->db->select('count(*) as num')->from('tax_verify')->where(array('email' => $email, 'verify_string' => $verify))->get();
        if ($exist->result()[0]->num > 0) {     // find verify information
            // Step2. Update the verify flag in verify table
            $this->db->update('tax_verify', array('verified' => 1), array('email' => $email));
            // Step3. Update the verify flag and timestamp in user table
            $nowstamp = new DateTime();
            $this->db->update('tax_user', array('verified' => 1, 'last' => $nowstamp->format('Y-m-d H:i:s')), array('email' => $email));
            // Step4. Return true
            return true;
        }
        else {
            return false;
        }
    }

    // Check reset password verification string, verified means that have passed check but no reset already.
    public function resetVerifyCheck($email, $verify) {
        // Step1. Check whether the email and verfiy is existed
        $exist = $this->db->select('count(*) as num')->from('tax_verify')->where(array('email' => $email, 'verify_string' => $verify))->get();
        if ($exist->result()[0]->num > 0) {     // find verify information
            // Step2. Update the verify flag in verify table
            $this->db->update('tax_verify', array('verified' => 2), array('email' => $email));
            // Step3. Return true
            return true;
        }
        else {
            return false;
        }
    }

    // Get Username by E-mail address
    public function getUsername($email) {
        $res = $this->db->select('username')->from('tax_user')->where('email', $email)->get();
        if($res->num_rows() > 0) {
            return $res->result()[0]->username;
        }
        else {
            return null;
        }
    }

    // Update password with verification
    public function updatePassword($email, $password, $verify) {
        // Step1. Check whether the email and verfiy is existed
        $exist = $this->db->select('count(*) as num')->from('tax_verify')->where(array('email' => $email, 'verify_string' => $verify, 'verified' => 2))->get();
        if ($exist->result()[0]->num > 0) {     // find verify information
            // Step2. Update the verify flag in verify table
            $this->db->update('tax_verify', array('verified' => 1), array('email' => $email));
            // Step3. Update password in user table
            $this->db->update('tax_user', array('password' => $password), array('email' => $email));
            // Step4. Return true
            return true;
        }
        else {
            return false;
        }
    }

}