<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/1/2017
 * Time: 5:23 PM
 */

class Prop_model extends CI_Model {

    public function classify($id) {
        $exist = $this->db->select('count(*) as num')->from('tax_prop_info')->where('prop_id', $id)->get();
        if ($exist->result()[0]->num > 0) {
            $compare = $this->db->select('count(*) as num')->from('tax_comp_result')->where('m_prop_id', $id)->get();
            return $compare->result()[0]->num;
        } else {
            return -1;
        }
    }

    public function autocomplete($term) {
        // select CONCAT(address, ', ', COALESCE(city_zip, '')) as address from tax_prop_info where address like '123%' limit 10;
        $sql = 'select CONCAT(address, \', \', COALESCE(city_zip, \'\')) as address from tax_prop_info where address like \''.$term.'%\' limit 10';
        $res = $this->db->query($sql);
        foreach ($res->result() as $row) {
            $data[] = $row['address'];
        }
        return $data;
    }

    public function getSummaryInfo($id) {
        $info = $this->db->select('land_val, total_mid_val, total_aver_mid_val')->from('tax_prop_mid_val')->where('prop_id', $id)->get()->result();
        return $info;
    }

    public function getCompareResult($id) {
        $result = $this->db->select('prop_id, address, grade, living_area, year, appraised_val, land_adj, swim_adj, grade_adj, age_adj, size_adj, other_adj, total_adj, cmp_market_val, value_gap, value_aver_gap')
            ->from('tax_comp_result')->where('id', $id)->order_by('cmp_market_val')->get()->result();
        return $result;
    }

    public function getCompareInfo($id, $arrayId) {
        array_push($arrayId, $id);
        $info = $this->db->select('prop_id, address, city_zip, grade, full_grade, hood_id, year, floor_1_area, floor_2_area, attached, detached, covered_p, open_porc, swim_area, appraised_val, appraised_aver_val, living_area, land_val, imprv_val, swim_val, extra_val')
            ->from('tax_prop_info')->where_in('prop_id', $arrayId)->order_by('appraised_val', 'desc')->get()->result();
        return $info;
    }

}