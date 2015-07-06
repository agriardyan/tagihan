<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubBagVerifikasi
 *
 * @author root
 */
class SubBagVerifikasi extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 5) {
            show_404();
        } else {
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('subbag_verifikasi/home-subbag-verifikasi');
    }
    
    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(5, $_SESSION['iduser']);
        $this->load->view('subbag_verifikasi/lihatdaftartagihanbaru-subbag-verifikasi', $data);
    }

    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('manbid/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('subbag_verifikasi/lihatdetailtagihan-subbag-verifikasi', $data);
        }
    }
    
    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        redirect(base_url('uploads/' . $result['file_tagihan']));
    }

    public function hitungpotongan() {
        $data = $_POST;
        $this->load->view('subbag_verifikasi/hitungpotongan-subbag-verifikasi', $data);
    }

    public function teruskan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 6, 17);
            $this->historytagihanmodel->insertHistory($idtagihan, 5, $_SESSION['iduser']);
            $this->load->view('subbag_verifikasi/berhasilteruskan-subbag-verifikasi');
        }
    }

}
