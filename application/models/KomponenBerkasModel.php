<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KomponenBerkasModel
 *
 * @author root
 */
class KomponenBerkasModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllKomponenBerkas() {
        $query = $this->db->get('t_komponenberkas');
        return $query->result_array();
    }
    
    public function getNamaKomponenBerkas($id) {
        $query = $this->db->get_where('t_komponenberkas', array('id_komponenberkas' => $id));
        return $query->row_array();
    }
}
