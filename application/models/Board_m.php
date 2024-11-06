<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_qna($req) {
        $this->db->trans_begin();

        $this->db->set('member_seq', $req['seq']);
        $this->db->set('company_name', $req['company_name']);
        $this->db->set('employee_name', "FN_ENCRYPT('" . $req['employee_name'] . "')", false);
        $this->db->set('employee_tel', "FN_ENCRYPT('" . $req['employee_tel'] . "')", false);
        $this->db->set('employee_email', "FN_ENCRYPT('" . $req['employee_email'] . "')", false);
        $this->db->set('contents', $req['contents']);
        $this->db->set('question_at', 'now()', false);
        $this->db->set('is_answer', 'n');

        $this->db->insert('tb_qna');
        $seq = $this->db->insert_id();

        if(!empty($req['file_newpath'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'qna');
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

    public function update_qna($req) {
        $this->db->trans_begin();

        $this->db->set('answer_title', $req['answer_title']);
        $this->db->set('answer', $req['answer']);
        $this->db->set('answered_by', $req['member_id']);
        $this->db->set('answered_at', 'now()', false);
        $this->db->set('is_answer', 'y');
        $this->db->where('qna_seq', $req['qna_seq']);

        $this->db->update('tb_qna');

        if(!empty($req['file_newpath'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'ans');
            $this->db->set('parent_cd', $req['qna_seq']);
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

    public function faq_list($category) {
        $sql = "select
                    faq_seq
                    , title
                    , contents
                    , order_no
                    , category
                    , updated_by
                    , date_format(updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_faq
                where
                    is_use = 'y'
                    and is_delete = 'n'
                    and FIND_IN_SET(?, category) 
                order by order_no ";
        return $this->db->query($sql, array($category));
    }

    public function faq_info($seq) {
        $sql = "select
                    faq_seq
                    , category
                    , title
                    , contents
                    , order_no
                from
                    tb_faq
                where
                    faq_seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function notice_list($req, $offset, $perpage) {
        $sql = "select
                    t1.notice_seq
                    , t1.title
                    , t1.contents

                    , t1.thumbnail_img as thumbnail

                    , date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n'
                    and t1.notice_type = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.created_at desc
                limit ?, ? ";
        return $this->db->query($sql, array($req['type'], $offset, $perpage));
    }

    public function notice_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n'
                    and t1.notice_type = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array($req['type']))->row_array();
        return $tmp['cnt'];
    }

    public function notice_list_total($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.title like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function notice_info($seq) {
        $sql = "select
                    t1.notice_seq
                    , t1.notice_type
                    , t1.title
                    , t1.contents

                    , ifnull((SELECT notice_seq FROM tb_notice a WHERE a.notice_seq < t1.notice_seq and a.notice_type = t1.notice_type and a.is_delete = 'n' ORDER BY a.notice_seq DESC LIMIT 1), '') as prev_seq
                    , ifnull((SELECT notice_seq FROM tb_notice a WHERE a.notice_seq > t1.notice_seq and a.notice_type = t1.notice_type and a.is_delete = 'n' ORDER BY a.notice_seq LIMIT 1), '') as next_seq
  
                    , date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_notice t1
                where
                    t1.is_delete = 'n'
                    and t1.notice_seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function faq_category_list()
    {
        $sql = "SELECT
                    t1.*
                    , (select count(*) from tb_faq a where FIND_IN_SET(t1.sub_code, a.category) and a.is_delete = 'n' and a.is_use = 'y') as faq_cnt
                FROM
                    tb_code t1
                WHERE
                    t1.main_code = 'faq_category'
                    and t1.is_delete = 'n'
                order by t1.order_no asc ";

        return $this->db->query($sql, array());
    }

    public function change_order($req) {
		$this->db->trans_begin();

		if($req['dir'] == 'up') {
			$sql = "select 
						t1.faq_seq
						, t1.order_no
					from
						tb_faq t1
					where
						t1.is_delete = 'n'
						and " . $req['order_no'] . " > t1.order_no
					order by t1.order_no desc
					limit 0, 1 ";
		}
		else {
			$sql = "select 
						t1.faq_seq
						, t1.order_no
					from
						tb_faq t1
			    	where
    					t1.is_delete = 'n'
 				   		and " . $req['order_no'] . " < t1.order_no
			    	order by t1.order_no asc
			    	limit 0, 1 ";
		}
		$res = $this->db->query($sql, array())->row_array();

        if(!empty($res)) {
            $sql = "update tb_faq
                    set
                        order_no = ?
                        , updated_at = now()
                        , updated_by = ?
                    where
                        faq_seq = ?  ";
            $this->db->query($sql, array($req['order_no'], $req['member_id'], $res['faq_seq']));
            $this->db->query($sql, array($res['order_no'], $req['member_id'], $req['faq_seq']));

        }

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}       
    
    public function insert_faq($req) {
		$this->db->trans_begin();

        $this->db->set('category', implode(',', $req['category']));
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('order_no', "ifnull((select order_no + 1 from tb_faq a where a.is_delete = 'n' order by order_no desc limit 1), 1)", false);
        $this->db->set('is_use', 'y');
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at',  'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_faq');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_faq($req) {
		$this->db->trans_begin();

        $this->db->set('category', implode(',', $req['category']));
        $this->db->set('title', $req['title']);
        $this->db->set('contents', $req['contents']);
        $this->db->set('is_use', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('faq_seq', $req['faq_seq']);
        $this->db->update('tb_faq');
        
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function delete_faq($req) {
		$this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('faq_seq', $req['faq_seq']);
        $this->db->update('tb_faq');
        
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function qna_list($req, $offset, $perpage) {
        $sql = "select
                    t1.qna_seq
                    , t2.member_id
                    , t1.company_name
                    , FN_DECRYPT(t1.employee_name) as employee_name
                    , FN_DECRYPT(t1.employee_tel) as employee_tel
                    , FN_DECRYPT(t1.employee_email) as employee_email
                    , t1.is_answer
                    , date_format(t1.question_at, '%Y.%m.%d %H:%i') as question_at
                    , ifnull(t1.answered_by, '') as answered_by
                    , if(t1.answered_at is not null, date_format(t1.answered_at, '%Y.%m.%d %H:%i'), '') as answered_at
                from
                    tb_qna t1
                inner join tb_member t2 on t2.seq = t1.member_seq
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.employee_name) like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['is_answer'])) {
            $sql .= " and t1.is_answer ";
        }
        $sql .= " order by t1.question_at desc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function qna_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_qna t1
                inner join tb_member t2 on t2.seq = t1.member_seq
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.employee_name) like '%" . $req['keyword'] . "%' or t1.contents like '%" . $req['keyword'] . "%') ";
        }
        if(!empty($req['is_answer'])) {
            $sql .= " and t1.is_answer ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function qna_info($seq) {
        $sql = "select
                    t1.qna_seq
                    , t2.member_id
                    , t1.company_name
                    , FN_DECRYPT(t1.employee_name) as employee_name
                    , FN_DECRYPT(t1.employee_tel) as employee_tel
                    , FN_DECRYPT(t1.employee_email) as employee_email
                    , t1.contents
                    , t1.is_answer
                    , t1.answer_title
                    , t1.answer
                    , date_format(t1.question_at, '%Y.%m.%d %H:%i') as question_at
                    , ifnull(t1.answered_by, '') as answered_by
                    , if(t1.answered_at is not null, date_format(t1.answered_at, '%Y.%m.%d %H:%i'), '') as answered_at
                from
                    tb_qna t1
                inner join tb_member t2 on t2.seq = t1.member_seq
                where
                    qna_seq = ? ";
        return $this->db->query($sql, array($seq));
    }

}


?>