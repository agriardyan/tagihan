<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FaseModel
 *
 * @author root
 */
class FaseModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getSpecificData($idfase) {
        $data = array('id_fase' => $idfase);
        $query = $this->db->get_where('fase', $data);
        return $query->row_array();
    }
}
