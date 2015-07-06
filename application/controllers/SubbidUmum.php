<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubbidUmum
 *
 * @author root
 */
class SubbidUmum extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 2) {
            show_404();
        } else {
            $this->load->model('usermodel');
            $this->load->model('agendatagihanmodel');
            $this->load->model('vendormodel');
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('subbid_umum/home-subbid-umum');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(2, $_SESSION['iduser']);
        $this->load->view('subbid_umum/lihatdaftartagihanbaru-subbid-umum', $data);
    }
    
    public function kembali() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(88, $_SESSION['iduser']);
        $this->load->view('subbid_umum/lihatdokumenkembali-subbid-umum', $data);
    }
    
    public function agenda() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbidumum/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('subbid_umum/lihatdetailtagihan-subbid-umum', $data);
        }
    }
    
    public function simpan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');
        $this->form_validation->set_rules('hidden_direksi', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('subbidumum'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $direksi = $_POST['hidden_direksi'];
            $result = $this->usermodel->getManajerByDireksi($direksi);
            $this->tagihanmodel->updateTanggalMasukAgenda($idtagihan);
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 3, $result['id_manajer']);
            $this->historytagihanmodel->insertHistory($idtagihan, 2, $_SESSION['iduser']);
            $this->load->view('subbid_umum/berhasilteruskan-subbid-umum');
        }
    }
    
    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbidumum/kembali'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('subbid_umum/lihatdetailtagihankembali-subbid-umum', $data);
        }
    }
    
    public function kembalikan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('subbidumum'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 99, 20);
            $this->historytagihanmodel->insertHistory($idtagihan, 88, $_SESSION['iduser']);
            $this->load->view('subbid_umum/berhasilteruskan-subbid-umum');
        }
    }

    public function semuatagihan() {
        $this->load->view('subbid_umum/lihatdaftartagihan-subbid-umum');
    }

    public function agendatagihan() {
        $data['vendorlist'] = $this->vendormodel->getAllVendor();
        $this->load->view('subbid_umum/agendatagihan-subbid-umum', $data);
    }

    public function lihatdetail() {
        $id = $_GET['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        $data['specifictagihan'] = $result;
        $result = $this->tagihanmodel->getChecklistTagihan($id);
        $data['checklisttagihan'] = $result;
        $this->load->view('subbid_umum/lihatdetailtagihan-subbid-umum', $data);
    }

    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        if (is_file('uploads/' . $result['file_tagihan'])) {
            redirect(base_url('uploads/' . $result['file_tagihan']));
        } else {
            redirect(base_url('subbidumum'));
        }
    }

    public function lihatdetailkembali() {
        $id = $_GET['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        $data['specifictagihan'] = $result;
        $this->load->view('subbid_umum/lihatdetailtagihankembali-subbid-umum', $data);
    }

//    public function kembalikan() {
//        $data = $_POST;
//        $idtagihan = $data['idtagihan'];
//        $this->tagihanmodel->updateFaseTagihan($idtagihan, 99, 20);
//        $this->historytagihanmodel->insertHistory($idtagihan, 88, $_SESSION['iduser']);
//        $this->load->view('subbid_umum/berhasilteruskan-subbid-umum');
//    }

    public function reviewagenda() {
        $data = $_POST;
//        $namavendor = $data['namavendor'];
//        $tanggalmasuk = $data['tanggalmasuk'];
//        $nomortagihan = $data['nomortagihan'];
//        $namapekerjaan = $data['namapekerjaan'];
//        $nilaipekerjaan = $data['nilaipekerjaan'];
        $iduser = $data['teruskan'];
        $userByID = $this->usermodel->getUserByID($iduser);
        $data['teruskanval'] = $userByID['nama_user'];
//        $idvendor = $data['idvendor'];

        $this->load->view('subbid_umum/konfirmasiagendatagihan-subbid-umum', $data);
    }

    public function updateagenda() {
        $data = $_POST;
        $tanggalmasuk = $data['tanggalmasuk'];
        $teruskan = $data['teruskan'];
        $idtagihan = $data['idtagihan'];

        $this->tagihanmodel->updateTagihan($idtagihan, $tanggalmasuk, 3, $teruskan);
        $this->historytagihanmodel->insertHistory($idtagihan, 2, $_SESSION['iduser']);

        $this->load->view('subbid_umum/berhasilteruskan-subbid-umum');
    }

}
