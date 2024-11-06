<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Domestic_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function manufacture_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (
                    select
                        t1.biz_no
                        , t1.company_name
                        , t1.summary
                        , t1.category
                        , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                        , t1.tags
                        , t1.industrial_code
                        , t1.main_client
                        , t1.distribution_channel
                        , t1.main_group
                        , t1.main_oem
                        , t2.sales_year
                        , t2.credit_rating
                        , t1.production_year
                        , t1.production_month
                        , t1.production_day
                        , t1.unit_year
                        , t1.unit_month
                        , t1.unit_day
                        , t1.export_nation
                        , replace(t1.certi, ' ', '') as certi_name
                        , t1.certi
                        , t1.created_at
                        , t1.updated_at
                        , t1.hit_cnt
                    from
                        tb_domestic_companym t1
                    left outer join (
                                        select
                                            max(a.base_year)
                                            , a.biz_no
                                            , a.sales_year
                                            , a.credit_rating
                                            , a.biz_profits
                                            , a.current_profits
                                        from
                                            tb_domestic_finance a
                                        group by a.biz_no
                                    )  t2 on t2.biz_no = t1.biz_no 
                    where
                        t1.is_delete = 'n' 
                ) TB1 
                WHERE
                    1=1 ";
        if(!empty($req['category'])) {
            /*            $where = array();
                        foreach($req['category'] as $row) {
                            $where[] = "FIND_IN_SET('" . $row . "', TB1.category)";
                        }
                
                        if(!empty($where)) {
                            $sql .= " and ( " . implode(' or ', $where) . " ) ";
                        } */
            $sql .= " and FIND_IN_SET('" . $req['category'] . "', TB1.category) ";
        }
                
        if(!empty($req['company'])) {
            /*            $where = array();
                        foreach($req['company'] as $row) {
                            $where[] = "FIND_IN_SET('" . $row . "', TB1.main_oem)";
                        }
                
                        if(!empty($where)) {
                            $sql .= " and ( " . implode(' or ', $where) . " ) ";
                        } */
            $sql .= " and FIND_IN_SET('" . $req['company'] . "', TB1.main_oem) ";
        }
            
        if(!empty($req['sales'])) {
            $sql  .= " and TB1.sales_year is not null and TB1.sales_year != '' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.sales_year >= 100 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.sales_year < 100 and TB1.sales_year >= 50 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.sales_year < 50 and TB1.sales_year >= 10 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.sales_year < 10 ";
            }
        }

        if(!empty($req['rating'])) {
            $sql  .= " and TB1.credit_rating is not null and TB1.credit_rating != '' ";
            if($req['rating'] === '1') {
                $sql .= " and TB1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['rating'] === '2') {
                $sql .= " and TB1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['rating'] === '3') {
                $sql .= " and TB1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['rating'] === '4') {
                $sql .= " and TB1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['rating'] === '5') {
                $sql .= " and TB1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['rating'] === '6') {
                $sql .= " and TB1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['rating'] === '7') {
                $sql .= " and TB1.credit_rating in ('C', 'D') " ;
            }
        }

        if(!empty($req['cert'])) {
            $where = array();
            foreach($req['cert'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.certi_name)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%' or TB1.category_name like '%" . $req['keyword'] . "%' or TB1.tags like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.industrial_code like '%" . $req['keyword'] . "%' or TB1.main_client like '%" . $req['keyword'] . "%' or TB1.distribution_channel like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.main_group like '%" . $req['keyword'] . "%' or TB1.main_oem like '%" . $req['keyword'] . "%' or TB1.export_nation like '%" . $req['keyword'] . "%' or TB1.certi like '%" . $req['keyword'] . "%' ) ";
        }

        if($req['order_by'] == 'created_at') {
            $sql .= " order by TB1.updated_at desc, TB1.company_name ";
        }
        else if($req['order_by'] == 'company_name') {
            $sql .= " order by TB1.company_name ";
        }
        else {
            $sql .= " order by TB1.hit_cnt desc, TB1.company_name ";
        }
        $sql .= " limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }


    public function manufacture_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                FROM
                (
                    select
                        t1.biz_no
                        , t1.company_name
                        , t1.summary
                        , t1.category
                        , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                        , t1.tags
                        , t1.industrial_code
                        , t1.main_client
                        , t1.distribution_channel
                        , t1.main_group
                        , t1.main_oem
                        , t2.sales_year
                        , t2.credit_rating
                        , replace(t1.certi, ' ', '') as certi_name
                        , t1.certi
                        , t1.export_nation
                        , t1.created_at
                        , t1.updated_at
                    from
                        tb_domestic_companym t1
                    left outer join (
                                        select
                                            max(a.base_year)
                                            , a.biz_no
                                            , a.sales_year
                                            , a.credit_rating
                                            , a.biz_profits
                                            , a.current_profits
                                        from
                                            tb_domestic_finance a
                                        group by a.biz_no
                                    )  t2 on t2.biz_no = t1.biz_no 
                    where
                        t1.is_delete = 'n' 
                ) TB1 
                WHERE 
                    1=1 ";
        if(!empty($req['category'])) {
/*            $where = array();
            foreach($req['category'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.category)";
            }
    
            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            } */
            $sql .= " and FIND_IN_SET('" . $req['category'] . "', TB1.category) ";
        }
    
        if(!empty($req['company'])) {
/*            $where = array();
            foreach($req['company'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.main_oem)";
            }
    
            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            } */
            $sql .= " and FIND_IN_SET('" . $req['company'] . "', TB1.main_oem) ";
        }
    
        if(!empty($req['sales'])) {
            $sql  .= " and TB1.sales_year is not null and TB1.sales_year != '' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.sales_year >= 100 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.sales_year < 100 and TB1.sales_year >= 50 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.sales_year < 50 and TB1.sales_year >= 10 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.sales_year < 10 ";
            }
        }
    
        if(!empty($req['rating'])) {
            $sql  .= " and TB1.credit_rating is not null and TB1.credit_rating != '' ";
            if($req['rating'] === '1') {
                $sql .= " and TB1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['rating'] === '2') {
                $sql .= " and TB1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['rating'] === '3') {
                $sql .= " and TB1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['rating'] === '4') {
                $sql .= " and TB1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['rating'] === '5') {
                $sql .= " and TB1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['rating'] === '6') {
                $sql .= " and TB1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['rating'] === '7') {
                $sql .= " and TB1.credit_rating in ('C', 'D') " ;
            }
        }
    
        if(!empty($req['cert'])) {
            $where = array();
            foreach($req['cert'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.certi_name)";
            }
    
            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }
    
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%' or TB1.category_name like '%" . $req['keyword'] . "%' or TB1.tags like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.industrial_code like '%" . $req['keyword'] . "%' or TB1.main_client like '%" . $req['keyword'] . "%' or TB1.distribution_channel like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.main_group like '%" . $req['keyword'] . "%' or TB1.main_oem like '%" . $req['keyword'] . "%' or TB1.export_nation like '%" . $req['keyword'] . "%' or TB1.certi like '%" . $req['keyword'] . "%' ) ";
        }
    
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function manufacture_info($biz_no) {
        $sql = "select
                    t1.biz_no
                    , t1.company_name
                    , t1.summary
                    , t1.category
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.main_oem
                    , t1.company_name_eng
                    , t1.logo_img
                    , t1.tags
                    , t1.ceo_name
                    , t1.industrial_code
                    , if(t1.incorporation_at is not null and t1.incorporation_at != '', date_format(t1.incorporation_at, '%Y.%m.%d'), '미등록') as incorporation_at
                    , t1.addr
                    , t1.homepage
                    , t1.company_tel
                    , t1.introduce_file
                    , t1.main_product
                    , t1.main_client
                    , t1.production_day
                    , t1.unit_day
                    , t1.production_month
                    , t1.unit_month
                    , t1.production_year
                    , t1.unit_year
                    , t1.capa
                    , t1.capa_at
                    , t1.facilities_info
                    , t1.packaging_machine
                    , t1.etc_machine
                    , t1.detection_machine
                    , t1.certi
                    , t1.is_fda
                    , t1.distribution_channel
                    , t1.export_nation
                    , t1.hit_cnt
                    , ifnull(t2.base_year, '') as base_year
                    , ifnull(t2.sales_year, '') as sales_year
                    , ifnull(t2.biz_profits, '') as biz_profits
                    , ifnull(t2.current_profits, '') as current_profits
                    , ifnull(t2.credit_rating, '') as credit_rating
                from
                    tb_domestic_companym t1
                left outer join (
                                    select
                                        max(a.base_year)
                                        , a.biz_no
                                        , a.base_year
                                        , a.sales_year
                                        , a.credit_rating
                                        , a.biz_profits
                                        , a.current_profits
                                    from
                                        tb_domestic_finance a
                                    group by a.biz_no
                                )  t2 on t2.biz_no = t1.biz_no 
                where
                        t1.biz_no = ? ";
        
        return $this->db->query($sql, array($biz_no));
    }

    public function update_manufacture_hit($biz_no) {
		$this->db->trans_begin();

        $this->db->set('hit_cnt' , 'hit_cnt + 1', false);
        $this->db->where('biz_no', $biz_no);
        $this->db->update('tb_domestic_companym');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }


    public function distribution_list($req, $offset, $perpage) {
        $sql = "select
                    t1.biz_no
                    , t1.company_name
                    , t1.industrial_code
                    , t1.main_product
                    , t1.distribution_type
                    , t1.sales_year
                    , t1.credit_rating
                    , t1.created_at
                    , t1.updated_at
                    , t1.hit_cnt
                from
                    tb_domestic_companyd t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['industrial_code'])) {
/*            $where = array();
            foreach($req['industrial_code'] as $row) {
                $where[] = " t1.industrial_code = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            } */
            $sql .= " and t1.industrial_code = '" . $req['industrial_code'] . "' ";
        }

        if(!empty($req['distribution_type'])) {
            $where = array();
            foreach($req['distribution_type'] as $row) {
                $where[] = " t1.distribution_type like '%" . $row . "%' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['sales'])) {
            if($req['sales'] === '1') {
                $sql .= " and t1.sales_year >= 1000 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and t1.sales_year < 1000 and t1.sales_year >= 500 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and t1.sales_year < 500 and t1.sales_year >= 100 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and t1.sales_year < 100 and t1.sales_year >= 50 ";
            }
            else if($req['sales'] === '5') {
                $sql .= " and t1.sales_year < 50 and t1.sales_year >= 10 ";
            }
            else if($req['sales'] === '6') {
                $sql .= " and t1.sales_year < 10 ";
            }
        }

        if(!empty($req['rating'])) {
            if($req['rating'] === '1') {
                $sql .= " and t1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['rating'] === '2') {
                $sql .= " and t1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['rating'] === '3') {
                $sql .= " and t1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['rating'] === '4') {
                $sql .= " and t1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['rating'] === '5') {
                $sql .= " and t1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['rating'] === '6') {
                $sql .= " and t1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['rating'] === '7') {
                $sql .= " and t1.credit_rating in ('C', 'D') " ;
            }
        }

        if(!empty($req['keyword'])) {
            $sql .= " and t1.company_name like '%" . $req['keyword'] . "%' ";
        }

        if($req['order_by'] == 'created_at') {
            $sql .= " order by t1.updated_at desc, t1.company_name ";
        }
        else if($req['order_by'] == 'company_name') {
            $sql .= " order by t1.company_name ";
        }
        else {
            $sql .= " order by t1.hit_cnt desc, t1.company_name ";
        }
        $sql .= " limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }


    public function distribution_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_companyd t1
                where
                    t1.is_delete = 'n' ";

        if(!empty($req['industrial_code'])) {
/*            $where = array();
            foreach($req['industrial_code'] as $row) {
                $where[] = " t1.industrial_code = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            } */
            $sql .= " and t1.industrial_code = '" . $req['industrial_code'] . "' ";
        }

        if(!empty($req['distribution_type'])) {
            $where = array();
            foreach($req['distribution_type'] as $row) {
                $where[] = " t1.distribution_type like '%" . $row . "%' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['sales'])) {
            if($req['sales'] === '1') {
                $sql .= " and t1.sales_year >= 1000 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and t1.sales_year < 1000 and t1.sales_year >= 500 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and t1.sales_year < 500 and t1.sales_year >= 100 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and t1.sales_year < 100 and t1.sales_year >= 50 ";
            }
            else if($req['sales'] === '5') {
                $sql .= " and t1.sales_year < 50 and t1.sales_year >= 10 ";
            }
            else if($req['sales'] === '6') {
                $sql .= " and t1.sales_year < 10 ";
            }
        }

        if(!empty($req['rating'])) {
            if($req['rating'] === '1') {
                $sql .= " and t1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['rating'] === '2') {
                $sql .= " and t1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['rating'] === '3') {
                $sql .= " and t1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['rating'] === '4') {
                $sql .= " and t1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['rating'] === '5') {
                $sql .= " and t1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['rating'] === '6') {
                $sql .= " and t1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['rating'] === '7') {
                $sql .= " and t1.credit_rating in ('C', 'D') " ;
            }
        }

        if(!empty($req['keyword'])) {
            $sql .= " and t1.company_name like '%" . $req['keyword'] . "%' ";
        }
  
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }
    
    public function distribution_info($biz_no) {
        $sql = "select
                    t1.biz_no
                    , t1.company_name
                    , t1.industrial_code
                    , t1.main_product
                    , t1.distribution_type
                    , t1.sales_year
                    , t1.credit_rating
                    , t1.created_at
                    , t1.updated_at
                    , t1.hit_cnt
                from
                    tb_domestic_companyd t1
                where
                    t1.biz_no = ? ";
        
        return $this->db->query($sql, array($biz_no));
    }

    public function product_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (
                    select
                        t1.seq
                        , 'nb' as product_type
                        , t1.company_name
                        , t1.product_name
                        , t1.category
                        , t1.category_etc
                        , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                        , t1.main_group
                        , '' as main_oem
                        , t1.summary
                        , t1.tags
                        , t1.supply_price
                        , t1.moq
                        , t1.delivery_day
                        , t1.weight
                        , t1.unit
                        , t1.storage
                        , t1.expire_day
                        , t1.qty
                        , t1.qty_unit
                        , t1.container_type
                        , t1.channel_status
                        , date_format(t1.created_at, '%Y-%m-%d') as created_at
                        , t1.hit_cnt
                        , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'NB_image' and a.is_main = 'y'), '') as prod_img
                        , t1.product_type as product_type2
                    from
                        tb_domestic_product t1 
                    where
                        t1.is_delete = 'n'
                    union
                    select
                        t1.seq
                        , 'oem' as product_type
                        , t1.company_name
                        , t1.product_name
                        , t1.category
                        , t1.category_etc
                        , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                        , t1.main_group
                        , t1.main_oem
                        , t1.summary
                        , t1.tags
                        , t1.supply_price
                        , t1.moq
                        , t1.delivery_day
                        , t1.weight
                        , t1.unit
                        , t1.storage
                        , t1.expire_day
                        , t1.qty
                        , t1.qty_unit
                        , t1.container_type
                        , t1.channel_status
                        , date_format(t1.created_at, '%Y-%m-%d') as created_at
                        , t1.hit_cnt
                        , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                        , t1.product_type as product_type2
                    from
                        tb_domestic_oem t1 
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%' or TB1.product_name like '%" . $req['keyword'] . "%' or TB1.category_name like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.main_group like '%" . $req['keyword'] . "%' or TB1.main_oem like '%" . $req['keyword'] . "%' or TB1.tags like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.product_type2 like '%" . $req['keyword'] . "%' or TB1.channel_status like '%" . $req['keyword'] . "%' ) ";
        }

        if(!empty($req['category'])) {
            $where = array();
            foreach($req['category'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.category)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['company'])) {
            $where = array();
            foreach($req['company'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.main_oem)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['storage'])) {
            $where = array();
            foreach($req['company'] as $row) {
                $where[] = " TB1.storage = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['new'])) {
            $sql .= " and TB1.created_at > date_format(add_date(now(), INTERVAL -30 DAY), '%Y-%m-%d') ";
        }

        if(!empty($req['nation'])) {
            $sql .= " and TB.seq = -1 ";
        }

        if($req['order_by'] === 'created_at') {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END),  TB1.created_at desc, TB1.product_name asc ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END),TB1.product_name asc ";
        }
        else {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END), TB1.hit_cnt desc, TB1.product_name asc ";
        }
        $sql .= " limit ?, ? ";
