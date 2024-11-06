<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Community_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function community_list($req, $offset, $perpage) {
        $sql = "select
                    t1.community_seq
                    , t1.member_seq
                    , t1.title
                    , t1.contents
                    , t1.community_type
                    , t2.member_id as nickname
                    , FN_GETCODENAME('member_type', t2.member_type) as member_type_name
                    , t1.hit_cnt
                    , ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t2.seq and a.is_delete = 'n'), '') as profile_img
                    , FN_GETCODENAME('community', t1.community_type) as community_type_name
                    , t1.created_by
                    , date_format(t1.created_at, '%Y-%m-%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                    , (select count(*) as cnt from tb_community_reply a where a.community_seq = t1.community_seq and a.is_delete = 'n') as reply_cnt
                from
                    tb_community t1
                inner join tb_member t2 on t2.seq = t1.member_seq
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['community_type']) && $req['community_type'] !== 'all') {
            $sql .= " and t1.community_type = '" . $req['community_type'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%' or t2.member_id like '%" . $req['keyword'] . "%') ";
        }
        $sql .= "order by t1.created_at desc
                limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function community_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_community t1
                inner join tb_member t2 on t2.seq = t1.member_seq 
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['community_type']) && $req['community_type'] !== 'all') {
            $sql .= " and t1.community_type = '" . $req['community_type'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%' or t2.member_id like '%" . $req['keyword'] . "%') ";
        }
        
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function community_info($seq) {
        $sql = "select
                    t1.community_seq
                    , t1.member_seq
                    , t1.title
                    , t1.contents
                    , t1.community_type
                    , t2.member_id as nickname
                    , FN_GETCODENAME('community', t1.community_type) as community_type_name
                    , date_format(t1.created_at, '%Y.%m.%d') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d') as updated_at
                    
                    , ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t2.seq and a.is_delete = 'n'), '') as profile_img

                    , ifnull((SELECT community_seq FROM tb_community a WHERE a.community_seq < t1.community_seq and a.is_delete = 'n' ORDER BY a.community_seq DESC LIMIT 1), '') as prev_seq
                    , ifnull((SELECT community_seq FROM tb_community a WHERE a.community_seq > t1.community_seq and a.is_delete = 'n' ORDER BY a.community_seq LIMIT 1), '') as next_seq
                    , (select count(*) as cnt from tb_community_reply a where a.community_seq = t1.community_seq and a.is_delete = 'n' ) as reply_cnt
                from
                    tb_community t1
                inner join tb_member t2 on t2.seq = t1.member_seq 
                where
                    t1.is_delete = 'n' 
                    and t1.community_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function insert_community($req) {
        $this->db->trans_begin();

        $this->db->set('member_seq', $req['member_seq']);
        $this->db->set('community_type', $req['community_type']);
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('hit_cnt', '0', false);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_community');
        $seq = $this->db->insert_id();

        if(!empty($req['file_newpath'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'community');
            $this->db->set('parent_cd', $seq);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['file_orgname']);
            $this->db->set('new_filepath', $req['file_newpath']);
            $this->db->set('new_filename', $req['file_newname']);
            $this->db->set('file_size', $req['file_size']);
            $this->db->set('file_ext', $req['file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_community($req) {
        $this->db->trans_begin();

        $this->db->set('community_type', $req['community_type']);
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('community_seq', $req['seq']);

        $this->db->update('tb_community');

        if($req['org_file'] !== $req['new_file']) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->where('parent_gbn', 'community');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');
        }
        if(!empty($req['file_newpath'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'community');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['file_orgname']);
            $this->db->set('new_filepath', $req['file_newpath']);
            $this->db->set('new_filename', $req['file_newname']);
            $this->db->set('file_size', $req['file_size']);
            $this->db->set('file_ext', $req['file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_community_hit($seq) {
        $this->db->trans_begin();

        $this->db->set('hit_cnt', 'hit_cnt+1', false);
        $this->db->where('community_seq', $seq);

        $this->db->update('tb_community');
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_community($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('community_seq', $req['seq']);

        $this->db->update('tb_community');
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }



    public function reply_list($req, $offset, $perpage) {
        $sql = "select
                    t1.reply_seq
                    , t1.member_seq
                    , t1.contents
                    , t2.member_id as nickname
                    , FN_GETREPLYTIME(t1.created_at) as created_at
                    , FN_GETREPLYTIME(t1.updated_at) as updated_at

                    , ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t2.seq and a.is_delete = 'n'), '') as profile_img
                    , (select count(*) as cnt from tb_community_reply a where a.parent_seq = t1.reply_seq and a.is_delete = 'n') as reply_cnt
                from
                    tb_community_reply t1
                inner join tb_member t2 on t2.seq = t1.member_seq 
                where
                    t1.is_delete = 'n' 
                    and t1.community_seq = ?
                    and t1.parent_seq = ? 
                order by t1.created_at desc ";
            if($offset !== '') {
                $sql .= "limit " . $offset . ", " . $perpage;
            }
                
        
        return $this->db->query($sql, array($req['community_seq'], $req['parent_seq']));
    }

    public function reply_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_community_reply t1
                inner join tb_member t2 on t2.seq = t1.member_seq
                where
                    t1.is_delete = 'n' 
                    and t1.community_seq = ?
                    and t1.parent_seq = ? ";
        
        $tmp = $this->db->query($sql, array($req['community_seq'], $req['parent_seq']))->row_array();
        return $tmp['cnt'];
    }

    public function insert_reply($req) {
        $this->db->trans_begin();

        $this->db->set('member_seq', $req['member_seq']);
        $this->db->set('community_seq', $req['community_seq']);
        $this->db->set('parent_seq', $req['parent_seq']);
        $this->db->set('depth', $req['depth']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_community_reply');
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_reply($req) {
        $this->db->trans_begin();

        $this->db->set('contents', $req['contents']);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('reply_seq', $req['seq']);

        $this->db->update('tb_community_reply');
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_reply($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('reply_seq', $req['seq']);

        $this->db->update('tb_community_reply');
        
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