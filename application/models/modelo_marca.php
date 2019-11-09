<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelo_marca extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
     /* Nueva Version de Marca */

    var $table = 'tbmarca';
    var $colum = array('nommar', 'codmar');
    var $order = array('nommar' => 'desc');

    private function _get_datatables_query() {
        $this->db->from($this->table);
        $this->db->where('idmarc', 1); //1 Flota
        $this->db->where('estregmar', 'A');
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
        $this->db->where('idmarc', 1);
         $this->db->where('estregmar', 'A');
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('idmarc', 1);
        $this->db->where('codmar', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->where('idmarc', 1);
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->set('estregmar', 'I');
        $this->db->where('idmarc', 1);
        $this->db->where('codmar', $id);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
    //llantas
    private function llan_get_datatables_query() {
        $this->db->from($this->table);
        $this->db->where('idmarc', 2); //1 Flota
        $this->db->where('estregmar', 'A');
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

    function llan_get_datatables() {
        $this->llan_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function llan_count_filtered() {
        $this->llan_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function llan_count_all() {
        $this->db->from($this->table);
        $this->db->where('idmarc', 2);
         $this->db->where('estregmar', 'A');
        return $this->db->count_all_results();
    }

    public function llan_get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('idmarc', 2);
        $this->db->where('codmar', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function llan_save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function llan_update($where, $data) {
        $this->db->where('idmarc', 2);
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function llan_delete_by_id($id) {
        $this->db->set('estregmar', 'I');
        $this->db->where('idmarc', 2);
        $this->db->where('codmar', $id);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }
    
}
?>

