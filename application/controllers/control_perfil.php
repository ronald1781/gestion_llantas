<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control_perfil extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('modelo_perfil', '', TRUE);
    }

    function index() {
        
    }

    function reg_perfil() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Perfil';
            $datos['contenido'] = 'vista_perfil';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function ajax_list() {

        $list = $this->modelo_perfil->get_datatables();
        //var_dump($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = ucfirst(strtolower($person->nommlttb));
            $row[] = ucfirst(strtolower($person->nommenu));
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
           // $row[] = '<a href="javascript:void()" title="Editar" onclick="edit_person(' . "'" . $person->codpfmn . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
             //       <a href="javascript:void()" title="Anular" onclick="delete_person(' . "'" . $person->codpfmn . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
            $data[] = $row;
        }
      
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->modelo_perfil->count_all(),
            "recordsFiltered" => $this->modelo_perfil->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->modelo_perfil->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $nomacc = $this->input->post('nommar');
        $data = array(
            'idmarc' => 1,
            'nommar' => strtolower($nomacc),
            'usucrmar' => $this->session->userdata('codiper'),
        );
        $insert = $this->modelo_perfil->save($data);
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
        $result = $this->modelo_perfil->update(array('codmar' => $this->input->post('codmar')), $data);
        if ($result > 0) {
            $dato = 'Correctamente : ' . $datmd . ', ' . $result . ' Fila (s) Actualizado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function ajax_delete($id) {
        $result = $this->modelo_perfil->delete_by_id($id);
        if ($result > 0) {
            $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

}
?>

