<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function member_login_check($req) {
        $sql = "select
                    t1.seq
                    , t1.member_id
                    , t1.member_type
                    , FN_DECRYPT(t1.name) as name
                    , t1.is_block
                    , t1.is_dormant
                    , t1.is_leave
                    , ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t1.seq and a.is_delete = 'n' order by created_at desc limit 1), '') as profile_img
                from
                    tb_member t1
                where
                    t1.member_id = ? 
                    and t1.member_pw = SHA2(?, 512) ";
        
        return $this->db->query($sql, array($req['member_id'], $req['member_pw']));
    }

    public function member_pw_check($cd, $pw) {
        $this->db->where('seq', $cd);
        $this->db->where('member_pw', "SHA2('" . $pw . "', 512)", false);
        return $this->db->get('tb_member');
    }

    public function member_id_check($id) {
        $this->db->where('member_id', $id);
        return $this->db->get('tb_member');
    }

    public function member_tel_check($tel) {
        $this->db->where('FN_DECRYPT(tel)', $tel);
        return $this->db->get('tb_member');
    }

    public function member_email_check($tel) {
        $this->db->where('FN_DECRYPT(email)', $tel);
        return $this->db->get('tb_member');
    }

    public function member_nickname_check($nickname) {
        $this->db->where('nickname', $nickname);
        return $this->db->get('tb_member');
    }

    public function member_nickname_check2($cd, $nickname) {
        $sql = "select
                    seq
                from
                    tb_member
                where
                    nickname = ?
                    and seq != ? ";
        return $this->db->query($sql, array($nickname, $cd));
    }

    public function company_email_check($email) {
        $this->db->where('company_email', $email);
        return $this->db->get('tb_member');
    }

    public function employee_email_check($email) {
        $this->db->where('FN_DECRYPT(employee_email)', $email);
        return $this->db->get('tb_member');
    }

    public function update_member_pwreset($req) {
        $this->db->set('token', $req['token']);
        $this->db->set('token_expire', 'date_add(now(), INTERVAL 1 DAY)', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');
    }

    public function member_info_by_token($token) {
        $sql = "select
                    seq
                from
                    tb_member
                where
                    token = ?
                    and date_format(token_expire, '%Y-%m-%d %H:%i') >= date_format(now(), '%Y-%m-%d %H:%i') ";
        
        return $this->db->query($sql, array($token));
    }

    public function change_reset_pw($req) {
        $this->db->set('member_pw', "SHA2('" . $req['new_pw'] . "', 512)", false);
        $this->db->set('token', '');
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');
    }

    public function employee_email_check2($cd, $email) {
        $sql = "select
                    seq
                from
                    tb_member
                where
                    FN_DECRYPT(employee_email) = ?
                    and seq != ? ";
        return $this->db->query($sql, array($email, $cd));
    }

    public function company_bizno_check($bizno) {
        $this->db->where('biz_no', $bizno);
        return $this->db->get('tb_member');
    }

    public function insert_member($req) {
        $this->db->trans_begin();

        $this->db->set('member_id', $req['member_id']);
        $this->db->set('member_pw', "SHA2('" . $req['member_pw'] . "', 512)", false);
        $this->db->set('member_type', $req['member_type']);
        $this->db->set('interest_cd', $req['interest']);
        $this->db->set('name', "FN_ENCRYPT('" . $req['name'] . "')", false);
        $this->db->set('tel', "FN_ENCRYPT('" . $req['tel'] . "')", false);
        $this->db->set('email', "FN_ENCRYPT('" . $req['email'] . "')", false);

        $this->db->set('joined_at', 'now()', false);
        $this->db->set('joined_ip', $req['joined_ip']);
        $this->db->set('created_by', '0');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', '0');
        $this->db->set('updated_at', 'now()', false);

        $this->db->insert('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function update_login($req) {
        $this->db->trans_begin();

        $this->db->set('last_login_at', 'now()', false);
        $this->db->set('last_login_ip', $req['last_login_ip']);
        $this->db->where('seq', $req['seq']);

        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
        
    }

    public function member_info($cd) {
        $sql = "select
                    t1.seq
                    , t1.member_id
                    , t1.member_type
                    , FN_GETCODENAME('member_type', t1.member_type) as member_type_name
                    , FN_GETCODENAME('interest', t1.interest_cd) as interest_name
                    , (select a.new_filepath from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t1.seq and a.is_delete = 'n' order by created_at desc limit 1) as profile_img
                    , (select a.org_filename from tb_file a where a.parent_gbn = 'profile' and a.parent_cd = t1.seq and a.is_delete = 'n' order by created_at desc limit 1) as profile_img_name
                    , ifnull(t1.homepage, '') as homepage
                    , ifnull(t1.nation_biz_type, '') as nation_biz_type
                    , ifnull(t1.kotra_apply, '') as kotra_apply
                    , t1.interest_cd

                    , FN_DECRYPT(t1.name) as name
                    , FN_DECRYPT(t1.tel) as tel
                    , FN_DECRYPT(t1.email) as email

                    , ifnull(t1.is_block, 'n') as is_block
                    , t1.blocked_memo
                    , date_format(t1.blocked_at, '%Y.%m.%d %H:%i') as blocked_at
                    , ifnull(t1.is_leave, 'n') as is_leave
                    , t1.leaved_memo
                    , date_format(t1.leaved_at, '%Y.%m.%d %H:%i') as leaved_at
                    , t1.leaved_type
                    , ifnull(t1.is_dormant, 'n') as is_dormant
                    , date_format(t1.dormanted_at, '%Y.%m.%d') as dormanted_at
                
                    , t1.zonecode
                    , t1.addr
                    , t1.addr_detail
                    , t1.incorporation_at
                    , t1.industrial_code
                from
                    tb_member t1
                where
                    t1.seq = ? ";
        
        return $this->db->query($sql, array($cd));
    }

    public function update_password($cd, $pw) {
        $this->db->trans_begin();

        $this->db->set('member_pw', "SHA2('" . $pw . "', 512)", false);
        $this->db->where('seq', $cd);
        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_field($cd, $field, $val) {
        $this->db->trans_begin();

        $this->db->set($field, $val);
        $this->db->where('seq', $cd);
        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_member($req) {
        $this->db->trans_begin();

        $this->db->set('interest_cd', $req['interest']);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if((!empty($req['del_profile_img']) && $req['del_profile_img'] === 'y') || !empty($req['profile_img_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'profile');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');
        }

        if(!empty($req['profile_img_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'introduce');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'profile');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['profile_img_orgname']);
            $this->db->set('new_filepath', $req['profile_img_newpath']);
            $this->db->set('new_filename', $req['profile_img_newname']);
            $this->db->set('file_size', $req['profile_img_size']);
            $this->db->set('file_ext', $req['profile_img_ext']);
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


    public function update_member_distribution($req) {
        $this->db->trans_begin();

        $this->db->set('employee_name', "FN_ENCRYPT('" . trim($req['employee_name']) . "')", false);
        $this->db->set('employee_tel', "FN_ENCRYPT('" . trim($req['employee_tel']) . "')", false);
        $this->db->set('employee_email', "FN_ENCRYPT('" . trim($req['employee_email']) . "')", false);
        $this->db->set('net_profit', preg_replace('/[^0-9]*/s', '', $req['net_profit']));
        $this->db->set('staff_number', preg_replace('/[^0-9]*/s', '', $req['staff_number']));
        $this->db->set('homepage', trim($req['homepage']));
        $this->db->set('credit_rating', trim($req['credit_rating']));
        $this->db->set('incorporation_at', trim($req['incorporation_at']));
        $this->db->set('industrial_code', trim($req['industrial_code']));
        $this->db->set('nation_biz_type', trim($req['nation_biz_type']));
        $this->db->set('kotra_apply', trim($req['kotra_apply']));
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if(!empty($req['bizcard_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'bizcard');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'bizcard');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['bizcard_file_orgname']);
            $this->db->set('new_filepath', $req['bizcard_file_newpath']);
            $this->db->set('new_filename', $req['bizcard_file_newname']);
            $this->db->set('file_size', $req['bizcard_file_size']);
            $this->db->set('file_ext', $req['bizcard_file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }

        if(!empty($req['introduce_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'introduce');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'introduce');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['introduce_file_orgname']);
            $this->db->set('new_filepath', $req['introduce_file_newpath']);
            $this->db->set('new_filename', $req['introduce_file_newname']);
            $this->db->set('file_size', $req['introduce_file_size']);
            $this->db->set('file_ext', $req['introduce_file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }

        if(!empty($req['etc_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'etcfile');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'etcfile');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['etc_file_orgname']);
            $this->db->set('new_filepath', $req['etc_file_newpath']);
            $this->db->set('new_filename', $req['etc_file_newname']);
            $this->db->set('file_size', $req['etc_file_size']);
            $this->db->set('file_ext', $req['etc_file_ext']);
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


    public function update_member_brand($req) {
        $this->db->trans_begin();

        $this->db->set('employee_name', "FN_ENCRYPT('" . trim($req['employee_name']) . "')", false);
        $this->db->set('employee_tel', "FN_ENCRYPT('" . trim($req['employee_tel']) . "')", false);
        $this->db->set('employee_email', "FN_ENCRYPT('" . trim($req['employee_email']) . "')", false);
        $this->db->set('net_profit', preg_replace('/[^0-9]*/s', '', $req['net_profit']));
        $this->db->set('staff_number', preg_replace('/[^0-9]*/s', '', $req['staff_number']));
        $this->db->set('homepage', trim($req['homepage']));
        $this->db->set('credit_rating', trim($req['credit_rating']));
        $this->db->set('incorporation_at', trim($req['incorporation_at']));
        $this->db->set('industrial_code', trim($req['industrial_code']));
        $this->db->set('nation_biz_type', trim($req['nation_biz_type']));
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if(!empty($req['bizcard_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'bizcard');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'bizcard');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['bizcard_file_orgname']);
            $this->db->set('new_filepath', $req['bizcard_file_newpath']);
            $this->db->set('new_filename', $req['bizcard_file_newname']);
            $this->db->set('file_size', $req['bizcard_file_size']);
            $this->db->set('file_ext', $req['bizcard_file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }

        if(!empty($req['introduce_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'introduce');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'introduce');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['introduce_file_orgname']);
            $this->db->set('new_filepath', $req['introduce_file_newpath']);
            $this->db->set('new_filename', $req['introduce_file_newname']);
            $this->db->set('file_size', $req['introduce_file_size']);
            $this->db->set('file_ext', $req['introduce_file_ext']);
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', $req['member_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', $req['member_id']);
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_file');
        }

        if(!empty($req['etc_file_orgname'])) {
            $this->db->reset_query();
            $this->db->set('is_delete', 'y');
            $this->db->where('parent_gbn', 'etcfile');
            $this->db->where('parent_cd', $req['seq']);
            $this->db->update('tb_file');

            $this->db->reset_query();
            $this->db->set('parent_gbn', 'etcfile');
            $this->db->set('parent_cd', $req['seq']);
            $this->db->set('file_no', '1');
            $this->db->set('org_filename', $req['etc_file_orgname']);
            $this->db->set('new_filepath', $req['etc_file_newpath']);
            $this->db->set('new_filename', $req['etc_file_newname']);
            $this->db->set('file_size', $req['etc_file_size']);
            $this->db->set('file_ext', $req['etc_file_ext']);
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
  
    public function member_info_for_request($cd) {
        $sql = "select
                    t1.seq
                    , t1.member_id
                    , t1.member_type
                    , FN_DECRYPT(t1.name) as name
                    , t1.biz_no
                    , t1.owner_name
                    , t1.company_tel
                    , t1.company_email
                    , FN_DECRYPT(t1.employee_name) as employee_name
                    , FN_DECRYPT(t1.employee_tel) as employee_tel
                    , FN_DECRYPT(t1.employee_email) as employee_email

                    , t1.zonecode
                    , t1.addr
                    , t1.addr_detail
                from
                    tb_member t1
                where
                    t1.seq = ? ";
        
        return $this->db->query($sql, array($cd));
    }
  
    public function member_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.member_id
                    , t1.member_type
                    , FN_GETCODENAME('member_type', t1.member_type) as member_type_name
                    , FN_GETCODENAME('interest', t1.interest_cd) as interest_cd_name
                    , FN_DECRYPT(t1.name) as name
                    , FN_DECRYPT(t1.tel) as tel
                    , FN_DECRYPT(t1.email) as email
                    , ifnull(t1.homepage, '') as homepage

                    , date_format(t1.joined_at, '%Y.%m.%d') as joined_at

                    , ifnull(t1.is_block, 'n') as is_block
                    , t1.blocked_memo
                    , date_format(t1.blocked_at, '%Y.%m.%d %H:%i') as blocked_at
                    , ifnull(t1.is_leave, 'n') as is_leave
                    , t1.leaved_memo
                    , date_format(t1.leaved_at, '%Y.%m.%d %H:%i') as leaved_at
                    , t1.leaved_type
                    , ifnull(t1.is_dormant, 'n') as is_dormant
                    , date_format(t1.dormanted_at, '%Y.%m.%d') as dormanted_at
                from
                    tb_member t1 
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.member_id like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.name like) '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.created_at desc
                limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function member_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_member t1 
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.member_id like '%" . $req['keyword'] . "%' or FN_DECRYPT(t1.name like) '%" . $req['keyword'] . "%') ";
        }
        
       $tmp = $this->db->query($sql, array())->row_array();
       return $tmp['cnt'];
    }


    public function update_member_leave($req) {
        $this->db->trans_begin();

        $this->db->set('is_leave', 'y');
        $this->db->set('leaved_memo', $req['leaved_memo']);
        $this->db->set('leaved_at', 'now()', false);
        $this->db->set('leaved_type', $req['leaved_type']);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }    

    public function update_member_block($req) {
        $this->db->trans_begin();

        $this->db->set('is_block', 'y');
        $this->db->set('blocked_memo', $req['blocked_memo']);
        $this->db->set('blocked_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }    

    public function update_member_unleave($req) {
        $this->db->trans_begin();

        $this->db->set('is_leave', 'n');
        $this->db->set('leaved_memo', '');
        $this->db->set('leaved_at', 'now()', false);
        $this->db->set('leaved_type', '');
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }    

    public function update_member_unblock($req) {
        $this->db->trans_begin();

        $this->db->set('is_block', 'n');
        $this->db->set('blocked_memo', '');
        $this->db->set('blocked_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_member');

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