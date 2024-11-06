<?php defined('BASEPATH') OR exit('No direct script access allowed');

class File_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_file($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'n');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_file', $req);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_file($seq) {
        $this->db->trans_begin();

        $this->db->where('seq', $seq);
        $this->db->set('is_delete', 'y');
        $this->db->update('tb_file');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_file_by_parent($parent, $cd) {
        $this->db->trans_begin();

        $this->db->where('parent_gbn', $parent);
        $this->db->where('parent_cd', $cd);
        $this->db->set('is_delete', 'y');
        $this->db->update('tb_file');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function file_list($gbn, $cd) {
        $sql = "select
                    t1.file_seq
                    , t1.new_filepath
                    , t1.new_filename
                    , t1.org_filename
                    , t1.file_size
                    , t1.file_ext
                    , t1.file_no
                    , date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_file t1
                where
                    t1.is_delete = 'n'
                    and t1.parent_gbn = ?
                    and t1.parent_cd = ?
                order by t1.file_no ";

        return $this->db->query($sql, array($gbn, $cd));
    }
}


?>