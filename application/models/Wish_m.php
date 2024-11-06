<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wish_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function wish_list($req, $offset, $perpage) {
        $sql = "select
                    t1.target_cd
                    , t1.source_cd
                    , case t1.target_type when '1' then (select a.company_name from tb_domestic_companym a where a.biz_no = t1.target_cd)
                                        when '2' then ( select
                                                            b.company_name
                                                        from
                                                            tb_domestic_product a
                                                        inner join tb_domestic_companym b on b.biz_no = a.biz_no
                                                        where
                                                            a.seq = t1.target_cd)
                                        when '3' then ( select
                                                            b.company_name
                                                        from
                                                            tb_domestic_oem a
                                                        inner join tb_domestic_companym b on b.biz_no = a.biz_no
                                                        where
                                                            a.seq = t1.target_cd)
                                        end as company_name
                    , case t1.target_type when '1' then ''
                                        when '2' then ( select
                                                            a.product_name
                                                        from
                                                            tb_domestic_product a
                                                        where
                                                            a.seq = t1.target_cd)
                                        when '3' then ( select
                                                            a.product_name
                                                        from
                                                            tb_domestic_oem a
                                                        where
                                                            a.seq = t1.target_cd)
                                        end as product_name
                    , case t1.target_type when '1' then '관심기업'
                                        when '2' then '관심제품(자사)'
                                        when '3' then '관심제품(OEM)'
                                        end as target_type_name
                    , t1.target_type
                    , date_format(t1.updated_at, '%Y.%m.%d') as updated_at
                from
                    tb_wish t1
                where
                    t1.source_cd = ?
                    and is_wish = 'y' ";
        $sql .="
                order by t1.updated_at desc
                limit ?, ? ";

        return $this->db->query($sql, array($req['seq'], $offset, $perpage));
    }

    public function wish_list_cnt($req) {
        $sql = "select
                    count(*) as cnt
                from
                    tb_wish t1
                where
                    t1.source_cd = ?
                    and is_wish = 'y'  ";

        $tmp = $this->db->query($sql, array($req['seq']))->row_array();
        return $tmp['cnt'];
    }

    public function wish_info($req) {
        $sql = "select
                    t1.is_wish
                from
                    tb_wish t1
                where
                    t1.source_cd = ?
                    and t1.target_cd = ? 
                    and t1.target_type = ? ";
        return $this->db->query($sql, array($req['source_cd'], $req['target_cd'], $req['target_type']));
    }

    public function insert_wish($req) {
        $this->db->trans_begin();

        $sql = "insert into tb_wish
                (
                    source_cd
                    , target_cd
                    , target_type
                    , is_wish
                    , created_by
                    , created_at
                    , updated_by
                    , updated_at
                )
                values
                (
                    '" . $req['source_cd'] . "'
                    , '" . $req['target_cd'] . "'
                    , '" . $req['target_type'] . "'
                    , '" . $req['is_wish'] . "'
                    , '" . $req['member_id'] . "'
                    , now()
                    , '" . $req['member_id'] . "'
                    , now()
                )
                ON DUPLICATE KEY UPDATE 
                    is_wish = VALUES(is_wish)
                    , updated_by = VALUES(updated_by) 
                    , updated_at = VALUES(updated_at) ";

        $this->db->query($sql, array());
    
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