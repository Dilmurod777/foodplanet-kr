<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_search10($req)
    {
        $this->db->trans_begin();

        $this->db->set('keyword_type', $req['keyword_type']);
        $this->db->set('keyword', $req['keyword']);
        $this->db->set('order_no', "ifnull((select order_no + 1 from tb_recommend_keyword a where a.is_delete = 'n' and a.keyword_type = '" . $req['keyword_type'] . "' order by order_no desc limit 1), 1)", false);
        $this->db->set('is_use', 'y');
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at',  'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_recommend_keyword');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function update_search10($req)
    {
        $this->db->trans_begin();

        $this->db->set('keyword', $req['keyword']);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('recommend_seq', $req['recommend_seq']);
        $this->db->update('tb_recommend_keyword');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function delete_search10($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('recommend_seq', $req['recommend_seq']);
        $this->db->update('tb_recommend_keyword');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function search10_change_order($req) {
		$this->db->trans_begin();

		if($req['dir'] == 'up') {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                        tb_recommend_keyword t1
					where
						t1.is_delete = 'n'
                        and t1.keyword_type = '"  . $req['keyword_type'] . "' 
						and " . $req['order_no'] . " > t1.order_no
					order by t1.order_no desc
					limit 0, 1 ";
		}
		else {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                        tb_recommend_keyword t1
			    	where
    					t1.is_delete = 'n'
                        and t1.keyword_type = '"  . $req['keyword_type'] . "' 
 				   		and " . $req['order_no'] . " < t1.order_no
			    	order by t1.order_no asc
			    	limit 0, 1 ";
		}
		$res = $this->db->query($sql, array())->row_array();

        if(!empty($res)) {
            $sql = "update tb_recommend_keyword
                    set
                        order_no = ?
                        , updated_at = now()
                        , updated_by = ?
                    where
                        recommend_seq = ?  ";
            $this->db->query($sql, array($req['order_no'], $req['member_id'], $res['recommend_seq']));
            $this->db->query($sql, array($res['order_no'], $req['member_id'], $req['recommend_seq']));

        }

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}      

    public function insert_product10($req)
    {
        $this->db->trans_begin();

        $this->db->set('product_type', $req['product_type']);
        $this->db->set('product_seq', $req['product_seq']);
        $this->db->set('order_no', "ifnull((select order_no + 1 from tb_recommend_product a where a.is_delete = 'n' order by order_no desc limit 1), 1)", false);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at',  'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_recommend_product');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function delete_product10($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('recommend_seq', $req['recommend_seq']);
        $this->db->update('tb_recommend_product');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function product10_change_order($req) {
		$this->db->trans_begin();

		if($req['dir'] == 'up') {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                        tb_recommend_product t1
					where
						t1.is_delete = 'n'
						and " . $req['order_no'] . " > t1.order_no
					order by t1.order_no desc
					limit 0, 1 ";
		}
		else {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                        tb_recommend_product t1
			    	where
    					t1.is_delete = 'n'
 				   		and " . $req['order_no'] . " < t1.order_no
			    	order by t1.order_no asc
			    	limit 0, 1 ";
		}
		$res = $this->db->query($sql, array())->row_array();

        if(!empty($res)) {
            $sql = "update tb_recommend_product
                    set
                        order_no = ?
                        , updated_at = now()
                        , updated_by = ?
                    where
                        recommend_seq = ?  ";
            $this->db->query($sql, array($req['order_no'], $req['member_id'], $res['recommend_seq']));
            $this->db->query($sql, array($res['order_no'], $req['member_id'], $req['recommend_seq']));

        }

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}          

    public function insert_manufacture10($req)
    {
        $this->db->trans_begin();

        $this->db->set('biz_no', $req['biz_no']);
        $this->db->set('order_no', "ifnull((select order_no + 1 from tb_recommend_manufacture a where a.is_delete = 'n' order by order_no desc limit 1), 1)", false);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', $req['member_id']);
        $this->db->set('created_at',  'now()', false);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_recommend_manufacture');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function delete_manufacture10($req)
    {
        $this->db->trans_begin();

        $this->db->set('is_delete', 'y');
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('recommend_seq', $req['recommend_seq']);
        $this->db->update('tb_recommend_manufacture');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function manufacture10_change_order($req) {
		$this->db->trans_begin();

		if($req['dir'] == 'up') {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                        tb_recommend_manufacture t1
					where
						t1.is_delete = 'n'
						and " . $req['order_no'] . " > t1.order_no
					order by t1.order_no desc
					limit 0, 1 ";
		}
		else {
			$sql = "select 
						t1.recommend_seq
						, t1.order_no
					from
                    tb_recommend_manufacture t1
			    	where
    					t1.is_delete = 'n'
 				   		and " . $req['order_no'] . " < t1.order_no
			    	order by t1.order_no asc
			    	limit 0, 1 ";
		}
		$res = $this->db->query($sql, array())->row_array();

        if(!empty($res)) {
            $sql = "update tb_recommend_manufacture
                    set
                        order_no = ?
                        , updated_at = now()
                        , updated_by = ?
                    where
                        recommend_seq = ?  ";
            $this->db->query($sql, array($req['order_no'], $req['member_id'], $res['recommend_seq']));
            $this->db->query($sql, array($res['order_no'], $req['member_id'], $req['recommend_seq']));

        }

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}          

    public function update_recommend_main($req)
    {
        $this->db->trans_begin();

        $this->db->set('title', $req['title']);
        $this->db->set('desc', $req['desc']);
        $this->db->set('link_url', $req['link_url']);
        $this->db->set('img_url', $req['img_url']);
        $this->db->set('updated_by', $req['member_id']);
        $this->db->set('updated_at', 'now()', false);
        $this->db->where('recommend_seq', $req['recommend_seq']);
        $this->db->update('tb_recommend_main');

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