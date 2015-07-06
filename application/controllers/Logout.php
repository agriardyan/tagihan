<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logout
 *
 * @author root
 */
class Logout extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $array = $this->session->all_userdata();

        foreach ($array as $key => $value) {
            $this->session->unset_userdata($key);
        }

        redirect(base_url('index.php'));
    }

}
