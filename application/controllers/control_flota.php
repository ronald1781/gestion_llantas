<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control_flota extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('modelo_flota', '', TRUE);
    }

    function index() {
        
    }

    function reg_flota_tipo() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Flota Tipo';
            $datos['contenido'] = 'vista_flota_tipo';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function ajax_list() {

        $list = $this->modelo_flota->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = ucfirst(strtolower($person->nommlttb));
            //add html for action  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->coderr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            $row[] = '<a href="javascript:void()" title="Editar" onclick="edit_person(' . "'" . $person->codmlttb . "'" . ')"><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
            <a href="javascript:void()" title="Anular" onclick="delete_person(' . "'" . $person->codmlttb . "'" . ')"><span class="label label-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->modelo_flota->count_all(),
            "recordsFiltered" => $this->modelo_flota->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->modelo_flota->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $nomacc = $this->input->post('nomtflt');
        $data = array(
            'codimlttb' => 11,
            'nommlttb' => strtolower($nomacc),
            'usucrmlttb' => $this->session->userdata('codiper'),
        );
        $insert = $this->modelo_flota->save($data);
        if ($insert > 0) {
            $dato = 'Correctamente,  Tipo flota : ' . $nomacc;
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function ajax_update() {
        $datmd = $this->input->post('nomtflt');
        $data = array(
            'nommlttb' => $datmd,
            'usumdmlttb' => $this->session->userdata('codiper'),
            'fcrmlttb' => gmdate("Y-m-d H:i:s", time() - 18000),
        );
        $result = $this->modelo_flota->update(array('codmlttb' => $this->input->post('codmar')), $data);
        if ($result > 0) {
            $dato = 'Correctamente : ' . $datmd . ', ' . $result . ' Fila (s) Actualizado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    public function ajax_delete($id) {
        $result = $this->modelo_flota->delete_by_id($id);
        if ($result > 0) {
            $dato = 'Correctamente ' . $result . ' Fila (s) Anulado (s)';
        } else {
            $dato = 'Fallo!!!';
        }
        echo json_encode(array("status" => $dato));
    }

    function reg_flota($codpl = NULL) {
        if ($this->session->userdata('validated') == TRUE) {
            if($codpl==FALSE){
                $codpla='';
            }else{
                $codpla=$codpl;
            }
            $datos['codpla'] = $codpla;
            $datos['titulo'] = 'Flota';
            $datos['contenido'] = 'vista_flota';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function getTipFlota() {
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_flota->listTipflota();
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codtiflota = $cad['codmlttb'];
                $nomtiflota = $cad['nommlttb'];
                $dato[] = $codtiflota . '#$#' . strtoupper($nomtiflota);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }

        echo json_encode($json);
    }

    function get_esquemallanta() {
        $tipoflota = $this->input->post('id');
        $json = array();
        $dato = array();
        $esqllanflota = $this->modelo_flota->get_esquemallanta($tipoflota);
        $num = count($esqllanflota);
        //,,adjdsn
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $esqllanflota[$g];
                $coddsn = $cad['coddsn'];
                $nomdsn = $cad['nomdsn'];
                $dato[] = $coddsn . '#$#' . strtoupper($nomdsn);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }

        echo json_encode($json);
    }

    function get_esquemallanta_datos() {
        $tipoflota = $this->input->post('id');

        $rstesflt = $this->modelo_flota->get_esquemallanta_datos($tipoflota);
        $num = count($rstesflt);
        if ($num > 0) {
            $result = [
                //'coddsn' => $rstesflt->coddsn,
                'adjdsn' => $rstesflt->adjdsn,
                'nroejedsn' => $rstesflt->nroejedsn,
                'nrolladsn' => $rstesflt->nrolladsn,
            ];
        } else {
            $result = 0;
        }
        echo json_encode($result);
    }

    public function getmrkFlota() {
        $json = array();
        $dato = array();
        $listmrkflota = $this->modelo_flota->listmrkflota();
        $num = count($listmrkflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listmrkflota[$g];
                $codmrkflota = $cad['codmar'];
                $nommrkflota = $cad['nommar'];
                $dato[] = $codmrkflota . '#$#' . strtoupper($nommrkflota);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }

        echo json_encode($json);
    }

    function add_flota() {
        if (isset($_POST['grabar']) and $_POST['grabar'] == 'si') {
            $dato['codempflt'] = $this->session->userdata('codemp');
            $dato['plaflt'] = strtoupper($this->input->post('txtplaca', true));
            $dato['tipflt'] = $this->input->post('seletp', true);
            $dato['marflt'] = $this->input->post('selemrk', true);
            $dato['coddsnsqll'] = $this->input->post('seledsn', true);
            $dato['modflt'] = strtoupper($this->input->post('txtmdl', true));
            $dato['mtrflt'] = strtoupper($this->input->post('txtnromtr', true));
            $dato['serflt'] = strtoupper($this->input->post('txtsermtr', true));
            $dato['aniflt'] = $this->input->post('txtanio', true);
            $dato['cdintflt'] = $this->input->post('txtpdrn', true);
            $dato['cfgflt'] = $this->input->post('txtcfg', true);
            $dato['neoflt'] = $this->input->post('txtnrollnts', true);
            $dato['neorpsflt'] = $this->input->post('txtnrorpts', true);
            $dato['kmflt'] = $this->input->post('txtkmts', true);
            $dato['ejeflt'] = $this->input->post('txtnroeje', true);
            $dato['estflt'] = 37;
            $dato['usucrflt'] = $this->session->userdata('codiper');
            $resul = $this->modelo_flota->add_flota($dato);

            if (!$resul) {
                header('Content-type: application/json; charset=utf-8');
                $jsonresp['Error'] = 'Error';
                $jsonresp['existe'] = 2;
            } else {
                header('Content-type: application/json; charset=utf-8');
                $jsonresp['dato'] = 'dato';
                $jsonresp['existe'] = 1;
            }
            echo json_encode($jsonresp);
            exit();
        } else {
            redirect('regmrkflt', 'refresh');
        }
    }

    function lista_flota() {
        if ($this->session->userdata('validated') == TRUE) {
            $listaflota = $this->modelo_flota->listflotacab();
            $datos['titulo'] = 'Lista flota';
            $datos['listaflota'] = $listaflota;
            $datos['contenido'] = 'vista_flota_lista';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

}

?>