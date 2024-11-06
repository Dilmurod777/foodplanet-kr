<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Main extends FP_ApiController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->model('admin/manager_m', 'manager_m');
        $this->load->model('admin/log_m', 'log_m');
    }

	public function register()
	{
		$req = $this->input->post();

		for($i = 0; $i < count($req['recommend_seq']); $i++) {
			$val = array();
			$val['recommend_seq'] = $req['recommend_seq'][$i];
			$val['title'] = $req['title_' . $req['recommend_seq'][$i]];
			$val['desc'] = $req['desc_' . $req['recommend_seq'][$i]];
			$val['link_url'] = $req['link_url_' . $req['recommend_seq'][$i]];
			$val['img_url'] = $req['img_url_' . $req['recommend_seq'][$i]];
			$val['member_id'] = $this->data['admin']['admin_id'];
			
			$this->manager_m->update_recommend_main($val);
			$this->log_m->insert_log('tb_recommend_main', 'U', $val, $this->data['admin']['admin_id']);
		}

		$result = array();
		$result['result'] = 'succ';
		$result['msg'] = '등록하였습니다.';

		echo json_encode($result);		
	}

}