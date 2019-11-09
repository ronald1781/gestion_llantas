<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Control_llanta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('modelo_llanta', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Llanta';
            $datos['contenido'] = 'vista_llanta_compra';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function getmrkllanta() {
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_llanta->listmrkllanta();
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codtiflota = $cad['codmar'];
                $nomtiflota = $cad['nommar'];
                $dato[] = $codtiflota . '#$#' . strtoupper($nomtiflota);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function getLstProveedor() {
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_llanta->listproveedor();
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codper = $cad['codper'];
                $rassocper = $cad['rassocper'];
                $nrodocper = $cad['nrodocper'];
                $dato[] = $codper . '#$#' . strtoupper($rassocper) . '#$#' . $nrodocper;
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function getListacomproba() {
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_llanta->listcomprobante();
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codper = $cad['codmlttb'];
                $rassocper = $cad['nommlttb'];
                $dato[] = $codper . '#$#' . strtoupper($rassocper);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function getModLlanta() {
        $codmk = $this->input->post('id');
        //var_dump($codper,$codequi);
        $codimk = $this->security->xss_clean($codmk);
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_llanta->listmodllanta($codimk);
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codtiflota = $cad['codmod'];
                $nomtiflota = $cad['nommod'];
                $dato[] = $codtiflota . '#$#' . strtoupper($nomtiflota);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function getMedLlanta() {
        $codmk = $this->input->post('id');
        $codimk = $this->security->xss_clean($codmk);
        $json = array();
        $dato = array();
        $listTipflota = $this->modelo_llanta->listmedllanta($codimk);
        $num = count($listTipflota);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listTipflota[$g];
                $codtiflota = $cad['codmedi'];
                $nomtiflota = $cad['nommedi'];
                $dato[] = $codtiflota . '#$#' . strtoupper($nomtiflota);
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function save_compra_llanta() {
        if ($_POST['seleprove'] != "") {
            $numcompllta = $this->generarcodcompllan();
            $hard_cab_pie = array(
                'codempcmp' => $this->session->userdata('codemp'),
                'codcmp' => $numcompllta->id,
                'codcmpprv' => $this->input->post('seleprove', true),
                'codcbtcmp' => $this->input->post('selepgo', true),
                'nrodoccmp' => $this->input->post('txtndocu', true),
                'fcmp' => $this->input->post('fechacomp', true),
                'subtotacmp' => $this->input->post('subTotal', true),
                'igvcmp' => $this->input->post('montoigv', true),
                'totacmp' => $this->input->post('totApagar', true),
                'usucrcmp' => $this->session->userdata('codiper'),
            );
            $rs = $this->modelo_llanta->save_compra_llanta($hard_cab_pie, json_decode($this->input->post('lst_compra', true)));
            if ($rs) {
                echo '1';
            } else {
                echo '0';
            }
        } else {
            echo '2';
        }
    }

    function save_nroser_llanta() {
        if ($_POST['nroserllan'] != "") {
            $llan_cab = array(
                'codllan' => $this->input->post('codllan', true),
                'nrosrllan' => $this->input->post('nroserllan', true),
                'codempllan' => $this->session->userdata('codemp'),
                'usumdllan' => $this->session->userdata('codiper'),
                'fmdllan' => gmdate("Y-m-d H:i:s", time() - 18000),
            );
            $rs = $this->modelo_llanta->save_nroser_llanta($llan_cab);
            if ($rs > 0) {
                echo 'Se guardo correctamente !!' . $this->input->post('nroserllan', true);
            } else {
                echo 'Error al registrarse ' . $this->input->post('nroserllan', true);
            }
        } else {
            echo 'sin datos';
        }
    }

    public function generarcodcompllan() {
        $data = $this->modelo_llanta->ultimoId_cmpllta();
        //"H" . str_pad($data['id'] + 1, 9, '0', STR_PAD_LEFT);
        return $data;
    }

    function lista_compra_llanta() {
        if ($this->session->userdata('validated') == TRUE) {
            $listacpl = $this->modelo_llanta->listcompllantacab();
            $datos['titulo'] = 'Compra Llanta';
            $datos['listacpl'] = $listacpl;
            $datos['contenido'] = 'vista_llanta_listacompra';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    function compra_llanta_mant($codicmp) {
        $codicmp = $this->security->xss_clean($codicmp);
        if ($this->session->userdata('validated') == TRUE) {
            $cmpllcab = $this->modelo_llanta->compllantacab($codicmp);
            $cmplldet = $this->modelo_llanta->compllantadeta($codicmp);
            $datos['titulo'] = 'Compra Llanta Detalle';
            $datos['cmpllcab'] = $cmpllcab;
            $datos['cmplldet'] = $cmplldet;
            $datos['contenido'] = 'vista_llanta_compra_mant';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    function lista_llanta() {
        if ($this->session->userdata('validated') == TRUE) {
            $listallan = $this->modelo_llanta->listllantacab();
            $datos['titulo'] = 'Lista Llanta';
            $datos['listallan'] = $listallan;
            $datos['contenido'] = 'vista_llanta_lista';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    function editarllantadata($codillan) {
        $codillan = $this->security->xss_clean($codillan);
        if ($this->session->userdata('validated') == TRUE) {
            $dateditllan = $this->modelo_llanta->editarllantadata($codillan);
            $datos['titulo'] = 'Editar Llanta';
            $datos['dateditllan'] = $dateditllan;
            $datos['contenido'] = 'vista_llanta_editar';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    function montaje_llanta() {
        if ($this->session->userdata('validated') == TRUE) {
            $datos['titulo'] = 'Montaje de Llanta';
            $datos['contenido'] = 'vista_llanta_monta';
            $this->load->view('includes/plantilla', $datos);
        } else {
            redirect('principal_control', 'refresh');
        }
    }

    public function buscarporplaca_flota() {
        $codhard = $this->input->post('txtdatae');
        $nrplcod = $this->security->xss_clean($codhard);
        $query = $this->modelo_llanta->buscarporplaca_flota($nrplcod);
        echo json_encode($query);
    }

    function montaje_llanta_vehi($codpl = NULL) {
        if ($codpl == FALSE) {
            $codhard = $this->input->post('txtnroplaca');
        } else {
            $codhard = $codpl;
        }
        $nrplcod = strtoupper($this->security->xss_clean($codhard));
        $query = $this->modelo_llanta->buscarporplaca_flota($nrplcod);

        if ($query == FALSE) {
            $msg = '<font color=red>la placa <strong> ' . $nrplcod . '</strong>  No existe debe ->' . '<a href=' . 'rgtflota/' . $nrplcod . '> Registrar</a> </font> <i class="fa fa-plus" aria-hidden="true"></i>';
            $this->session->set_flashdata("mensajepernohar", $msg);
            redirect('regmntdsmt');
        } else {
            if ($this->session->userdata('validated') == TRUE) {
                $datos['titulo'] = 'Montaje de Llanta';
                $datos['datamovil'] = $query;
                $datos['contenido'] = 'vista_llanta_movi';
                $this->load->view('includes/plantilla', $datos);
            } else {
                redirect('principal_control', 'refresh');
            }
        }
    }

    function get_llanta() {
        $tipvehi = $_POST['tipvehi'];
        $json = array();
        $dato = array();
        $listServ = $this->modelo_llanta->get_llanta($tipvehi);
        $num = count($listServ);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listServ[$g];
                $codllan = $cad['codllan'];
                $codillan = $cad['codillan'];
                $nommrkllan = $cad['nommrkllan'];
                $nommod = $cad['nommod'];
                $nommedi = $cad['nommedi'];
                $remallan = $cad['remallan'];
                $dato[] = $codllan . '#$#' . $codillan . '#$#' . $nommrkllan . '#$#' . $nommod . '#$#' . $nommedi . '#$#' . $remallan;
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }

    function get_llanta_vehi() {
        $codvehi = $this->input->post('codvehi');
        $codivehi = $this->security->xss_clean($codvehi);
        $lspbct = $this->modelo_llanta->get_llanta_vehi($codivehi);

        echo json_encode($lspbct);
    }

    function set_add_montllant_vehi() {
        $addmntll['codperfltd'] = $this->session->userdata('codemp');
        $addmntll['codiflt'] = $this->input->post('hdcodfta');
        $addmntll['poslland'] = $this->input->post('selepos');
        $addmntll['codillan'] = $this->input->post('selellan');
        $addmntll['fmonlland'] = $this->input->post('txtfmon');
        $addmntll['kmlland'] = $this->input->post('txtkmllan');
        $addmntll['prsnlland'] = $this->input->post('txtprsllan');  
        $addremll['prfintllanrem'] = $this->input->post('prfllanintmnt');
        $addremll['prfcntllanrem'] = $this->input->post('prfllancntmnt');
        $addremll['prfextllanrem'] = $this->input->post('prfllanextmnt');
        $addmntll['usucrfltd'] = $this->session->userdata('codiper');
         $listServ = $this->modelo_llanta->set_add_montllant_vehi($addmntll,$addremll);
         
        if ($listServ == FALSE) {
            $resultado = [
                "pos" => $this->input->post('selepos'),
                "msg" => 'Esta Posecion ' . $this->input->post('selepos') . ' esta registrado!!',
            ];
            $resultado['existe'] = 2;
        } else {
            $resultado = [
                "pos" => $this->input->post('selepos'),
                "msg" => 'Llanta Registrado en Posecion ' . $this->input->post('selepos') . ' !!',
            ];
            $resultado['existe'] = 1;
        }

        echo json_encode($resultado);
    }

    function set_desmontllant_vehi() {        
        $dsmntll['codiflt'] = $this->input->post('hdcodftadsmnt');
        $dsmntll['poslland'] = $this->input->post('txtposllandsmt');
        $dsmntll['codillan'] = $this->input->post('txtcodllandsmt');
        $dsmntll['fdsmonlland'] = $this->input->post('txtfdsmon');        
        $dsmntll['motdsmonlland'] = $this->input->post('selemtvdsmont');
        $dsmntll['kmlland'] = $this->input->post('txtkmdsmon');
         $addremll['prfintllanrem'] = $this->input->post('prfllanintdsmnt');
        $addremll['prfcntllanrem'] = $this->input->post('prfllancntdsmnt');
        $addremll['prfextllanrem'] = $this->input->post('prfllanextdsmnt');
      
        $listServ = $this->modelo_llanta->set_desmontllant_vehi($dsmntll,$addremll);
        if ($listServ == FALSE) {
            $resultado = [
                "pos" => $this->input->post('txtposllandsmt'),
                "msg" => 'Esta Posecion ' . $this->input->post('txtposllandsmt') . ' No existe o ya fue desmotado!!',
            ];
            $resultado['existe'] = 2;
        } else {
            $resultado = [
                "pos" => $this->input->post('txtposllandsmt'),
                "msg" => 'Llanta desmontado de la Posecion ' . $this->input->post('txtposllandsmt') . ' !!',
            ];
            $resultado['existe'] = 1;
        }
        echo json_encode($resultado);
    }

    function get_motivo_montaje_llanta() {

        $json = array();
        $dato = array();
        $listServ = $this->modelo_llanta->get_motivo_montaje_llanta();
        $num = count($listServ);
        if ($num > 0) {
            for ($g = 0; $g < $num; $g++) {
                $cad = $listServ[$g];
                $codmtvdsmon = $cad['codmtvdsmon'];
                $nommtvdsmon = $cad['nommtvdsmon'];
                $dato[] = $codmtvdsmon . '#$#' . $nommtvdsmon;
            }
            $json['lista'] = implode("&&&", $dato);
        } else {
            $json['lista'] = 0;
        }
        echo json_encode($json);
    }
    
    function set_inspectllant_vehi() {        
        $dsmntll['codiflt'] = $this->input->post('hdcodftaisp');
         $dsmntll['poslland'] = $this->input->post('txtposllanisp');
        $addremll['codillanrem'] = $this->input->post('txtcodllanisp');
        $addremll['fispllanrem'] = $this->input->post('txtfispllan');        
        $addremll['prellanrem'] = $this->input->post('txtprsispllan');
        $addremll['kmllanrem'] = $this->input->post('txtkmispllan');
         $addremll['prfintllanrem'] = $this->input->post('prfllanintisp');
        $addremll['prfcntllanrem'] = $this->input->post('prfllanintisp');
        $addremll['prfextllanrem'] = $this->input->post('prfllanextisp');
        $listServ = $this->modelo_llanta->set_inspectllant_vehi($addremll);
        if ($listServ == FALSE) {
            $resultado = [
                "pos" => $this->input->post('txtposllanisp'),
                "msg" => 'Esta Posecion ' . $this->input->post('txtposllanisp') . ' Fallo el registro de inspeccion!!',
            ];
            $resultado['existe'] = 2;
        } else {
            $resultado = [
                "pos" => $this->input->post('txtposllanisp'),
                "msg" => 'Llanta inspencionado en la Posecion ' . $this->input->post('txtposllanisp') . ' Exitosamente !!',
            ];
            $resultado['existe'] = 1;
        }

        echo json_encode($resultado);
    }

}
