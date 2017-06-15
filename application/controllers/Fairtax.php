<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/9/2017
 * Time: 4:05 PM
 */

class Fairtax extends CI_Controller {

    public function result() {
        if (isset($_SESSION['loggin']) && $_SESSION['loggin'] === true) {
            if ($this->input->post('para1')) {
                $flag = 'post';
                $para = explode(',', $this->input->post('para1'));
            }
            elseif ($this->uri->segment(3)) {
                $flag = 'get';
                $para = $this->uri->segment(3);
            }
            else {
                echo 'without any parameters';
            }

            if ($flag == 'post') {
                $id = $this->db->select('prop_id')->from('tax_prop_info')->where('address', $para[0])->get()->result()[0]->prop_id;
            }
            elseif ($flag == 'get') {
                $id = $para;
            }
            else {
                return;
            }

            $this->load->model('Prop_model');
            $summary_info = $this->Prop_model->getSummaryInfo($id);

            if($summary_info) {     // is over-valued property id
                // get neighbors' info from table tax_comp_result
                $compare_result = $this->Prop_model->getCompareResult($id);

                // get neighbors' base info from table tax_prop_info
                $compare_prop_id = array();
                foreach ($compare_result as $row) {
                    array_push($compare_prop_id, $row->prop_id);
                }
                $compare_info = $this->Prop_model->getCompareInfo($id, $compare_prop_id);

                $data['o_flag'] = 1;
                $data['o_land_val'] = $summary_info[0]->land_val;
                $data['o_total_mid_val'] = $summary_info[0]->total_mid_val;
                $data['o_total_aver_mid_val'] = $summary_info[0]->total_aver_mid_val;
                $data['o_compare_result'] = $compare_result;
                $data['o_compare_info'] = $compare_info;
            }
            else {
                $self_info = $this->Prop_model->getCompareInfo($id, array());
                $data['o_flag'] = 0;
                $data['o_compare_info'] = $self_info;
            }

            $data['o_prop_id'] = $id;

            $this->load->view('test', $data);
        }
        else {
            $this->load->view('login/login');
        }
    }

    public function check() {
        echo $this->input->user_agent();
        exit;
        $user = $this->session->tempdata('user');
        var_dump($user);
        $this->session->set_tempdata('user', $user, 5);
    }

}