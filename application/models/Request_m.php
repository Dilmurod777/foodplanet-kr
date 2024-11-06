<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Request_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_request($req) {
        $this->db->trans_begin();

        $this->db->set('req_type', '1');
        $this->db->set('req_title', $req['title']);
        $this->db->set('target_member_cd', $req['target_member_cd']);
        $this->db->set('target_detail_seq', !empty($req['target_detail_seq']) ? $req['target_detail_seq'] : '0');
        $this->db->set('target_company_name', $req['target_company_name']);
        $this->db->set('target_product_name', $req['target_product_name']);
        $this->db->set('target_qty', preg_replace('/[^0-9]*/s', '', $req['target_qty']));
        $this->db->set('target_price', preg_replace('/[^0-9]*/s', '', $req['target_price']));
        $this->db->set('req_member_cd', $req['req_member_cd']);
        $this->db->set('req_company_name', $req['req_company_name']);
        $this->db->set('req_biz_no', $req['req_biz_no']);
        $this->db->set('req_owner_name', $req['req_owner_name']);
        $this->db->set('req_company_tel', $req['req_company_tel']);
        $this->db->set('req_employee_name', "FN_ENCRYPT('" . trim($req['req_employee_name']) . "')", false);
        $this->db->set('req_employee_tel', "FN_ENCRYPT('" . trim($req['req_employee_tel']) . "')", false);
        $this->db->set('req_employee_email', "FN_ENCRYPT('" . trim($req['req_employee_email']) . "')", false);
        $this->db->set('req_zonecode', $req['req_zonecode']);
        $this->db->set('req_addr', $req['req_addr']);
        $this->db->set('req_addr_detail', $req['req_addr_detail']);
        $this->db->set('delivery_info', $req['delivery_info']);
        $this->db->set('delivery_day', $req['delivery_day']);
        $this->db->set('delivery_zonecode', $req['delivery_zonecode']);
        $this->db->set('delivery_addr', $req['delivery_addr']);
        $this->db->set('delivery_addr_detail', $req['delivery_addr_detail']);
        $this->db->set('status', 'req');
        $this->db->set('requested_at', 'now()', false);

        $this->db->insert('tb_request');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_estimate($req) {
        $sql = "select
                    t1.request_seq
                    , t1.req_company_name
                    , t1.req_owner_name
                    , t1.req_company_tel
                    , t1.req_biz_no
                    , t1.req_member_cd
                    , t1.req_addr
                    , t1.req_addr_detail
                    , t1.req_title
                    , t1.ans_title

                from
                    tb_request t1
                where
                    t1.request_seq = ? ";

        $res = $this->db->query($sql, array($req['request_seq']))->row_array();

        $this->db->trans_begin();

        $this->db->set('req_type', '2');
        $this->db->set('target_member_cd', $res['req_member_cd']);
        $this->db->set('target_detail_seq', !empty($res['target_detail_seq']) ? $res['target_detail_seq'] : '0');
        $this->db->set('target_company_name', $res['req_company_name']);
        
        $this->db->set('target_product_name', $req['target_product_name']);
        $this->db->set('target_qty', preg_replace('/[^0-9]*/s', '', $req['target_qty']));
        $this->db->set('target_price', preg_replace('/[^0-9]*/s', '', $req['target_price']));
        $this->db->set('target_total_price', preg_replace('/[^0-9]*/s', '', $req['target_total_price']));
        $this->db->set('target_total_vat', preg_replace('/[^0-9]*/s', '', $req['target_total_vat']));
        $this->db->set('target_total_sum', preg_replace('/[^0-9]*/s', '', $req['target_total_sum']));

        $this->db->set('req_title', $req['req_title']);
        $this->db->set('req_member_cd', $req['req_member_cd']);
        $this->db->set('req_company_name', $req['req_company_name']);
        $this->db->set('req_biz_no', $req['req_biz_no']);
        $this->db->set('req_owner_name', $req['req_owner_name']);
        $this->db->set('req_company_tel', $req['req_company_tel']);
        $this->db->set('req_employee_name', "FN_ENCRYPT('" . trim($req['req_employee_name']) . "')", false);
        $this->db->set('req_employee_tel', "FN_ENCRYPT('" . trim($req['req_employee_tel']) . "')", false);
        $this->db->set('req_employee_email', "FN_ENCRYPT('" . trim($req['req_employee_email']) . "')", false);
        $this->db->set('req_zonecode', $req['req_zonecode']);
        $this->db->set('req_addr', $req['req_addr']);
        $this->db->set('req_addr_detail', $req['req_addr_detail']);
        $this->db->set('status', 'ans');
        $this->db->set('requested_at', 'now()', false);

        $this->db->insert('tb_request');

        $this->db->reset_query();
        $this->db->set('status', 'ans');
        $this->db->set('answered_at', 'now()', false);
        $this->db->where('request_seq', $req['request_seq']);
        $this->db->update('tb_request');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_qna($req, $member, $target) {
        $this->db->trans_begin();

        $this->db->set('req_type', '3');
        $this->db->set('req_title', $req['req_title']);
        $this->db->set('target_member_cd', $target['member_cd']);
        $this->db->set('target_company_name', $target['company_name']);
        $this->db->set('req_member_cd', $member['member_cd']);
        $this->db->set('req_company_name', $member['company_name']);
        $this->db->set('req_biz_no', $member['biz_no']);
        $this->db->set('req_owner_name', $member['owner_name']);
        $this->db->set('req_company_tel', $member['company_tel']);
        $this->db->set('req_employee_name', "FN_ENCRYPT('" . trim($member['employee_name']) . "')", false);
        $this->db->set('req_employee_tel', "FN_ENCRYPT('" . trim($member['employee_tel']) . "')", false);
        $this->db->set('req_employee_email', "FN_ENCRYPT('" . trim($member['employee_email']) . "')", false);
        $this->db->set('req_zonecode', $member['zonecode']);
        $this->db->set('req_addr', $member['addr']);
        $this->db->set('req_addr_detail', $member['addr_detail']);
        $this->db->set('req_contents', $req['req_contents']);
        $this->db->set('status', 'req');
        $this->db->set('requested_at', 'now()', false);

        $this->db->insert('tb_request');
        $seq = $this->db->insert_id();

        if(!empty($req['file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'request_qna');
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

        $this->db->set('ans_title', $req['ans_title']);
        $this->db->set('ans_contents', $req['ans_contents']);
        $this->db->set('status', 'ans');
        $this->db->set('answered_at', 'now()', false);
        $this->db->where('request_seq', $req['request_seq']);
        $this->db->update('tb_request');

        if(!empty($req['file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('parent_gbn', 'request_ans');
            $this->db->set('parent_cd', $req['request_seq']);
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

    public function request_list($req, $offset, $perpage) {
        $sql = "select
                    t1.request_seq
                    , t1.status
                    , case t1.status when 'req' then '요청중'
                                    when 'ans' then '답변완료'
                                    else '' end as status_name
                    , t1.req_type
                    , FN_GETCODENAME('req_type', t1.req_type) as req_type_name
                    , t1.target_company_name
                    , t1.req_company_name
                    , date_format(t1.requested_at, '%Y.%m.%d') as requested_at
                    , t1.req_member_cd
                    , t1.target_member_cd
                    , t1.req_title
                    , case when t1.req_type = '3' and t1.target_member_cd = ? then t1.ans_title
                            else t1.req_title end as title
                from
                    tb_request t1
                where
                    t1.target_member_cd = ? or t1.req_member_cd = ?
                order by t1.requested_at desc
                limit ?, ? ";

        return $this->db->query($sql, array($req['member_cd'], $req['member_cd'], $req['member_cd'], $offset, $perpage));
    }

    public function request_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_request t1
                where
                    t1.target_member_cd = ? or t1.req_member_cd = ? ";

        $tmp = $this->db->query($sql, array($req['member_cd'], $req['member_cd']))->row_array();
        return $tmp['cnt'];
    }

    public function request_list_for_dashboard($cd) {
        $sql = "select
                    TB1.* 
                    , date_format(TB1.order_date, '%Y.%m.%d %H:%i') as order_date2
                from
                (select
                    t1.request_seq
                    , t1.status
                    , t1.req_type
                    , t1.target_company_name
                    , t1.req_company_name
                    , date_format(t1.requested_at, '%Y.%m.%d') as requested_at
                    , t1.req_member_cd
                    , FN_GETCODENAME('member_level', (select a.level_cd from tb_member a where a.member_cd = t1.req_member_cd)) as req_member_level
                    , t1.target_member_cd
                    , FN_GETCODENAME('member_level', (select a.level_cd from tb_member a where a.member_cd = t1.target_member_cd)) as target_member_level
                    , t1.req_title
                    , t1.ans_title
                    , case when t1.req_type = '3' and t1.answered_at is not null then t1.answered_at
                            else t1.requested_at end as order_date
                from
                    tb_request t1
                where
                    t1.target_member_cd = ? or t1.req_member_cd = ?
                ) TB1
                order by TB1.order_date desc
                limit 0, 5 ";

        return $this->db->query($sql, array($cd, $cd));
    }

    public function request_info($seq) {
        $sql = "select
                    t1.request_seq
                    , t1.status
                    , case t1.status when 'req' then '요청중'
                                    when 'ans' then '답변완료'
                                    else '' end as status_name
                    , t1.req_type
                    , FN_GETCODENAME('req_type', t1.req_type) as req_type_name
                    , t1.target_company_name
                    , t1.target_product_name
                    , t1.target_qty
                    , t1.target_price
                    , t1.req_company_name
                    , t1.req_owner_name
                    , t1.req_company_tel
                    , t1.req_biz_no
                    , FN_DECRYPT(t1.req_employee_name) as req_employee_name
                    , FN_DECRYPT(t1.req_employee_tel) as req_employee_tel
                    , FN_DECRYPT(t1.req_employee_email) as req_employee_email
                    , date_format(t1.requested_at, '%Y.%m.%d') as requested_at
                    , t1.req_member_cd
                    , t1.target_member_cd
                    , t1.req_addr
                    , t1.req_addr_detail
                    , t1.req_title
                    , t1.ans_title

                    , t1.target_total_price
                    , t1.target_total_vat
                    , t1.target_total_sum

                    , t1.delivery_info
                    , date_format(t1.delivery_day, '%Y.%m.%d') as delivery_day
                    , t1.delivery_addr
                    , t1.delivery_addr_detail

                    , t1.req_contents
                    , t1.ans_contents

                from
                    tb_request t1
                where
                    t1.request_seq = ? ";

        return $this->db->query($sql, array($seq));
    }
}    

?>