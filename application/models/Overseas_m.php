<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overseas_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function overseas_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (
                    select
                        t1.seq ,
                        t1.nation_name ,
                        t1.nation_name_eng ,
                        t1.nation_code ,
                        t1.continent , 
                        t1.logo_img ,
                        t1.background_img ,
                        t1.flag_img , 
                        t1.currency ,
                        t1.language ,
                        t1.summary ,
                        t1.fta_status ,
                        t1.hit_cnt ,
                        (select 
                            substring_index(GROUP_CONCAT(a.product_name ORDER BY a.order_no), ',', 3) 
                        from
                            tb_overseas_top a
                        where
                            a.nation_seq = t1.seq
                        group by a.nation_seq ) as product_name ,
                        (select group_concat(a.channel_name) from tb_overseas_channel a where a.nation_seq = t1.seq group by a.nation_seq) as channel_name ,
                        (select group_concat(a.product_name) from tb_overseas_top a where a.nation_seq = t1.seq group by a.nation_seq) as top_name , 

                        date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at ,
                        date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                    from
                        tb_overseas_nation t1
                    where
                        t1.is_delete = 'n' 
                ) TB1
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.nation_name like '%" . $req['keyword'] . "%' or TB1.channel_name like '%" . $req['keyword'] . "%' or TB1.top_name like '%" . $req['keyword'] . "%' ) ";
        }
        if(empty($req['order_by']) ||  $req['order_by'] === 'hit_cnt') {
            $sql .= " order by TB1.hit_cnt desc, TB1.nation_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'created_at') {
            $sql .= " order by TB1.updated_at asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'nation_name') {
            $sql .= " order by TB1.nation_name asc
                    limit ?, ? ";
        }
        else {
            $sql .= " order by TB1.hit_cnt desc, TB1.nation_name asc
                    limit ?, ? ";
        }
        
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function overseas_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                from
                (
                    select
                        t1.seq ,
                        t1.nation_name ,
                        t1.nation_name_eng ,
                        t1.nation_code ,
                        t1.continent , 
                        t1.logo_img ,
                        t1.background_img ,
                        t1.flag_img , 
                        t1.currency ,
                        t1.language ,
                        t1.summary ,
                        t1.fta_status ,
                        t1.hit_cnt ,
                        (select 
                            substring_index(GROUP_CONCAT(a.product_name ORDER BY a.order_no), ',', 3) 
                        from
                            tb_overseas_top a
                        where
                            a.nation_seq = t1.seq
                        group by a.nation_seq ) as product_name ,
                        (select group_concat(a.channel_name) from tb_overseas_channel a where a.nation_seq = t1.seq group by a.nation_seq) as channel_name ,
                        (select group_concat(a.product_name) from tb_overseas_top a where a.nation_seq = t1.seq group by a.nation_seq) as top_name , 

                        date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at ,
                        date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at                    
                    from
                        tb_overseas_nation t1
                    where
                        t1.is_delete = 'n'
                ) TB1
                where 
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.nation_name like '%" . $req['keyword'] . "%' or TB1.channel_name like '%" . $req['keyword'] . "%' or TB1.top_name like '%" . $req['keyword'] . "%' ) ";
        }
        
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function overseas_list_all() {
        $sql = "SELECT
                    t1.seq ,
                    t1.nation_name ,
                    t1.nation_name_eng ,
                    t1.nation_code ,
                    t1.continent , 
                    t1.logo_img ,
                    t1.background_img ,
                    t1.flag_img , 
                    t1.currency ,
                    t1.language ,
                    t1.summary ,
                    t1.fta_status ,
                    t1.hit_cnt ,
                    (select 
                        group_concat(a.product_name)
                    from
                        tb_overseas_top a
                    where
                        a.nation_seq = t1.seq
                    order by order_no 
                    limit 0, 3 ) as product_name ,

                    date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at ,
                    date_format(t1.updated_at, '%Y.%m.%d %H:%i') as updated_at
                from
                    tb_overseas_nation t1
                where
                    t1.is_delete = 'n' 
                order by t1.nation_name asc ";
        
        return $this->db->query($sql);
    }

    public function overseas_nation_info($seq) {
        $sql = "SELECT
                    t1.seq ,
                    t1.nation_name ,
                    t1.nation_name_eng ,
                    t1.nation_code ,
                    t1.continent , 
                    t1.logo_img ,
                    t1.background_img ,
                    t1.flag_img , 
                    t1.currency ,
                    t1.language ,
                    t1.summary ,
                    t1.fta_status ,
                    t1.hit_cnt 
                from
                    tb_overseas_nation t1
                where
                    t1.seq = ? ";
        return $this->db->query($sql, array($seq));
    }

    public function overseas_product_info($nation_seq, $product_seq) {
        $sql = "SELECT
                    t2.product_name
                    , t2.product_name_eng
                    , t2.product_img
                    , t2.background_img
                    , t2.summary
                    , t2.hscode
                    , t3.fta_status
                    , t3.nation_name
                    , t1.export_price
                    , t1.nation_seq
                    , t1.product_seq
                from
                    tb_overseas_np t1
                inner join tb_overseas_product t2 on t2.seq = t1.product_seq
                inner join tb_overseas_nation t3 on t3.seq = t1.nation_seq 
                where
                    t1.nation_seq = ?
                    and t1.product_seq = ? ";
        return $this->db->query($sql, array($nation_seq, $product_seq));
    }

    public function nation_list_for_product($nation_seq, $product_seq) {
        $sql = "SELECT
                    t2.seq ,
                    t2.nation_name ,
                    t2.nation_name_eng ,
                    t2.nation_code ,
                    t2.flag_img 
                from
                    tb_overseas_np t1
                inner join tb_overseas_nation t2 on t1.nation_seq = t2.seq 
                where
                    t1.is_delete = 'n' 
                    and t1.product_seq = ?
                order by t2.nation_name asc ";
        
        return $this->db->query($sql, array($product_seq));
    }

    public function overseas_top($seq) {
        $sql = "SELECT
                    t1.order_no
                    , t1.product_seq
                    , t1.nation_seq
                    , t1.product_name
                    , t1.hscode
                    , t1.price
                from
                    tb_overseas_top t1
                where
                    t1.nation_seq = ? 
                    and t1.is_delete = 'n'
                order by t1.order_no ";
        return $this->db->query($sql, array($seq));
    }

    public function overseas_channel($seq) {
        $sql = "SELECT
                    t1.seq
                    , t1.channel_name
                    , t1.channel_name_eng
                    , t1.channel_name_origin
                    , t1.url
                from
                    tb_overseas_channel t1
                where
                    t1.nation_seq = ? 
                    and t1.is_delete = 'n' ";
        return $this->db->query($sql, array($seq));
    }

    public function overseas_hscode($seq) {
        $sql = "SELECT
                    t1.product_seq
                    , t1.nation_seq
                    , (select a.product_name from tb_overseas_product a where a.seq = t1.product_seq) as product_name
                    , t1.hscode
                    , t1.desc
                from
                    tb_overseas_hscode t1
                where
                    t1.nation_seq = ? 
                    and t1.is_delete = 'n' ";
        return $this->db->query($sql, array($seq));
    }

    public function overseas_requirement($seq) {
        $sql = "SELECT
                    t1.seq
                    , t1.nation_seq
                    , t1.product_name
                    , t1.hscode
                    , t1.export_requirement
                from
                    tb_overseas_requirement t1
                where
                    t1.nation_seq = ?
                    and t1.is_delete = 'n' ";
        return $this->db->query($sql, array($seq));
    }

    public function buyer_list($seq, $offset, $perpage) {
        $sql = "SELECT
                    company_name
                    , owner_name
                    , category
                    , hscode
                    , volume_order
                    , available_period
                    , product_name
                    , `desc`
                    , trade_condition
                    , trade_volume
                    , request_company_name
                    , main_product
                    , main_income
                    , is_korea
                    , contact
                    , export_staff
                    , date_format(t1.updated_at, '%Y-%m-%d') as updated_at
                from
                    tb_overseas_buyer t1
                where
                    t1.nation_seq = ? 
                    and t1.is_delete = 'n'
                group by company_name 
                limit ?, ? ";
        return $this->db->query($sql, array($seq, $offset, $perpage));
    }

    public function trends_list($seq, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.title
                    , t1.link_url
                    , t1.hit_cnt
                from
                    tb_overseas_trends t1
                where
                    t1.nation_seq = ? 
                    and t1.is_delete = 'n'
                group by t1.title 
                limit ?, ? ";
        return $this->db->query($sql, array($seq, $offset, $perpage));
    }

    public function buyer_list2($req, $offset, $perpage) {
        $sql = "SELECT
                    company_name
                    , owner_name
                    , category
                    , hscode
                    , volume_order
                    , available_period
                    , product_name
                    , `desc`
                    , trade_condition
                    , trade_volume
                    , request_company_name
                    , main_product
                    , main_income
                    , is_korea
                    , contact
                    , export_staff
                    , date_format(t1.updated_at, '%Y-%m-%d') as updated_at
                from
                    tb_overseas_buyer t1
                where
                    t1.nation_seq = ? 
                    and t1.product_seq = ?
                    and t1.is_delete = 'n'
                group by company_name 
                limit ?, ? ";
        return $this->db->query($sql,  array($req['nation_seq'], $req['product_seq'], $offset, $perpage));
    }

    public function trends_list2($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.title
                    , t1.link_url
                    , t1.hit_cnt
                from
                    tb_overseas_trends t1
                where
                    t1.nation_seq = ?
                    and t1.product_seq = ? 
                    and t1.is_delete = 'n'
                group by t1.title 
                limit ?, ? ";
        return $this->db->query($sql, array($req['nation_seq'], $req['product_seq'], $offset, $perpage));
    }

    public function requirement_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.nation_seq
                    , t1.product_name
                    , t1.hscode
                    , t1.export_requirement
                from
                    tb_overseas_requirement t1
                where
                    t1.nation_seq = ?
                limit ?, ? ";
        return $this->db->query($sql, array($req['nation_seq'],  $offset, $perpage));
    }

    public function document_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.document_kind
                    , t1.hscode
                    , t1.title
                    , t1.desc
                    , t1.document
                    , t2.nation_name
                from
                    tb_overseas_document t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq
                where
                    t1.nation_seq = ?
                    and t1.product_seq = ?
                    and t1.is_delete = 'n'
                order by t1.document_kind
                limit ?, ? ";
        return $this->db->query($sql, array($req['nation_seq'], $req['product_seq'],  $offset, $perpage));
    }

    public function laws_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.nation_seq
                    , t1.product_seq
                    , t1.law_kind
                    , t1.hscode
                    , t1.laws
                    , t1.desc
                    , t2.nation_name
                    , t3.product_name
                from
                    tb_overseas_laws t1
                inner join tb_overseas_nation t2 on t2.seq = t1.nation_seq
                inner join tb_overseas_product t3 on t3.seq = t1.product_seq
                where
                    t1.nation_seq = ?
                    and t1.product_seq = ?
                    and t1.is_delete = 'n'
                order by t1.law_kind
                limit ?, ? ";
        return $this->db->query($sql, array($req['nation_seq'], $req['product_seq'],  $offset, $perpage));
    }

    public function nation_hit_cnt($seq) {
        $this->db->trans_begin();

        $this->db->set('hit_cnt', 'hit_cnt+1', false);
        $this->db->where('seq', $seq);
        $this->db->update('tb_overseas_nation');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function trends_hit_cnt($seq) {
        $this->db->trans_begin();

        $this->db->set('hit_cnt', 'hit_cnt+1', false);
        $this->db->where('seq', $seq);
        $this->db->update('tb_overseas_trends');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function product_hit_cnt($nation_seq, $product_seq) {
        $this->db->trans_begin();

        $this->db->set('hit_cnt', 'hit_cnt+1', false);
        $this->db->where('nation_seq', $nation_seq);
        $this->db->where('product_seq', $product_seq);
        $this->db->update('tb_overseas_np');

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