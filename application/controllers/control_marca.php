<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control_marca extends CI_Controller {

    function __construct() {
        parent::__construct();
       
         $this->load->model('modelo_marca', '', TRUE);   
    }

    function index() {
        
    }

   
    function reg_mrkflota() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Flota Marca';
            $datos['contenido'] = 'vista_marca_flota';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function ajax_list() {
        
        $list = $this->modelo_marca->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = ucfirst(strtolower($person->nommar));
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            $row[] = '<a href="javascript:void()" title="Editar" onclick="edit_person(' . "'" . $person->codmar . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
                    <a href="javascript:void()" title="Anular" onclick="delete_person(' . "'" . $person->codmar . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->modelo_marca->count_all(),
            "recordsFiltered" => $this->modelo_marca->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->modelo_marca->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $nomacc = $this->input->post('nommar');
        $data = array(
            'idmarc' => 1,
            'nommar' => strtolower($nomacc),
            'usucrmar' => $this->session->userdata('codiper'),
        );
        $insert = $this->modelo_marca->save($data);
        if ($insert > 0) {
            $dato = 'Correctamente,  Marca : ' . $nomacc;
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function ajax_update() {
        $datmd = $this->input->post('nommar');
        $data = array(
            'nommar' => $datmd,
            'usumdmar' => $this->session->userdata('codiper'),
            'fmdmar' => gmdate("Y-m-d H:i:s", time() - 18000),
        );
        $result = $this->modelo_marca->update(array('codmar' => $this->input->post('codmar')), $data);
        if ($result > 0) {
            $dato = 'Correctamente : ' . $datmd . ', ' . $result . ' Fila (s) Actualizado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function ajax_delete($id) {
        $result = $this->modelo_marca->delete_by_id($id);
        if ($result > 0) {
            $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }
    //llanta
     function reg_mrkllanta() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Llanta Marca';
            $datos['contenido'] = 'vista_marca_llanta';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function llan_ajax_list() {
        
        $list = $this->modelo_marca->llan_get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = ucfirst(strtolower($person->nommar));
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            $row[] = '<a href="javascript:void()" title="Editar" onclick="edit_person(' . "'" . $person->codmar . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
                    <a href="javascript:void()" title="Anular" onclick="delete_person(' . "'" . $person->codmar . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->modelo_marca->llan_count_all(),
            "recordsFiltered" => $this->modelo_marca->llan_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function llan_ajax_edit($id) {
        $data = $this->modelo_marca->llan_get_by_id($id);
        echo json_encode($data);
    }

    public function llan_ajax_add() {
        $nomacc = $this->input->post('nommar');
        $data = array(
            'idmarc' => 2,
            'nommar' => strtolower($nomacc),
            'usucrmar' => $this->session->userdata('codiper'),
        );
        $insert = $this->modelo_marca->llan_save($data);
        if ($insert > 0) {
            $dato = 'Correctamente,  Marca : ' . $nomacc;
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function llan_ajax_update() {
        $datmd = $this->input->post('nommar');
        $data = array(
            'nommar' => $datmd,
            'usumdmar' => $this->session->userdata('codiper'),
            'fmdmar' => gmdate("Y-m-d H:i:s", time() - 18000),
        );
        $result = $this->modelo_marca->llan_update(array('codmar' => $this->input->post('codmar')), $data);
        if ($result > 0) {
            $dato = 'Correctamente : ' . $datmd . ', ' . $result . ' Fila (s) Actualizado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function llan_ajax_delete($id) {
        $result = $this->modelo_marca->llan_delete_by_id($id);
        if ($result > 0) {
            $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }
//marca llanta
}
?>

