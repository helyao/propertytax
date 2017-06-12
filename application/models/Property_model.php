<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/11/2017
 * Time: 11:54 PM
 * This model is used to access mysql with property information
 */

class Property_model extends CI_Model {
    // Fuzzy search full address string by $addr - Used for address auto-complete function
    public function matchAddr($addr) {
        $sql = 'select CONCAT(address, \', \', COALESCE(city_zip, \'\')) as address from tax_prop_info where address like \'%'.$addr.'%\' limit 10';
        $results = $this->db->query($sql)->result();
        return $results;
    }

}