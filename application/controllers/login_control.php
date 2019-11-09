<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_control extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($msg = NULL) {
        $datos['msg'] = $msg;
        $datos['titulo'] = 'Gestion Neomatico';
        $this->load->view('login_view', $datos);
    }

    public function process() {
        
        $username = $this->security->xss_clean(strtolower($this->input->post('username')));
        $pass = $this->security->xss_clean(strtolower($this->input->post('password')));
        $password = md5($pass);
        $this->load->model('login_model');
        $result = $this->login_model->validate($username, $password);
        print_r($result);
        $valid = $this->session->userdata('validated');
        
        if ($valid == TRUE) {
            $datos['titulo'] = 'Principal';
            $datos['contenido'] = 'principal_view';
            $this->load->view('/includes/plantilla', $datos);
        } else {
            $msg = $result;
            $this->index($msg);
        }
        
    }

    function home_principal($msg = NULL) { 
        $msg = NULL;
          $valid = $this->session->userdata('validated');
        if ($valid == TRUE) {
            $datos['titulo'] = 'Principal';
            $datos['contenido'] = 'principal_view';
            $this->load->view('/includes/plantilla', $datos);
        }else {          
            $this->index($msg);
        }
    }

    public function do_logout() {
        $this->session->sess_destroy();
        redirect('login_control');
    }

    public function sin_datos() {
        $username = $this->session->userdata('usuaper');
        $previ = $this->session->userdata('prevper');
        $codiper = $this->session->userdata('codiper');
        $userape = $this->session->userdata('apepper');
        $datos['username'] = $username;
        $datos['previ'] = $previ;
        $datos['codiper'] = $codiper;
        $datos['userape'] = $userape;
        $datos['titulo'] = 'Error';
        $datos['contenido'] = 'error_sin_datos_view';
        $this->load->view('/includes/plantillaerror', $datos);
    }

}

?>