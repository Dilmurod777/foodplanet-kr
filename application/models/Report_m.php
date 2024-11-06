<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function report_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.report_seq ,
                    t1.report_type ,
                    case when t1.report_type = '1' then '분석리포트'
                            when t1.report_type = '2' then '뉴스레터'
                            end as report_type_name ,
                    t1.report_type2 ,
                    case when t1.report_type2 = '1' then '국가별'
                            when t1.report_type2 = '2' then '제품별'
                            end as report_type2_name ,
                    t1.title ,
                    t1.contents ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at ,
                    t1.hit_cnt , 
                    t1.thumbnail_img as thumbnail ,
                    created_by
                from
                    tb_report t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['report_type'])) {
            $sql .= " and t1.report_type = '" . $req['report_type'] . "' ";
        }
        if(!empty($req['report_type2'])) {
            $sql .= " and t1.report_type2 = '" . $req['report_type2'] . "' ";
        }
        $sql .= " order by t1.created_at desc
                    limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function report_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                from
                    tb_report t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['report_type'])) {
            $sql .= " and t1.report_type = '" . $req['report_type'] . "' ";
        }
        if(!empty($req['report_type2'])) {
            $sql .= " and t1.report_type2 = '" . $req['report_type2'] . "' ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function report_info($seq) {
        $sql = "SELECT
                    t1.report_seq ,
                    t1.report_type ,
                    case when t1.report_type = '1' then '분석리포트'
                            when t1.report_type = '2' then '뉴스레터'
                            end as report_type_name ,
                    t1.report_type2 ,
                    case when t1.report_type2 = '1' then '국가별'
                            when t1.report_type2 = '2' then '제품별'
                            end as report_type2_name ,
                    t1.title ,
                    t1.contents ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at ,
                    t1.hit_cnt , 
                    t1.thumbnail_img as thumbnail ,
                    t1.thumbnail_img ,
                    t1.thumbnail_img_name ,
                    t1.created_by ,
                    t1.tags ,

                    ifnull((SELECT report_seq FROM tb_report a WHERE a.report_seq < t1.report_seq and a.is_delete = 'n' and a.report_type = t1.report_type ORDER BY a.report_seq DESC LIMIT 1), '') as prev_seq ,
                    ifnull((SELECT report_seq FROM tb_report a WHERE a.report_seq > t1.report_seq and a.is_delete = 'n' and a.report_type = t1.report_type ORDER BY a.report_seq LIMIT 1), '') as next_seq
                from
                    tb_report t1
                where
                    t1.is_delete = 'n'
                    and t1.report_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function insert_report($req) {
        $this->db->trans_begin();

        $this->db->set('report_type', $req['report_type']);
        $this->db->set('report_type2', $req['report_type2']);
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('thumbnail_img', $req['thumbnail_img']);
        $this->db->set('thumbnail_img_name', $req['thumbnail_img_name']);
        $this->db->set('tags', $req['tags']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_report');
        $seq = $this->db->insert_id();

        if(!empty($req['file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'report');
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

    public function update_report($req) {
        $this->db->trans_begin();

        $this->db->set('report_type', $req['report_type']);
        $this->db->set('report_type2', $req['report_type2']);
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        if(!empty($req['thumbnail_img'])) {
            $this->db->set('thumbnail_img', $req['thumbnail_img']);
            $this->db->set('thumbnail_img_name', $req['thumbnail_img_name']);
        }
        $this->db->set('tags', $req['tags']);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('report_seq', $req['report_seq']);

        $this->db->update('tb_report');

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
            $this->db->set('parent_gbn', 'report');
            $this->db->set('parent_cd', $req['report_seq']);
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

    public function delete_report($req) {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('report_seq', $req['report_seq']);
        $this->db->update('tb_report');

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('parent_gbn', 'report');
        $this->db->where('parent_cd', $req['report_seq']);
        $this->db->update('tb_file');

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