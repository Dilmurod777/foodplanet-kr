<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function product_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (
                    select
                        t1.seq
                        , 'nb' as product_type2
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
                        , t1.product_type
                    from
                        tb_domestic_product t1 
                    where
                        t1.is_delete = 'n'
                    union
                    select
                        t1.seq
                        , 'oem' as product_type2
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
                        , t1.product_type
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
            $sql .= " or TB1.product_type like '%" . $req['keyword'] . "%' or TB1.channel_status like '%" . $req['keyword'] . "%' ) ";
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
            foreach($req['storage'] as $row) {
                $where[] = " TB1.storage = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['new'])) {
            $sql .= " and TB1.created_at > date_format(date_add(now(), INTERVAL -30 DAY), '%Y-%m-%d') ";
        }

        if(!empty($req['nation'])) {
            $sql .= " and TB1.seq = -1 ";
        }

        if($req['order_by'] === 'created_at') {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END), TB1.created_at desc, TB1.product_name asc ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END), TB1.product_name asc ";
        }
        else {
            $sql .= " order by (case TB1.prod_img when '' then '1' else '0' END), TB1.hit_cnt desc, TB1.product_name asc ";
        }
        $sql .= " limit ?, ? ";

        return $this->db->query($sql, array($offset, $perpage));
    }

    public function product_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                FROM
                (
                    select
                        t1.seq
                        , 'nb' as product_type2
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
                        , t1.product_type
                    from
                        tb_domestic_product t1 
                    where
                        t1.is_delete = 'n'
                    union
                    select
                        t1.seq
                        , 'oem' as product_type2
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
                        , t1.product_type
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
            $sql .= " or TB1.product_type like '%" . $req['keyword'] . "%' or TB1.channel_status like '%" . $req['keyword'] . "%' ) ";
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
            foreach($req['storage'] as $row) {
                $where[] = " TB1.storage = '" . $row . "' ";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['new'])) {
            $sql .= " and TB1.created_at > date_format(date_add(now(), INTERVAL -30 DAY), '%Y-%m-%d') ";
        }

        if(!empty($req['nation'])) {
            $sql .= " and TB1.seq = -1 ";
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
                    t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }

        if($req['order_by'] === 'created_at') {
            $sql .= " order by t1.created_at desc, t1.product_name asc ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " order by t1.product_name asc ";
        }
        else {
            $sql .= " order by t1.hit_cnt desc, t1.product_name asc ";
        }
        $sql .= " limit ?, ? ";

        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function nbproduct_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                from
                    tb_domestic_product t1 
                where
                    t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }

        $tmp = $this->db->query($sql, array($req['biz_no']))->row_array();
        return $tmp['cnt'];
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
                    t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }

        if($req['order_by'] === 'created_at') {
            $sql .= " order by t1.created_at desc, t1.product_name asc ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " order by t1.product_name asc ";
        }
        else {
            $sql .= " order by t1.hit_cnt desc, t1.product_name asc ";
        }
        $sql .= " limit ?, ? ";

        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function oemproduct_list_cnt($req) {
        $sql = "SELECT
                    count(*) as cnt
                from
                    tb_domestic_oem t1 
                where
                    t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }

        $tmp = $this->db->query($sql, array($req['biz_no']))->row_array();
        return $tmp['cnt'];
    }

    public function own_product_info($cd) {
        $sql = "select
                    t1.member_cd
                    , t2.own_product
                    , case when  t2.main_product_cd is not null  and t2.main_product_cd != '' then t2.main_product_cd
                            else '' end as main_product_cd
                    , case when  t2.main_product_etc is not null  and t2.main_product_etc != '' then t2.main_product_etc
                            else '' end as main_product_etc
                    , t2.channel_online
                    , t2.channel_offline
                    , case when t2.order_moq is not null and t2.order_moq != '' then t2.order_moq
                            else '' end as order_moq
                    , case when t2.delivery_day is not null and t2.delivery_day != '' then t2.delivery_day
                            else '' end as delivery_day
                    , t2.nb_product
                    , case when t2.type_cnt is not null and t2.type_cnt != '' then  t2.type_cnt
                            else '' end  as type_cnt
                    , case when  t2.supply_price is not null and t2.supply_price != '' then t2.supply_price
                            else '' end as supply_price
                    , t2.expire_day
                from
                    tb_member t1
                left outer join tb_product_own t2 on t2.member_cd = t1.member_cd
                where
                    t1.member_cd = ? ";
        
        return $this->db->query($sql, array($cd));
    }

    public function oem_product_info($cd) {
        $sql = "select
                    t1.member_cd
                    , ifnull(t2.main_product_cd, '') as main_product_cd
                    , ifnull(t2.main_product_etc, '') as main_product_etc
                    , ifnull(t2.channel_online, '') as channel_online
                    , ifnull(t2.channel_offline, '') as channel_offline
                    , case when t2.order_moq is not null and t2.order_moq != '' then t2.order_moq
                            else '' end as order_moq
                    , case when t2.delivery_day is not null and t2.delivery_day != '' then t2.delivery_day
                            else '' end as delivery_day
                    , ifnull(t2.nb_product, '') as nb_product
                    , ifnull(t2.type_cnt, '') as type_cnt
                    , case when  t2.supply_price is not null and t2.supply_price != '' then t2.supply_price
                            else '' end as supply_price
                    , ifnull(t2.expire_day, '') as expire_day
                    , ifnull(t2.type_a, '') as type_a
                    , ifnull(t2.type_b, '') as type_b
                    , ifnull(t2.type_c, '') as type_c
                    , ifnull(t2.sub_material, '') as sub_material
                    , case when  t2.sub_lead_time is not null and t2.sub_lead_time != '' then t2.sub_lead_time
                            else '' end as sub_lead_time
                    , case when  t2.sub_moq is not null and t2.sub_moq != '' then t2.sub_moq
                            else '' end as sub_moq
                    , case when  t2.sub_price is not null and t2.sub_price != '' then t2.sub_price
                            else '' end as sub_price
                from
                    tb_member t1
                left outer join tb_product_oem t2 on t2.member_cd = t1.member_cd
                where
                    t1.member_cd = ? ";
        
        return $this->db->query($sql, array($cd));
    }

    public function update_product_own($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_product_own
                (
                    member_cd ,
                    own_product ,
                    main_product_cd ,
                    main_product_etc ,
                    channel_online ,
                    channel_offline ,
                    delivery_day ,
                    order_moq ,
                    nb_product ,
                    supply_price ,
                    type_cnt ,
                    expire_day ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['own_product'] . "' , 
                    '" . implode(',', $req['main_product_cd']) . "' , 
                    '" . $req['main_product_etc'] . "' , 
                    '" . $req['channel_online'] . "' , 
                    '" . $req['channel_offline'] . "' , 
                    '" . $req['delivery_day'] . "' , 
                    '" . $req['order_moq'] . "' , 
                    '" . $req['nb_product'] . "' , 
                    '" . $req['supply_price'] . "' , 
                    '" . $req['type_cnt'] . "' , 
                    '" . $req['expire_day'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    own_product = VALUES(own_product),
                    main_product_cd = VALUES(main_product_cd),
                    main_product_etc = VALUES(main_product_etc),
                    channel_online = VALUES(channel_online),
                    channel_offline = VALUES(channel_offline),
                    delivery_day = VALUES(delivery_day),
                    order_moq = VALUES(order_moq),
                    nb_product = VALUES(nb_product),
                    supply_price = VALUES(supply_price),
                    type_cnt = VALUES(type_cnt),
                    expire_day = VALUES(expire_day),
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";

        $this->db->query($sql, array());

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function update_product_oem($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_product_oem
                (
                    member_cd ,
                    main_product_cd ,
                    main_product_etc ,
                    channel_online ,
                    channel_offline ,
                    delivery_day ,
                    order_moq ,
                    nb_product ,
                    supply_price ,
                    type_cnt ,
                    expire_day ,
                    type_a , 
                    type_b ,
                    type_c ,
                    sub_material ,
                    sub_lead_time ,
                    sub_moq ,
                    sub_price ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . implode(',', $req['main_product_cd']) . "' , 
                    '" . $req['main_product_etc'] . "' , 
                    '" . $req['channel_online'] . "' , 
                    '" . $req['channel_offline'] . "' , 
                    '" . $req['delivery_day'] . "' , 
                    '" . $req['order_moq'] . "' , 
                    '" . $req['nb_product'] . "' , 
                    '" . $req['supply_price'] . "' , 
                    '" . $req['type_cnt'] . "' , 
                    '" . $req['expire_day'] . "' , 
                    '" . $req['type_a'] . "' , 
                    '" . $req['type_b'] . "' , 
                    '" . $req['type_c'] . "' , 
                    '" . $req['sub_material'] . "' , 
                    '" . $req['sub_lead_time'] . "' , 
                    '" . $req['sub_moq'] . "' , 
                    '" . $req['sub_price'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    main_product_cd = VALUES(main_product_cd),
                    main_product_etc = VALUES(main_product_etc),
                    channel_online = VALUES(channel_online),
                    channel_offline = VALUES(channel_offline),
                    delivery_day = VALUES(delivery_day),
                    order_moq = VALUES(order_moq),
                    nb_product = VALUES(nb_product),
                    supply_price = VALUES(supply_price),
                    type_cnt = VALUES(type_cnt),
                    expire_day = VALUES(expire_day),
                    type_a = VALUES(type_a),
                    type_b = VALUES(type_b),
                    type_c = VALUES(type_c),
                    sub_material = VALUES(sub_material),
                    sub_lead_time = VALUES(sub_lead_time),
                    sub_moq = VALUES(sub_moq),
                    sub_price = VALUES(sub_price),
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";

        $this->db->query($sql, array());

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }


    public function own_product_detail_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (select
                    t1.detail_seq ,
                    t1.member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.brand ,
                    (select company_name from tb_member a where a.member_cd = t1.member_cd) as maker ,
                    if(t1.brand is not null and t1.brand != '', t1.brand, (select company_name from tb_member a where a.member_cd = t1.member_cd)) as brand_name ,
                    t1.expire_day ,
                    t1.channel_offline ,
                    concat('오프라인:' ,t1.channel_offline, ', 온라인:', t1.channel_online) as channel, 
                    t1.delivery_day ,
                    t1.type_cnt ,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'prod_thumb' and a.parent_cd = t1.detail_seq order by file_no limit 1), '')  thumbnail_img ,
                    t1.hit_cnt , 
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_product_detail_own t1 
                where
                    t1.is_delete = 'n' 
                    and t1.member_cd = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }

        if(empty($req['order_by']) ||  $req['order_by'] === 'hit') {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'product') {
            $sql .= " ) TB1
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " ) TB1 
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        
        return $this->db->query($sql, array($req['member_cd'], $offset, $perpage));
    }

    public function own_product_detail_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_product_detail_own t1 
                where
                    is_delete = 'n' 
                    and t1.member_cd = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }
        
       $tmp = $this->db->query($sql, array($req['member_cd']))->row_array();
       return $tmp['cnt'];
    }

    public function own_product_detail_info($seq) {
        $sql = "select
                    t1.detail_seq ,
                    t1.member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.brand ,
                    (select company_name from tb_member a where a.member_cd = t1.member_cd) as maker ,
                    if(t1.brand is not null and t1.brand != '', t1.brand, (select company_name from tb_member a where a.member_cd = t1.member_cd)) as brand_name ,
                    t1.expire_day ,
                    t1.channel_offline ,
                    t1.channel_online ,
                    concat('오프라인:' ,t1.channel_offline, ', 온라인:', t1.channel_online) as channel, 
                    t1.delivery_day ,
                    t1.type_cnt ,
                    '' as type_a,
                    '' as type_b,
                    '' as type_c,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'prod_thumb' and a.parent_cd = t1.detail_seq order by file_no limit 1), '')  thumbnail_img ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_product_detail_own t1 
                where
                    t1.detail_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function insert_product_detail_own($req) {
        $this->db->trans_begin();

        $sql = "insert into tb_product_detail_own
                (
                    member_cd ,
                    product_name ,
                    tags ,
                    product_summary ,
                    supply_price ,
                    moq ,
                    food_type ,
                    brand ,
                    expire_day ,
                    channel_offline ,
                    channel_online ,
                    delivery_day ,
                    type_cnt ,
                    material_leadtime ,
                    material_moq ,
                    material_price ,
                    export_nation  ,
                    export_progress ,
                    is_ios22000 ,
                    is_fda ,
                    is_halal ,
                    created_by ,
                    created_at ,
                    updated_by , 
                    updated_at
                )
                VALUES
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['product_name'] . "' , 
                    '" . $req['tags'] . "' , 
                    '" . $req['product_summary'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['supply_price']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['moq']) . "' , 
                    '" . $req['food_type'] . "' , 
                    '" . $req['brand'] . "' , 
                    '" . $req['expire_day'] . "' , 
                    '" . $req['channel_offline'] . "' , 
                    '" . $req['channel_online'] . "' , 
                    '" . $req['delivery_day'] . "' , 
                    '" . $req['type_cnt'] . "' , 
                    '" . $req['material_leadtime'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['material_moq']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['material_price']) . "' , 
                    '" . $req['export_nation'] . "' , 
                    '" . $req['export_progress'] . "' , 
                    '" . $req['is_ios22000'] . "' , 
                    '" . $req['is_fda'] . "' , 
                    '" . $req['is_halal'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                ) ";
        
        $this->db->query($sql, array());
        $seq = $this->db->insert_id();

        if(!empty($req['product_img'])) {
            $idx = 1;
            foreach($req['product_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_thumb');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['detail_img'])) {
            $idx = 1;
            foreach($req['detail_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_detail');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['label_img'])) {
            $idx = 1;
            foreach($req['label_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_label');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_product_detail_own($req) {
        $this->db->trans_begin();

        $sql = "update tb_product_detail_own
                set
                    product_name = '" . $req['product_name'] . "' , 
                    tags = '" . $req['tags'] . "',
                    product_summary = '" . $req['product_summary'] . "',
                    supply_price = '" . preg_replace('/[^0-9]*/s', '', $req['supply_price']) . "',
                    moq = '" . preg_replace('/[^0-9]*/s', '', $req['moq']) . "',
                    food_type = '" . $req['food_type'] . "',
                    brand = '" . $req['brand'] . "',
                    expire_day = '" . $req['expire_day'] . "',
                    channel_offline = '" . $req['channel_offline'] . "',
                    channel_online = '" . $req['channel_online'] . "',
                    delivery_day = '" . $req['delivery_day'] . "',
                    type_cnt = '" . $req['type_cnt'] . "',
                    material_leadtime = '" . $req['material_leadtime'] . "',
                    material_moq = '" . preg_replace('/[^0-9]*/s', '', $req['material_moq']) . "',
                    material_price = '" . preg_replace('/[^0-9]*/s', '', $req['material_price']) . "',
                    export_nation  = '" . $req['export_nation'] . "',
                    export_progress = '" . $req['export_progress'] . "',
                    is_ios22000 = '" . $req['is_ios22000'] . "',
                    is_fda = '" . $req['is_fda'] . "',
                    is_halal = '" . $req['is_halal'] . "',
                    updated_by = '" . $req['member_id'] . "', 
                    updated_at = now()
                where
                    detail_seq = ? ";
        
        $this->db->query($sql, array($req['detail_seq']));

        $seq = $req['detail_seq'];

        if(!empty($req['delete_file'])) {
            $this->db->reset_query();
            $sql = "update tb_file
                    set 
                        is_delete = 'y'
                        , updated_by = '" . $req['member_id'] . "' 
                        , updated_at = now()
                    where
                        file_seq in (" . $req['delete_file'] . ") ";
            $this->db->query($sql, array());
        }
        if(!empty($req['product_img'])) {
            $idx = 1;
            foreach($req['product_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_thumb');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['detail_img'])) {
            $idx = 1;
            foreach($req['detail_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_detail');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['label_img'])) {
            $idx = 1;
            foreach($req['label_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'prod_label');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }


    public function oem_product_detail_list($req, $offset, $perpage) {
        $sql = "select
                    TB1.*
                from
                (select
                    t1.detail_seq ,
                    t1.member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.brand ,
                    FN_GETCODENAME('oem_company', t1.brand) as maker ,
                    FN_GETCODENAME('oem_company', t1.brand) as brand_name ,
                    t1.expire_day ,
                    concat('오프라인:' ,t1.channel_offline, ', 온라인:', t1.channel_online) as channel, 
                    t1.delivery_day ,
                    t1.type_cnt ,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'oem_thumb' and a.parent_cd = t1.detail_seq order by file_no limit 1), '')  thumbnail_img ,
                    t1.hit_cnt , 
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_product_detail_oem t1 
                where
                    t1.is_delete = 'n' 
                    and t1.member_cd = ?";
        if(!empty($req['keyword'])) {
            $sql .= " and TB11.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }

        if(empty($req['order_by']) ||  $req['order_by'] === 'hit') {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'product') {
            $sql .= " ) TB1
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " ) TB1 
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        
        return $this->db->query($sql, array($req['member_cd'], $offset, $perpage));
    }

    public function oem_product_detail_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_product_detail_oem t1 
                where
                    is_delete = 'n' 
                    and t1.member_cd = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }
        
       $tmp = $this->db->query($sql, array($req['member_cd']))->row_array();
       return $tmp['cnt'];
    }

    public function oem_product_detail_info($seq) {
        $sql = "select
                    t1.detail_seq ,
                    t1.member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.brand ,
                    FN_GETCODENAME('oem_company', t1.brand) as maker ,
                    FN_GETCODENAME('oem_company', t1.brand) as brand_name ,
                    t1.expire_day ,
                    t1.channel_offline ,
                    t1.channel_online ,
                    concat('오프라인:' ,t1.channel_offline, ', 온라인:', t1.channel_online) as channel, 
                    t1.delivery_day ,
                    t1.type_cnt ,
                    t1.type_a ,
                    t1.type_b ,
                    t1.type_c ,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_product_detail_oem t1 
                where
                    t1.detail_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function insert_product_detail_oem($req) {
        $this->db->trans_begin();

        $sql = "insert into tb_product_detail_oem
                (
                    member_cd ,
                    product_name ,
                    tags ,
                    product_summary ,
                    supply_price ,
                    moq ,
                    food_type ,
                    brand ,
                    expire_day ,
                    channel_offline ,
                    channel_online ,
                    delivery_day ,
                    type_a ,
                    type_b ,
                    type_c ,
                    material_leadtime ,
                    material_moq ,
                    material_price ,
                    export_nation  ,
                    export_progress ,
                    is_ios22000 ,
                    is_fda ,
                    is_halal ,
                    created_by ,
                    created_at ,
                    updated_by , 
                    updated_at
                )
                VALUES
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['product_name'] . "' , 
                    '" . $req['tags'] . "' , 
                    '" . $req['product_summary'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['supply_price']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['moq']) . "' , 
                    '" . $req['food_type'] . "' , 
                    '" . $req['brand'] . "' , 
                    '" . $req['expire_day'] . "' , 
                    '" . $req['channel_offline'] . "' , 
                    '" . $req['channel_online'] . "' , 
                    '" . $req['delivery_day'] . "' , 
                    '" . $req['type_a'] . "' , 
                    '" . $req['type_b'] . "' , 
                    '" . $req['type_c'] . "' , 
                    '" . $req['material_leadtime'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['material_moq']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['material_price']) . "' , 
                    '" . $req['export_nation'] . "' , 
                    '" . $req['export_progress'] . "' , 
                    '" . $req['is_ios22000'] . "' , 
                    '" . $req['is_fda'] . "' , 
                    '" . $req['is_halal'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                ) ";
        
        $this->db->query($sql, array());
        $seq = $this->db->insert_id();

        if(!empty($req['product_img'])) {
            $idx = 1;
            foreach($req['product_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_thumb');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['detail_img'])) {
            $idx = 1;
            foreach($req['detail_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_detail');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['label_img'])) {
            $idx = 1;
            foreach($req['label_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_label');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_product_detail_oem($req) {
        $this->db->trans_begin();

        $sql = "update tb_product_detail_oem
                set
                    product_name = '" . $req['product_name'] . "' , 
                    tags = '" . $req['tags'] . "',
                    product_summary = '" . $req['product_summary'] . "',
                    supply_price = '" . preg_replace('/[^0-9]*/s', '', $req['supply_price']) . "',
                    moq = '" . preg_replace('/[^0-9]*/s', '', $req['moq']) . "',
                    food_type = '" . $req['food_type'] . "',
                    brand = '" . $req['brand'] . "',
                    expire_day = '" . $req['expire_day'] . "',
                    channel_offline = '" . $req['channel_offline'] . "',
                    channel_online = '" . $req['channel_online'] . "',
                    delivery_day = '" . $req['delivery_day'] . "',
                    type_a = '" . $req['type_a'] . "',
                    type_b = '" . $req['type_b'] . "',
                    type_c = '" . $req['type_c'] . "',
                    material_leadtime = '" . $req['material_leadtime'] . "',
                    material_moq = '" . preg_replace('/[^0-9]*/s', '', $req['material_moq']) . "',
                    material_price = '" . preg_replace('/[^0-9]*/s', '', $req['material_price']) . "',
                    export_nation  = '" . $req['export_nation'] . "',
                    export_progress = '" . $req['export_progress'] . "',
                    is_ios22000 = '" . $req['is_ios22000'] . "',
                    is_fda = '" . $req['is_fda'] . "',
                    is_halal = '" . $req['is_halal'] . "',
                    updated_by = '" . $req['member_id'] . "', 
                    updated_at = now()
                where
                    detail_seq = ? ";
        
        $this->db->query($sql, array($req['detail_seq']));

        $seq = $req['detail_seq'];

        if(!empty($req['delete_file'])) {
            $this->db->reset_query();
            $sql = "update tb_file
                    set 
                        is_delete = 'y'
                        , updated_by = '" . $req['member_id'] . "' 
                        , updated_at = now()
                    where
                        file_seq in (" . $req['delete_file'] . ") ";
            $this->db->query($sql, array());
        }
        if(!empty($req['product_img'])) {
            $idx = 1;
            foreach($req['product_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_thumb');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['detail_img'])) {
            $idx = 1;
            foreach($req['detail_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_detail');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if(!empty($req['label_img'])) {
            $idx = 1;
            foreach($req['label_img'] as $row) {
                $this->db->reset_query();
                $this->db->set('parent_gbn', 'oem_label');
                $this->db->set('parent_cd', $seq);
                $this->db->set('file_no', $idx);
                $this->db->set('org_filename', $row['file_orgname']);
                $this->db->set('new_filepath', $row['file_newpath']);
                $this->db->set('new_filename', $row['file_newname']);
                $this->db->set('file_size', $row['file_size']);
                $this->db->set('file_ext', $row['file_ext']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['member_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['member_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_file');
                $idx++;
            }
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }


    public function admin_BI031_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.*
                FROM
                (select
                    t1.detail_seq ,
                    '' as member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.maker ,
                    if(t1.brand is not null and t1.brand != '', t1.brand, (select company_name from tb_admin_bi01 a where a.biz_no = t1.biz_no)) as brand_name ,
                    t1.brand ,
                    t1.expire_day ,
                    t1.channel as channel_offline ,
                    t1.delivery_day ,
                    t1.type_cnt ,
                    '' as type_a,
                    '' as type_b,
                    '' as type_c,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    '' as thumbnail_img ,
                    t1.hit_cnt , 
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_admin_bi031 t1 
                where
                    t1.is_delete = 'n' 
                    and t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }

        if(empty($req['order_by']) ||  $req['order_by'] === 'hit') {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'product') {
            $sql .= " ) TB1
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " ) TB1 
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        
        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function admin_BI031_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                tb_admin_bi031 t1 
                where
                    t1.is_delete = 'n' 
                    and t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }
        
       $tmp = $this->db->query($sql, array($req['biz_no']))->row_array();
       return $tmp['cnt'];
    }

    public function admin_BI032_list($req, $offset, $perpage) {
        $sql = "SELECT
                    TB1.* 
                FROM
                (select
                    t1.detail_seq ,
                    '' as member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    '' as maker ,
                    t1.brand as brand_name ,
                    t1.brand ,
                    t1.expire_day ,
                    t1.channel as channel_offline ,
                    t1.delivery_day ,
                    '' as type_cnt ,
                    '' as type_a,
                    '' as type_b,
                    '' as type_c,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    '' as thumbnail_img ,
                    t1.hit_cnt , 
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_admin_bi032 t1 
                where
                    t1.is_delete = 'n' 
                    and t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }

        if(empty($req['order_by']) ||  $req['order_by'] === 'hit') {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'product') {
            $sql .= " ) TB1
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else if($req['order_by'] === 'company') {
            $sql .= " ) TB1 
                    order by TB1.product_name asc
                    limit ?, ? ";
        }
        else {
            $sql .= " ) TB1
                    order by TB1.hit_cnt desc, TB1.product_name asc
                    limit ?, ? ";
        }
        
        return $this->db->query($sql, array($req['biz_no'], $offset, $perpage));
    }

    public function admin_BI032_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                tb_admin_bi032 t1 
                where
                    t1.is_delete = 'n' 
                    and t1.biz_no = ? ";
        if(!empty($req['keyword'])) {
            $sql .= " and t1.product_name like '%" . $req['keyword'] . "%' ";
        }
        if(!empty($req['food_type'])) {
            $sql .= " and t1.food_type = '" . $req['food_type'] . "' ";
        }
        if(!empty($req['detail_seq'])) {
            $sql .= " and t1.detail_seq != '" . $req['detail_seq'] . "' ";
        }
        
       $tmp = $this->db->query($sql, array($req['biz_no']))->row_array();
       return $tmp['cnt'];
    }

    public function admin_BI031_info($seq) {
        $sql = "select
                    t1.detail_seq ,
                    '' as member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    t1.food_type ,
                    t1.maker ,
                    if(t1.brand is not null and t1.brand != '', t1.brand, (select company_name from tb_admin_bi01 a where a.biz_no = t1.biz_no)) as brand_name ,
                    t1.expire_day ,
                    t1.channel ,
                    t1.delivery_day ,
                    t1.type_cnt ,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_admin_bi031 t1 
                where
                    t1.detail_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }    


    public function admin_BI032_info($seq) {
        $sql = "select
                    t1.detail_seq ,
                    '' as member_cd ,
                    t1.product_name ,
                    t1.tags ,
                    t1.product_summary ,
                    t1.supply_price ,
                    t1.moq ,
                    '' as maker ,
                    if(t1.brand is not null and t1.brand != '', t1.brand, (select company_name from tb_admin_bi01 a where a.biz_no = t1.biz_no)) as brand_name ,
                    t1.expire_day ,
                    t1.channel ,
                    t1.delivery_day ,
                    '' as type_cnt ,
                    t1.material_leadtime ,
                    t1.material_moq ,
                    t1.material_price ,
                    t1.export_nation  ,
                    t1.export_progress ,
                    t1.is_ios22000 ,
                    t1.is_fda ,
                    t1.is_halal ,
                    t1.size ,
                    t1.storage_method ,
                    t1.manufacture_day ,
                    t1.manufacture_month ,
                    t1.manufacture_year ,
                    date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_admin_bi032 t1 
                where
                    t1.detail_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }    


    public function update_product_own_hit($seq, $cd) {
        $this->db->trans_begin();

        $sql = "update tb_product_detail_own
                set
                    hit_cnt = hit_cnt + 1
                where
                    detail_seq = ? ";
        $this->db->query($sql, array($seq));

        $this->db->reset_query();
        $this->db->set('member_cd', $cd);
        $this->db->set('product_type', '1');
        $this->db->set('product_seq', $seq);
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_hit_history');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_product_oem_hit($seq, $cd) {
        $this->db->trans_begin();

        $sql = "update tb_product_detail_oem
                set
                    hit_cnt = hit_cnt + 1
                where
                    detail_seq = ? ";
        $this->db->query($sql, array($seq));

        $this->db->reset_query();
        $this->db->set('member_cd', $cd);
        $this->db->set('product_type', '2');
        $this->db->set('product_seq', $seq);
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_hit_history');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_admin_bi031_hit($seq) {
        $this->db->trans_begin();

        $sql = "update tb_admin_bi031
                set
                    hit_cnt = hit_cnt + 1
                where
                    detail_seq = ? ";
        $this->db->query($sql, array($seq));

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_admin_bi032_hit($seq) {
        $this->db->trans_begin();

        $sql = "update tb_admin_bi032
                set
                    hit_cnt = hit_cnt + 1
                where
                    detail_seq = ? ";
        $this->db->query($sql, array($seq));

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function product_detail_for_request($seq, $type) {
        $sql = "select
                    t1.product_name ,
                    t1.supply_price
                from
                    tb_product_detail_" . $type . " t1 
                where
                    t1.detail_seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function product_hit_for_dashboard($type, $cd) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_hit_history t1
                where
                    date_format(t1.created_at, '%Y-%m-%d') between 
                                                    date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 week), date_sub(date_sub(now(), interval 1 week), interval (weekday(date_sub(now(), interval 1 week)) + 1) DAY)), '%Y-%m-%d') 
                                                    and date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 day), if(weekday(now()) = 5, date_sub(now(), interval 1 week), date_add(date_sub(now(), interval 1 week), interval (5 - weekday(date_sub(now(), interval 1 week))) DAY))), '%Y-%m-%d')
                    and t1.product_type = ?
                    and t1.member_cd = ? ";
        $tmp = $this->db->query($sql, array($type, $cd))->row_array();
        return $tmp['cnt'];
    }

    public function product_cnt_for_dashboard($type, $cd) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_product_detail_" . ($type === '1' ? 'own' : 'oem') . " t1
                where
                    t1.is_delete = 'n'
                    and t1.member_cd = ? ";
        $tmp = $this->db->query($sql, array($cd))->row_array();
        return $tmp['cnt'];
    }

    public function product_list_for_dashboard($type, $cd) {
        $sql = "select
                    t1.product_name
                    , t1.supply_price
                    , ifnull(t2.cnt, '0') as cnt
                from
                    tb_product_detail_" . ($type === '1' ? 'own' : 'oem') . " t1
                inner join  (
                                select
                                    a.product_seq
                                    , count(a.product_seq) as cnt
                                from
                                    tb_hit_history a
                                where
                                    date_format(a.created_at, '%Y-%m-%d') between 
                                                                    date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 week), date_sub(date_sub(now(), interval 1 week), interval (weekday(date_sub(now(), interval 1 week)) + 1) DAY)), '%Y-%m-%d') 
                                                                    and date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 day), if(weekday(now()) = 5, date_sub(now(), interval 1 week), date_add(date_sub(now(), interval 1 week), interval (5 - weekday(date_sub(now(), interval 1 week))) DAY))), '%Y-%m-%d')
                                    and a.product_type = ?
                                    and a.member_cd = ? 
                                group by a.product_seq 
                            ) t2 on t2.product_seq = t1.detail_seq
                where
                    t1.member_cd = ? 
                    and t1.is_delete = 'n'
                order by ifnull(t2.cnt, '0') desc, t1.product_name
                limit 0, 5 ";
        return $this->db->query($sql, array($type, $cd, $cd));
    }

    public function product_hit_sum($type, $cd) {
        $sql = "select
                    max(TB1.cnt) as sum_max
                from
                (select
                    t1.member_cd
                    , count(*) as cnt
                from
                    tb_hit_history t1
                inner join tb_member t2 on t2.member_cd = t2.member_cd
                where
                    date_format(t1.created_at, '%Y-%m-%d') between 
                                                    date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 week), date_sub(date_sub(now(), interval 1 week), interval (weekday(date_sub(now(), interval 1 week)) + 1) DAY)), '%Y-%m-%d') 
                                                    and date_format(if(weekday(now()) = 6, date_sub(now(), interval 1 day), if(weekday(now()) = 5, date_sub(now(), interval 1 week), date_add(date_sub(now(), interval 1 week), interval (5 - weekday(date_sub(now(), interval 1 week))) DAY))), '%Y-%m-%d')
                    and t1.product_type = ?
                    and t2.industrial_code = (select a.industrial_code from tb_member a where a.member_cd = ?)
                group by t1.member_cd) TB1 ";

        $tmp = $this->db->query($sql, array($type, $cd))->row_array();
        return $tmp['sum_max'];
    }

    public function product_cnt_sum($type, $cd) {
        $sql = "select
                    max(TB1.cnt) as sum_max
                from
                (select
                    count(*) as cnt
                from
                    tb_product_detail_" . ($type === '1' ? 'own' : 'oem') . " t1
                inner join tb_member t2 on t2.member_cd = t1.member_cd
                where
                    t1.is_delete = 'n'
                    and t2.industrial_code = (select a.industrial_code from tb_member a where a.member_cd = ?)
                group by t1.member_cd) TB1 ";
        $tmp = $this->db->query($sql, array($cd))->row_array();
        return $tmp['sum_max'];
    }

}    

?>