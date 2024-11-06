<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_notice($req) {
        $this->db->trans_begin();

        $this->db->set('notice_type', $req['notice_type']);
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('thumbnail_img', $req['thumbnail_img']);
        $this->db->set('thumbnail_img_name', $req['thumbnail_img_name']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_notice');
        $seq = $this->db->insert_id();

        if(!empty($req['file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'notice');
            $this->db->set('parent_cd', $seq);
            $this->db->set('file_no', 1);
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

    public function update_notice($req) {
        $this->db->trans_begin();

        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        if(!empty($req['thumbnail_img'])) {
            $this->db->set('thumbnail_img', $req['thumbnail_img']);
            $this->db->set('thumbnail_img_name', $req['thumbnail_img_name']);
        }
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('notice_seq', $req['notice_seq']);

        $this->db->update('tb_notice');

        if(!empty($req['delete_file'])) {
            $sql = "update tb_file
                    set
                        is_delete = 'y'
                        , updated_by = '" . $req['member_id'] . "' 
                        , updated_at = now()
                    where
                        file_seq = ? ";
            $this->db->query($sql, array($req['delete_file']));
        }
        if(!empty($req['file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'notice');
            $this->db->set('parent_cd', $req['notice_seq']);
            $this->db->set('file_no', 1);
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

    public function delete_notice($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('notice_seq', $req['notice_seq']);
        $this->db->update('tb_notice');

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('parent_gbn', 'notice');
        $this->db->where('parent_cd', $req['notice_seq']);
        $this->db->update('tb_file');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
        
    }


    public function notice_info($cd) {
        $sql = "select
                    t1.notice_seq
                    , t1.notice_type
                    , case when t1.notice_type = 'event' then '이벤트'
                            when t1.notice_type = 'news' then '뉴스'
                            end as notice_type_name
                    , t1.title
                    , t1.contents
                    , t1.thumbnail_img
                    , t1.thumbnail_img_name
                    , t1.created_by
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i')  as created_at
                    , t1.updated_by
                    , date_format(t1.updated_by, '%Y.%m.%d %H:%i') as updated_at
                    , t1.hit_cnt
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n'
                    and t1.notice_seq = ? ";
        
        return $this->db->query($sql, array($cd));
    }

    public function notice_list($req, $offset, $perpage) {
        $sql = "select
                    t1.notice_seq
                    , t1.notice_type
                    , case when t1.notice_type = 'event' then '이벤트'
                            when t1.notice_type = 'news' then '뉴스'
                            end as notice_type_name
                    , t1.title
                    , t1.contents
                    , t1.created_by
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i')  as created_at
                    , t1.updated_by
                    , date_format(t1.updated_by, '%Y.%m.%d %H:%i') as updated_at                
                    , t1.hit_cnt
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['notice_type'])) {
            $sql .= " and notice_type = '" . $req['notice_type'] . "' ";
        }
        $sql .= " order by t1.created_at desc
                limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function notice_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['notice_type'])) {
            $sql .= " and notice_type = '" . $req['notice_type'] . "' ";
        }
        
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

}


?>