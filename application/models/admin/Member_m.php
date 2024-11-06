<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function member_list($req, $offset, $perpage) {
        $sql = "select
                    t1.member_id
                    , t1.member_type
                    , FN_GETCODENAME('member_type', t1.member_type) as member_type_name
                    , FN_GETCODENAME('nation', t1.nation_cd) as nation_cd_name
                    , FN_GETCODENAME('industry', t1.industry_cd) as industry_cd_name
                    , FN_GETCODENAME('company_type', t1.company_type) as company_type_name
                    , t1.nickname
                    , t1.company_name
                    , t1.biz_no
                    , t1.owner_name
                    , t1.company_tel
                    , t1.company_email
                    , FN_DECRYPT(t1.employee_name) as employee_name
                    , FN_DECRYPT(t1.employee_tel) as employee_tel
                    , FN_DECRYPT(t1.employee_email) as employee_email
                    , ifnull(t1.homepage, '') as homepage

                    , ifnull(t1.incorporation_at, '') as incorporation_at
                    , ifnull(t1.industrial_code, '') as industrial_code
                    , ifnull(t1.facilities_scale, '') as facilities_scale
                    , ifnull(t1.net_profit, '') as net_profit
                    , ifnull(t1.biz_profit, '') as biz_profit

                    , ifnull(t1.company_name_eng, '') as company_name_eng
                    , ifnull(t1.tags, '') as tags
                    , ifnull(t1.summary, '') as summary
                    , ifnull(t1.zonecode, '') as zonecode
                    , ifnull(t1.addr, '') as addr
                    , ifnull(t1.addr_detail, '') as addr_detail

                    , t1.level_cd
                    , FN_GETCODENAME('member_level', t1.level_cd) as level_name
                    , t1.status
                    , case t1.status when 'request' then '요청중'
                                    when 'deny' then '승인거절'
                                    when 'apply' then '승인'
                                    end as status_name
                    , if(t1.status_at is not null, date_format(t1.status_at, '%Y-%m-%d %H:%i'), '') as status_at
                    , ifnull(t1.status_memo, '') as status_memo

                    , ifnull(t1.staff_number, '') as staff_number
                    , ifnull(t1.annual_sales, '') as annual_sales
                from
                    tb_member t1 
                where
                    1=1 ";
        if(!empty($req['status'])) {
            $sql .= " and t1.status = '" . $req['status'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.member_id like '%" . $req['keyword'] . "%' or t1.nickname like '%" . $req['keyword'] . "%') ";
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
        if(!empty($req['status'])) {
            $sql .= " and t1.status = '" . $req['status'] . "' ";
        }
                    
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.member_id like '%" . $req['keyword'] . "%' or t1.nickname like '%" . $req['keyword'] . "%' or t1.company_name like '%" . $req['keyword'] . "%') ";
        }
        
       $tmp = $this->db->query($sql, array())->row_array();
       return $tmp['cnt'];
    }

}

?>