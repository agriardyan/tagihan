<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubBid
 *
 * @author root
 */
class SubBid extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 4) {
            show_404();
        } else {
            $this->load->model('komponenberkasmodel');
            $this->load->model('vendormodel');
            $this->load->model('tagihanmodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('checklistvendormodel');
        }
    }

    public function index() {
        $this->load->view('subbid/home-subbid');
    }

    public function baru() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanBaru(4, $_SESSION['iduser']);
        $this->load->view('subbid/lihatdaftartagihanbaru-subbid', $data);
    }

    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid/baru'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $data['allkomponenberkas'] = $this->komponenberkasmodel->getAllKomponenBerkas();
            $this->load->view('subbid/verifikasitagihan-subbid', $data);
        }
    }

    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        redirect(base_url('uploads/' . $result['file_tagihan']));
    }

    public function carivendor() {
        $kodevendor = $_POST['carivendor'];
        $result = $this->vendormodel->getSpecificVendor($kodevendor);
        $data['nama_vendor'] = $result['nama_vendor'];
        $data['id_vendor'] = $result['id_vendor'];
        $data['display1'] = 'none';
        $data['display2'] = '';
        $this->load->view('subbid_umum/agendatagihan-subbid-umum', $data);
    }

    public function performverifikasi() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid/baru'));
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

            $this->load->view('subbid/hasilverifikasi-subbid', $data);
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
            $this->load->view('subbid/berhasilteruskan-subbid');
        }
    }

    public function kembalikan() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('subbid'));
        } else {
            $data = $_POST;
            $idtagihan = $data['hidden_idtagihan'];
            $keterangan = $data['keterangan1'];
            $keterangan .= '<br>Pesan : <br>' . nl2br(trim($data['keterangan'])) . '<br>';
            $this->tagihanmodel->updateFaseTagihan($idtagihan, 88, 2);
            $this->tagihanmodel->updateKeterangan($idtagihan, $keterangan);
            $this->historytagihanmodel->insertHistory($idtagihan, 4, $_SESSION['iduser']);
            $this->load->view('subbid/berhasilteruskan-subbid');
        }
    }

}
