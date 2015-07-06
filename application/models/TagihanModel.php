<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagihanModel
 *
 * @author root
 */
class TagihanModel extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllTagihan() {
        $sql = 'SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor FROM tagihan t JOIN vendor v ON t.id_vendor = v.id_vendor';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllTagihanSorted() {
        $sql = 'SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor FROM tagihan t JOIN vendor v ON t.id_vendor = v.id_vendor ORDER BY t.tanggal_masuk DESC';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllTagihanBaru($fase, $iduser) {
//        $query = $this->db->query('SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor FROM tagihan t JOIN vendor v ON t.id_vendor = v.id_vendor AND t.id_tagihan NOT IN (SELECT id_tagihan FROM agendatagihan)');
        $sql = 'SELECT * FROM t_tagihan t, t_kontrak k, t_pekerjaan p WHERE t.id_kontrak = k.id_kontrak AND k.id_kontrak = p.id_kontrak AND t.fase_aktif = ? AND t.current_user = ?';
        $query = $this->db->query($sql, array($fase, $iduser));
        return $query->result_array();
    }
    
    public function getAllTagihanBaruSubbagPembayaran($fase, $iduser) {
//        $query = $this->db->query('SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor FROM tagihan t, vendor v, agendatagihan a WHERE t.id_vendor = v.id_vendor AND t.id_tagihan = a.id_tagihan AND a.fase = 3');
        $sql = 'SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor FROM tagihan t, vendor v WHERE t.id_vendor = v.id_vendor AND t.current_user = ? AND t.fase = ?';
        $query = $this->db->query($sql, array($iduser, $fase));
        return $query->result_array();
    }
    
    public function getAllTagihanKembali($namavendor) {
        $sql = 'SELECT * FROM t_tagihan t, t_kontrak k, t_pekerjaan p WHERE t.id_kontrak = k.id_kontrak AND k.id_kontrak = p.id_kontrak AND t.fase_aktif = 99 AND k.id_vendor = ?';
        $query = $this->db->query($sql, array($namavendor));
        return $query->result_array();
    }
    
    public function getSpecificTagihan($idtagihan) {
//        $sql = 'SELECT t.id_tagihan, t.nomor_tagihan, t.nama_pekerjaan, t.nilai_pekerjaan, v.nama_vendor, t.keterangan, DATE_FORMAT(t.tanggal_masuk, \'%d-%m-%Y\') as tanggal_masuk, t.fase, t.current_user, t.keterangan, t.nomor_kontrak, t.file_tagihan FROM t_tagihan t JOIN t_vendor v ON t.id_vendor = v.id_vendor AND t.id_tagihan = ?';
        $sql = 'SELECT * FROM t_tagihan t, t_kontrak k, t_pekerjaan p WHERE t.id_kontrak = k.id_kontrak AND k.id_kontrak = p.id_kontrak AND t.id_tagihan = ?';
        $query = $this->db->query($sql, array($idtagihan));        
        return $query->row_array();
    }
    
    public function getChecklistTagihan($id) {
        $sql = 'SELECT c.id_komponenberkas, k.nama_komponenberkas FROM checklistvendor c, komponenberkas k WHERE c.id_tagihan = ? AND c.id_komponenberkas = k.id_komponenberkas';
        $query = $this->db->query($sql, array($id));
        return $query->result_array();  
    }
    
    public function insertTagihan($nomortagihan, $idkontrak, $filetagihan) {
        
        $sql = 'SELECT sysdate() as time';
        $query = $this->db->query($sql);
        $result = $query->row_array();
        
        $data = array('nomor_tagihan' => $nomortagihan, 'tanggal_registrasi_tagihan' => $result['time'], 'fase_aktif' => 1, 'current_user' => 1, 'id_kontrak' => $idkontrak, 'file_tagihan' => $filetagihan);
        $this->db->trans_start();
        $this->db->insert('t_tagihan', $data);
        $newid = $this->db->insert_id();
        $this->db->trans_complete();
        return $newid;
    }
    
    public function insertTagihanRevisi($nomortagihan, $nilaipekerjaan, $nama, $idvendor, $nomorkontrak, $filetagihan, $previousid) {
        $sql = 'SELECT sysdate() as time';
        $query = $this->db->query($sql);
        $result = $query->row_array();
        
        $data = array('nomor_tagihan' => $nomortagihan, 'tanggal_registrasi_tagihan' => $result['time'], 'fase_aktif' => 1, 'current_user' => 1, 'id_kontrak' => $idkontrak, 'file_tagihan' => $filetagihan, 'previous_id' => $previousid);
        $this->db->trans_start();
        $this->db->insert('t_tagihan', $data);
        $newid = $this->db->insert_id();
        $this->db->trans_complete();
        return $newid;
    }
    
    public function updateTagihan($idtag, $tanggal, $fase, $currentuser) {
        $data = array('tanggal_masuk' => date('Y-m-d', strtotime($tanggal)), 'fase' => $fase, 'current_user' => $currentuser);
        $this->db->trans_start();
        $this->db->where('id_tagihan', $idtag);
        $this->db->update('tagihan', $data);
        $this->db->trans_complete();
    }
    
    public function updateFaseTagihan($idtagihan, $fase, $iduser) {
        $data = array('fase_aktif' => $fase, 'current_user' => $iduser);
        $this->db->trans_start();
        $this->db->where('id_tagihan', $idtagihan);
        $this->db->update('t_tagihan', $data);
        $this->db->trans_complete();
    }
    
    public function updateTanggalMasukAgenda($idtagihan) {
        $sql = 'SELECT sysdate() as time';
        $query = $this->db->query($sql);
        $result = $query->row_array();
        
        $data = array('tanggal_masuk_agenda' => $result['time']);
        $this->db->trans_start();
        $this->db->where('id_tagihan', $idtagihan);
        $this->db->update('t_tagihan', $data);
        $this->db->trans_complete();
    }
    
    public function updateKeterangan($idtagihan, $keterangan) {
        $data = array('keterangan' => $keterangan);
        $this->db->trans_start();
        $this->db->where('id_tagihan', $idtagihan);
        $this->db->update('t_tagihan', $data);
        $this->db->trans_complete();
    }
    
}
