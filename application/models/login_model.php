<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validate($username, $password) {
               $perf = '';
        $msg = '';
        $codperf = '';
        $this->db->select('codusua,usuausua,tbusuario.codempusua,nombape,correusua,campas,perfilusua,llavpfmn');
        $this->db->from('tbusuario');
        $this->db->join('tbpersona', 'tbpersona.codper = tbusuario.codiperusua');
        $this->db->join('vtperfilmenua', 'vtperfilmenua.codiprfmn = tbusuario.perfilusua');
        $this->db->where('usuausua', trim($username));
        $this->db->where('passusua', trim($password));
        $this->db->where('tbusuario.estrgusua', 'A');
        $this->db->where('tbpersona.estrgper', 'A');
        $this->db->limit(1);
        $query = $this->db->get();
        $codperf = $query->row();
        if (count($codperf) > 0) {
            $perf = $codperf->perfilusua;

            $this->db->select('*');
            $this->db->from('vtperfil');
            $this->db->where('estrgmlttb', 'A');
            $this->db->where('codmlttb', $perf);
            $querypf = $this->db->get();
            $codperf = $querypf->row();
            if (count($codperf) > 0) {
                $this->db->select('codmenu,paremenu,nommenu,linkmenu,codiprfmn');
                $this->db->join('vtperfilmenua', 'vtperfilmenua.codimenmn = tbmenu.codmenu');
                $this->db->from('tbmenu');
                $this->db->where('codimenu', '1');
                $this->db->where('estrgmenu', 'A');
                $this->db->where('codiprfmn', $perf);
                $consulta = $this->db->get();
                $menu = $consulta->result_array();

                if ($query->num_rows() == 1) {
                    $row = $query->row();
                    $data = array(
                        'menu' => $menu,
                        'codiper' => $row->codusua,
                        'usuaper' => $row->usuausua,
                        'codemp'=>$row->codempusua,
                        'campas' => $row->campas,
                        'correusua' => $row->correusua,
                        'nombape' => $row->nombape,
                        'prevper' => $row->perfilusua,
                        'llavpfmn' => $row->llavpfmn,
                        'validated' => TRUE,
                    );
                    $this->session->set_userdata($data);
                    $msg = TRUE;
                } else {
                    $msg = "<font color=red>Comunicarse con el Administrador de sistemas</font>";
                }
            } else {
                $msg = "<font color=red>Verificar datos del usuario</font><br />";
            }
        } else {
            $msg = " <font color=red>Invalido Usuario o Password.</font><br /><br />";
        }
        return $msg;
        
    }

    public function menumulti() {
        $this->db->select('codmenu,paremenu,linkmenu');
        $this->db->from('tbmenu');
        $this->db->where('codimenu', '1');
        $this->db->where('estrgmenu', 'A');
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
    

}

?>