<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/17/2017
 * Time: 11:46 AM
 */

class Report_model extends CI_Model {
    public function getAddress($id) {
        $sql = 'select address, city_zip from tax_prop_info where prop_id = \''.$id.'\'';
        $res = $this->db->query($sql)->result()[0];
        return $res;
    }

    public function getOverValue($id) {
        $appraised_val = $this->db->select('appraised_val')->from('tax_prop_info')->where('prop_id', $id)->get()->result()[0]->appraised_val;
        $total_mid_val = $this->db->select('total_mid_val')->from('tax_prop_mid_val')->where('prop_id', $id)->get()->result()[0]->total_mid_val;
        return ($appraised_val - $total_mid_val);
    }

    public function getBaseInfo($id) {
        $res = $this->db->select('hood_id, year, full_grade, living_area, appraised_val, appraised_aver_val, land_val, imprv_val, swim_val, extra_val')->from('tax_prop_info')->where('prop_id', $id)->get()->result()[0];
        return $res;
    }

    public function getCountCompare($id) {
        $num = $this->db->select('count(*) as num')->from('tax_prop_info')->where('prop_id', $id)->get()->result()[0]->num;
        return $num;
    }

    public function getSummaryInfo($id) {
        $res = $this->db->select('total_mid_val, total_aver_mid_val')->from('tax_prop_mid_val')->where('prop_id', $id)->get()->result()[0];
        return $res;
    }

    public function getChartInfo($id) {
        $res = $this->db->select('prop_id, appraised_val')->from('tax_comp_result')->where('id', $id)->order_by('appraised_val')->get()->result();
        return $res;
    }

    public function getCompareData($id) {
        $res = $this->db->select('prop_id, address, grade, living_area, year, appraised_val, land_adj, swim_adj, grade_adj, age_adj, size_adj, other_adj, total_adj, cmp_market_val, value_gap, value_aver_gap')
            ->from('tax_comp_result')->where('id', $id)->order_by('appraised_val')->get()->result();
        return $res;
    }

    public function getNeighborBaseData($id) {
        $res1 = $this->db->select('prop_id')->from('tax_comp_result')->where('id', $id)->get()->result();
        $neigh_ids = array();
        foreach ($res1 as $row) {
            array_push($neigh_ids, $row->prop_id);
        }
        array_push($neigh_ids, $id);
        $res2 = $this->db->select('prop_id, address, city_zip, grade, year, living_area, land_val, floor_1_area, floor_2_area, attached, detached, covered_p, open_porc, swim_val, extra_val, appraised_val')
            ->from('tax_prop_info')->where_in('prop_id', $neigh_ids)->order_by('appraised_val', 'desc')->get()->result();
        return $res2;
    }
}