<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelo_llanta extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function listproveedor() {
        $this->db->select('codper,rassocper,nrodocper,estrgper');
        $this->db->from('vtproveedor');
        $this->db->where('estrgper', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function listmrkllanta() {
        $this->db->select('codmar,nommar');
        $this->db->from('tbmarca');
        $this->db->where('idmarc', 2);
        $this->db->where('estregmar', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function listmodllanta($codimk) {
        $this->db->select('codmod,nommod');
        $this->db->from('tbllantamodelo');
        $this->db->where('codmrk', $codimk);
        $this->db->where('estrgmod', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function listmedllanta($codimk) {
        $this->db->select('codmedi,nommedi');
        $this->db->from('tbllantamedida');
        $this->db->where('codmode', $codimk);
        $this->db->where('estregnedi', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function listcomprobante() {
        $this->db->select('codmlttb,nommlttb');
        $this->db->from('vtcomprobante');
        $this->db->where('estrgmlttb', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    public function ultimoId_cmpllta() {
        $sql = $this->db->query("select right(concat('0000000000',(select count(*) as id from tbcomprallanta)+1),10)as id")->row();
        return $sql;
    }

    public function ultimoId_llnta() {
        $sql = $this->db->query("select right(concat('0000000000',(select count(*) as id from tbllanta)+1),10)as id")->row();
        return $sql;
    }

    function save_compra_llanta($comp_cab_pie, $detalle) {

        $this->db->trans_start(true);
        $this->db->trans_begin();
        $compras = array(
            'codempcmp' => $comp_cab_pie['codempcmp'],
            'codcmp' => $comp_cab_pie['codcmp'],
            'codcmpprv' => $comp_cab_pie['codcmpprv'],
            'codcbtcmp' => $comp_cab_pie['codcbtcmp'],
            'nrodoccmp' => $comp_cab_pie['nrodoccmp'],
            'fcmp' => $comp_cab_pie['fcmp'],
            'subtotacmp' => $comp_cab_pie['subtotacmp'],
            'igvcmp' => $comp_cab_pie['igvcmp'],
            'totacmp' => $comp_cab_pie['totacmp'],
            'usucrcmp' => $comp_cab_pie['usucrcmp'],
        );

        $this->db->insert('tbcomprallanta', $compras);
        $insert_id = $this->db->insert_id();

        $data = array();
        $comllant = array();
        foreach ($detalle as $row) {
            $list_comp = array(
                'codiempcplldt' => $this->session->userdata('codemp'),
                'codicplldt' => $insert_id,
                'condicplldt' => $row->condi,
                'codimrkcplldt' => $row->codmkl,
                'codimodcplldt' => $row->codmod,
                'codimedcplldt' => $row->codmed,
                'ctdcplldt' => $row->cant,
                'pucplldt' => $row->prec,
                'impcplldt' => $row->impo,
                'usucrcplldt' => $this->session->userdata('codiper'),
            );
            array_push($comllant, $list_comp);
        }
        $this->db->insert_batch('tbcomprallantadetalle', $comllant);
        $this->db->trans_complete();

        foreach ($detalle as $row1) {
            $cant = $row1->cant;
            print_r($cant);
            for ($x = 0; $x < $cant; $x++) {
                $codillta = $this->ultimoId_llnta();

                $inertllta = array(
                    'codempllan' => $this->session->userdata('codemp'),
                    'codcmpllan' => $insert_id,
                    'condillan' => $row1->condi,
                    'codillan' => $codillta->id,
                    'codmarllan' => $row1->codmkl,
                    'modllan' => $row1->codmod,
                    'medillan' => $row1->codmed,
                    'precllan' => $row1->prec,
                    'fcmpllan' => $comp_cab_pie['fcmp'],
                    'usucrllan' => $this->session->userdata('codiper'),
                );
                $this->db->insert('tbllanta', $inertllta);
                $insertllta_id = $this->db->insert_id();
                $movillta = array(
                    'codempmovi' => $this->session->userdata('codemp'),
                    'iomovi' => 0, // 0 entrada 1 salida
                    'codtipmovi' => '30', //30 COMPRA
                    'codllanmovi' => $insertllta_id,
                    'usucrmovi' => $this->session->userdata('codiper'),
                );
                $this->db->insert('tbmovimiento', $movillta);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        $this->db->trans_off();
    }

    function save_nroser_llanta($llan_cab) {
        $this->db->set('nrosrllan', $llan_cab['nrosrllan']);
        $this->db->set('usumdllan', $llan_cab['usumdllan']);
        $this->db->set('fmdllan', $llan_cab['fmdllan']);
        $this->db->where('codempllan', $llan_cab['codempllan']);
        $this->db->where('codllan', $llan_cab['codllan']);
        $this->db->where('estregllan', 'A');
        $this->db->update('tbllanta');
        return $this->db->affected_rows();
    }

    function listcompllantacab() {
        $this->db->select('c.codicmp,c.codcmp,p.nrodocper,p.rassocper,cp.nommlttb as comproban,c.nrodoccmp,c.fcmp,c.subtotacmp,c.igvcmp,c.totacmp');
        $this->db->from('tbcomprallanta c');
        $this->db->join('vtproveedor p', 'c.codcmpprv=p.codper');
        $this->db->join('vtcomprobante cp', 'c.codcbtcmp=cp.codmlttb');
        $this->db->where('c.codempcmp', $this->session->userdata('codemp'));
        $this->db->where('c.estrgcmp', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function compllantacab($codicmp) {
        $this->db->select('c.codicmp,c.codcmp,p.nrodocper,p.rassocper,cp.nommlttb as comproban,c.nrodoccmp,c.fcmp,c.subtotacmp,c.igvcmp,c.totacmp');
        $this->db->from('tbcomprallanta c');
        $this->db->join('vtproveedor p', 'c.codcmpprv=p.codper');
        $this->db->join('vtcomprobante cp', 'c.codcbtcmp=cp.codmlttb');
        $this->db->where('c.codempcmp', $this->session->userdata('codemp'));
        $this->db->where('c.codicmp', $codicmp);
        $this->db->where('c.estrgcmp', 'A');
        $sql = $this->db->get();
        return $sql->row();
    }

    function compllantadeta($codicmp) {
        $this->db->select('cld.codcplldt,cld.condicplldt,ml.nommrkllan,md.nommod,mdi.nommedi,cld.ctdcplldt,cld.pucplldt,cld.impcplldt,cld.estcplldt');
        $this->db->from('tbcomprallantadetalle cld');
        $this->db->join('vtmarcallanta ml', 'cld.codimrkcplldt=ml.codmrkllan');
        $this->db->join('tbllantamodelo md', 'cld.codimodcplldt=md.codmod');
        $this->db->join('tbllantamedida mdi', 'cld.codimedcplldt=mdi.codmedi');
        $this->db->where('cld.codiempcplldt', $this->session->userdata('codemp'));
        $this->db->where('cld.codicplldt', $codicmp);
        $this->db->where('cld.estrgcplldt', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function listllantacab() {
        $this->db->select('ll.codllan,ll.codillan,ll.condillan,ll.nrosrllan,ml.nommrkllan,md.nommod,mdi.nommedi,ll.remallan,ll.estllan');
        $this->db->from('tbllanta ll');
        $this->db->join('vtmarcallanta ml', 'll.codmarllan=ml.codmrkllan');
        $this->db->join('tbllantamodelo md', 'll.modllan=md.codmod');
        $this->db->join('tbllantamedida mdi', 'll.medillan=mdi.codmedi');
        $this->db->where('ll.codempllan', $this->session->userdata('codemp'));
        $this->db->where('ll.estregllan', 'A');
        $this->db->order_by('ll.codllan', 'desc');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function editarllantadata($codllan) {
        $this->db->select('ll.codllan,ll.codillan,ll.condillan,ll.nrosrllan,ml.nommrkllan,md.nommod,mdi.nommedi,ll.remallan,ll.fcmpllan,ll.estllan,p.rassocper');
        $this->db->from('tbllanta ll');
        $this->db->join('vtmarcallanta ml', 'll.codmarllan=ml.codmrkllan');
        $this->db->join('tbllantamodelo md', 'll.modllan=md.codmod');
        $this->db->join('tbllantamedida mdi', 'll.medillan=mdi.codmedi');
        $this->db->join('tbcomprallanta c', 'c.codicmp=ll.codcmpllan');
        $this->db->join('vtproveedor p', 'p.codper=c.codcmpprv');
        $this->db->where('ll.codempllan', $this->session->userdata('codemp'));
        $this->db->where('ll.codllan', $codllan);
        $this->db->where('ll.estregllan', 'A');
        $sql = $this->db->get();
        return $sql->row();
    }

    function buscarporplaca_flota($nrplcod) {
        //var_dump($nrplcod);
        $this->db->select('fl.codflt,fl.plaflt,fl.cdintflt,tf.nommlttb,mf.nommar,fl.modflt,fl.cfgflt,fl.ejeflt,fl.neoflt,fl.neorpsflt,fl.kmflt,fl.aniflt,fl.tipflt,sf.nommlttb as estflt,b.adjdsn,fl.estrgflt');
        $this->db->from('tbflota fl');
        $this->db->join('vttipoflota tf', 'fl.tipflt=tf.codmlttb');
        $this->db->join('vtmarcaflota mf', 'fl.marflt=mf.codmar');
        $this->db->join('tbflotadisenio b', 'fl.coddsnsqll=b.coddsn');
        $this->db->join('vtestaflota sf', 'fl.estflt=sf.codmlttb');
        $this->db->where('fl.plaflt', $nrplcod);
        //$this->db->where_or('fl.cdintflt', $nrplcod);
        $this->db->where('fl.codempflt', $this->session->userdata('codemp'));
        $this->db->where('fl.estrgflt', 'A');
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            $result = $sql->row();
        } else {
            $result = FALSE;
        }
        return $result;
    }

    function get_llanta($codtipvh) {
        $this->db->select('ll.codllan,ll.codillan,ll.nrosrllan,ml.nommrkllan,md.nommod,mdi.nommedi,ll.remallan,ll.fcmpllan,ll.estllan,p.rassocper');
        $this->db->from('tbllanta ll');
        $this->db->join('vtmarcallanta ml', 'll.codmarllan=ml.codmrkllan');
        $this->db->join('tbllantamodelo md', 'll.modllan=md.codmod');
        $this->db->join('tbllantamedida mdi', 'll.medillan=mdi.codmedi');
        $this->db->join('tbcomprallanta c', 'c.codicmp=ll.codcmpllan');
        $this->db->join('vtproveedor p', 'p.codper=c.codcmpprv');
        $this->db->where('ll.codempllan', $this->session->userdata('codemp'));
        $this->db->where('ll.aplvhllan', $codtipvh);
        $this->db->where('ll.estllan', 'D');
        $this->db->where('ll.estregllan', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
    }

    function get_llanta_vehi($codivehi) {
        $this->db->select('fd.codfltd,fd.codillan as codllan,ll.codillan,ml.nommrkllan,md.nommod,mdi.nommedi,fd.remallan,fd.poslland,fd.fmonlland');
        $this->db->from('tbflotadetalle fd');
        $this->db->join('tbllanta ll', 'll.codllan=fd.codillan');
        $this->db->join('vtmarcallanta ml', 'll.codmarllan=ml.codmrkllan');
        $this->db->join('tbllantamodelo md', 'll.modllan=md.codmod');
        $this->db->join('tbllantamedida mdi', 'll.medillan=mdi.codmedi');
        $this->db->where('fd.codperfltd', $this->session->userdata('codemp'));
        $this->db->where('fd.codiflt', $codivehi);
        $this->db->where('fd.estrgfltd', 'A');
        $sql = $this->db->get();
        return $sql->result_array();
        //tbflotadetalle,codiflt,codillan,estrgfltd,codperfltd
        //posec,marca.modelo,medida,rema,
    }

    function get_motivo_montaje_llanta() {
        $this->db->select('codmlttb as codmtvdsmon,nommlttb as nommtvdsmon');
        $this->db->from('vtmotivodesmontaje');

        $sql = $this->db->get();
        return $sql->result_array();
        //tbflotadetalle,codiflt,codillan,estrgfltd,codperfltd
        //posec,marca.modelo,medida,rema,
    }

    function set_add_montllant_vehi($addmntll, $addremll) {
        $this->db->select('poslland');
        $this->db->from('tbflotadetalle');
        $this->db->where('codperfltd', $this->session->userdata('codemp'));
        $this->db->where('codiflt', $addmntll['codiflt']);
        $this->db->where('poslland', $addmntll['poslland']);
        $this->db->where('estrgfltd', 'A');
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            $result = FALSE;
        } else {
            $this->db->set('codperrem', $this->session->userdata('codemp'));
            $this->db->set('codillanrem', $addmntll['codillan']);
            $this->db->set('prfintllanrem', $addremll['prfintllanrem']);
            $this->db->set('prfcntllanrem', $addremll['prfcntllanrem']);
            $this->db->set('prfextllanrem', $addremll['prfextllanrem']);
            $this->db->set('prellanrem', $addmntll['prsnlland']);
            $this->db->set('kmllanrem', $addmntll['kmlland']);
            $this->db->set('usuregrem', $this->session->userdata('codiper'));
            $this->db->insert('tbremanente');
            $this->db->set('codempmovi', $this->session->userdata('codemp'));
            $this->db->set('iomovi', '1');
            $this->db->set('codtipmovi', '31');
            $this->db->set('codllanmovi', $addmntll['codillan']);
            $this->db->set('usucrmovi', $this->session->userdata('codiper'));
            $this->db->insert('tbmovimiento');
            $this->db->set('estllan', 'M'); //M MONTADO
            $this->db->where('codllan', $addmntll['codillan']);
            $this->db->update('tbllanta');
            $this->db->insert('tbflotadetalle', $addmntll);
            $result = $this->db->insert_id();
        }
        return $result;
    }

    function set_desmontllant_vehi($dsmntll, $addremll) {

        $this->db->select('poslland');
        $this->db->where('codperfltd', $this->session->userdata('codemp'));
        $this->db->where('codiflt', $dsmntll['codiflt']);
        $this->db->where('codillan', $dsmntll['codillan']);
        $this->db->where('poslland', $dsmntll['poslland']);
        $this->db->where('estrgfltd', 'A');
        $this->db->from('tbflotadetalle');
        $sql = $this->db->get();
        $resul = $sql->result();

        if ($sql->num_rows() > 0) {

            $this->db->set('codperrem', $this->session->userdata('codemp'));
            $this->db->set('codillanrem', $dsmntll['codillan']);
            $this->db->set('prfintllanrem', $addremll['prfintllanrem']);
            $this->db->set('prfcntllanrem', $addremll['prfcntllanrem']);
            $this->db->set('prfextllanrem', $addremll['prfextllanrem']);
            $this->db->set('kmllanrem', $dsmntll['kmlland']);
            $this->db->set('usuregrem', $this->session->userdata('codiper'));
            $this->db->insert('tbremanente');

            $this->db->set('codempmovi', $this->session->userdata('codemp'));
            $this->db->set('iomovi', '0');
            $this->db->set('codtipmovi', '32');
            $this->db->set('codllanmovi', $dsmntll['codillan']); //kmlland
            $this->db->set('mtvmovi', $dsmntll['motdsmonlland']);
            $this->db->set('usucrmovi', $this->session->userdata('codiper'));
            $this->db->insert('tbmovimiento');

            if ($dsmntll['motdsmonlland'] == '44') {
                $estado = 'D';
            } else IF ($dsmntll['motdsmonlland'] == '43') {
                $estado = 'R';
            } ELSE {
                $estado = 'A';
            }


            $this->db->set('estllan', $estado); //D DISPONIBLE-DESMONTADO
            $this->db->set('usumdllan', $this->session->userdata('codiper'));
            $this->db->set('fmdllan', gmdate("Y-m-d H:i:s", time() - 18000));
            $this->db->where('codllan', $dsmntll['codillan']);
            $this->db->update('tbllanta');

            $this->db->set('fdsmonlland', $dsmntll['fdsmonlland']);
            $this->db->set('motdsmonlland', $dsmntll['motdsmonlland']);
            $this->db->set('kmlland', $dsmntll['kmlland']);
            $this->db->set('estrgfltd', 'I');
            $this->db->set('usumdfltd', $this->session->userdata('codiper'));
            $this->db->set('fmdfltd', gmdate("Y-m-d H:i:s", time() - 18000));
            $this->db->where('codperfltd', $this->session->userdata('codemp'));
            $this->db->where('codiflt', $dsmntll['codiflt']);
            $this->db->where('codillan', $dsmntll['codillan']);
            $this->db->where('poslland', $dsmntll['poslland']);
            $this->db->where('estrgfltd', 'A');
            $this->db->update('tbflotadetalle');
            $result = $this->db->affected_rows();
        } else {
            $result = FALSE;
        }
        return $result;
    }

    function set_inspectllant_vehi($addremll) {
        $this->db->set('codperrem', $this->session->userdata('codemp'));
        $this->db->set('codillanrem', $addremll['codillanrem']);
        $this->db->set('prfintllanrem', $addremll['prfintllanrem']);
        $this->db->set('prfcntllanrem', $addremll['prfcntllanrem']);
        $this->db->set('prfextllanrem', $addremll['prfextllanrem']);
        $this->db->set('kmllanrem', $addremll['kmllanrem']);
        $this->db->set('fispllanrem', gmdate("Y-m-d H:i:s", time() - 18000));
        $this->db->set('usuregrem', $this->session->userdata('codiper'));
        $this->db->insert('tbremanente');
        return $this->db->insert_id();
    }

}

?>