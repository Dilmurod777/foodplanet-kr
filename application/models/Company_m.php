<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function company_list_for_home() {
        $sql = "select
                    t1.member_id
                    , t1.member_cd
                    , ifnull((select a.new_filepath from tb_file a where a.parent_gbn = 'logo' and a.parent_cd = t1.member_cd and a.is_delete = 'n'), '') as logo_img
                    , ifnull((select a.org_filename from tb_file a where a.parent_gbn = 'logo' and a.parent_cd = t1.member_cd and a.is_delete = 'n'), '') as logo_img_name
                    , t1.company_name
                    , t1.homepage
                    , ifnull(t1.summary, '') as summary
                from
                    tb_member t1
                order by RAND()
                limit 0, 10 ";
        
        return $this->db->query($sql, array());
    }

    public function company_list($req, $offset, $perpage) {
        $sql = "select
                    TB1.*
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, TB1.main_product_cd)) as main_product_name
                from
                (
                    select
                        t1.member_cd
                        , t1.biz_no
                        , t1.company_name
                        , t1.summary
                        , case when t2.main_product_cd is not null and t2.main_product_cd != '' then t2.main_product_cd
                                when t3.main_product_cd is not null and t3.main_product_cd != '' then t3.main_product_cd
                                else '' end as main_product_cd
                        , case when t1.year_sales is not null and t1.year_sales != '' then t1.year_sales
                                when t4.year_sales is not null and t4.year_sales != '' then t4.year_sales
                                else '미등록' end as year_sales
                        , case when t1.credit_rating is not null and t1.credit_rating != '' then t1.credit_rating
                                when t4.credit_rating is not null and t4.credit_rating != '' then t4.credit_rating
                                else '미등록' end as credit_rating
                        , case when t5.manufacture_year is not null and t5.manufacture_year != '' then t5.manufacture_year
                                when t6.manufacture_year is not null and t6.manufacture_year != '' then t6.manufacture_year
                                else '미등록' end as manufacture_year
                        , t1.hit_cnt
                        , case when t7.export_nation is not null and t7.export_nation != '' then t7.export_nation
                                when t8.export_nation is not null and t8.export_nation != '' then t8.export_nation
                                else '미등록' end as export_nation
                    from
                        tb_member t1
                    left outer join tb_product_own t2 on t2.member_cd = t1.member_cd
                    left outer join tb_manufacture t5 on t5.member_cd = t1.member_cd
                    left outer join tb_distribution t7 on t7.member_cd = t1.member_cd
                    left outer join tb_admin_bi03 t3 on t3.biz_no = t1.biz_no
                    left outer join tb_admin_bi02 t4 on t4.biz_no = t1.biz_no
                    left outer join tb_admin_bi05 t6 on t6.biz_no = t1.biz_no
                    left outer join tb_admin_bi07 t8 on t8.biz_no = t1.biz_no
                    where
                        t1.member_type = '1'
                    union
                    select
                        ifnull(t2.member_cd, '') as member_cd
                        , t1.biz_no
                        , case when t2.company_name is not null and t2.company_name != '' then t2.company_name
                                else t1.company_name end as company_name
                        , case when t2.summary is not null and t2.summary != '' then t2.summary
                                else '' end as summary
                        , case when t3.main_product_cd is not null and t3.main_product_cd != '' then t3.main_product_cd
                                when t4.main_product_cd is not null and t4.main_product_cd != '' then t4.main_product_cd
                                else '' end as main_product_cd
                        , case when t2.year_sales is not null and t2.year_sales != '' then t2.year_sales
                                when t5.year_sales is not null and t5.year_sales != '' then t5.year_sales
                                else '미등록' end as year_sales
                        , case when t2.credit_rating is not null and t2.credit_rating != '' then t2.credit_rating
                                when t5.credit_rating is not null and t5.credit_rating != '' then t5.credit_rating
                                else '미등록' end as credit_rating
                        , case when t6.manufacture_year is not null and t6.manufacture_year != '' then t6.manufacture_year
                                when t7.manufacture_year is not null and t7.manufacture_year != '' then t7.manufacture_year
                                else '미등록' end as manufacture_year
                        , case when t2.member_cd is not null and t2.member_cd != '' then t2.hit_cnt
                                else t1.hit_cnt end as hit_cnt
                        , case when t8.export_nation is not null and t8.export_nation != '' then t8.export_nation
                                when t9.export_nation is not null and t9.export_nation != '' then t9.export_nation
                                else '미등록' end as export_nation
                    from
                        tb_admin_bi01 t1
                    left outer join tb_member t2 on t2.biz_no = t1.biz_no
                    left outer join tb_manufacture t6 on t6.member_cd = t2.member_cd
                    left outer join tb_product_own t3 on t3.member_cd = t2.member_cd
                    left outer join tb_distribution t8 on t8.member_cd = t2.member_cd
                    left outer join tb_admin_bi03 t4 on t4.biz_no = t1.biz_no
                    left outer join tb_admin_bi02 t5 on t5.biz_no = t1.biz_no
                    left outer join tb_admin_bi05 t7 on t7.biz_no = t1.biz_no
                    left outer join tb_admin_bi07 t9 on t9.biz_no = t1.biz_no
                ) TB1
                WHERE
                    1=1 ";
        if(!empty($req['category'])) {
            $where = array();
            foreach($req['category'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.main_product_cd)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['company'])) {
            $where = array();
            foreach($req['company'] as $row) {
//                $where[] = "FIND_IN_SET(TB1., '" . $row . "')";
            }

            if(!empty($where)) {
//                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['sales'])) {
            $sql  .= " and TB1.year_sales != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.year_sales >= 10000000 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.year_sales < 10000000 and TB1.year_sales >= 5000000 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.year_sales < 5000000 and TB1.year_sales >= 1000000 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.year_sales < 1000000 ";
            }
        }

        if(!empty($req['rating'])) {
            $sql  .= " and TB1.year_sales != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['sales'] === '5') {
                $sql .= " and TB1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['sales'] === '6') {
                $sql .= " and TB1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['sales'] === '7') {
                $sql .= " and TB1.credit_rating in ('C', 'D') " ;
            }
        }

        if(!empty($req['rating'])) {
            $sql  .= " and TB1.manufacture_year != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.manufacture_year >= 300000 " ;
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.manufacture_year < 300000 and TB1.manufacture_year >= 100000 " ;
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.manufacture_year < 100000 and TB1.manufacture_year >= 50000 " ;
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.manufacture_year < 50000 and TB1.manufacture_year >= 30000 " ;
            }
            else if($req['sales'] === '5') {
                $sql .= " and TB1.manufacture_year < 30000 and TB1.manufacture_year >= 10000 " ;
            }
            else if($req['sales'] === '6') {
                $sql .= " and TB1.manufacture_year < 10000 and TB1.manufacture_year >= 5000 " ;
            }
            else if($req['sales'] === '7') {
                $sql .= " and TB1.manufacture_year < 5000 " ;
            }
        }

        if(!empty($req['keyword'])) {
            $sql .= " and TB1.company_name like '%" . $req['keyword'] . "%' ";
        }

        $sql .= " order by TB1.hit_cnt desc, TB1.company_name
                limit ?, ? ";
        
        return $this->db->query($sql, array($offset, $perpage));
    }


    public function company_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                (
                    select
                        t1.member_cd
                        , t1.biz_no
                        , t1.company_name
                        , case when t2.main_product_cd is not null and t2.main_product_cd != '' then t2.main_product_cd
                                when t3.main_product_cd is not null and t3.main_product_cd != '' then t3.main_product_cd
                                else '' end as main_product_cd
                        , case when t1.year_sales is not null and t1.year_sales != '' then t1.year_sales
                                when t4.year_sales is not null and t4.year_sales != '' then t4.year_sales
                                else '미등록' end as year_sales
                        , case when t1.credit_rating is not null and t1.credit_rating != '' then t1.credit_rating
                                when t4.credit_rating is not null and t4.credit_rating != '' then t4.credit_rating
                                else '미등록' end as credit_rating
                        , case when t5.manufacture_year is not null and t5.manufacture_year != '' then t5.manufacture_year
                                when t6.manufacture_year is not null and t6.manufacture_year != '' then t6.manufacture_year
                                else '미등록' end as manufacture_year
                        , t1.hit_cnt
                    from
                        tb_member t1
                    left outer join tb_product_own t2 on t2.member_cd = t1.member_cd
                    left outer join tb_manufacture t5 on t5.member_cd = t1.member_cd
                    left outer join tb_admin_bi03 t3 on t3.biz_no = t1.biz_no
                    left outer join tb_admin_bi02 t4 on t4.biz_no = t1.biz_no
                    left outer join tb_admin_bi05 t6 on t6.biz_no = t1.biz_no
                    where
                        t1.member_type = '1'
                    union
                    select
                        ifnull(t2.member_cd, '') as member_cd
                        , t1.biz_no
                        , case when t2.company_name is not null and t2.company_name != '' then t2.company_name
                                else t1.company_name end as company_name
                        , case when t3.main_product_cd is not null and t3.main_product_cd != '' then t3.main_product_cd
                                when t4.main_product_cd is not null and t4.main_product_cd != '' then t4.main_product_cd
                                else '' end as main_product_cd
                        , case when t2.year_sales is not null and t2.year_sales != '' then t2.year_sales
                                when t5.year_sales is not null and t5.year_sales != '' then t5.year_sales
                                else '미등록' end as year_sales
                        , case when t2.credit_rating is not null and t2.credit_rating != '' then t2.credit_rating
                                when t5.credit_rating is not null and t5.credit_rating != '' then t5.credit_rating
                                else '미등록' end as credit_rating
                        , case when t6.manufacture_year is not null and t6.manufacture_year != '' then t6.manufacture_year
                                when t7.manufacture_year is not null and t7.manufacture_year != '' then t7.manufacture_year
                                else '미등록' end as manufacture_year
                        , case when t2.member_cd is not null and t2.member_cd != '' then t2.hit_cnt
                                else t1.hit_cnt end as hit_cnt
                    from
                        tb_admin_bi01 t1
                    left outer join tb_member t2 on t2.biz_no = t1.biz_no
                    left outer join tb_manufacture t6 on t6.member_cd = t2.member_cd
                    left outer join tb_product_own t3 on t3.member_cd = t2.member_cd
                    left outer join tb_admin_bi03 t4 on t4.biz_no = t1.biz_no
                    left outer join tb_admin_bi02 t5 on t5.biz_no = t1.biz_no
                    left outer join tb_admin_bi05 t7 on t7.biz_no = t1.biz_no
                ) TB1
                WHERE
                    1=1 ";
        if(!empty($req['category'])) {
            $where = array();
            foreach($req['category'] as $row) {
                $where[] = "FIND_IN_SET('" . $row . "', TB1.main_product_cd)";
            }

            if(!empty($where)) {
                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['company'])) {
            $where = array();
            foreach($req['company'] as $row) {
//                $where[] = "FIND_IN_SET(TB1., '" . $row . "')";
            }

            if(!empty($where)) {
//                $sql .= " and ( " . implode(' or ', $where) . " ) ";
            }
        }

        if(!empty($req['sales'])) {
            $sql  .= " and TB1.year_sales != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.year_sales >= 10000000 ";
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.year_sales < 10000000 and TB1.year_sales >= 5000000 ";
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.year_sales < 5000000 and TB1.year_sales >= 1000000 ";
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.year_sales < 1000000 ";
            }
        }

        if(!empty($req['rating'])) {
            $sql  .= " and TB1.year_sales != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.credit_rating in ('A', 'A+', 'A-', 'AA', 'AA+', 'AA-', 'AAA') " ;
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.credit_rating in ('BBB', 'BBB+', 'BBB-') " ;
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.credit_rating in ('BB', 'BB+', 'BB-') " ;
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.credit_rating in ('B', 'B+', 'B-') " ;
            }
            else if($req['sales'] === '5') {
                $sql .= " and TB1.credit_rating in ('CCC', 'CCC+', 'CCC-') " ;
            }
            else if($req['sales'] === '6') {
                $sql .= " and TB1.credit_rating in ('CC', 'CC+', 'CC-') " ;
            }
            else if($req['sales'] === '7') {
                $sql .= " and TB1.credit_rating in ('C', 'D') " ;
            }
        }

        if(!empty($req['rating'])) {
            $sql  .= " and TB1.manufacture_year != '미등록' ";
            if($req['sales'] === '1') {
                $sql .= " and TB1.manufacture_year >= 300000 " ;
            }
            else if($req['sales'] === '2') {
                $sql .= " and TB1.manufacture_year < 300000 and TB1.manufacture_year >= 100000 " ;
            }
            else if($req['sales'] === '3') {
                $sql .= " and TB1.manufacture_year < 100000 and TB1.manufacture_year >= 50000 " ;
            }
            else if($req['sales'] === '4') {
                $sql .= " and TB1.manufacture_year < 50000 and TB1.manufacture_year >= 30000 " ;
            }
            else if($req['sales'] === '5') {
                $sql .= " and TB1.manufacture_year < 30000 and TB1.manufacture_year >= 10000 " ;
            }
            else if($req['sales'] === '6') {
                $sql .= " and TB1.manufacture_year < 10000 and TB1.manufacture_year >= 5000 " ;
            }
            else if($req['sales'] === '7') {
                $sql .= " and TB1.manufacture_year < 5000 " ;
            }
        }

        if(!empty($req['keyword'])) {
            $sql .= " and TB1.company_name like '%" . $req['keyword'] . "%' ";
        }
        
        $tmp = $this->db->query($sql, array())->row_array();
        return $tmp['cnt'];
    }
    
    
    public function admin_company_by_bizno($biz_no) {
        $sql = "select
                    t1.biz_no
                    , t1.company_name
                    , t1.owner_name
                    , t1.company_tel
                    , t1.company_email
                    , t1.homepage
                    , t1.incorporation_at
                    , t1.industrial_code

                    , if(t2.employee_name is not null, FN_DECRYPT(t2.employee_name), '')  as employee_name
                    , if(t2.employee_tel is not  null, FN_DECRYPT(t2.employee_tel), '')  as employee_tel

                    , if(t3.biz_profit is not null, t3.biz_profit, '') as biz_profit
                    , if(t3.net_profit is not null, t3.net_profit, '') as net_profit

                    , t1.hit_cnt
                from
                    tb_admin_bi01 t1
                left outer join tb_admin_bi011 t2 on t2.biz_no = t1.biz_no and t2.is_delete = 'n'
                left outer join tb_admin_bi02 t3 on t3.biz_no = t1.biz_no and t3.is_delete = 'n'
                where
                    t1.biz_no = ? 
                    and t1.is_delete = 'n' ";
        return $this->db->query($sql, array($biz_no));
    }

    public function company_info_by_admin($biz_no) {
        $sql = "select
                    t1.biz_no
                    , t1.company_name
                    , '' as member_cd
                    , '' as company_name_eng
                    , '' as summary
                    , '' as tags
                    , '' as introduce_file
                    , '' as introduce_file_name
                    , '' as introduce_file_updated_at
                    , '' as staff_number
                    , '' as staff_updated_at
                    , '' as logo_img
                    , '' as facilities_scale

                    , '' as model_lines
                    , '' as pack_bandsealer
                    , '' as pack_container
                    , '' as pack_rotary
                    , '' as pack_pouch
                    , '' as pack_rollfilm
                    , '' as freeze_machine
                    , '' as etc_machine
                    , '' as detector_xray
                    , '' as detector_metal

                    , t7.channel_name as channel_info
                    , '' as competitive_product
                    , t8.export_nation as export_nation
                    , t7.nb_export_nation as own_nation
                    , t7.oem_export_nation as oem_nation
                    , '' as export_progress

                    , case when t5.cert = 'HACCP' then t5.cert
                            else '' end as haccp
                    , case when t5.cert is not null and t5.cert != '' and t5.cert != 'HACCP' then t5.cert
                            else '' end as etc_cert1_name
                    , case when t5.patent is not null and t5.patent != '' then t5.patent
                            else '' end as patent_cnt
                    , '' as etc_cert2_name
                    , '' as etc_cert3_name
                    
                    , '' as own_product
                    , '' as channel_online
                    , '' as channel_offline
                    , t4.nb_product_delivery as delivery_day
                    , t4.nb_product_moq as order_moq
                    , '' as nb_product
                    , t4.nb_product_price as supply_price
                    , t4.nb_product_type as type_cnt
                    , '' as expire_day
                    , (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t4.main_product_cd)) as main_product_name
                    , t4.main_product_etc

                    , '' as oem_channel_online 
                    , '' as oem_channel_offline
                    , t4.oem_product_delivery as oem_delivery_day
                    , t4.oem_product_moq as oem_order_moq
                    , t4.oem_product_price as oem_supply_price
                    , '' as oem_type_a
                    , '' as oem_type_b
                    , '' as oem_type_c
                    , t4.oem_material_price as oem_sub_price
                    , t4.oem_material_leadtime as oem_sub_lead_time
                    , t4.oem_material_moq as oem_sub_moq
                      
                      
                    , ifnull(t1.owner_name, '') as owner_name
                    , ifnull(t1.company_tel, '') as company_tel
                    , ifnull(t1.company_email, '') as company_email
                    , ifnull(t1.homepage, '') as homepage
                    , if(t1.incorporation_at is not null and t1.incorporation_at != '', date_format(t1.incorporation_at, '%Y.%m.%d'), '') as incorporation_at
                    , if(t1.incorporation_at is not null and t1.incorporation_at != '', TIMESTAMPDIFF(YEAR, date_format(t1.incorporation_at, '%Y-%m-%d'), date_format(now(), '%Y-%m-%d')), '') as incorporation_year
                    , ifnull(t1.industrial_code, '') as industrial_code
                    , ifnull(t1.zonecode, '') as zonecode
                    , ifnull(t1.addr, '') as addr

                    , if(t2.employee_name is not null, FN_DECRYPT(t2.employee_name), '')  as employee_name
                    , if(t2.employee_tel is not  null, FN_DECRYPT(t2.employee_tel), '')  as employee_tel

                    , if(t3.biz_profit is not null, t3.biz_profit, '') as biz_profit
                    , if(t3.net_profit is not null, t3.net_profit, '') as net_profit
                    , if(t3.year_sales is not null, t3.year_sales, '') as year_sales
                    , '' as sales_arrow
                    , if(t3.year_sales is not null, date_format(t3.updated_at, '%y'), '') as sales_updated_at
                    , if(t3.biz_profit is not null, t3.biz_profit, '') as biz_profit
                    , '' as biz_profit_arrow
                    , if(t3.biz_profit is not null, date_format(t3.updated_at, '%y'), '') as biz_profit_updated_at
                    , if(t3.net_profit is not null, t3.net_profit, '') as net_profit
                    , '' as net_profit_arrow
                    , if(t3.net_profit is not null, date_format(t3.updated_at, '%y'), '') as net_profit_updated_at

                    , t1.hit_cnt
                from
                    tb_admin_bi01 t1
                left outer join tb_admin_bi011 t2 on t2.biz_no = t1.biz_no and t2.is_delete = 'n'
                left outer join tb_admin_bi02 t3 on t3.biz_no = t1.biz_no and t3.is_delete = 'n'
                left outer join tb_admin_bi03 t4 on t4.biz_no = t1.biz_no and t4.is_delete = 'n'
                left outer join tb_admin_bi04 t5 on t5.biz_no = t1.biz_no and t5.is_delete = 'n'
                left outer join tb_admin_bi05 t6 on t6.biz_no = t1.biz_no and t6.is_delete = 'n'
                left outer join tb_admin_bi06 t7 on t7.biz_no = t1.biz_no and t7.is_delete = 'n'
                left outer join tb_admin_bi07 t8 on t8.biz_no = t1.biz_no and t8.is_delete = 'n'
                where
                    t1.biz_no = ? 
                    and t1.is_delete = 'n' ";
        return $this->db->query($sql, array($biz_no));
    }

    public function company_info_by_member($member_cd) {
        $sql = "select
                    t1.member_cd
                    , t1.biz_no
                    , t1.company_name
                    , t1.company_name_eng
                    , t1.summary
                    , t1.tags
                    , (select a.new_filepath from tb_file a where a.parent_gbn = 'introduce' and a.parent_cd = t1.member_cd and a.is_delete = 'n' order by created_at desc limit 1) as introduce_file
                    , (select a.org_filename from tb_file a where a.parent_gbn = 'introduce' and a.parent_cd = t1.member_cd and a.is_delete = 'n' order by created_at desc limit 1) as introduce_file_name
                    , (select date_format(a.created_at, '%Y.%m.%d') from tb_file a where a.parent_gbn = 'introduce' and a.parent_cd = t1.member_cd and a.is_delete = 'n' order by created_at desc limit 1) as introduce_file_updated_at
                    , t1.staff_number
                    , date_format(t1.updated_at, '%Y.%m.%d') as staff_updated_at
                    , (select a.new_filepath from tb_file a where a.parent_gbn = 'logo' and a.parent_cd = t1.member_cd and a.is_delete = 'n' order by created_at desc limit 1) as logo_img
                    , t1.facilities_scale

                    , ifnull(t9.model_lines, '') as model_lines
                    , ifnull(t9.pack_bandsealer, '') as pack_bandsealer
                    , ifnull(t9.pack_container, '') as pack_container
                    , ifnull(t9.pack_rotary, '') as pack_rotary
                    , ifnull(t9.pack_pouch, '') as pack_pouch
                    , ifnull(t9.pack_rollfilm, '') as pack_rollfilm
                    , ifnull(t9.freeze_machine, '') as freeze_machine
                    , ifnull(t9.etc_machine, '') as etc_machine
                    , ifnull(t9.detector_xray, '') as detector_xray
                    , ifnull(t9.detector_metal, '') as detector_metal

                    , case when t10.channel_info is not null and t10.channel_info != '' then t10.channel_info
                            when t7.channel_name is not null and t7.channel_name != '' then t7.channel_name
                            else '' end as channel_info
                    , ifnull(t10.competitive_product, '') as competitive_product
                    , case when t10.export_nation is not null and t10.export_nation != '' then t10.export_nation
                            when t8.export_nation is not null and t8.export_nation != '' then t8.export_nation
                            else '' end as export_nation
                    , case when t10.own_nation is not null and t10.own_nation != '' then t10.own_nation
                            when t7.nb_export_nation is not null and t7.nb_export_nation != '' then t7.nb_export_nation
                            else '' end as own_nation
                    , case when t10.oem_nation is not null and t10.oem_nation != '' then t10.oem_nation
                            when t7.oem_export_nation is not null and t7.oem_export_nation != '' then t7.oem_export_nation 
                            else '' end as oem_nation
                    , ifnull(t10.export_progress, '') as export_progress

                    , case when t11.haccp is not null and t11.haccp != '' then t11.haccp
                            when t5.cert = 'HACCP' then t5.cert
                            else '' end as haccp
                    , case when t11.etc_cert1_cd is not null and t11.etc_cert1_cd != '' then FN_GETCODENAME('etc_cert', t11.etc_cert1_cd)
                            when t5.cert is not null and t5.cert != '' and t5.cert != 'HACCP' then t5.cert
                            else '' end as etc_cert1_name
                    , case when t11.etc_cert2_cd is not null and t11.etc_cert2_cd != '' then FN_GETCODENAME('etc_cert', t11.etc_cert2_cd)
                            else '' end as etc_cert2_name
                    , case when t11.etc_cert3_cd is not null and t11.etc_cert3_cd != '' then FN_GETCODENAME('etc_cert', t11.etc_cert3_cd)
                            else '' end as etc_cert3_name
                    , case when t11.patent_cnt is not null and t11.patent_cnt != '' then t11.patent_cnt
                            when t5.patent is not null and t5.patent != '' then t5.patent
                            else '' end as patent_cnt
                    
                    , ifnull(t12.own_product, '') as own_product
                    , ifnull(t12.channel_online, '') as channel_online
                    , ifnull(t12.channel_offline, '') as channel_offline
                    , case when t12.delivery_day is not null and t12.delivery_day != '' then t12.delivery_day
                            when t4.nb_product_delivery is not null and t4.nb_product_delivery != '' then t4.nb_product_delivery
                            else '' end as delivery_day
                    ,case when t12.order_moq is not null  and t12.order_moq != '' then t12.order_moq
                            when t4.nb_product_moq is not null and t4.nb_product_moq != '' then t4.nb_product_moq
                            else '' end as order_moq
                    , ifnull(t12.nb_product, '') as nb_product
                    , case when t12.supply_price is not null and t12.supply_price != '' then t12.supply_price
                            when t4.nb_product_price is not null and t4.nb_product_price != '' then t4.nb_product_price
                            else '' end as supply_price
                    , case when t12.type_cnt is not null and t12.type_cnt != '' then t12.type_cnt
                            when t4.nb_product_type is not null and t4.nb_product_type != '' then t4.nb_product_type
                            else '' end as type_cnt
                    , ifnull(t12.expire_day, '') as expire_day
                    , case when t12.main_product_cd is not null and t12.main_product_cd != '' then (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t12.main_product_cd)) 
                            when t4.main_product_cd is not null and t4.main_product_cd != '' then (SELECT group_concat(a.code_name) FROM tb_code a WHERE a.main_code = 'food_category' and FIND_IN_SET(a.sub_code, t4.main_product_cd)) 
                            else '' end as main_product_name
                    , case when t12.main_product_etc is not null and t12.main_product_etc != '' then t12.main_product_etc
                            when t4.main_product_etc is not null and t4.main_product_etc != '' then t4.main_product_etc
                            else '' end as main_product_etc

                    , ifnull(t13.channel_online, '') as oem_channel_online 
                    , ifnull(t13.channel_offline, '') as oem_channel_offline
                    , case when t13.delivery_day is not null and t13.delivery_day != '' then t13.delivery_day
                            when t4.oem_product_delivery is not null and t4.oem_product_delivery != '' then t4.oem_product_delivery
                            else '' end as oem_delivery_day
                    , case when t13.order_moq is not null and t13.order_moq != '' then t13.order_moq
                            when t4.oem_product_moq is not null and t4.oem_product_moq != '' then t4.oem_product_moq
                            else '' end as oem_order_moq
                    , case when t13.supply_price is not null and t13.supply_price != '' then t13.supply_price
                            when t4.oem_product_price is not null and t4.oem_product_price != '' then t4.oem_product_price
                            else '' end as oem_supply_price
                    , ifnull(t13.type_a, '') as oem_type_a
                    , ifnull(t13.type_b, '') as oem_type_b
                    , ifnull(t13.type_c, '') as oem_type_c
                    , case when t13.sub_price is not null and t13.sub_price != '' then t13.sub_price
                            when t4.oem_material_price is not null and t4.oem_material_price != '' then t4.oem_material_price
                            else '' end as oem_sub_price
                    , case when t13.sub_lead_time is not null and t13.sub_lead_time != '' then t13.sub_lead_time
                            when t4.oem_material_leadtime is not null and t4.oem_material_leadtime != '' then t4.oem_material_leadtime
                            else '' end as oem_sub_lead_time
                    , case when t13.sub_moq is not null and t13.sub_moq != '' then t13.sub_moq
                            when t4.oem_material_moq is not null and t4.oem_material_moq != '' then t4.oem_material_moq
                            else '' end as oem_sub_moq
                      
                      
                    , t1.owner_name
                    , t1.company_tel
                    , t1.company_email
                    , ifnull(t1.homepage, '') as homepage
                    , if(t1.incorporation_at is not null and t1.incorporation_at != '', date_format(t1.incorporation_at, '%Y.%m.%d'), '') as incorporation_at
                    , if(t1.incorporation_at is not null and t1.incorporation_at != '', TIMESTAMPDIFF(YEAR, date_format(t1.incorporation_at, '%Y-%m-%d'), date_format(now(), '%Y-%m-%d')), '') as incorporation_year
                    , ifnull(t1.industrial_code, '') as industrial_code
                    , ifnull(t1.zonecode, '') as zonecode
                    , concat(ifnull(t1.addr, ''), ' ' , ifnull(t1.addr_detail, '')) as addr

                    , if(t1.employee_name is not null, FN_DECRYPT(t1.employee_name), '')  as employee_name
                    , if(t1.employee_tel is not  null, FN_DECRYPT(t1.employee_tel), '')  as employee_tel

                    , case when t1.biz_profit is not null and t1.biz_profit != '' then t1.biz_profit
                            when t3.biz_profit is not null and t3.biz_profit != '' then t3.biz_profit
                            else '' end as biz_profit
                    , case when t1.net_profit is not null and t1.net_profit != '' then t1.net_profit
                            when t3.net_profit is not null and t3.net_profit != '' then t3.net_profit
                            else '' end as net_profit
                    , case when t1.year_sales is not null and t1.year_sales != '' then t1.year_sales
                            when t3.year_sales is not null and t3.year_sales != '' then t3.year_sales
                            else '' end as year_sales
                    , '' as sales_arrow
                    , '' as biz_profit_arrow
                    , '' as net_profit_arrow
                    , date_format(t1.updated_at, '%y') as sales_updated_at
                    , date_format(t1.updated_at, '%y') as biz_profit_updated_at
                    , date_format(t1.updated_at, '%y') as net_profit_updated_at

                    , t1.hit_cnt
                from
                    tb_member t1
                left outer join tb_admin_bi011 t2 on t2.biz_no = t1.biz_no and t2.is_delete = 'n'
                left outer join tb_admin_bi02 t3 on t3.biz_no = t1.biz_no and t3.is_delete = 'n'
                left outer join tb_admin_bi03 t4 on t4.biz_no = t1.biz_no and t4.is_delete = 'n'
                left outer join tb_admin_bi04 t5 on t5.biz_no = t1.biz_no and t5.is_delete = 'n'
                left outer join tb_admin_bi05 t6 on t6.biz_no = t1.biz_no and t6.is_delete = 'n'
                left outer join tb_admin_bi06 t7 on t7.biz_no = t1.biz_no and t7.is_delete = 'n'
                left outer join tb_admin_bi07 t8 on t8.biz_no = t1.biz_no and t8.is_delete = 'n'

                left outer join tb_facilities t9 on t9.member_cd = t1.member_cd 
                left outer join tb_distribution t10 on t10.member_cd = t1.member_cd
                left outer join tb_certify t11 on t11.member_cd = t1.member_cd
                left outer join tb_product_own t12 on t12.member_cd = t1.member_cd
                left outer join tb_product_oem t13 on t13.member_cd = t1.member_cd
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($member_cd));
    }

    public function company_manufacture_info($cd) {
        $sql = "select
                    t1.member_cd

                    , case when t2.manufacture_day is not null and t2.manufacture_day != '' then t2.manufacture_day
                            else '0' end as manufacture_day
                    , case when t2.manufacture_month is not null and t2.manufacture_month != '' then t2.manufacture_month
                            else '0' end as manufacture_month
                    , case when t2.manufacture_year is not null and t2.manufacture_year != '' then t2.manufacture_year
                            else '0' end as manufacture_year
                    , case when t2.load_cnt is not null and t2.load_cnt != '' then t2.load_cnt
                            else '0' end as load_cnt
                    , if(t2.updated_at is not null and t2.updated_at != '', date_format(t2.updated_at, '%Y.%m.%d'), '') as updated_at
                from
                    tb_member t1
                left outer join tb_manufacture t2 on t2.member_cd =  t1.member_cd
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($cd));
    }

    public function company_facilities_info($cd) {
        $sql = "select
                    t1.member_cd

                    , ifnull(t1.model_lines, '') as model_lines
                    , ifnull(t1.pack_bandsealer, '') as pack_bandsealer
                    , ifnull(t1.pack_container, '')  as pack_container
                    , ifnull(t1.pack_rotary, '')  as pack_rotary
                    , ifnull(t1.pack_pouch, '') as pack_pouch
                    , ifnull(t1.pack_rollfilm, '') as pack_rollfilm
                    , ifnull(t1.freeze_machine, '') as freeze_machine
                    , ifnull(t1.etc_machine, '')  as etc_machine
                    , ifnull(t1.detector_xray, '') as detector_xray
                    , ifnull(t1.detector_metal, '')  as detector_metal
                from
                    tb_facilities t1
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($cd));
    }

    public function company_facilities_detail($cd) {
        $sql = "select
                    t1.detail_seq

                    , ifnull(t1.facilities_name, '') as facilities_name
                    , ifnull(t1.facilities_img, '') as facilities_img
                    , ifnull(t1.facilities_img_name, '')  as facilities_img_name
                    , ifnull(t1.facilities_cnt, '')  as facilities_cnt
                    , ifnull(t1.facilities_summary, '') as facilities_summary
                from
                    tb_facilities_detail t1
                where
                    t1.is_delete = 'n'
                    and t1.member_cd = ? ";
        return $this->db->query($sql, array($cd));
    }

    public function company_cert_info($cd) {
        $sql = "select
                    t1.member_cd

                    , ifnull(t1.haccp, '') as haccp
                    , ifnull(t1.etc_cert1_cd, '') as etc_cert1_cd
                    , ifnull(t1.etc_cert2_cd, '')  as etc_cert2_cd
                    , ifnull(t1.etc_cert3_cd, '')  as etc_cert3_cd
                    , ifnull(t1.patent_cnt, '') as patent_cnt
                from
                    tb_certify t1
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($cd));
    }

    public function company_cert_detail($cd, $type) {
        $sql = "select
                    t1.detail_seq
                    , t1.cert_type
                    , t1.cert_name
                    , t1.cert_img
                    , t1.cert_img_name
                    , date_format(t1.created_at, '%Y.%m.%d') as created_at
                from
                    tb_certify_detail t1
                where
                    t1.is_delete = 'n'
                    and t1.member_cd = ? 
                    and t1.cert_type = ? ";
        return $this->db->query($sql, array($cd, $type));
    }

    public function company_distribution_info($cd) {
        $sql = "select
                    t1.member_cd

                    , ifnull(t1.channel_info, '') as channel_info
                    , ifnull(t1.competitive_product, '') as competitive_product
                    , ifnull(t1.export_nation, '')  as export_nation
                    , ifnull(t1.export_progress, '') as export_progress
                    , ifnull(t1.own_nation, '') as own_nation
                    , ifnull(t1.oem_nation, '') as oem_nation
                from
                    tb_distribution t1
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($cd));
    }

    public function update_company_manufacture($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_manufacture
                (
                    member_cd ,
                    manufacture_day ,
                    manufacture_month ,
                    manufacture_year ,
                    load_cnt ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_day']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_month']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_year']) . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['load_cnt']) . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    manufacture_day = VALUES(manufacture_day),
                    manufacture_month = VALUES(manufacture_month) ,
                    manufacture_year = VALUES(manufacture_year) ,
                    load_cnt = VALUES(load_cnt) ,
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";

            $this->db->query($sql, array());

            $sql = "INSERT INTO tb_manufacture_history
            (
                member_cd ,
                manufacture_day ,
                manufacture_month ,
                manufacture_year ,
                load_cnt ,
                created_by ,
                created_at
            )
            VALUES 
            (
                '" . $req['member_cd'] . "' , 
                '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_day']) . "' , 
                '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_month']) . "' , 
                '" . preg_replace('/[^0-9]*/s', '', $req['manufacture_year']) . "' , 
                '" . preg_replace('/[^0-9]*/s', '', $req['load_cnt']) . "' , 
                '" . $req['member_id'] . "' , 
                now()
            ) ";

        $this->db->query($sql, array());

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function update_company_facilities($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_facilities
                (
                    member_cd ,
                    model_lines ,
                    pack_bandsealer ,
                    pack_container ,
                    pack_rotary ,
                    pack_pouch ,
                    pack_rollfilm ,
                    freeze_machine , 
                    etc_machine ,
                    detector_xray ,
                    detector_metal ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['model_lines'] . "' , 
                    '" . $req['pack_bandsealer'] . "' , 
                    '" . $req['pack_container'] . "' , 
                    '" . $req['pack_rotary'] . "' , 
                    '" . $req['pack_pouch'] . "' , 
                    '" . $req['pack_rollfilm'] . "' , 
                    '" . $req['freeze_machine'] . "' , 
                    '" . $req['etc_machine'] . "' , 
                    '" . $req['detector_xray'] . "' , 
                    '" . $req['detector_metal'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    model_lines = VALUES(model_lines) ,
                    pack_bandsealer = VALUES(pack_bandsealer) ,
                    pack_container = VALUES(pack_container) ,
                    pack_rotary = VALUES(pack_rotary) ,
                    pack_pouch = VALUES(pack_pouch) ,
                    pack_rollfilm = VALUES(pack_rollfilm) ,
                    freeze_machine  = VALUES(freeze_machine), 
                    etc_machine = VALUES(etc_machine) ,
                    detector_xray = VALUES(detector_xray) ,
                    detector_metal = VALUES(detector_metal) ,
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";

        $this->db->query($sql, array());

        if(!empty($req['delete_seq'])) {
            $sql = "update tb_facilities_detail
                    set
                        is_delete = 'y'
                        , updated_by = '" . $req['member_id'] . "'
                        , updated_at = now()  
                    where
                        detail_seq in (" . $req['delete_seq'] . ") ";
            $this->db->query($sql, array());
        }

        if(!empty($req['details'])) {
            foreach($req['details'] as $row) {
                if(!empty($row['detail_seq'])) {
                    $sql = "update tb_facilities_detail
                            set
                                facilities_name = '" . $row['facilities_name'] . "'
                                , facilities_cnt = '" . $row['facilities_cnt'] . "'
                                , facilities_summary = '" . $row['facilities_summary'] . "' 
                                , updated_by = '" . $req['member_id'] . "'
                                , updated_at = now() ";
                    if(!empty($row['file_newpath'])) {
                        $sql .= "   , facilities_img = '" . (!empty($row['file_newpath']) ? $row['file_newpath'] : '') . "'
                                    , facilities_img_name = '" . (!empty($row['file_orgname']) ? $row['file_orgname'] : '') . "' ";

                    }
                    $sql .= " where
                                detail_seq = '" . $row['detail_seq'] . "' ";
                }
                else {
                    $sql = "insert into tb_facilities_detail
                            (
                                member_cd
                                , facilities_name
                                , facilities_cnt
                                , facilities_summary
                                , facilities_img
                                , facilities_img_name
                                , created_by
                                , created_at
                                , updated_by
                                , updated_at
                            )
                            VALUES
                            (
                                '" .  $req['member_cd'] . "'
                                , '" . $row['facilities_name'] . "'
                                , '" . preg_replace('/[^0-9]*/s', '', $row['facilities_cnt']) . "'
                                , '" . $row['facilities_summary'] . "' 
                                , '" . (!empty($row['file_newpath']) ? $row['file_newpath'] : '') . "'
                                , '" . (!empty($row['file_orgname']) ? $row['file_orgname'] : '') . "'
                                , '" . $req['member_id'] . "'
                                , now()
                                , '" . $req['member_id'] . "'
                                , now()
                            ) ";
                }
                $this->db->query($sql, array());
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

    public function update_company_cert($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_certify
                (
                    member_cd ,
                    haccp ,
                    etc_cert1_cd ,
                    etc_cert2_cd ,
                    etc_cert3_cd ,
                    patent_cnt ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['haccp'] . "' , 
                    '" . $req['etc_cert1_cd'] . "' , 
                    '" . $req['etc_cert2_cd'] . "' , 
                    '" . $req['etc_cert3_cd'] . "' , 
                    '" . preg_replace('/[^0-9]*/s', '', $req['patent_cnt']) . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    haccp = VALUES(haccp) ,
                    etc_cert1_cd = VALUES(etc_cert1_cd) ,
                    etc_cert2_cd = VALUES(etc_cert2_cd) ,
                    etc_cert3_cd = VALUES(etc_cert3_cd) ,
                    patent_cnt = VALUES(patent_cnt) ,
                    updated_by = VALUES(updated_by) ,
                    updated_at = now() ";

        $this->db->query($sql, array());

        if(!empty($req['delete_seq'])) {
            $sql = "update tb_certify_detail
                    set
                        is_delete = 'y'
                        , updated_by = '" . $req['member_id'] . "'
                        , updated_at = now()  
                    where
                        detail_seq in (" . $req['delete_seq'] . ") ";
            $this->db->query($sql, array());
        }

        if(!empty($req['details'])) {
            foreach($req['details'] as $row) {
                if(!empty($row['detail_seq'])) {
                    $sql = "update tb_certify_detail
                            set
                                cert_name = '" . $row['cert_name'] . "'
                                , updated_by = '" . $req['member_id'] . "'
                                , updated_at = now() ";
                    if(!empty($row['file_newpath'])) {
                        $sql .= "   , cert_img = '" . (!empty($row['file_newpath']) ? $row['file_newpath'] : '') . "'
                                    , cert_img_name = '" . (!empty($row['file_orgname']) ? $row['file_orgname'] : '') . "' ";

                    }
                    $sql .= " where
                                detail_seq = '" . $row['detail_seq'] . "' ";
                }
                else {
                    $sql = "insert into tb_certify_detail
                            (
                                member_cd
                                , cert_type
                                , cert_name
                                , cert_img
                                , cert_img_name
                                , created_by
                                , created_at
                                , updated_by
                                , updated_at
                            )
                            VALUES
                            (
                                '" .  $req['member_cd'] . "'
                                , '" . $row['cert_type'] . "'
                                , '" . $row['cert_name'] . "'
                                , '" . (!empty($row['file_newpath']) ? $row['file_newpath'] : '') . "'
                                , '" . (!empty($row['file_orgname']) ? $row['file_orgname'] : '') . "'
                                , '" . $req['member_id'] . "'
                                , now()
                                , '" . $req['member_id'] . "'
                                , now()
                            ) ";
                }
                $this->db->query($sql, array());
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


    public function update_company_distribution($req) {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_distribution
                (
                    member_cd ,
                    channel_info , 
                    competitive_product , 
                    export_nation ,
                    export_progress ,
                    own_nation ,
                    oem_nation ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES 
                (
                    '" . $req['member_cd'] . "' , 
                    '" . $req['channel_info'] . "' , 
                    '" . $req['competitive_product'] . "' , 
                    '" . $req['export_nation'] . "' , 
                    '" . $req['export_progress'] . "' , 
                    '" . $req['own_nation'] . "' , 
                    '" . $req['oem_nation'] . "' , 
                    '" . $req['member_id'] . "' , 
                    now() ,
                    '" . $req['member_id'] . "' , 
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    channel_info = VALUES(channel_info),
                    competitive_product = VALUES(competitive_product) ,
                    export_nation = VALUES(export_nation) ,
                    export_progress = VALUES(export_progress) ,
                    own_nation = VALUES(own_nation) ,
                    oem_nation = VALUES(oem_nation) ,
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

    public function update_company_hit($seq) {
        $this->db->trans_begin();

        $sql = "UPDATE tb_member
                SET
                    hit_cnt = hit_cnt +  1
                WHERE
                    member_cd = ? ";

        $this->db->query($sql, array($seq));

  
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }

    }

    public function update_admin_bi01_hit($seq) {
        $this->db->trans_begin();

        $sql = "UPDATE tb_admin_bi01
                SET
                    hit_cnt = hit_cnt +  1
                WHERE
                    biz_no = ? ";

        $this->db->query($sql, array($seq));

  
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }

    }

    public function summary_manufacture_day($code) {
        $sql = "SELECT
                    AVG(TB1.manufacture_day) as avg_val
                    , MAX(TB1.manufacture_day) as max_val
                FROM
                (
                    SELECT 
                        case when t3.manufacture_day is not null and t3.manufacture_day != '' then t3.manufacture_day
                            when t2.manufacture_day is not null and t2.manufacture_day != '' then t2.manufacture_day
                            else '-1' end as manufacture_day
                    FROM
                        tb_member t1
                    left outer join tb_manufacture t3 on t1.member_cd = t3.member_cd
                    left outer join tb_admin_bi05 t2 on t2.biz_no = t1.biz_no and t2.is_delete =  'n'
                    WHERE
                            1=1 ";
        if(!empty($code)) {
            $sql .= " and  t1.industrial_code = '" . $code . "' ";
        }
        $sql .= "                        
                    union
                    SELECT 
                        case when t3.manufacture_day is not null and t3.manufacture_day != '' then t3.manufacture_day
                            when t4.manufacture_day is not null and t4.manufacture_day != '' then t4.manufacture_day
                            else '-1' end as manufacture_day
                    FROM
                        tb_admin_bi01 t2
                    left outer join tb_admin_bi05 t4 on t4.biz_no = t2.biz_no
                    left outer join tb_member t1 on t2.biz_no = t1.biz_no
                    left outer join tb_manufacture t3 on t1.member_cd = t3.member_cd
                    where
                        t2.is_delete = 'n' ";
        if(!empty($code)) {
            $sql .= " and  t2.industrial_code = '" . $code . "' ";
        }

        $sql .= "
                ) TB1
                WHERE
                    TB1.manufacture_day > 0 ";

        return $this->db->query($sql, array());

    }

    public function summary_manufacture_month($code) {
        $sql = "SELECT
                    AVG(TB1.manufacture_month) as avg_val
                    , MAX(TB1.manufacture_month) as max_val
                FROM
                (
                    SELECT 
                        case when t3.manufacture_month is not null and t3.manufacture_month != '' then t3.manufacture_month
                            when t2.manufacture_month is not null and t2.manufacture_month != '' then t2.manufacture_month
                            else '-1' end as manufacture_month
                    FROM
                        tb_member t1
                    left outer join tb_manufacture t3 on t1.member_cd = t3.member_cd
                    left outer join tb_admin_bi05 t2 on t2.biz_no = t1.biz_no and t2.is_delete = 'n'
                    WHERE
                            1=1 ";
        if(!empty($code)) {
            $sql .= " and  t1.industrial_code = '" . $code . "' ";
        }
        $sql .= "                        
                    union
                    SELECT 
                        case when t3.manufacture_month is not null and t3.manufacture_month != '' then t3.manufacture_month
                            when t4.manufacture_month is not null and t4.manufacture_month != '' then t4.manufacture_month
                            else '-1' end as manufacture_month
                    FROM
                        tb_admin_bi01 t2
                    left outer join tb_admin_bi05 t4 on t4.biz_no = t2.biz_no
                    left outer join tb_member t1 on t2.biz_no = t1.biz_no
                    left outer join tb_manufacture t3 on t3.member_cd = t1.member_cd
                    where
                        t2.is_delete = 'n' ";
        if(!empty($code)) {
            $sql .= " and  t2.industrial_code = '" . $code . "' ";
        }
                
        $sql .= "
                ) TB1
                WHERE
                    TB1.manufacture_month > 0 ";
        return $this->db->query($sql, array());

    }

    public function summary_load_cnt($code) {
        $sql = "SELECT
                    AVG(TB1.load_cnt) as avg_val
                    , MAX(TB1.load_cnt) as max_val
                FROM
                (
                    SELECT 
                        case when t3.load_cnt is not null and t3.load_cnt != '' then t3.load_cnt
                            when t2.load_cnt is not null and t2.load_cnt != '' then t2.load_cnt
                            else '-1' end as load_cnt
                    FROM
                        tb_member t1
                    left outer join tb_manufacture t3 on t3.member_cd = t1.member_cd
                    left outer join tb_admin_bi05 t2 on t2.biz_no = t1.biz_no and t2.is_delete =  'n'
                    WHERE
                        1=1 ";
        if(!empty($code)) {
            $sql .= " and  t1.industrial_code = '" . $code . "' ";
        }
        $sql .= "                        
                    union
                    SELECT 
                        case when t3.load_cnt is not null and t3.load_cnt != '' then t3.load_cnt
                            when t4.load_cnt is not null and t4.load_cnt != '' then t4.load_cnt
                            else '-1' end as load_cnt
                    FROM
                        tb_admin_bi01 t2
                    left outer join tb_admin_bi05 t4 on t4.biz_no = t2.biz_no
                    left outer join tb_member t1 on t2.biz_no = t1.biz_no
                    left outer join tb_manufacture t3 on t3.member_cd = t1.member_cd
                    where
                        t2.is_delete = 'n' ";
        if(!empty($code)) {
            $sql .= " and  t2.industrial_code = '" . $code . "' ";
        }

        $sql .= "
                ) TB1
                WHERE
                    TB1.load_cnt > 0 ";

        return $this->db->query($sql, array());

    }


    public function company_info_for_request($member_cd) {
        $sql = "select
                    t1.member_cd
                    , t1.company_name
                    , t1.owner_name
                      
                    , t1.owner_name
                    , t1.company_tel
                    , t1.company_email
                    , ifnull(t1.zonecode, '') as zonecode
                    , concat(ifnull(t1.addr, ''), ' ' , ifnull(t1.addr_detail, '')) as addr

                    , if(t1.employee_name is not null, FN_DECRYPT(t1.employee_name), '')  as employee_name
                    , if(t1.employee_tel is not  null, FN_DECRYPT(t1.employee_tel), '')  as employee_tel 
                from
                    tb_member t1
                where
                    t1.member_cd = ? ";
        return $this->db->query($sql, array($member_cd));
    }

}    

?>