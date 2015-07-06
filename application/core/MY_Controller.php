<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author root
 */
class MY_Controller extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        
        // validasi user disini. nantinya bisa ditambah cookie
        if ($this->session->userdata('username') == NULL 
                || $this->session->userdata('namauser') == NULL 
                || $this->session->userdata('role') == NULL 
                || $this->session->userdata('iduser') == NULL
                || $this->session->userdata('ipaddress') != $this->input->ip_address() 
                || $this->session->userdata('useragent') != $this->input->user_agent()) {
            
            $array = $this->session->all_userdata();

            foreach ($array as $key => $value) {
                $this->session->unset_userdata($key);
            }
            
            redirect(base_url('index.php'));
        }
    }
    
    public function lihatfile() {
        $id = $_POST['idtag'];
        $result = $this->tagihanmodel->getSpecificTagihan($id);
        if (is_file('uploads/' . $result['file_tagihan'])) {
            redirect(base_url('uploads/' . $result['file_tagihan']));
        } else {
            show_404();
        }
    }

}
