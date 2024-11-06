<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_m extends CI_Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

  //유저 리스트
    public function code_list($main_code)
    {
        $sql = "SELECT
                    t1.*
                FROM
                    tb_code t1
                WHERE
                    t1.main_code = ?
                    and t1.is_delete = 'n'
                    and t1.is_use = 'y' 
                order by t1.order_no asc ";

        return $this->db->query($sql, array($main_code));
    }

    public function code_list_for_admin($main_code)
    {
        $sql = "SELECT
                    t1.*
                FROM
                    tb_code t1
                WHERE
                    t1.main_code = ?
                    and t1.is_delete = 'n'
                order by t1.order_no asc ";

        return $this->db->query($sql, array($main_code));
    }

    public function delete_code($req)
    {
		$this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->where('main_code', $req['main_code']);
        $this->db->where('sub_code', $req['sub_code']);
        $this->db->update('tb_code');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function update_code($req)
    {
		$this->db->trans_begin();

        $this->db->set('is_use', $req['is_use']);
        $this->db->set('code_name', $req['code_name']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->where('main_code', $req['main_code']);
        $this->db->where('sub_code', $req['sub_code']);
        $this->db->update('tb_code');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_code($req)
    {
		$this->db->trans_begin();

        $sql = "insert into tb_code
                (main_code, sub_code, code_name, order_no, is_use, is_delete, created_by, created_at, updated_by, updated_at)
                values
                (
                    '" . $req['main_code'] . "'
                    , '" . $req['sub_code'] . "'
                    , '" . $req['code_name'] . "'
                    , (select order_no + 1 from tb_code a where a.main_code = '" . $req['main_code'] . "' and a.is_delete = 'n' order by order_no desc limit 1) 
                    , 'y'
                    , 'n'
                    , '" . $req['member_id'] . "'
                    , now()
                    , '" . $req['member_id'] . "'
                    , now()
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

	public function change_order($req) {
		$this->db->trans_begin();

		if($req['dir'] == 'up') {
			$sql = "select 
						t1.sub_code
						, t1.order_no
					from
						tb_code t1
					where
						t1.is_delete = 'n'
                        and t1.main_code = '" . $req['main_code'] . "'
						and " . $req['order_no'] . " > t1.order_no
					order by t1.order_no desc
					limit 0, 1 ";
		}
		else {
			$sql = "select 
						t1.sub_code
						, t1.order_no
					from
						tb_code t1
			    	where
    					t1.is_delete = 'n'
                        and t1.main_code = '" . $req['main_code'] . "'
 				   		and " . $req['order_no'] . " < t1.order_no
			    	order by t1.order_no asc
			    	limit 0, 1 ";
		}
		$res = $this->db->query($sql, array())->row_array();

        if(!empty($res)) {
            $sql = "update tb_code
            set
                order_no = ?
                , updated_at = now()
                , updated_by = ?
            where
                sub_code = ? 
                and main_code = '" . $req['main_code'] . "' ";
            $this->db->query($sql, array($req['order_no'], $req['member_id'], $res['sub_code']));
            $this->db->query($sql, array($res['order_no'], $req['member_id'], $req['sub_code']));

        }

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}       

    public function exists_code($main, $sub) {
        $this->db->where('main_code', $main);
        $this->db->where('sub_code', $sub);
        return $this->db->get('tb_code');
    }

    public function recommend_keyword($type)
    {
        $sql = "SELECT
                    t1.keyword
                    , t1.recommend_seq
                    , t1.order_no
                    , t1.created_by
                    , t1.created_at
                    , t1.updated_by
                    , t1.updated_at
                FROM
                    tb_recommend_keyword t1
                WHERE
                    t1.is_delete = 'n'
                    and t1.keyword_type = ?
                    AND t1.is_use = 'y'
                ORDER BY t1.order_no asc";

        return $this->db->query($sql, array($type));
    }

    public function search_list($cd)
    {
        $sql = "SELECT
                    t1.search_text
                FROM
                    tb_search t1
                WHERE
                    t1.is_delete = 'n'
                    and t1.member_seq = ? 
                ORDER BY t1.updated_at desc";

        return $this->db->query($sql, array($cd));
    }

    public function insert_search($cd, $search_text) {
        $sql = "INSERT INTO tb_search
                (
                    member_seq ,
                    search_text ,
                    is_delete ,
                    created_at ,
                    updated_at
                )
                VALUES 
                (
                    '" . $cd . "' , 
                    '" . $search_text . "' , 
                    'n' ,
                    now() ,
                    now()
                )
                ON DUPLICATE KEY UPDATE 
                    is_delete = 'n',
                    updated_at = now() ";

            $this->db->query($sql, array());
    }

    public function delete_search($cd, $search_text) {
        $this->db->set('is_delete', 'y');
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('member_seq', $cd);
        $this->db->where('search_text', $search_text);
        $this->db->update('tb_search');
    }

    public function recommend_product() {
        $sql = "select
                    TB1.*
                from
                (
                    select
                        t1.recommend_seq
                        , '자사제품' as product_type
                        , t1.product_seq
                        , t1.order_no
                        , t2.company_name
                        , t2.product_name
                        , t1.product_type as product_type2
                        , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.product_seq and a.img_type = 'NB_image' and a.is_main = 'y'), '') as prod_img
                        , t1.updated_by
                        , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                    from
                        tb_recommend_product t1
                    inner join tb_domestic_product t2 on t2.seq = t1.product_seq
                    where
                        t1.product_type = '1'
                        and t1.is_delete = 'n'
                    union
                    select
                        t1.recommend_seq
                        , 'OEM제품' as product_type
                        , t1.product_seq
                        , t1.order_no
                        , t2.company_name
                        , t2.product_name
                        , t1.product_type as product_type2
                        , ifnull((select a.img_url from tb_domestic_prodimg a where a.product_seq = t1.product_seq and a.img_type = 'OEM_image' and a.is_main = 'y'), '') as prod_img
                        , t1.updated_by
                        , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                    from
                        tb_recommend_product t1
                    inner join tb_domestic_oem t2 on t2.seq = t1.product_seq
                    where
                        t1.product_type = '2'
                        and t1.is_delete = 'n'
                ) TB1
                order by TB1.order_no ";
        return $this->db->query($sql);
    }

    public function recommend_manufacture10() {
        $sql = "select
                    t1.recommend_seq
                    , t1.biz_no
                    , t1.order_no
                    , t2.company_name
                    , t2.logo_img
                    , t1.updated_by
                    , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                from
                    tb_recommend_manufacture t1
                inner join tb_domestic_companym t2 on t2.biz_no = t1.biz_no
                where
                    t1.is_delete = 'n' 
                order by t1.order_no ";
        return $this->db->query($sql);
    }

    public function recommend_main($type, $offset, $perpage) {
        $sql = "select
                    t1.recommend_seq
                    , t1.recommend_type
                    , t1.title
                    , t1.desc
                    , t1.link_url
                    , t1.img_url
                    , t1.updated_by
                    , date_format(t1.updated_at, '%Y-%m-%d %H:%i') as updated_at
                from
                    tb_recommend_main t1
                where
                    t1.is_delete = 'n' 
                    and t1.recommend_type = ?
                limit ?, ? ";
        return $this->db->query($sql, array($type, $offset, $perpage));
    }

    public function insert_auth($val) {
        $this->db->trans_begin();

        $this->db->set('is_auth', 'y');
        $this->db->where('email', $val['email']);
        $this->db->where('is_auth', 'n');
        $this->db->update('tb_auth');

        $this->db->reset_query();
        $this->db->set('email', $val['email']);
        $this->db->set('auth_num', $val['auth_num']);
        $this->db->set('exp_date', 'DATE_ADD(NOW(), INTERVAL 3 MINUTE)', false);
        $this->db->set('is_auth', 'n');
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_auth');

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function chk_auth($val) {
        $sql = "select
                    *
                from
                    tb_auth
                where
                    email = ?
                    and auth_num = ?
                    and exp_date >= now() 
                    and is_auth = 'n' ";
        $res = $this->db->query($sql, array($val['email'], $val['auth_num']))->row_array();

        if(!empty($res)) {
            $this->db->set('is_auth', 'y');
            $this->db->where('email', $val['email']);
            $this->db->update('tb_auth');
            return true;
        }
        else {
            return false;
        }
    }
}

?>