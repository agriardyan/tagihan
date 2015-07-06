<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestModel
 *
 * @author root
 */
class TestModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function show($idtagihan) {
        $query = $this->db->get_where('t_tagihan', array('id_tagihan' => $idtagihan));
        return $query->row_array();
    }
}