echo $sql;
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function product_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                FROM
                (
                    select
                        t1.seq
                        , 'nb' as product_type
                        , t1.company_name
                        , t1.product_name
                        , t1.category
                        , t1.category_etc
                        , t1.main_group
                        , '' as main_oem
                        , t1.summary
                        , t1.tags
                        , t1.supply_price
                        , t1.moq
                        , t1.delivery_day
                        , t1.weight
                        , t1.unit
                        , t1.storage
                        , t1.expire_day
                        , t1.qty
                        , t1.qty_unit
                        , t1.container_type
                        , t1.channel_status
                        , date_format(t1.created_at, '%Y-%m-%d') as created_at
                        , t1.hit_cnt
                        , t1.product_type as product_type2
                    from
                        tb_domestic_product t1 
                    where
                        t1.is_delete = 'n'
                    union
                    select
                        t1.seq
                        , 'oem' as product_type
                        , t1.company_name
                        , t1.product_name
                        , t1.category
                        , t1.category_etc
                        , t1.main_group
                        , t1.main_oem
                        , t1.summary
                        , t1.tags
                        , t1.supply_price
                        , t1.moq
                        , t1.delivery_day
                        , t1.weight
                        , t1.unit
                        , t1.storage
                        , t1.expire_day
                        , t1.qty
                        , t1.qty_unit
                        , t1.container_type
                        , t1.channel_status
                        , date_format(t1.created_at, '%Y-%m-%d') as created_at
                        , t1.hit_cnt
                        , t1.product_type as product_type2
                    from
                        tb_domestic_oem t1 
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%' or TB1.product_name like '%" . $req['keyword'] . "%' or TB1.category_name like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.main_group like '%" . $req['keyword'] . "%' or TB1.main_oem like '%" . $req['keyword'] . "%' or TB1.tags like '%" . $req['keyword'] . "%' ";
            $sql .= " or TB1.product_type2 like '%" . $req['keyword'] . "%' or TB1.channel_status like '%" . $req['keyword'] . "%' ) ";
        }

        if(!empty($req['category'])) {
            $where = array();
            foreach($req['category'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.category)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['company'])) {
            $where = array();
            foreach($req['company'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.main_oem)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['storage'])) {
            $where = array();
            foreach($req['company'] as $row) {
                $where[] = " TB1.storage = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['new'])) {
            $sql .= " and TB1.created_at > date_format(add_date(now(), INTERVAL -30 DAY), '%Y-%m-%d') ";
        }

        if(!empty($req['nation'])) {
            $sql .= " and TB.seq = -1 ";
        }

        $tmp = $this->db->query($sql)->row_array();
        return $tmp['cnt'];
    }

    public function nbproduct_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'NB_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_product t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ?
                limit ?, ? ";

        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function nbproduct_top($req) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , t1.product_type
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'NB_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_product t1 
                where
                    t1.is_delete = 'n'
                    and t1.is_main = 'y'
                    and t1.biz_no = ?
                limit 1 ";

        return $this->db->query($sql, array($req['biz_no']));
    }

    public function oemproduct_list($req, $offset, $perpage) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_oem t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ?
                limit ?, ? ";

        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function oemproduct_top($req) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , t1.product_type
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_oem t1 
                where
                    t1.is_delete = 'n'
                    and t1.is_main = 'y'
                    and t1.biz_no = ?
                limit 1 ";

        return $this->db->query($sql, array($req['biz_no']));
    }

    public function facilities_list($req) {
        $sql = "SELECT
                    t1.img_url
                    , t1.img_desc
                from
                    tb_domestic_facilities t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ? ";

        return $this->db->query($sql, array($req['biz_no']));
    }

    public function cert_list($req) {
        $sql = "SELECT
                    t1.cert_name
                    , t1.cert_img
                from
                    tb_domestic_cert t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ? ";

        return $this->db->query($sql, array($req['biz_no']));
    }

    public function patent_list($req) {
        $sql = "SELECT
                    t1.patent_name
                    , t1.patent_name_eng
                    , t1.patent_img
                from
                    tb_domestic_patent t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ? ";

        return $this->db->query($sql, array($req['biz_no']));
    }

    public function update_nbproduct_hit($seq) {
		$this->db->trans_begin();

        $this->db->set('hit_cnt' , 'hit_cnt + 1', false);
        $this->db->where('seq', $seq);
        $this->db->update('tb_domestic_product');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_oemproduct_hit($seq) {
		$this->db->trans_begin();

        $this->db->set('hit_cnt' , 'hit_cnt + 1', false);
        $this->db->where('seq', $seq);
        $this->db->update('tb_domestic_oem');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function nbproduct_info($seq) {
        $sql = "SELECT
                    t1.seq
                    , t1.biz_no
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , t1.product_type
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                from
                    tb_domestic_product t1 
                where
                    t1.is_delete = 'n'
                    and t1.seq = ? ";

        return $this->db->query($sql, array($seq));
    }

    public function oemproduct_info($seq) {
        $sql = "SELECT
                    t1.seq
                    , t1.biz_no
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , t1.product_type
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                from
                    tb_domestic_oem t1 
                where
                    t1.is_delete = 'n'
                    and t1.seq = ? ";

        return $this->db->query($sql, array($seq));
    }

    public function prodimg_list($req) {
        $sql = "SELECT
                    t1.seq
                    , t1.img_url
                from
                    tb_domestic_prodimg t1 
                where
                    t1.is_delete = 'n'
                    and t1.product_seq = ?
                    and t1.img_type = ? 
                order by t1.order_no asc ";

        return $this->db->query($sql, array($req['detail_seq'], $req['img_type']));
    }

    public function nbproduct_recommend_list($req) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'NB_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_product t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ?
                    and t1.seq != ?
                    and t1.product_type = ?
                limit 0, 5 ";

        return $this->db->query($sql, array($req['biz_no'], $req['seq'], $req['product_type']));
    }

    public function oemproduct_recommend_list($req) {
        $sql = "SELECT
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , t1.category
                    , t1.category_etc
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.main_group
                    , t1.summary
                    , t1.tags
                    , t1.supply_price
                    , t1.moq
                    , t1.delivery_day
                    , t1.weight
                    , t1.unit
                    , t1.storage
                    , t1.expire_day
                    , t1.qty
                    , t1.qty_unit
                    , t1.container_type
                    , t1.channel_status
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                from
                    tb_domestic_oem t1 
                where
                    t1.is_delete = 'n'
                    and t1.biz_no = ?
                    and t1.seq != ?
                    and t1.product_type = ?
                limit 0, 5 ";

        return $this->db->query($sql, array($req['biz_no'], $req['seq'], $req['product_type']));
    }    
}    

?>