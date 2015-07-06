<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChecklistVendor
 *
 * @author root
 */
class ChecklistVendorModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insertChecklist($idkomponen, $idtagihan) {
        $data = array('id_komponenberkas' => $idkomponen, 'id_tagihan' => $idtagihan);
        $this->db->insert('t_checklistvendor', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function getChecklistVendor($idvendor) {
        $sql = 'SELECT c.id_komponenberkas, k.nama_komponenberkas FROM t_checklistvendor c, t_komponenberkas k WHERE c.id_tagihan = ? AND c.id_komponenberkas = k.id_komponenberkas';
        $query = $this->db->query($sql, array($idvendor));
        return $query->result_array();  
    }
}
