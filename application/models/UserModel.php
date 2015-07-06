<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author root
 */
class UserModel extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getUsernamePassword($username) {
        $query = $this->db->get_where('t_user', array('username' => $username));
        return $query->row_array();
    }
    
    public function getUserByID($iduser) {
        $query = $this->db->get_where('user', array('id_user' => $iduser));
        return $query->row_array();
    }
    
    public function getSubbid($iduser) {
        $query = $this->db->get_where('user', array('id_manajer' => $iduser));
        return $query->result_array();
    }
    
    public function getManajerByDireksi($direksi) {
        $query = $this->db->get_where('t_user', array('nama_user' => $direksi));
        return $query->row_array();
    }

}
