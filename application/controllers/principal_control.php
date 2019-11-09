<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('validated') == TRUE) {
        $datos['titulo'] = 'Principal';
            $datos['contenido'] = 'principal_view';
            $this->load->view('/includes/plantilla', $datos);
        } else {
            redirect('login_control', 'refresh');
        }
    }


    }

