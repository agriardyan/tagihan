<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManBid
 *
 * @author root
 */
class ManBid extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 3) {
            show_404();
        } else {
            $this->load->model('usermodel');
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('mb/home-mb');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(3, $_SESSION['iduser']);
        $this->load->view('mb/lihatdaftartagihanbaru-mb', $data);
    }

    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('manbid/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('mb/lihatdetailtagihan-mb', $data);
        }
    }

    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        redirect(base_url('uploads/' . $result['file_tagihan']));
    }

    public function teruskan() {

        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');
        $this->form_validation->set_rules('hidden_direksi', '', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('manbid'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $direksi = $_POST['hidden_direksi'];
            $keterangan = trim($_POST['keterangan']);
            $keterangan = nl2br($keterangan);
            $result = $this->usermodel->getManajerByDireksi($direksi);
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 4, $result['id_user']);
            $this->tagihanmodel->updateKeterangan($idtagihan, $keterangan);
            $this->historytagihanmodel->insertHistory($idtagihan, 3, $_SESSION['iduser']);
            $this->load->view('mb/berhasilteruskan-mb');
        }
    }

}
