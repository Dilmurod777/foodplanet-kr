<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Log_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_log($target, $type, $data, $admin_id) {
        $this->db->trans_begin();

        $this->db->set('log_target', $target);
        $this->db->set('log_type', $type);
        $this->db->set('log_desc', json_encode($data));
        $this->db->set('created_by', $admin_id);
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_admin_log');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

}

?>