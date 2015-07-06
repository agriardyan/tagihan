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
            $this->load->model('vendormodel');
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
            $this->load->model('komponenberkasmodel');  
        }
    }

    public function index() {
        $this->load->view('subbid_umum/home-subbid-umum');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(2, $_SESSION['iduser']);
        $this->load->view('subbid_umum/lihatdaftartagihanbaru-subbid-umum', $data);
    }
    
    public function masuk() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(4, $_SESSION['iduser']);
        $this->load->view('subbid_umum/lihatdaftartagihanmasuk-subbid-umum', $data);
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
    
    public function detaildisposisi() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $data['allkomponenberkas'] = $this->komponenberkasmodel->getAllKomponenBerkas();
            $this->load->view('subbid_umum/verifikasitagihan-subbid-umum', $data);
        }
    }
    
    public function kembalivendor() {
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
    
    public function fkembali() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbidumum/masuk'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $data['allkomponenberkas'] = $this->komponenberkasmodel->getAllKomponenBerkas();
            $this->load->view('subbid_umum/alasankembali-subbid-umum', $data);
        }
    }

    public function performverifikasi() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbidumum/masuk'));
        } else {
            $id = $_POST['hidden_idtagihan'];
            $data['idtagihan'] = $id;
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($id);
            $ket = '';
            $lengkap = array();

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'syarat') !== false) {
                    $lengkap[] = $value;
                }
            }

            $result = $this->komponenberkasmodel->getAllKomponenBerkas();

            foreach ($result as $value) {
                $i = $value['id_komponenberkas'];
                if (in_array($i, $lengkap) === FALSE) {
                    $namadokumen = $this->komponenberkasmodel->getNamaKomponenBerkas($i);
                    $ket .= '<li>' . $namadokumen['nama_komponenberkas'] . '</li>';
                }
            }

            if ($ket == NULL || $ket == '') {
                $data['success'] = true;
            } else {
                $data['success'] = false;
                $data['keterangan'] = '<ol>' . $ket . '</ol>';
            }

            $this->load->view('subbid_umum/hasilverifikasi-subbid-umum', $data);
        }
    }

    public function teruskan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 5, 16);
            $this->historytagihanmodel->insertHistory($idtagihan, 4, $_SESSION['iduser']);
            $this->load->view('subbid_umum/berhasilteruskan-subbid-umum');
        }
    }

    public function kembalikan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid'));
        } else {
            $data = $_POST;
            $idtagihan = $data['hidden_idtagihan'];
            $keterangan = '';
            if(isset($data['keterangan1'])) {
                $keterangan = $data['keterangan1'];
            }
            $keterangan .= '<br>Pesan dari '. $_SESSION['namauser'] .' : <br>' . nl2br(trim($data['keterangan'])) . '<br>';
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 88, 2);
            $this->tagihanmodel->updateKeterangan($idtagihan, $keterangan);
            $this->historytagihanmodel->insertHistoryWithKeterangan($idtagihan, 4, $_SESSION['iduser'], $keterangan);
            $this->load->view('subbid/berhasilteruskan-subbid');
        }
    }


}
