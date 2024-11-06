<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login_check($id, $pw) {
        $sql = "select
                    t1.admin_seq
                    , t1.admin_id
                    , FN_DECRYPT(t1.admin_name) as admin_name
                    , FN_DECRYPT(t1.admin_tel) as admin_tel
                    , FN_DECRYPT(t1.admin_email) as admin_email
                    , t1.admin_grade
                    , t1.is_block
                    , t1.blocked_reason
                    , date_format(t1.blocked_at, '%Y.%m.%d %H:%i') as blocked_at
                from
                    tb_admin t1
                where
                    t1.admin_id = ?
                    and t1.admin_pw = SHA2(?, 512)
                    and t1.is_delete = 'n' ";

        return $this->db->query($sql, array($id, $pw));
    }

    public function update_last_login($seq) {
        $this->db->set('last_logined_at', 'now()', false);
        $this->db->where('admin_seq', $seq);
        $this->db->update('tb_admin');
    }

    public function insert_admin($req) {
        $this->db->trans_begin();

        $this->db->set('admin_id', $req['admin_id']);
        $this->db->set('admin_pw', "SHA2('" . $req['admin_pw'] . "', 512)", false);
        $this->db->set('admin_name', "FN_ENCRYPT('" . $req['admin_name'] . "')", false);
        $this->db->set('admin_tel', "FN_ENCRYPT('" . $req['admin_tel'] . "')", false);
        $this->db->set('admin_email', "FN_ENCRYPT('" . $req['admin_email'] . "')", false);
        $this->db->set('admin_grade', '02');
        $this->db->set('is_block', 'n');
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id2']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id2']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_admin');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_admin($req) {
        $this->db->trans_begin();

        $this->db->set('admin_name', "FN_ENCRYPT('" . $req['admin_name'] . "')", false);
        $this->db->set('admin_tel', "FN_ENCRYPT('" . $req['admin_tel'] . "')", false);
        $this->db->set('admin_email', "FN_ENCRYPT('" . $req['admin_email'] . "')", false);
        $this->db->set('updated_by', $req['admin_id2']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('admin_seq', $req['admin_seq']);
        $this->db->update('tb_admin');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_admin($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id2']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('admin_seq', $req['admin_seq']);
        $this->db->update('tb_admin');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function change_pw($req) {
        $this->db->trans_begin();

        $this->db->set('admin_pw', "SHA2('" . $req['admin_pw'] . "', 512)", false);
        $this->db->set('updated_by', $req['admin_id2']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('admin_seq', $req['admin_seq']);
        $this->db->update('tb_admin');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function admin_list($req, $offset, $perpage) {
        $sql = "select
                    t1.admin_seq
                    , t1.admin_id
                    , FN_DECRYPT(t1.admin_name) as admin_name
                    , FN_DECRYPT(t1.admin_tel) as admin_tel
                    , FN_DECRYPT(t1.admin_email) as admin_email
                    , if(t1.last_logined_at is not null, date_format(t1.last_logined_at, '%Y-%m-%d %H:%i'), '') as last_logined_at
                    , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                from
                    tb_admin t1
                where
                    t1.is_delete = 'n'
                    and t1.admin_grade = '02' " ;
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.admin_id like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.admin_name) like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.admin_id 
                    limit ?, ? ";

        return $this->db->query($sql, array($offset, $perpage));
    }

    public function admin_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_admin t1
                where
                    t1.is_delete = 'n'
                    and t1.admin_grade = '02'" ;
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.admin_id like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.admin_name) like '%" . $req['keyword'] . "%') ";
        }
            
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function admin_info($seq) {
        $sql = "select
                    t1.admin_seq
                    , t1.admin_id
                    , FN_DECRYPT(t1.admin_name) as admin_name
                    , FN_DECRYPT(t1.admin_tel) as admin_tel
                    , FN_DECRYPT(t1.admin_email) as admin_email
                    , if(t1.last_logined_at is not null, date_format(t1.last_logined_at, '%Y-%m-%d %H:%i'), '') as last_logined_at
                from
                    tb_admin t1
                where
                    t1.admin_seq = ? " ;

        return $this->db->query($sql, array($seq));
    }

    public function admin_info_by_id($id) {
        $sql = "select
                    t1.admin_seq
                    , t1.admin_id
                    , FN_DECRYPT(t1.admin_name) as admin_name
                    , FN_DECRYPT(t1.admin_tel) as admin_tel
                    , FN_DECRYPT(t1.admin_email) as admin_email
                    , if(t1.last_logined_at is not null, date_format(t1.last_logined_at, '%Y-%m-%d %H:%i'), '') as last_logined_at
                from
                    tb_admin t1
                where
                    t1.admin_id = ? " ;

        return $this->db->query($sql, array($id));
    }
}

?>