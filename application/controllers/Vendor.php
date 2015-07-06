<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vendor
 *
 * @author root
 */
class Vendor extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 9) {
            show_404();
        } else {
            $this->load->model('komponenberkasmodel');
            $this->load->model('tagihanmodel');
            $this->load->model('checklistvendormodel');
            $this->load->model('historytagihanmodel');
            $this->load->model('kontrakmodel');
        }
    }

    public function index() {
        $this->load->view('vendor/home-vendor');
    }

    public function kontrak() {
        $data['kontrakarray'] = $this->kontrakmodel->getKontrakForTagihan($_SESSION['namauser']);
        $this->load->view('vendor/lihatdaftarkontrak-vendor', $data);
    }

    public function tagih() {
        $this->form_validation->set_rules('hidden_idkontrak', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('vendor/kontrak'));
        } else {
            $idkontrak = $_POST['hidden_idkontrak'];
            $data['idkontrak'] = $idkontrak;
            $data['kontrak'] = $this->kontrakmodel->getSpecificKontrak($idkontrak);
            $data['checklist'] = $this->komponenberkasmodel->getAllKomponenBerkas();
            $this->load->view('vendor/uploaddokumen-vendor', $data);
        }
    }

    public function uploaddokumen() {
        $result = $this->komponenberkasmodel->getAllKomponenBerkas();
        $data['checklist'] = $result;
        $this->load->view('vendor/uploaddokumen-vendor');
//        $data['kontrakarray'] = $this->kontrakmodel->getKontrakforTagihan();
//        $this->load->view('vendor/lihatdaftarkontrak-vendor', $data);
    }

    public function dokumenkembali() {
        $data['dbresult'] = $this->tagihanmodel->getAllTagihanKembali($_SESSION['namauser']);
        $this->load->view('vendor/lihatdaftardokumenkembali-vendor', $data);
    }
    
    public function detail() {
        $this->form_validation->set_rules('hidden_idtagihan', '', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect(base_url('vendor/dokumenkembali'));
        } else {
            $idtagihan = $_POST['hidden_idtagihan'];
            $data['specifictagihan'] = $this->tagihanmodel->getSpecificTagihan($idtagihan);
            $data['checklisttagihan'] = $this->checklistvendormodel->getChecklistVendor($idtagihan);
            $this->load->view('vendor/lihatdetaildokumenkembali-vendor', $data);
        }
    }

    public function performupload() {
        
        if ($this->security->xss_clean($_POST['nomortagihan']) === FALSE) {
            redirect(base_url('vendor'));
        } else {

            $this->form_validation->set_rules('nomortagihan', '"Nomor tagihan"', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('vendor/lihatdaftarkontrak-vendor');
            } else {
                $data = $_POST;
                $lengkap = array();

                foreach ($data as $key => $value) {
                    if (strpos($key, 'syarat') !== FALSE) {
                        $lengkap[] = $value;
                    }
                }

                $config['upload_path'] = 'uploads';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '100000'; //in KB
                $config['file_name'] = time() . '-' . random_string() . '-' . trim($_SESSION['namauser']);

                $this->load->library('upload', $config);
                $uploadstatus = $this->upload->do_upload();
                $upload_data = $this->upload->data();

                if ($uploadstatus) {
                    $newIdTagihan = $this->tagihanmodel->insertTagihan($data['nomortagihan'], $data['hidden_idkontrak'], $upload_data['file_name']);

                    foreach ($lengkap as $res) {
                        $newIdChecklist = $this->checklistvendormodel->insertChecklist($res, $newIdTagihan);
                    }

                    $this->load->view('vendor/berhasilupload-vendor');
                } else {
                    echo 'fail';
                }
            }
        }
    }

}
