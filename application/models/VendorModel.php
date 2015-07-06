<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VendorModel
 *
 * @author root
 */
class VendorModel extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getUsernamePassword($username, $password) {
        $query = $this->db->get_where('t_vendor', array('username' => $username));
        return $query->row_array();
    }
    
    public function getSpecificVendor($id) {
        $query = $this->db->get_where('t_vendor', array('id_vendor' => $id));
        return $query->row_array();
    }
    
    public function getAllVendor() {
        $query = $this->db->get('vendor');
        return $query;
    }
}
