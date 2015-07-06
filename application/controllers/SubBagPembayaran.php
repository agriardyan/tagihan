<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubBagPembayaran
 *
 * @author root
 */
class SubBagPembayaran extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 6) {
            show_404();
        } else {
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('subbag_pembayaran/home-subbag-pembayaran');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(6, $_SESSION['iduser']);
        $this->load->view('subbag_pembayaran/lihatdaftartagihanbaru-subbag-pembayaran', $data);
    }

    public function pembayaran() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaruSubbagPembayaran(10, $_SESSION['iduser']);
        $this->load->view('subbag_pembayaran/lihatdaftarpembayaranbaru-subbag-pembayaran', $data);
    }

    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('manbid/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('subbag_pembayaran/lihatdetailtagihan-subbag-pembayaran', $data);
        }
    }

    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        redirect(base_url('uploads/' . $result['file_tagihan']));
    }

    public function lihatdetailpembayaran() {
        $id = $_GET['idtag'];
        $result1 = $this->tagihanmodel->getSpecificTagihan($id);
        $data['specifictagihan'] = $result1;
        $result2 = $this->tagihanmodel->getChecklistTagihan($id);
        $data['checklisttagihan'] = $result2;
        $this->load->view('subbag_pembayaran/lihatdetailpembayaran-subbag-pembayaran', $data);
    }

    public function teruskan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbagpembayaran'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 7, 18);
            $this->historytagihanmodel->insertHistory($idtagihan, 6, $_SESSION['iduser']);
            $this->load->view('subbag_pembayaran/berhasilteruskan-subbag-pembayaran');
        }
    }

    public function pembayaranselesai() {
        $data = $_POST;
        $idtagihan = $data['idtagihan'];
        $this->tagihanmodel->updateFaseTagihan($idtagihan, 11, '');
        $this->historytagihanmodel->insertHistory($idtagihan, 10, $_SESSION['iduser']);
        $this->load->view('subbag_pembayaran/berhasilselesai-subbag-pembayaran');
    }

}
