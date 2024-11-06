<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Domestic_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function manufacture_list($req, $offset, $perpage) {
        $sql = "select
                    TB1.* 
                from
                (
                    select
                        t1.company_name
                        , t1.biz_no
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                        , t1.logo_img
                        , t1.hit_cnt
                    from
                        tb_domestic_companym t1
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['is_matching'])) {
            $sql .= " and TB1.is_matching = '" . $req['is_matching'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by TB1.created_at desc, TB1.company_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function manufacture_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                (
                    select
                        t1.company_name
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    from
                        tb_domestic_companym t1
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['is_matching'])) {
            $sql .= " and TB1.is_matching = '" . $req['is_matching'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function manufacture_info($biz_no) {
        $this->db->where('biz_no', $biz_no);
        return $this->db->get('tb_domestic_companym');
    }

    public function distribution_list($req, $offset, $perpage) {
        $sql = "select
                    TB1.* 
                from
                (
                    select
                        t1.company_name
                        , t1.biz_no
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    from
                        tb_domestic_companyd t1
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['is_matching'])) {
            $sql .= " and TB1.is_matching = '" . $req['is_matching'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by TB1.created_at desc, TB1.company_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function distribution_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                (
                    select
                        t1.company_name
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    from
                        tb_domestic_companyd t1
                    where
                        t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['is_matching'])) {
            $sql .= " and TB1.is_matching = '" . $req['is_matching'] . "' ";
        }
        if(!empty($req['keyword'])) {
            $sql .= " and (TB1.company_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function distribution_info($biz_no) {
        $this->db->where('biz_no', $biz_no);
        return $this->db->get('tb_domestic_companyd');
    }

    public function finance_list($req, $offset, $perpage) {
        $sql = "select
                    TB1.*
                from
                (
                    select
                        t2.company_name
                        , t1.biz_no
                        , t1.base_year
                        , t1.sales_year
                        , t1.biz_profits
                        , t1.current_profits
                        , t1.credit_rating
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    from
                        tb_domestic_finance t1
                    left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                    where
                        t2.is_delete = 'n'
                        and t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and TB1.company_name like '%" . $req['keyword'] . "%' ";
        }
        $sql .= " order by TB1.base_year desc, TB1.created_at desc, TB1.company_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function finance_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                (
                    select
                        t2.company_name
                        , t1.biz_no
                        , t1.base_year
                        , t1.sales_year
                        , t1.biz_profits
                        , t1.current_profits
                        , t1.credit_rating
                        , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    from
                        tb_domestic_finance t1
                    left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                    where
                        t2.is_delete = 'n'
                        and t1.is_delete = 'n'
                ) TB1
                where
                    1=1 ";
        if(!empty($req['keyword'])) {
            $sql .= " and TB1.company_name like '%" . $req['keyword'] . "%' ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function finance_info($biz_no, $year) {
        $sql = "select
                    t2.company_name
                    , t1.biz_no
                    , t1.base_year
                    , t1.sales_year
                    , t1.biz_profits
                    , t1.current_profits
                    , t1.credit_rating
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_finance t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t1.biz_no = ?
                    and t1.base_year = ? ";
        
        return $this->db->query($sql, array($biz_no, $year));
    }

    public function facilities_list($req, $offset, $perpage) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.img_url
                    , t1.img_desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_facilities t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.img_desc like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t2.company_name , t1.created_at desc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function facilities_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_facilities t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.img_desc like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function facilities_info($seq) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.img_url
                    , t1.img_desc
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_facilities t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t1.seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function cert_list($req, $offset, $perpage) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.cert_name
                    , t1.cert_img
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_cert t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.cert_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t2.company_name , t1.created_at desc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function cert_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_cert t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.cert_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function cert_info($seq) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.cert_name
                    , t1.cert_img
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_cert t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t1.seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function patent_list($req, $offset, $perpage) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.patent_name
                    , t1.patent_name_eng
                    , t1.patent_img
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_patent t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.patent_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t2.company_name , t1.created_at desc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function patent_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_patent t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t2.is_delete = 'n'
                    and t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t2.company_name like '%" . $req['keyword'] . "%' or t1.patent_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function patent_info($seq) {
        $sql = "select
                    t2.company_name
                    , t1.seq
                    , t1.biz_no
                    , t1.patent_name
                    , t1.patent_name_eng
                    , t1.patent_img
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                from
                    tb_domestic_patent t1
                left outer join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t1.seq = ? ";
        
        return $this->db->query($sql, array($seq));
    }

    public function nbproduct_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.company_name
                    , t1.product_name
                    , '1' as product_type2
                    , t1.product_type
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.tags
                    , t1.biz_no
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'NB_image' and a.is_main = 'y' limit 1), '') as prod_img
                    , t1.is_main
                    , t1.hit_cnt
                 from
                    tb_domestic_product t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.company_name, t1.product_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function nbproduct_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_product t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }

    public function oemproduct_list($req, $offset, $perpage) {
        $sql = "select
                    t1.seq
                    , t1.company_name
                    , '2' as product_type2
                    , t1.product_type
                    , t1.product_name
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t1.category)) as category_name
                    , t1.tags
                    , t1.biz_no
                    , date_format(t1.created_at, '%Y.%m.%d %H:%i') as created_at
                    , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                    , t1.is_main
                    , t1.hit_cnt
                 from
                    tb_domestic_oem t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%') ";
        }
        $sql .= " order by t1.company_name, t1.product_name asc
                limit ?, ? ";
        return $this->db->query($sql, array($offset, $perpage));
    }

    public function oemproduct_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_domestic_oem t1
                where
                    t1.is_delete = 'n' ";
        if(!empty($req['keyword'])) {
            $sql .= " and (t1.company_name like '%" . $req['keyword'] . "%' or t1.product_name like '%" . $req['keyword'] . "%') ";
        }
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
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
                    , t1.is_main
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
                    , t1.product_type
                    , date_format(t1.created_at, '%Y-%m-%d') as created_at
                    , t1.hit_cnt
                    , t1.is_main
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

    public function insert_companym($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_companym
                (
                    `biz_no`,
                    `company_name`,
                    `company_name_eng`,
                    `logo_img`,
                    `summary`,
                    `tags`,
                    `ceo_name`,
                    `industrial_code`,
                    `incorporation_at`,
                    `addr`,
                    `homepage`,
                    `company_tel`,
                    `introduce_file`,
                    `category`,
                    `category_etc`,
                    `main_group`,
                    `main_product`,
                    `main_client`,
                    `main_oem`,
                    `production_day`,
                    `unit_day`,
                    `production_month`,
                    `unit_month`,
                    `production_year`,
                    `unit_year`,
                    `capa`,
                    `capa_at`,
                    `facilities_info`,
                    `packaging_machine`,
                    `etc_machine`,
                    `detection_machine`,
                    `certi`,
                    `is_fda`,
                    `distribution_channel`,
                    `export_nation`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['company_name'] . "' , 
                    '" . $row['company_name_eng'] . "' , 
                    '" . $row['logo_img'] . "' , 
                    '" . $row['summary'] . "' , 
                    '" . $row['tags'] . "' , 
                    '" . $row['ceo_name'] . "' , 
                    '" . $row['industrial_code'] . "' , 
                    '" . $row['incorporation_at'] . "' , 
                    '" . $row['addr'] . "' , 
                    '" . $row['homepage'] . "' , 
                    '" . $row['company_tel'] . "' , 
                    '" . $row['introduce_file'] . "' , 
                    '" . implode(',', $row['category']) . "' , 
                    '" . $row['category_etc'] . "' , 
                    '" . $row['main_group'] . "' , 
                    '" . $row['main_product'] . "' , 
                    '" . $row['main_client'] . "' , 
                    '" . implode(',', $row['main_oem']) . "' , 
                    '" . $row['production_day'] . "' , 
                    '" . $row['unit_day'] . "' , 
                    '" . $row['production_month'] . "' , 
                    '" . $row['unit_month'] . "' , 
                    '" . $row['production_year'] . "' , 
                    '" . $row['unit_year'] . "' , 
                    '" . $row['capa'] . "' , 
                    '" . $row['capa_at'] . "' , 
                    '" . $row['facilities_info'] . "' , 
                    '" . $row['packaging_machine'] . "' , 
                    '" . $row['etc_machine'] . "' , 
                    '" . $row['detection_machine'] . "' , 
                    '" . $row['certi'] . "' , 
                    '" . $row['is_fda'] . "' , 
                    '" . $row['distribution_channel'] . "' , 
                    '" . $row['export_nation'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                   '" . $row['admin_id'] . "' , 
                    now()
                ) 
                ON DUPLICATE KEY UPDATE 
                        company_name = VALUES(company_name),
                        company_name_eng = VALUES(company_name_eng),
                        logo_img = VALUES(logo_img),
                        summary = VALUES(summary),
                        tags = VALUES(tags),
                        ceo_name = VALUES(ceo_name),
                        industrial_code = VALUES(industrial_code),
                        incorporation_at = VALUES(incorporation_at),
                        addr = VALUES(addr),
                        homepage = VALUES(homepage),
                        company_tel = VALUES(company_tel),
                        introduce_file = VALUES(introduce_file),
                        category = VALUES(category),
                        category_etc = VALUES(category_etc),
                        main_group = VALUES(main_group),
                        main_product = VALUES(main_product),
                        main_client = VALUES(main_client),
                        main_oem = VALUES(main_oem),
                        production_day = VALUES(production_day),
                        unit_day = VALUES(unit_day),
                        production_month = VALUES(production_month),
                        unit_month = VALUES(unit_month),
                        production_year = VALUES(production_year),
                        unit_year = VALUES(unit_year),
                        capa = VALUES(capa),
                        capa_at = VALUES(capa_at),
                        facilities_info = VALUES(facilities_info),
                        packaging_machine = VALUES(packaging_machine),
                        etc_machine = VALUES(etc_machine),
                        detection_machine = VALUES(detection_machine),
                        certi = VALUES(certi),
                        is_fda = VALUES(is_fda),
                        distribution_channel = VALUES(distribution_channel),
                        export_nation = VALUES(export_nation),
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

    public function delete_companym($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('biz_no', $req['biz_no']);
        $this->db->update('tb_domestic_companym');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }
    
    public function insert_companyd($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_companyd
                (
                    `biz_no`,
                    `company_name`,
                    `industrial_code`,
                    `main_product`,
                    `distribution_type`,
                    `sales_year`,
                    `sales_at`,
                    `credit_rating`,
                    `rating_at`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['company_name'] . "' , 
                    '" . $row['industrial_code'] . "' , 
                    '" . $row['main_product'] . "' , 
                    '" . implode(',', $row['distribution_type']) . "' , 
                    '" . $row['sales_year'] . "' , 
                    '" . $row['sales_at'] . "' , 
                    '" . $row['credit_rating'] . "' , 
                    '" . $row['rating_at'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                    '" . $row['admin_id'] . "' , 
                    now()
                ) 
                ON DUPLICATE KEY UPDATE 
                        company_name = VALUES(company_name),
                        industrial_code = VALUES(industrial_code),
                        main_product = VALUES(main_product),
                        distribution_type = VALUES(distribution_type),
                        sales_year = VALUES(sales_year),
                        sales_at = VALUES(sales_at),
                        credit_rating = VALUES(credit_rating),
                        rating_at = VALUES(rating_at),
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

    public function delete_companyd($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('biz_no', $req['biz_no']);
        $this->db->update('tb_domestic_companyd');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_finance($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_finance
                (
                    `biz_no`,
                    `base_year`,
                    `sales_year`,
                    `biz_profits`,
                    `current_profits`,
                    `credit_rating`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['base_year'] . "' , 
                    '" . $row['sales_year'] . "' , 
                    '" . $row['biz_profits'] . "' , 
                    '" . $row['current_profits'] . "' , 
                    '" . $row['credit_rating'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                    '" . $row['admin_id'] . "' , 
                    now()
                ) 
                ON DUPLICATE KEY UPDATE 
                    sales_year = VALUES(sales_year),
                    biz_profits = VALUES(biz_profits),
                    current_profits = VALUES(current_profits),
                    credit_rating = VALUES(credit_rating),
                    is_delete = 'n' , 
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";
        $this->db->query($sql);

        $this->db->reset_query();
        $this->db->set('biz_no', $row['biz_no']);
        $this->db->set('base_year', $row['base_year']);
        $this->db->set('sales_year', $row['sales_year']);
        $this->db->set('biz_profits', $row['biz_profits']);
        $this->db->set('current_profits', $row['current_profits']);
        $this->db->set('credit_rating', $row['credit_rating']);
        $this->db->set('created_by', $row['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_domestic_finance_history');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function delete_finance($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('biz_no', $req['biz_no']);
        $this->db->where('base_year', $req['base_year']);
        $this->db->update('tb_domestic_finance');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_facilities($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_facilities
                (
                    `biz_no`,
                    `img_url`,
                    `img_desc`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['img_url'] . "' , 
                    '" . $row['img_desc'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                    '" . $row['admin_id'] . "' , 
                    now()
                ) ";
        $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function update_facilities($row)
    {
        $this->db->trans_begin();

        $this->db->set('img_url', $row['img_url']);
        $this->db->set('img_desc', $row['img_desc']);
        $this->db->set('updated_by', $row['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $row['seq']);
        $this->db->update('tb_domestic_facilities');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function delete_facilities($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_facilities');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_cert($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_cert
                (
                    `biz_no`,
                    `cert_img`,
                    `cert_name`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['cert_img'] . "' , 
                    '" . $row['cert_name'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                    '" . $row['admin_id'] . "' , 
                    now()
                ) ";
        $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function update_cert($row)
    {
        $this->db->trans_begin();

        $this->db->set('cert_img', $row['cert_img']);
        $this->db->set('cert_name', $row['cert_name']);
        $this->db->set('updated_by', $row['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $row['seq']);
        $this->db->update('tb_domestic_cert');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function delete_cert($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_cert');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_patent($row)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_patent
                (
                    `biz_no`,
                    `patent_img`,
                    `patent_name`,
                    `patent_name_eng`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES 
                (
                    '" . $row['biz_no'] . "' , 
                    '" . $row['patent_img'] . "' , 
                    '" . $row['patent_name'] . "' , 
                    '" . $row['patent_name_eng'] . "' , 
                    'n' ,
                    '" . $row['admin_id'] . "' , 
                    now() ,
                    '" . $row['admin_id'] . "' , 
                    now()
                ) ";
        $this->db->query($sql);

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function update_patent($row)
    {
        $this->db->trans_begin();

        $this->db->set('patent_img', $row['patent_img']);
        $this->db->set('patent_name', $row['patent_name']);
        $this->db->set('patent_name_eng', $row['patent_name_eng']);
        $this->db->set('updated_by', $row['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $row['seq']);
        $this->db->update('tb_domestic_patent');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }      

    public function delete_patent($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_patent');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_nbproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('biz_no', $req['biz_no']);
        $this->db->set('company_name', $req['company_name']);
        $this->db->set('category', $req['category']);
        $this->db->set('category_etc', $req['category_etc']);
        $this->db->set('main_group', $req['main_group']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('tags', $req['tags']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('supply_price', preg_replace('/[^0-9]*/s', '', $req['supply_price']));
        $this->db->set('moq', preg_replace('/[^0-9]*/s', '', $req['moq']));
        $this->db->set('delivery_day', preg_replace('/[^0-9]*/s', '', $req['delivery_day']));
        $this->db->set('product_type', $req['product_type']);
        $this->db->set('weight', $req['weight']);
        $this->db->set('unit', $req['unit']);
        $this->db->set('storage', $req['storage']);
        $this->db->set('expire_day', $req['expire_day']);
        $this->db->set('qty', $req['qty']);
        $this->db->set('qty_unit', $req['qty_unit']);
        $this->db->set('container_type', $req['container_type']);
        $this->db->set('channel_status', $req['channel_status']);
        $this->db->set('is_main', $req['is_main']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_domestic_product');

        $seq =  $this->db->insert_id();
        if(!empty($req['imgs'])) {
            foreach($req['imgs'] as $row) {
                $this->db->reset_query();
                $this->db->set('biz_no', $req['biz_no']);
                $this->db->set('product_seq', $seq);
                $this->db->set('img_type', $row['img_type']);
                $this->db->set('img_url', $row['img_url']);
                $this->db->set('is_main', $row['is_main']);
                $this->db->set('order_no', $row['order_no']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['admin_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_domestic_prodimg');
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

    public function update_nbproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('category', $req['category']);
        $this->db->set('category_etc', $req['category_etc']);
        $this->db->set('main_group', $req['main_group']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('tags', $req['tags']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('supply_price', preg_replace('/[^0-9]*/s', '', $req['supply_price']));
        $this->db->set('moq', preg_replace('/[^0-9]*/s', '', $req['moq']));
        $this->db->set('delivery_day', preg_replace('/[^0-9]*/s', '', $req['delivery_day']));
        $this->db->set('product_type', $req['product_type']);
        $this->db->set('weight', $req['weight']);
        $this->db->set('unit', $req['unit']);
        $this->db->set('storage', $req['storage']);
        $this->db->set('expire_day', $req['expire_day']);
        $this->db->set('qty', $req['qty']);
        $this->db->set('qty_unit', $req['qty_unit']);
        $this->db->set('container_type', $req['container_type']);
        $this->db->set('channel_status', $req['channel_status']);
        $this->db->set('is_main', $req['is_main']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_product');

        $seq =  $req['seq'];

        for($i = 1; $i <= 5; $i++) {

        }

        for($i = 1; $i <= 5; $i++) {
            if(!empty($req['prod_img' . $i . '_seq']) && empty($req['prod_img' . $i])) {
                $this->db->reset_query();
                $this->db->set('is_delete', 'y');
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->where('seq', $req['prod_img' . $i]);
                $this->db->update('tb_domestic_prodimg');
            }

            if(!empty($req['label_img' . $i . '_seq']) && empty($req['label_img' . $i])) {
                $this->db->reset_query();
                $this->db->set('is_delete', 'y');
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->where('seq', $req['label_img' . $i]);
                $this->db->update('tb_domestic_product');
            }
        }

        if(!empty($req['imgs'])) {
            foreach($req['imgs'] as $row) {
                $this->db->reset_query();
                $this->db->set('biz_no', $req['biz_no']);
                $this->db->set('product_seq', $seq);
                $this->db->set('img_type', $row['img_type']);
                $this->db->set('img_url', $row['img_url']);
                $this->db->set('is_main', $row['is_main']);
                $this->db->set('order_no', $row['order_no']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['admin_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_domestic_prodimg');
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

    public function delete_nbproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_product');

        $this->db->reset_query();
        $sql = "update tb_domestic_prodimg
                set
                    is_delete = 'y'
                    , updated_by = ?
                    , updated_at = now()
                where
                    product_seq = ?
                    and img_type = 'NB_%' ";
        $this->db->query($sql, array($req['admin_id'], $req['seq']));

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function insert_oemproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('biz_no', $req['biz_no']);
        $this->db->set('company_name', $req['company_name']);
        $this->db->set('category', $req['category']);
        $this->db->set('category_etc', $req['category_etc']);
        $this->db->set('main_group', $req['main_group']);
        $this->db->set('main_oem', $req['main_oem']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('tags', $req['tags']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('supply_price', preg_replace('/[^0-9]*/s', '', $req['supply_price']));
        $this->db->set('moq', preg_replace('/[^0-9]*/s', '', $req['moq']));
        $this->db->set('delivery_day', preg_replace('/[^0-9]*/s', '', $req['delivery_day']));
        $this->db->set('product_type', $req['product_type']);
        $this->db->set('weight', $req['weight']);
        $this->db->set('unit', $req['unit']);
        $this->db->set('storage', $req['storage']);
        $this->db->set('expire_day', $req['expire_day']);
        $this->db->set('qty', $req['qty']);
        $this->db->set('qty_unit', $req['qty_unit']);
        $this->db->set('container_type', $req['container_type']);
        $this->db->set('channel_status', $req['channel_status']);
        $this->db->set('is_main', $req['is_main']);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['admin_id']);
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_domestic_oem');

        $seq =  $this->db->insert_id();
        if(!empty($req['imgs'])) {
            foreach($req['imgs'] as $row) {
                $this->db->reset_query();
                $this->db->set('biz_no', $req['biz_no']);
                $this->db->set('product_seq', $seq);
                $this->db->set('img_type', $row['img_type']);
                $this->db->set('img_url', $row['img_url']);
                $this->db->set('is_main', $row['is_main']);
                $this->db->set('order_no', $row['order_no']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['admin_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_domestic_prodimg');
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

    public function update_oemproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('category', $req['category']);
        $this->db->set('category_etc', $req['category_etc']);
        $this->db->set('main_group', $req['main_group']);
        $this->db->set('main_oem', $req['main_oem']);
        $this->db->set('product_name', $req['product_name']);
        $this->db->set('tags', $req['tags']);
        $this->db->set('summary', $req['summary']);
        $this->db->set('supply_price', preg_replace('/[^0-9]*/s', '', $req['supply_price']));
        $this->db->set('moq', preg_replace('/[^0-9]*/s', '', $req['moq']));
        $this->db->set('delivery_day', preg_replace('/[^0-9]*/s', '', $req['delivery_day']));
        $this->db->set('product_type', $req['product_type']);
        $this->db->set('weight', $req['weight']);
        $this->db->set('unit', $req['unit']);
        $this->db->set('storage', $req['storage']);
        $this->db->set('expire_day', $req['expire_day']);
        $this->db->set('qty', $req['qty']);
        $this->db->set('qty_unit', $req['qty_unit']);
        $this->db->set('container_type', $req['container_type']);
        $this->db->set('channel_status', $req['channel_status']);
        $this->db->set('is_main', $req['is_main']);
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_oem');

        $seq =  $req['seq'];

        for($i = 1; $i <= 5; $i++) {

        }

        for($i = 1; $i <= 5; $i++) {
            if(!empty($req['prod_img' . $i . '_seq']) && empty($req['prod_img' . $i])) {
                $this->db->reset_query();
                $this->db->set('is_delete', 'y');
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->where('seq', $req['prod_img' . $i]);
                $this->db->update('tb_domestic_prodimg');
            }

            if(!empty($req['label_img' . $i . '_seq']) && empty($req['label_img' . $i])) {
                $this->db->reset_query();
                $this->db->set('is_delete', 'y');
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->where('seq', $req['label_img' . $i]);
                $this->db->update('tb_domestic_product');
            }
        }

        if(!empty($req['imgs'])) {
            foreach($req['imgs'] as $row) {
                $this->db->reset_query();
                $this->db->set('biz_no', $req['biz_no']);
                $this->db->set('product_seq', $seq);
                $this->db->set('img_type', $row['img_type']);
                $this->db->set('img_url', $row['img_url']);
                $this->db->set('is_main', $row['is_main']);
                $this->db->set('order_no', $row['order_no']);
                $this->db->set('is_delete', 'n');
                $this->db->set('created_by', $req['admin_id']);
                $this->db->set('created_at', 'now()', false);
                $this->db->set('updated_by', $req['admin_id']);
                $this->db->set('updated_at', 'now()', false);
                $this->db->insert('tb_domestic_prodimg');
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

    public function delete_oemproduct($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['admin_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('seq', $req['seq']);
        $this->db->update('tb_domestic_oem');

        $this->db->reset_query();
        $sql = "update tb_domestic_prodimg
                set
                    is_delete = 'y'
                    , updated_by = ?
                    , updated_at = now()
                where
                    product_seq = ?
                    and img_type = 'OEM_%' ";
        $this->db->query($sql, array($req['admin_id'], $req['seq']));

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }       

    public function insert_companym_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_companym
                (
                    `biz_no`,
                    `company_name`,
                    `company_name_eng`, 
                    `logo_img`,
                    `summary`,
                    `tags`,
                    `ceo_name`,
                    `industrial_code`,
                    `incorporation_at`,
                    `addr`,
                    `homepage`,
                    `company_tel`,
                    `introduce_file`,
                    `category`,
                    `category_etc`,
                    `main_group`,
                    `main_product`,
                    `main_client`,
                    `main_oem`,
                    `production_day`,
                    `unit_day`,
                    `production_month`,
                    `unit_month`,
                    `production_year`,
                    `unit_year`,
                    `capa`,
                    `capa_at`,
                    `facilities_info`,
                    `packaging_machine`,
                    `etc_machine`,
                    `detection_machine`,
                    `certi`,
                    `is_fda`,
                    `distribution_channel`,
                    `export_nation`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['company_name_eng'] . "' , 
                            '" . $row['logo_img'] . "' , 
                            '" . $row['summary'] . "' , 
                            '" . $row['tags'] . "' , 
                            '" . $row['ceo_name'] . "' , 
                            '" . $row['industrial_code'] . "' , 
                            '" . $row['incorporation_at'] . "' , 
                            '" . $row['addr'] . "' , 
                            '" . $row['homepage'] . "' , 
                            '" . $row['company_tel'] . "' , 
                            '" . $row['introduce_file'] . "' , 
                            '" . $row['category'] . "' , 
                            '" . $row['category_etc'] . "' , 
                            '" . $row['main_group'] . "' , 
                            '" . $row['main_product'] . "' , 
                            '" . $row['main_client'] . "' , 
                            '" . $row['main_oem'] . "' , 
                            '" . $row['production_day'] . "' , 
                            '" . $row['unit_day'] . "' , 
                            '" . $row['production_month'] . "' , 
                            '" . $row['unit_month'] . "' , 
                            '" . $row['production_year'] . "' , 
                            '" . $row['unit_year'] . "' , 
                            '" . $row['capa'] . "' , 
                            '" . $row['capa_at'] . "' , 
                            '" . $row['facilities_info'] . "' , 
                            '" . $row['packaging_machine'] . "' , 
                            '" . $row['etc_machine'] . "' , 
                            '" . $row['detection_machine'] . "' , 
                            '" . $row['certi'] . "' , 
                            '" . $row['is_fda'] . "' , 
                            '" . $row['distribution_channel'] . "' , 
                            '" . $row['export_nation'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        company_name = VALUES(company_name),
                        company_name_eng = VALUES(company_name_eng),
                        logo_img = VALUES(logo_img),
                        summary = VALUES(summary),
                        tags = VALUES(tags),
                        ceo_name = VALUES(ceo_name),
                        industrial_code = VALUES(industrial_code),
                        incorporation_at = VALUES(incorporation_at),
                        addr = VALUES(addr),
                        homepage = VALUES(homepage),
                        company_tel = VALUES(company_tel),
                        introduce_file = VALUES(introduce_file),
                        category = VALUES(category),
                        category_etc = VALUES(category_etc),
                        main_group = VALUES(main_group),
                        main_product = VALUES(main_product),
                        main_client = VALUES(main_client),
                        main_oem = VALUES(main_oem),
                        production_day = VALUES(production_day),
                        unit_day = VALUES(unit_day),
                        production_month = VALUES(production_month),
                        unit_month = VALUES(unit_month),
                        production_year = VALUES(production_year),
                        unit_year = VALUES(unit_year),
                        capa = VALUES(capa),
                        capa_at = VALUES(capa_at),
                        facilities_info = VALUES(facilities_info),
                        packaging_machine = VALUES(packaging_machine),
                        etc_machine = VALUES(etc_machine),
                        detection_machine = VALUES(detection_machine),
                        certi = VALUES(certi),
                        is_fda = VALUES(is_fda),
                        distribution_channel = VALUES(distribution_channel),
                        export_nation = VALUES(export_nation),
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

    public function insert_companyd_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_companyd
                (
                    `biz_no`,
                    `company_name`,
                    `industrial_code`,
                    `main_product`,
                    `distribution_type`,
                    `sales_year`,
                    `sales_at`,
                    `credit_rating`,
                    `rating_at`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['industrial_code'] . "' , 
                            '" . $row['main_product'] . "' , 
                            '" . $row['distribution_type'] . "' , 
                            '" . $row['sales_year'] . "' , 
                            '" . $row['sales_at'] . "' , 
                            '" . $row['credit_rating'] . "' , 
                            '" . $row['rating_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        company_name = VALUES(company_name),
                        industrial_code = VALUES(industrial_code),
                        main_product = VALUES(main_product),
                        distribution_type = VALUES(distribution_type),
                        sales_year = VALUES(sales_year),
                        sales_at = VALUES(sales_at),
                        credit_rating = VALUES(credit_rating),
                        rating_at = VALUES(rating_at),
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

    public function insert_nbproduct_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_product
                (
                    `seq`,
                    `biz_no`,
                    `company_name`,
                    `category`,
                    `category_etc`,
                    `main_group`,
                    `product_name`,
                    `summary`,
                    `tags`,
                    `supply_price`,
                    `moq`,
                    `delivery_day`,
                    `product_type`,
                    `weight`,
                    `unit`,
                    `storage`,
                    `expire_day`,
                    `qty`,
                    `qty_unit`,
                    `container_type`,
                    `channel_status`,
                    `is_main`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                if(empty($row['product_name'])) continue;

                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['biz_no'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['category'] . "' , 
                            '" . $row['category_etc'] . "' , 
                            '" . $row['main_group'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['summary'] . "' , 
                            '" . $row['tags'] . "' , 
                            '" . $row['supply_price'] . "' , 
                            '" . $row['moq'] . "' , 
                            '" . $row['delivery_day'] . "' , 
                            '" . $row['product_type'] . "' , 
                            '" . $row['weight'] . "' , 
                            '" . $row['unit'] . "' , 
                            '" . $row['storage'] . "' , 
                            '" . $row['expire_day'] . "' , 
                            '" . $row['qty'] . "' , 
                            '" . $row['qty_unit'] . "' , 
                            '" . $row['container_type'] . "' , 
                            '" . $row['channel_status'] . "' , 
                            '" . $row['is_main'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        company_name = VALUES(company_name),
                        category = VALUES(category),
                        category_etc = VALUES(category_etc),
                        tags = VALUES(tags),
                        main_group = VALUES(main_group),
                        product_name = VALUES(product_name),
                        summary = VALUES(summary),
                        supply_price = VALUES(supply_price),
                        moq = VALUES(moq),
                        delivery_day = VALUES(delivery_day),
                        product_type = VALUES(product_type),
                        weight = VALUES(weight),
                        unit = VALUES(unit),
                        storage = VALUES(storage),
                        expire_day = VALUES(expire_day),
                        qty = VALUES(qty),
                        qty_unit = VALUES(qty_unit),
                        container_type = VALUES(container_type),
                        channel_status = VALUES(channel_status),
                        is_main = VALUES(is_main),
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
    
    public function insert_oemproduct_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_oem
                (
                    `seq`,
                    `biz_no`,
                    `company_name`,
                    `category`,
                    `category_etc`,
                    `main_group`,
                    `main_oem`,
                    `product_name`,
                    `summary`,
                    `tags`,
                    `supply_price`,
                    `moq`,
                    `delivery_day`,
                    `product_type`,
                    `weight`,
                    `unit`,
                    `storage`,
                    `expire_day`,
                    `qty`,
                    `qty_unit`,
                    `container_type`,
                    `channel_status`,
                    `is_main`,
                    `is_delete`,
                    `created_by`,
                    `created_at`,
                    `updated_by`,
                    `updated_at`
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                if(empty($row['product_name'])) continue;
                
                $vals[] = "(
                            '" . $row['seq'] . "' , 
                            '" . $row['biz_no'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['category'] . "' , 
                            '" . $row['category_etc'] . "' , 
                            '" . $row['main_group'] . "' , 
                            '" . $row['main_oem'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['summary'] . "' , 
                            '" . $row['tags'] . "' , 
                            '" . $row['supply_price'] . "' , 
                            '" . $row['moq'] . "' , 
                            '" . $row['delivery_day'] . "' , 
                            '" . $row['product_type'] . "' , 
                            '" . $row['weight'] . "' , 
                            '" . $row['unit'] . "' , 
                            '" . $row['storage'] . "' , 
                            '" . $row['expire_day'] . "' , 
                            '" . $row['qty'] . "' , 
                            '" . $row['qty_unit'] . "' , 
                            '" . $row['container_type'] . "' , 
                            '" . $row['channel_status'] . "' , 
                            '" . $row['is_main'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        company_name = VALUES(company_name),
                        category = VALUES(category),
                        category_etc = VALUES(category_etc),
                        tags = VALUES(tags),
                        main_group = VALUES(main_group),
                        main_oem = VALUES(main_oem),
                        product_name = VALUES(product_name),
                        summary = VALUES(summary),
                        supply_price = VALUES(supply_price),
                        moq = VALUES(moq),
                        delivery_day = VALUES(delivery_day),
                        product_type = VALUES(product_type),
                        weight = VALUES(weight),
                        unit = VALUES(unit),
                        storage = VALUES(storage),
                        expire_day = VALUES(expire_day),
                        qty = VALUES(qty),
                        qty_unit = VALUES(qty_unit),
                        container_type = VALUES(container_type),
                        channel_status = VALUES(channel_status),
                        is_main = VALUES(is_main),
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

    public function insert_finance_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_finance
                (
                    `biz_no`,
                    `base_year`,
                    `sales_year`,
                    `biz_profits`,
                    `current_profits`,
                    `credit_rating`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['base_year'] . "' , 
                            '" . $row['sales_year'] . "' , 
                            '" . $row['biz_profits'] . "' , 
                            '" . $row['current_profits'] . "' , 
                            '" . $row['credit_rating'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        sales_year = VALUES(sales_year),
                        biz_profits = VALUES(biz_profits),
                        current_profits = VALUES(current_profits),
                        credit_rating = VALUES(credit_rating),
                        is_delete = 'n' , 
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() ";
            $this->db->query($sql);

        foreach($req as $row) {
            $this->db->reset_query();
            $this->db->set('biz_no', $row['biz_no']);
            $this->db->set('base_year', $row['base_year']);
            $this->db->set('sales_year', $row['sales_year']);
            $this->db->set('biz_profits', $row['biz_profits']);
            $this->db->set('current_profits', $row['current_profits']);
            $this->db->set('credit_rating', $row['credit_rating']);
            $this->db->set('created_by', $row['admin_id']);
            $this->db->set('created_at', 'now()', false);
            $this->db->insert('tb_domestic_finance_history');
        }
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }       
    
    public function insert_facilities_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_facilities
                (
                    `seq`,
                    `biz_no`,
                    `img_url`,
                    `img_desc`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['img_url'] . "' , 
                            '" . $row['img_desc'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        img_url = VALUES(img_url),
                        img_desc = VALUES(img_desc),
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
    
    public function insert_cert_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_cert
                (
                    `seq`,
                    `biz_no`,
                    `cert_name`,
                    `cert_img`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['cert_name'] . "' , 
                            '" . $row['cert_img'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        cert_name = VALUES(cert_name),
                        cert_img = VALUES(cert_img),
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

    public function insert_patent_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_patent
                (
                    `seq`,
                    `biz_no`,
                    `patent_name`,
                    `patent_name_eng`,
                    `patent_img`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['patent_name'] . "' , 
                            '" . $row['patent_name_eng'] . "' , 
                            '" . $row['patent_img'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        patent_name = VALUES(patent_name),
                        patent_name_eng = VALUES(patent_name_eng),
                        patent_img = VALUES(patent_img),
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
    
    public function insert_image_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_domestic_prodimg
                (
                    `seq`,
                    `biz_no`,
                    `product_seq`,
                    `img_type`,
                    `img_url`,
                    `is_main`,
                    `order_no`,
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
                            '" . $row['biz_no'] . "' , 
                            '" . $row['product_seq'] . "' , 
                            '" . $row['img_type'] . "' , 
                            '" . $row['img_url'] . "' , 
                            '" . $row['is_main'] . "' , 
                            '" . $row['order_no'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode(',', $vals);
            $sql .= " ON DUPLICATE KEY UPDATE 
                        biz_no = VALUES(biz_no),
                        product_seq = VALUES(product_seq),
                        img_type = VALUES(img_type),
                        img_url = VALUES(img_url),
                        is_main = VALUES(is_main),
                        order_no = VALUES(order_no),
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