<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoryTagihanModel
 *
 * @author root
 */
class HistoryTagihanModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertHistory($idtagihan, $fase, $iduser) {
        $data = array('id_tagihan' => $idtagihan, 'fase' => $fase, 'id_user' => $iduser);
        $this->db->set('time', '(SELECT sysdate())', FALSE);
        $this->db->insert('t_historytagihan', $data);
    }
    
    public function insertHistoryWithKeterangan($idtagihan, $fase, $iduser, $keterangan) {
        $data = array('id_tagihan' => $idtagihan, 'fase' => $fase, 'id_user' => $iduser, 'keterangan' => $keterangan);
        $this->db->set('time', '(SELECT sysdate())', FALSE);
        $this->db->insert('t_historytagihan', $data);
    }

    public function getAllData() {
        $sql = 'SELECT f.keterangan, u.nama_user FROM historytagihan h, fase f, user u WHERE h.fase = f.id_fase AND h.id_user = u.id_user';
        $query = $this->db->query($sql, array($idtagihan));
        return $query->result_array();
    }

    public function getSpecificData($idtagihan) {
        $sql = 'SELECT f.keterangan, u.nama_user, DATE_FORMAT(h.time, \'%d-%b-%Y %H:%i:%s\') as time FROM historytagihan h, fase f, user u WHERE h.fase = f.id_fase AND h.id_user = u.id_user AND h.id_tagihan = ?';
        $query = $this->db->query($sql, array($idtagihan));
        return $query->result_array();
    }

}
