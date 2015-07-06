<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author root
 */
class Login extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('usermodel');
        $this->load->model('vendormodel');
    }

    public function index() {

        $this->form_validation->set_rules('username', '"Username"', 'required');
        $this->form_validation->set_rules('password', '"Password"', 'required');
        $this->form_validation->set_rules('loggedas', '"Log In Sebagai"', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('upjb/login-upjb');
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $as = $_POST['loggedas'];

            if ($as == 1) {
                $this->load->model('usermodel');
                $result = $this->usermodel->getUsernamePassword($username);

                if ($result == null) {
                    $errormessage = "Username tidak terdaftar";
                    $this->session->set_flashdata('errormessage', $errormessage);
                    $this->load->view('upjb/login-upjb');
                } else {
                    if ($result['password'] == $password) {
                        
                        $session = array(
                            'role' => $result['role'], 
                            'username' => $username, 
                            'namauser' => $result['nama_user'], 
                            'iduser' => $result['id_user'], 
                            'ipaddress' => $this->input->ip_address(), 
                            'useragent' => $this->input->user_agent());
                        
                        $this->session->set_userdata($session);

                        switch ($result['role']) {
                            case 1:
                                redirect('mbksa');
                                break;
                            case 2:
                                redirect('subbidumum');
                                break;
                            case 3:
                                redirect('manbid');
                                break;
                            case 4:
                                redirect('subbid');
                                break;
                            case 5:
                                redirect('subbagverifikasi');
                                break;
                            case 6:
                                redirect('subbagpembayaran');
                                break;
                            case 7:
                                redirect('dmangkeu');
                                break;
                            case 8:
                                redirect('gm');
                                break;
                            default:
                                break;
                        }
                    } else {
                        $errormessage = "Salah password";
                        $this->session->set_flashdata('errormessage', $errormessage);
                        $this->load->view('upjb/login-upjb');
                    }
                }
            } else {
                $this->load->model('vendormodel');
                $result = $this->vendormodel->getUsernamePassword($username, $password);

                if ($result == null) {
                    $errormessage = "Vendor tidak terdaftar";
                    $this->session->set_flashdata('errormessage', $errormessage);
                    $this->load->view('upjb/login-upjb');
                } else {
                    if ($result['password'] == $password) {
                        
                        $session = array(
                            'role' => '9', 
                            'username' => $username, 
                            'namauser' => $result['nama_vendor'], 
                            'iduser' => $result['id_vendor'], 
                            'ipaddress' => $this->input->ip_address(), 
                            'useragent' => $this->input->user_agent());
                        
                        $this->session->set_userdata($session);
                        
                        redirect('vendor');
                        
                    } else {
                        $errormessage = "Salah password";
                        $this->session->set_flashdata('errormessage', $errormessage);
                        $this->load->view('upjb/login-upjb');
                    }
                }
            }
        }
    }

}
