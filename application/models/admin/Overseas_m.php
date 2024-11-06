<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overseas_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function nation_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_name
                    , t1.nation_name_eng
                    , t1.nation_code
                    , t1.logo_img
                    , t1.background_img
                    , t1.flag_img
                    , t1.continent
                    , t1.currency
                    , t1.language
                    , t1.fta_status
                    , t1.hit_cnt
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_nation t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.nation_name like '%" . $req['keyword'] . "%' ";
        }
        $sql .= " order by t1.created_at desc, t1.nation_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function nation_list_all() {
        $sql = "select
                    t1.seq
                    , t1.nation_name
                    , t1.nation_name_eng
                    , t1.nation_code
                    , t1.logo_img
                    , t1.background_img
                    , t1.flag_img
                    , t1.continent
                    , t1.currency
                    , t1.language
                    , t1.fta_status
                    , t1.hit_cnt
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_nation t1
                where
                    t1.is_delete = 'n' 
                order by t1.created_at desc, t1.nation_name asc ";
        return $this->db->query($sql, array());
    }

    public function nation_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_nation t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.nation_name like '%" . $req['keyword'] . "%' ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function nation_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_name
                    , t1.nation_name_eng
                    , t1.nation_code
                    , t1.logo_img
                    , t1.background_img
                    , t1.flag_img
                    , t1.continent
                    , t1.currency
                    , t1.language
                    , t1.fta_status
                    , t1.hit_cnt
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_nation t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function product_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.product_name
                    , t1.product_name_eng
                    , t1.product_img
                    , t1.background_img
                    , t1.summary
                    , t1.hscode
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_product t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        $sql .= " order by t1.created_at desc, t1.product_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function product_list_all() {
        $sql = "select
                    t1.seq
                    , t1.product_name
                    , t1.product_name_eng
                    , t1.product_img
                    , t1.background_img
                    , t1.summary
                    , t1.hscode
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_product t1
                where
                    t1.is_delete = 'n' 
                order by t1.created_at desc, t1.product_name asc ";
        return $this->db->query($sql, array());
    }

    public function product_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_product t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function product_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.product_name
                    , t1.product_name_eng
                    , t1.product_img
                    , t1.background_img
                    , t1.summary
                    , t1.hscode
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_product t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function np_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.product_seq
                    , t1.nation_seq
                    , t1.nation_name
                    , t1.export_price
                    , t1.distribution_status
                    , t1.hit_cnt
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.product_name
                from
                    tb_overseas_np t1
                inner join tb_overseas_product t2 on t2.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.nation_name like '%" . $req['keyword'] . "%' or t2.product_name like '%" . $req['keyword'] . '%") ';
        }
        $sql .= " order by t1.nation_seq, t1.product_seq
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function np_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_np t1
                inner join tb_overseas_product t2 on t2.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.nation_name like '%" . $req['keyword'] . "%' or t2.product_name like '%" . $req['keyword'] . '%") ';
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function np_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.product_seq
                    , t1.nation_seq
                    , t1.nation_name
                    , t1.export_price
                    , t1.distribution_status
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_np t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function top_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.product_seq
                    , t1.nation_seq
                    , t1.order_no
                    , t1.product_name
                    , t1.hscode
                    , t1.price
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                from
                    tb_overseas_top t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keysord'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.order_no
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function top_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_top t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keysord'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function top_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.product_seq
                    , t1.nation_seq
                    , t1.order_no
                    , t1.product_name
                    , t1.hscode
                    , t1.price
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_top t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function buyer_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.company_name
                    , t1.owner_name
                    , t1.category
                    , t1.hscode
                    , t1.volume_order
                    , t1.available_period
                    , t1.product_name
                    , t1.desc
                    , t1.trade_condition
                    , t1.trade_volume
                    , t1.request_company_name
                    , t1.main_product
                    , t1.main_income
                    , t1.is_korea
                    , t1.contact
                    , t1.export_staff
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_buyer t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_seq, t1.company_name
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function buyer_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_buyer t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function buyer_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.company_name
                    , t1.owner_name
                    , t1.category
                    , t1.hscode
                    , t1.volume_order
                    , t1.available_period
                    , t1.product_name
                    , t1.desc
                    , t1.trade_condition
                    , t1.trade_volume
                    , t1.request_company_name
                    , t1.main_product
                    , t1.main_income
                    , t1.is_korea
                    , t1.contact
                    , t1.export_staff
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_buyer t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function trends_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.title
                    , t1.link_url
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_trends t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.title like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_seq, t1.title
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function trends_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_trends t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.title like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function trends_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.title
                    , t1.link_url
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_trends t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function channel_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.nation_name
                    , t1.channel_name
                    , t1.channel_name_eng
                    , t1.channel_name_origin
                    , t1.url
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_channel t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.nation_name like '%" . $req['keyword'] . "%' or t1.channel_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.channel_name
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function channel_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_channel t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.nation_name like '%" . $req['keyword'] . "%' or t1.channel_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function channel_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.nation_name
                    , t1.channel_name
                    , t1.channel_name_eng
                    , t1.channel_name_origin
                    , t1.url
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_channel t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function hscode_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.hscode
                    , t1.desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_hscode t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.hscode like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_seq
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function hscode_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_hscode t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.hscode like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function hscode_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.hscode
                    , t1.desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_hscode t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }    

    public function requirement_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_name
                    , t1.hscode
                    , t1.export_requirement
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                from
                    tb_overseas_requirement t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%' or t1.hscode like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_name
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function requirement_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_requirement t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%' or t1.hscode like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function requirement_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_name
                    , t1.hscode
                    , t1.export_requirement
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_requirement t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }    

    public function document_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.document_kind
                    , t1.hscode
                    , t1.title
                    , t1.desc
                    , t1.document
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_document t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t3.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.title like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_seq, t1.document_kind
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function document_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_document t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t3.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.title like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function document_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.document_kind
                    , t1.hscode
                    , t1.title
                    , t1.desc
                    , t1.document
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_document t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }    

    public function laws_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.law_kind
                    , t1.hscode
                    , t1.laws
                    , t1.desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_laws t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t3.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.laws like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.nation_seq, t1.product_seq, t1.law_kind
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function laws_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_overseas_laws t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq and t2.is_delete = 'n'
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq and t3.is_delete = 'n'
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.nation_name like '%" . $req['keyword'] . "%' or t3.product_name like '%" . $req['keyword'] . "%' or t1.laws like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function laws_info($seq) {
        $sql = "select
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.law_kind
                    , t1.hscode
                    , t1.laws
                    , t1.desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_laws t1
                where
                    seq = ? ";
        return $this->db->query($sql, array($seq));
    }    

    public function insert_nation($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('nation_name_eng', $req['nation_name_eng']);
        $this->db->set('nation_code', $req['nation_code']);
        $this->db->set('logo_img', $req['logo_img']);
        $this->db->set('background_img', $req['background_img']);
        $this->db->set('flag_img', $req['flag_img']);
        $this->db->set('currency', $req['currency']);
        $this->db->set('language', $req['language']);
        $this->db->set('fta_status', $req['fta_status']);
        $this->db->set('continent', $req['continent']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_nation');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_nation($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('nation_name_eng', $req['nation_name_eng']);
        $this->db->set('nation_code', $req['nation_code']);
        if(!empty($req['logo_img'])) $this->db->set('logo_img', $req['logo_img']);
        if(!empty($req['background_img'])) $this->db->set('background_img', $req['background_img']);
        if(!empty($req['flag_img'])) $this->db->set('flag_img', $req['flag_img']);
        $this->db->set('currency', $req['currency']);
        $this->db->set('language', $req['language']);
        $this->db->set('fta_status', $req['fta_status']);
        $this->db->set('continent', $req['continent']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_nation');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_nation($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_nation');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function insert_product($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_name', $req['product_name']);
        $this->db->set('product_name_eng', $req['product_name_eng']);
        if(!empty($req['product_img'])) $this->db->set('product_img', $req['product_img']);
        if(!empty($req['background_img'])) $this->db->set('background_img', $req['background_img']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_product');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_product($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_name', $req['product_name']);
        $this->db->set('product_name_eng', $req['product_name_eng']);
        if(!empty($req['product_img'])) $this->db->set('product_img', $req['product_img']);
        if(!empty($req['background_img'])) $this->db->set('background_img', $req['background_img']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_product');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_product($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_product');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function insert_np($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('export_price', preg_replace('/[^0-9]*/s', '', $req['export_price']));
        $this->db->set('distribution_status', $req['distribution_status']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_np');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_np($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('export_price', preg_replace('/[^0-9]*/s', '', $req['export_price']));
        if(!empty($req['distribution_status'])) $this->db->set('distribution_status', $req['distribution_status']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_np');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_np($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_np');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }  

    public function insert_top($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('order_no', $req['order_no']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('price', preg_replace('/[^0-9]*/s', '', $req['price']));
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_top');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_top($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('order_no', $req['order_no']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('price', preg_replace('/[^0-9]*/s', '', $req['price']));
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_top');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_top($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_top');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }  

    public function insert_buyer($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('company_name', $req['company_name']);
        $this->db->set('owner_name', $req['owner_name']);
        $this->db->set('category', $req['category']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('volume_order', $req['volume_order']);
        $this->db->set('available_period', $req['available_period']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('trade_condition', $req['trade_condition']);
        $this->db->set('trade_volume', $req['trade_volume']);
        $this->db->set('request_company_name', $req['request_company_name']);
        $this->db->set('main_product', $req['main_product']);
        $this->db->set('main_income', $req['main_income']);
        $this->db->set('is_korea', $req['is_korea']);
        $this->db->set('contact', $req['contact']);
        $this->db->set('export_staff', $req['export_staff']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_buyer');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_buyer($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('company_name', $req['company_name']);
        $this->db->set('owner_name', $req['owner_name']);
        $this->db->set('category', $req['category']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('volume_order', $req['volume_order']);
        $this->db->set('available_period', $req['available_period']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('trade_condition', $req['trade_condition']);
        $this->db->set('trade_volume', $req['trade_volume']);
        $this->db->set('request_company_name', $req['request_company_name']);
        $this->db->set('main_product', $req['main_product']);
        $this->db->set('main_income', $req['main_income']);
        $this->db->set('is_korea', $req['is_korea']);
        $this->db->set('contact', $req['contact']);
        $this->db->set('export_staff', $req['export_staff']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_buyer');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_buyer($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_buyer');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }  

    public function insert_trends($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('title', $req['title']);
        $this->db->set('link_url', $req['link_url']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_trends');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_trends($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('title', $req['title']);
        $this->db->set('link_url', $req['link_url']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_trends');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_trends($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_trends');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }  

    public function insert_channel($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('channel_name', $req['channel_name']);
        $this->db->set('channel_name_eng', $req['channel_name_eng']);
        $this->db->set('channel_name_origin', $req['channel_name_origin']);
        $this->db->set('url', $req['url']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_channel');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_channel($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('nation_name', $req['nation_name']);
        $this->db->set('channel_name', $req['channel_name']);
        $this->db->set('channel_name_eng', $req['channel_name_eng']);
        $this->db->set('channel_name_origin', $req['channel_name_origin']);
        if(!empty($req['url'])) $this->db->set('url', $req['url']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_channel');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_channel($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_channel');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }  

    public function insert_requirement($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('export_requirement', $req['export_requirement']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_requirement');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_requirement($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('export_requirement', $req['export_requirement']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_requirement');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_requirement($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_requirement');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    } 

    public function insert_document($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('document_kind', $req['document_kind']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('title', $req['title']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('document', $req['document']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_document');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_document($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('document_kind', $req['document_kind']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('title', $req['title']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('document', $req['document']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_document');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_document($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_document');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    } 

    public function insert_hscode($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_hscode');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_hscode($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_hscode');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_hscode($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_hscode');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    } 

    public function insert_laws($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('law_kind', $req['law_kind']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('laws', $req['laws']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_laws');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function update_laws($req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $req['nation_seq']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('law_kind', $req['law_kind']);
        $this->db->set('hscode', $req['hscode']);
        $this->db->set('laws', $req['laws']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_laws');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_laws($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_overseas_laws');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    } 

    public function insert_nation_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_nation
                (
                    `seq`,
                    `nation_name`,
                    `nation_name_eng`,
                    `nation_code`,
                    `continent`,
                    `logo_img`,
                    `background_img`,
                    `flag_img`,
                    `currency`,
                    `language`,
                    `fta_status`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_name'] . "' , 
                            '" . $row['nation_name_eng'] . "' , 
                            '" . $row['nation_code'] . "' , 
                            '" . $row['continent'] . "' , 
                            '" . $row['logo_img'] . "' , 
                            '" . $row['background_img'] . "' , 
                            '" . $row['flag_img'] . "' , 
                            '" . $row['currency'] . "' , 
                            '" . $row['language'] . "' , 
                            '" . $row['fta_status'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_name = VALUES(nation_name),
                        nation_name_eng = VALUES(nation_name_eng),
                        nation_code = VALUES(nation_code),
                        continent = VALUES(continent),
                        logo_img = VALUES(logo_img),
                        background_img = VALUES(background_img),
                        flag_img = VALUES(flag_img),
                        currency = VALUES(currency),
                        language = VALUES(language),
                        fta_status = VALUES(fta_status),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function insert_channel_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_channel
                (
                    `seq`,
                    `nation_seq`,
                    `nation_name`,
                    `channel_name`,
                    `channel_name_eng`,
                    `channel_name_origin`,
                    `main_product`,
                    `url`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['nation_name'] . "' , 
                            '" . $row['channel_name'] . "' , 
                            '" . $row['channel_name_eng'] . "' , 
                            '" . $row['channel_name_origin'] . "' , 
                            '" . $row['main_product'] . "' , 
                            '" . $row['url'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_seq = VALUES(nation_seq),
                        nation_name = VALUES(nation_name),
                        channel_name = VALUES(channel_name),
                        channel_name_eng = VALUES(channel_name_eng),
                        channel_name_origin = VALUES(channel_name_origin),
                        main_product = VALUES(main_product),
                        url = VALUES(url),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function insert_product_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_product
                (
                    `seq`,
                    `product_name`,
                    `product_name_eng`,
                    `product_img`,
                    `background_img`,
                    `summary`,
                    `hscode`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['product_name_eng'] . "' , 
                            '" . $row['product_img'] . "' , 
                            '" . $row['background_img'] . "' , 
                            '" . $row['summary'] . "' , 
                            '" . $row['hscode'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_name = VALUES(product_name),
                        product_name_eng = VALUES(product_name_eng),
                        product_img = VALUES(product_img),
                        background_img = VALUES(background_img),
                        summary = VALUES(summary),
                        hscode = VALUES(hscode),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }  
    
    public function insert_top_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_top
                (
                    `seq`,
                    `nation_seq`,
                    `product_seq`,
                    `order_no`,
                    `product_name`,
                    `hscode`,
                    `price`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['order_no'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['price'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_seq = VALUES(nation_seq),
                        product_seq = VALUES(product_seq),
                        order_no = VALUES(order_no),
                        product_name = VALUES(product_name),
                        hscode = VALUES(hscode),
                        price = VALUES(price),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }     
    
    public function insert_np_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_np
                (
                    `seq`,
                    `product_seq`,
                    `nation_seq`,
                    `nation_name`,
                    `export_price`,
                    `distribution_status`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['nation_name'] . "' , 
                            '" . $row['export_price'] . "' , 
                            '" . $row['distribution_status'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_seq = VALUES(product_seq),
                        nation_seq = VALUES(nation_seq),
                        nation_name = VALUES(nation_name),
                        export_price = VALUES(export_price),
                        distribution_status = VALUES(distribution_status),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }         

    public function insert_hscode_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_hscode
                (
                    `seq`,
                    `product_seq`,
                    `nation_seq`,
                    `hscode`,
                    `desc`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['desc'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_seq = VALUES(product_seq),
                        nation_seq = VALUES(nation_seq),
                        hscode = VALUES(hscode),
                        `desc` = VALUES(`desc`),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    } 
    
    public function insert_document_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_document
                (
                    `seq`,
                    `product_seq`,
                    `nation_seq`,
                    `document_kind`,
                    `hscode`,
                    `title`,
                    `desc`,
                    `document`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['document_kind'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['title'] . "' , 
                            '" . $row['desc'] . "' , 
                            '" . $row['document'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_seq = VALUES(product_seq),
                        nation_seq = VALUES(nation_seq),
                        document_kind = VALUES(document_kind),
                        hscode = VALUES(hscode),
                        title = VALUES(title),
                        `desc` = VALUES(`desc`),
                        document = VALUES(document),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }     

    public function insert_law_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_laws
                (
                    `seq`,
                    `product_seq`,
                    `nation_seq`,
                    `law_kind`,
                    `hscode`,
                    `laws`,
                    `desc`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['law_kind'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['laws'] . "' , 
                            '" . $row['desc'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_seq = VALUES(product_seq),
                        nation_seq = VALUES(nation_seq),
                        law_kind = VALUES(law_kind),
                        hscode = VALUES(hscode),
                        laws = VALUES(laws),
                        `desc` = VALUES(`desc`),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }     

    public function insert_requirement_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_requirement
                (
                    `seq`,
                    `nation_seq`,
                    `product_name`,
                    `hscode`,
                    `export_requirement`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['export_requirement'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_seq = VALUES(nation_seq),
                        product_name = VALUES(product_name),
                        hscode = VALUES(hscode),
                        export_requirement = VALUES(export_requirement),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       

    public function insert_trends_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_trends
                (
                    `seq`,
                    `nation_seq`,
                    `product_seq`,
                    `title`,
                    `link_url`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['title'] . "' , 
                            '" . $row['link_url'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_seq = VALUES(nation_seq),
                        product_seq = VALUES(product_seq),
                        title = VALUES(title),
                        link_url = VALUES(link_url),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }  
    
    public function insert_buyer_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_overseas_buyer
                (
                    `seq`,
                    `nation_seq`,
                    `product_seq`,
                    `company_name`,
                    `owner_name`,
                    `category`,
                    `hscode`,
                    `volume_order`,
                    `available_period`,
                    `product_name`,
                    `desc`,
                    `trade_condition`,
                    `trade_volume`,
                    `request_company_name`,
                    `main_product`,
                    `main_income`,
                    `is_korea`,
                    `contact`,
                    `export_staff`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['nation_seq'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['owner_name'] . "' , 
                            '" . $row['category'] . "' , 
                            '" . $row['hscode'] . "' , 
                            '" . $row['volume_order'] . "' , 
                            '" . $row['available_period'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['desc'] . "' , 
                            '" . $row['trade_condition'] . "' , 
                            '" . $row['trade_volume'] . "' , 
                            '" . $row['request_company_name'] . "' , 
                            '" . $row['main_product'] . "' , 
                            '" . $row['main_income'] . "' , 
                            '" . $row['is_korea'] . "' , 
                            '" . $row['contact'] . "' , 
                            '" . $row['export_staff'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        nation_seq = VALUES(nation_seq),
                        product_seq = VALUES(product_seq),
                        company_name = VALUES(company_name),
                        owner_name = VALUES(owner_name),
                        category = VALUES(category),
                        hscode = VALUES(hscode),
                        volume_order = VALUES(volume_order),
                        available_period = VALUES(available_period),
                        product_name = VALUES(product_name),
                        `desc` = VALUES(`desc`),
                        trade_condition = VALUES(trade_condition),
                        trade_volume = VALUES(trade_volume),
                        request_company_name = VALUES(request_company_name),
                        main_product = VALUES(main_product),
                        main_income = VALUES(main_income),
                        is_korea = VALUES(is_korea),
                        contact = VALUES(contact),
                        export_staff = VALUES(export_staff),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

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