<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KontrakModel
 *
 * @author root
 */
class KontrakModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getKontrakForTagihan($idvendor) {
        $sql = 'SELECT * FROM t_kontrak k, t_pekerjaan p WHERE k.id_kontrak = p.id_kontrak AND k.id_vendor = ? AND k.selesai = 1 AND k.id_kontrak NOT IN (SELECT id_kontrak FROM t_tagihan)';
        $query = $this->db->query($sql, array($idvendor));
        return $query->result_array();
    }
    
    public function getSpecificKontrak($idkontrak) {
        $sql = 'SELECT * FROM t_kontrak k JOIN t_pekerjaan p ON k.id_kontrak = p.id_kontrak WHERE k.id_vendor = ? AND k.id_kontrak = ?';
        $data = array($_SESSION['namauser'], $idkontrak);
//        $query = $this->db->get_where('t_kontrak', array('id_vendor' => $_SESSION['namauser'], 'id_kontrak' => $idkontrak));
        $query = $this->db->query($sql, $data);
        return $query->row_array();
    }
    
}
