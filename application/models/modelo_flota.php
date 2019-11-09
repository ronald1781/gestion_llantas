<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelo_flota extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    var $table = 'vttipoflota';
    var $colum = array('nommlttb', 'codmlttb');
    var $order = array('nommlttb' => 'desc');
    private function _get_datatables_query() {
        $this->db->from($this->table);
        $this->db->where('codimlttb', 11);
        $this->db->where('estrgmlttb', 'A');
        $i = 0;
        foreach ($this->colum as $item) {
            if ($_POST['search']['value'])
                ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all() {
        $this->db->from($this->table);
        $this->db->where('codimlttb', 11);
        $this->db->where('estrgmlttb', 'A');
        return $this->db->count_all_results();
    }
    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('codimlttb', 11);
        $this->db->where('codmlttb', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function update($where, $data) {
        $this->db->where('codimlttb', 11);
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete_by_id($id) {
        $this->db->set('estrgmlttb', 'I');
        $this->db->where('codimlttb', 11);
        $this->db->where('codmlttb', $id);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
    function listTipflota() {
        $this->db->select('codmlttb,nommlttb');
        $this->db->from('vttipoflota');
        $sql = $this->db->get();
        return $sql->result_array();
    }
    function listmrkflota() {
        $this->db->select('codmar,nommar');
        $this->db->from('tbmarca');
        $this->db->where('idmarc', 1);
        $this->db->where('estregmar', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }
    function get_esquemallanta($tipoflota) {
        $this->db->select('coddsn,nomdsn,adjdsn');
        $this->db->from('tbflotadisenio');
        $this->db->where('codtipvehdsn', $tipoflota);
        $this->db->where('estrgdsn', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }
    function get_esquemallanta_datos($tipoflota) {
        $this->db->select('coddsn,adjdsn,nroejedsn,nrolladsn');
        $this->db->from('tbflotadisenio');
        $this->db->where('coddsn', $tipoflota);
        $this->db->where('estrgdsn', 'A');
        $sql = $this->db->get();
        return $sql->row();
    }
    function add_flota($data) {
        $this->db->insert('tbflota', $data);
        return $this->db->insert_id();        
    }
    function listflotacab() {
        $this->db->select('fl.codflt,fl.plaflt,fl.cdintflt,tf.nommlttb,fl.tipflt,mf.nommar,fl.modflt,fl.cfgflt,fl.ejeflt,fl.neoflt,fl.neorpsflt,fl.kmflt,fl.aniflt,sf.nommlttb as estflt');
        $this->db->from('tbflota fl');
        $this->db->join('vttipoflota tf', 'fl.tipflt=tf.codmlttb');
        $this->db->join('vtmarcaflota mf', 'fl.marflt=mf.codmar');
        $this->db->join('vtestaflota sf', 'fl.estflt=sf.codmlttb');
        $this->db->where('fl.codempflt', $this->session->userdata('codemp'));
        $this->db->where('fl.estrgflt', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

}

?>