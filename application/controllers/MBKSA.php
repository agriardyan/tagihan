<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MBKSA
 *
 * @author root
 */
class MBKSA extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('role') != 1) {
            show_404();
        } else {
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('fasemodel');
            $this->load->model('usermodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('mbksa/home-mbksa');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(1, $_SESSION['iduser']);
        $this->load->view('mbksa/lihatdaftartagihanbaru-mbksa', $data);
    }

    public function masuk() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(3, $_SESSION['iduser']);
        $this->load->view('mbksa/lihatdaftartagihanterusan-mbksa', $data);
    }

    public function pembayaran() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(8, $_SESSION['iduser']);
        $this->load->view('mbksa/lihatdaftarverifikasipembayaran-mbksa', $data);
    }

    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('mbksa'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('mbksa/lihatdetailtagihan-mbksa', $data);
        }
    }
    
    public function detaildisposisi() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('mbksa'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('mbksa/lihatdetailtagihanterusan-mbksa', $data);
        }
    }

    public function detailpembayaran() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('mbksa'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('mbksa/lihatdetailverifikasipembayaran-mbksa', $data);
        }
    }

    public function monitoring() {
        $result = $this->tagihanmodel->getAllTagihanSorted();
        $data['dbresult'] = $result;
        $this->load->view('mbksa/monitoring-mbksa', $data);
    }

    public function verifikasipembayaran() {
        $result = $this->tagihanmodel->getAllTagihanBaruManbid(8, $_SESSION['iduser']);
        $data['dbresult'] = $result;
        $this->load->view('mbksa/lihatdaftarverifikasipembayaran-mbksa', $data);
    }

    public function detailmonitoring() {
        $id = $_GET['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        $data['specifictagihan'] = $result;
        $idfase = $result['fase'];
        $iduser = $result['current_user'];
        $workingphase = $this->fasemodel->getSpecificData($idfase);
        $currentuser = $this->usermodel->getUserByID($iduser);
        $data['workingphase'] = $workingphase['keterangan'];
        $data['currentuser'] = $currentuser['nama_user'];
        $result = $this->historytagihanmodel->getSpecificData($id);
        $data['dbresult'] = $result;
        $result = $this->tagihanmodel->getChecklistTagihan($id);
        $data['checklisttagihan'] = $result;
        $this->load->view('mbksa/detailmonitoring-mbksa', $data);
    }

    public function teruskan() {

        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('mbksa'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 2, 2);
            $this->historytagihanmodel->insertHistory($idtagihan, 1, $_SESSION['iduser']);
            $this->load->view('mbksa/berhasilteruskan-mbksa');
        }
    }
    
    public function teruskandisposisi() {

        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');
        $this->form_validation->set_rules('hidden_direksi', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('mbksa'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $direksi = $_POST['hidden_direksi'];
            $keterangan = trim($_POST['keterangan']);
            $keterangan = nl2br($keterangan);
            $result = $this->usermodel->getManajerByDireksi($direksi);
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 4, $result['id_user']);
            $this->tagihanmodel->updateKeterangan($idtagihan, $keterangan);
            $this->historytagihanmodel->insertHistoryWithKeterangan($idtagihan, 3, $_SESSION['iduser'], $keterangan);
            $this->load->view('mbksa/berhasilteruskan-mbksa');
        }
    }

    public function verifikasi() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('mbksa/pembayaran'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 9, 19);
            $this->historytagihanmodel->insertHistory($idtagihan, 8, $_SESSION['iduser']);
            $this->load->view('mbksa/berhasilteruskan-mbksa');
        }
    }

}
