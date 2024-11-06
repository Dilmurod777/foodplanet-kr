<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_m extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_bi01_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi01
                (
                    biz_no,
                    company_name ,
                    member_type ,
                    owner_name ,
                    group_name ,
                    company_type ,
                    incorporation_at ,
                    zonecode ,
                    addr ,
                    industrial_code ,
                    industrial_name ,
                    homepage ,
                    company_tel ,
                    company_fax ,
                    company_email ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['company_name'] . "' , 
                            '" . $row['member_type'] . "' , 
                            '" . $row['owner_name'] . "' , 
                            '" . $row['group_name'] . "' , 
                            '" . $row['company_type'] . "' , 
                            '" . $row['incorporation_at'] . "' , 
                            '" . $row['zonecode'] . "' , 
                            '" . $row['addr'] . "' , 
                            '" . $row['industrial_code'] . "' , 
                            '" . $row['industrial_name'] . "' , 
                            '" . $row['homepage'] . "' , 
                            '" . $row['company_tel'] . "' , 
                            '" . $row['company_fax'] . "' , 
                            '" . $row['company_email'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        company_name = VALUES(company_name),
                        member_type = VALUES(member_type) ,
                        owner_name = VALUES(owner_name) ,
                        group_name = VALUES(group_name) ,
                        company_type = VALUES(company_type) ,
                        incorporation_at = VALUES(incorporation_at) ,
                        zonecode = VALUES(zonecode) ,
                        addr = VALUES(addr) ,
                        industrial_code = VALUES(industrial_code) ,
                        industrial_name = VALUES(industrial_name) ,
                        homepage = VALUES(homepage) ,
                        company_tel = VALUES(company_tel) ,
                        company_fax = VALUES(company_fax) ,
                        company_email = VALUES(company_email) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' , 
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

    public function insert_bi011_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi011
                (
                    biz_no,
                    employee_name ,
                    employee_tel ,
                    etc_memo ,
                    `sample`,
                    sample_testing ,
                    admin_memo ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            FN_ENCRYPT('" . $row['employee_name'] . "') , 
                            FN_ENCRYPT('" . $row['employee_tel'] . "') , 
                            '" . $row['etc_memo'] . "' , 
                            '" . $row['sample'] . "' , 
                            '" . $row['sample_testing'] . "' , 
                            '" . $row['admin_memo'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        employee_name = VALUES(employee_name) ,
                        employee_tel = VALUES(employee_tel) ,
                        etc_memo = VALUES(etc_memo) ,
                        `sample` = VALUES(`sample`),
                        sample_testing = VALUES(sample_testing) ,
                        admin_memo = VALUES(admin_memo) ,
                        is_delete = 'n' ,
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

    public function insert_bi02_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi02
                (
                    biz_no,
                    year_sales ,
                    biz_profit ,
                    net_profit ,
                    credit_rating ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['year_sales'] . "' , 
                            '" . $row['biz_profit'] . "' , 
                            '" . $row['net_profit'] . "' , 
                            '" . $row['credit_rating'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        year_sales = VALUES(year_sales) ,
                        biz_profit = VALUES(biz_profit) ,
                        net_profit = VALUES(net_profit) ,
                        credit_rating = VALUES(credit_rating) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
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


    public function insert_bi03_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi03
                (
                    biz_no,
                    main_product_cd ,
                    main_product_etc ,
                    nb_product_moq ,
                    nb_product_price ,
                    nb_product_delivery ,
                    nb_product_type ,
                    nb_material_moq ,
                    nb_material_leadtime ,
                    nb_material_price ,
                    oem_product_moq ,
                    oem_product_price ,
                    oem_product_delivery ,
                    oem_material_moq ,
                    oem_material_leadtime ,
                    oem_material_price ,
                    confirmed_at ,
                    payment_type ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['main_product_cd'] . "' , 
                            '" . $row['main_product_etc'] . "' , 
                            '" . $row['nb_product_moq'] . "' , 
                            '" . $row['nb_product_price'] . "' , 
                            '" . $row['nb_product_delivery'] . "' , 
                            '" . $row['nb_product_type'] . "' , 
                            '" . $row['nb_material_moq'] . "' , 
                            '" . $row['nb_material_leadtime'] . "' , 
                            '" . $row['nb_material_price'] . "' , 
                            '" . $row['oem_product_moq'] . "' , 
                            '" . $row['oem_product_price'] . "' , 
                            '" . $row['oem_product_delivery'] . "' , 
                            '" . $row['oem_material_moq'] . "' , 
                            '" . $row['oem_material_leadtime'] . "' , 
                            '" . $row['oem_material_price'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            '" . $row['payment_type'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        main_product_cd = VALUES(main_product_cd),
                        main_product_etc = VALUES(main_product_etc),
                        nb_product_moq = VALUES(nb_product_moq) ,
                        nb_product_price = VALUES(nb_product_price) ,
                        nb_product_delivery = VALUES(nb_product_delivery) ,
                        nb_product_type = VALUES(nb_product_type) ,
                        nb_material_moq = VALUES(nb_material_moq) ,
                        nb_material_leadtime = VALUES(nb_material_leadtime) ,
                        nb_material_price = VALUES(nb_material_price) ,
                        oem_product_moq = VALUES(oem_product_moq) ,
                        oem_product_price = VALUES(oem_product_price) ,
                        oem_product_delivery = VALUES(oem_product_delivery) ,
                        oem_material_moq = VALUES(oem_material_moq) ,
                        oem_material_leadtime = VALUES(oem_material_leadtime) ,
                        oem_material_price = VALUES(oem_material_price) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        payment_type = VALUES(payment_type) ,
                        is_delete = 'n' ,
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

    public function insert_bi031_list($req)
    {
        $this->db->trans_begin();


        $sql = "INSERT INTO tb_admin_bi031
                (
                    biz_no,
                    product_name ,
                    product_summary ,
                    tags ,
                    maker ,
                    supply_price ,
                    moq ,
                    food_type ,
                    brand ,
                    expire_day ,
                    channel ,
                    delivery_day ,
                    type_cnt ,
                    material_leadtime ,
                    material_moq ,
                    material_price ,
                    export_nation ,
                    export_progress ,
                    is_ios22000 ,
                    is_fda ,
                    is_halal ,
                    product_img ,
                    label_img ,
                    size ,
                    storage_method ,
                    manufacture_day ,
                    manufacture_month ,
                    manufacture_year ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['product_summary'] . "' , 
                            '" . $row['tags'] . "' , 
                            '" . $row['maker'] . "' , 
                            '" . $row['supply_price'] . "' , 
                            '" . $row['moq'] . "' , 
                            '" . $row['food_type'] . "' , 
                            '" . $row['brand'] . "' , 
                            '" . $row['expire_day'] . "' , 
                            '" . $row['channel'] . "' , 
                            '" . $row['delivery_day'] . "' , 
                            '" . $row['type_cnt'] . "' , 
                            '" . $row['material_leadtime'] . "' , 
                            '" . $row['material_moq'] . "' , 
                            '" . $row['material_price'] . "' , 
                            '" . $row['export_nation'] . "' , 
                            '" . $row['export_progress'] . "' , 
                            '" . $row['is_ios22000'] . "' , 
                            '" . $row['is_fda'] . "' , 
                            '" . $row['is_halal'] . "' , 
                            '" . $row['product_img'] . "' , 
                            '" . $row['label_img'] . "' , 
                            '" . $row['size'] . "' , 
                            '" . $row['storage_method'] . "' , 
                            '" . $row['manufacture_day'] . "' , 
                            '" . $row['manufacture_month'] . "' , 
                            '" . $row['manufacture_year'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
/*            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_name = VALUES(product_name) ,
                        product_summary = VALUES(product_summary) ,
                        tags = VALUES(tags) ,
                        maker = VALUES(maker) ,
                        supply_price = VALUES(supply_price) ,
                        moq = VALUES(moq) ,
                        food_type = VALUES(food_type) ,
                        brand = VALUES(brand) ,
                        expire_day = VALUES(expire_day) ,
                        channel = VALUES(channel) ,
                        delivery_day = VALUES(delivery_day) ,
                        type_cnt = VALUES(type_cnt) ,
                        material_leadtime = VALUES(material_leadtime) ,
                        material_moq = VALUES(material_moq) ,
                        material_price = VALUES(material_price) ,
                        export_nation = VALUES(export_nation) ,
                        export_progress = VALUES(export_progress) ,
                        is_ios22000 = VALUES(is_ios22000) ,
                        is_fda = VALUES(is_fda) ,
                        is_halal = VALUES(is_halal) ,
                        product_img = VALUES(product_img) ,
                        label_img = VALUES(label_img) ,
                        size = VALUES(size) ,
                        storage_method = VALUES(storage_method) ,
                        manufacture_day = VALUES(manufacture_day) ,
                        manufacture_month = VALUES(manufacture_month) ,
                        manufacture_year = VALUES(manufacture_year) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() "; */

            $this->db->query($sql, array());

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    public function insert_bi032_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi032
                (
                    biz_no,
                    product_name ,
                    product_summary ,
                    tags ,
                    maker_cd ,
                    maker_etc ,
                    supply_price ,
                    moq ,
                    food_type ,
                    brand ,
                    expire_day ,
                    channel ,
                    delivery_day ,
                    other_company ,
                    product_type ,
                    material_leadtime ,
                    material_moq ,
                    material_price ,
                    export_nation ,
                    export_progress ,
                    is_ios22000 ,
                    is_fda ,
                    is_halal ,
                    product_img ,
                    label_img ,
                    size ,
                    storage_method ,
                    manufacture_day ,
                    manufacture_month ,
                    manufacture_year ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['product_name'] . "' , 
                            '" . $row['product_summary'] . "' , 
                            '" . $row['tags'] . "' , 
                            '" . $row['maker_cd'] . "' , 
                            '" . $row['maker_etc'] . "' , 
                            '" . $row['supply_price'] . "' , 
                            '" . $row['moq'] . "' , 
                            '" . $row['food_type'] . "' , 
                            '" . $row['brand'] . "' , 
                            '" . $row['expire_day'] . "' , 
                            '" . $row['channel'] . "' , 
                            '" . $row['delivery_day'] . "' , 
                            '" . $row['other_company'] . "' , 
                            '" . $row['product_type'] . "' , 
                            '" . $row['material_leadtime'] . "' , 
                            '" . $row['material_moq'] . "' , 
                            '" . $row['material_price'] . "' , 
                            '" . $row['export_nation'] . "' , 
                            '" . $row['export_progress'] . "' , 
                            '" . $row['is_ios22000'] . "' , 
                            '" . $row['is_fda'] . "' , 
                            '" . $row['is_halal'] . "' , 
                            '" . $row['product_img'] . "' , 
                            '" . $row['label_img'] . "' , 
                            '" . $row['size'] . "' , 
                            '" . $row['storage_method'] . "' , 
                            '" . $row['manufacture_day'] . "' , 
                            '" . $row['manufacture_month'] . "' , 
                            '" . $row['manufacture_year'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
/*            $sql .= " ON DUPLICATE KEY UPDATE 
                        product_name = VALUES(product_name) ,
                        product_summary = VALUES(product_summary) ,
                        tags = VALUES(tags) ,
                        maker_cd = VALUES(maker_cd) ,
                        maker_etc = VALUES(maker_etc) ,
                        supply_price = VALUES(supply_price) ,
                        moq = VALUES(moq) ,
                        food_type = VALUES(food_type) ,
                        brand = VALUES(brand) ,
                        expire_day = VALUES(expire_day) ,
                        channel = VALUES(channel) ,
                        delivery_day = VALUES(delivery_day) ,
                        other_company = VALUES(other_company) ,
                        product_type = VALUES(product_type) ,
                        material_leadtime = VALUES(material_leadtime) ,
                        material_moq = VALUES(material_moq) ,
                        material_price = VALUES(material_price) ,
                        export_nation = VALUES(export_nation) ,
                        export_progress = VALUES(export_progress) ,
                        is_ios22000 = VALUES(is_ios22000) ,
                        is_fda = VALUES(is_fda) ,
                        is_halal = VALUES(is_halal) ,
                        product_img = VALUES(product_img) ,
                        label_img = VALUES(label_img) ,
                        size = VALUES(size) ,
                        storage_method = VALUES(storage_method) ,
                        manufacture_day = VALUES(manufacture_day) ,
                        manufacture_month = VALUES(manufacture_month) ,
                        manufacture_year = VALUES(manufacture_year) ,
                        cert_confirmed_at = VALUES(cert_confirmed_at) ,
                        is_delete = 'n' ,
                        updated_by = VALUES(updated_by) ,
                        updated_at = now() "; */

            $this->db->query($sql, array());

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }


    public function insert_bi04_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi04
                (
                    biz_no ,
                    `cert` ,
                    patent ,
                    iso ,
                    fda ,
                    halal,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['cert'] . "' , 
                            '" . $row['patent'] . "' , 
                            '" . $row['iso'] . "' , 
                            '" . $row['fda'] . "' , 
                            '" . $row['halal'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        `cert` = VALUES(`cert`),
                        patent  = VALUES(patent) ,
                        iso = VALUES(iso) ,
                        fda = VALUES(fda) ,
                        halal = VALUES(halal) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
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

    public function insert_bi05_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi05
                (
                    biz_no ,
                    manufacture_day ,
                    manufacture_month ,
                    manufacture_year ,
                    load_cnt ,
                    model_lines ,
                    machine_pack ,
                    machine_etc ,
                    machine_detector ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['manufacture_day'] . "' , 
                            '" . $row['manufacture_month'] . "' , 
                            '" . $row['manufacture_year'] . "' , 
                            '" . $row['load_cnt'] . "' , 
                            '" . $row['model_lines'] . "' , 
                            '" . $row['machine_pack'] . "' , 
                            '" . $row['machine_etc'] . "' , 
                            '" . $row['machine_detector'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        manufacture_day = VALUES(manufacture_day),
                        manufacture_month = VALUES(manufacture_month) ,
                        manufacture_year = VALUES(manufacture_year) ,
                        load_cnt = VALUES(load_cnt) ,
                        model_lines = VALUES(model_lines) ,
                        machine_pack = VALUES(machine_pack) ,
                        machine_etc = VALUES(machine_etc) ,
                        machine_detector = VALUES(machine_detector) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
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

    public function insert_bi06_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi06
                (
                    biz_no ,
                    channel_cnt ,
                    channel_name ,
                    nb_export_nation ,
                    oem_export_nation ,
                    oem_company ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['channel_cnt'] . "' , 
                            '" . $row['channel_name'] . "' , 
                            '" . $row['nb_export_nation'] . "' , 
                            '" . $row['oem_export_nation'] . "' , 
                            '" . $row['oem_company'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        channel_cnt = VALUES(channel_cnt),
                        channel_name = VALUES(channel_name) ,
                        nb_export_nation = VALUES(nb_export_nation) ,
                        oem_export_nation = VALUES(oem_export_nation) ,
                        oem_company = VALUES(oem_company) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
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

    public function insert_bi07_list($req)
    {
        $this->db->trans_begin();

        $sql = "INSERT INTO tb_admin_bi07
                (
                    biz_no ,
                    export_nation ,
                    confirmed_at ,
                    is_delete ,
                    created_by ,
                    created_at ,
                    updated_by ,
                    updated_at
                )
                VALUES ";

            $vals = array();
            foreach($req as $row) {
                $vals[] = "(
                            '" . $row['biz_no'] . "' , 
                            '" . $row['export_nation'] . "' , 
                            '" . $row['confirmed_at'] . "' , 
                            'n' ,
                            '" . $row['admin_id'] . "' , 
                            now() ,
                            '" . $row['admin_id'] . "' , 
                            now()
                    ) ";
            }

            $sql .= implode($vals, ',');
            $sql .= " ON DUPLICATE KEY UPDATE 
                        export_nation = VALUES(export_nation) ,
                        confirmed_at = VALUES(confirmed_at) ,
                        is_delete = 'n' ,
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





    public function insert_overseas_bi01($nation_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('company_name', $req[0]);
        $this->db->set('ceo_name', $req[1]);
        $this->db->set('category', $req[2]);
        $this->db->set('category_hscode', $req[3]);
        $this->db->set('main_product', (strtolower($req[11]) === 'x' ? '' : $req[11]));
        $this->db->set('main_nation', (strtolower($req[12]) === 'x' ? '' : $req[12]));
        $this->db->set('korea_relation', (strtolower($req[13]) === 'x' ? '' : strtolower($req[13])));
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_bi00');
        $seq = $this->db->insert_id();

        $this->db->set('buyer_seq', $seq);
        $this->db->set('buy_nation', '');
        $this->db->set('buy_product', '');
        $this->db->set('desc', (strtolower($req[7]) === 'x' ? '' : strtolower($req[7])));
        $this->db->set('trade_condition', (strtolower($req[8]) === 'x' ? '' : strtolower($req[8])));
        $this->db->set('trade_volume', (strtolower($req[9]) === 'x' ? '' : strtolower($req[9])));
        $this->db->set('contact', (strtolower($req[14]) === 'x' ? '' : strtolower($req[14])));
        $this->db->set('trade_staff', (strtolower($req[15]) === 'x' ? '' : strtolower($req[15])));
        $this->db->set('available_period', (strtolower($req[5]) === 'x' ? '' : strtolower($req[5])));
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_bi01');

        $this->db->set('relation_type', '1');
        $this->db->set('source_seq',  $seq);
        $this->db->set('target_seq', $nation_seq);
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->insert('tb_overseas_relation');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function insert_overseas_ni02($nation_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_name', $req[1]);
        $this->db->set('hs_code', $req[2]);
        $this->db->set('product_price', $req[3]);
        $this->db->set('order_no', $req[0]);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_ni02');
        $seq = $this->db->insert_id();

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function insert_overseas_ei00($nation_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_name', $req[0]);
        $this->db->set('hscode', $req[1]);
        $this->db->set('desc', $req[2]);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_ei00');
        $seq = $this->db->insert_id();

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function insert_overseas_mi01($nation_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_seq', '0');
        $this->db->set('title', $req[0]);
        $this->db->set('url_link', $req[1]);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_mi01');
        $seq = $this->db->insert_id();

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }


    public function insert_overseas_pi00($nation_seq, $req)
    {
        $sql = "select
                    product_seq
                from
                    tb_overseas_pi00
                where
                    hscode = ? ";
        $res = $this->db->query($sql, array($req[2]))->row_array();

        $this->db->trans_begin();

        $seq = '';
        if(empty($res)) {
            $name = explode(' ', $req[0]);
            $this->db->set('product_name', $name[0]);
            $this->db->set('product_name_eng', $name[1]);
            $this->db->set('hscode', $req[2]);
            $this->db->set('desc', $req[1]);
            $this->db->set('created_by', 'admin');
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', 'admin');
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_overseas_pi00');
            $seq = $this->db->insert_id();
        }
        else {
            $seq = $res['product_seq'];
        }


        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_seq', $seq);
        $this->db->set('hscode', $req[3]);
        $this->db->set('tax_rate', $req[4]);
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_pi01');
        $seq = $this->db->insert_id();

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}

    }

    public function insert_overseas_pi02($nation_seq, $product_seq, $req)
    {
        $this->db->trans_begin();

        $tmp = nl2br($req[0]);
        $hscode = explode('<br />', $tmp);
        for($i = 0; $i < count($hscode); $i++) {
            $tmp3 = explode('-', $hscode[$i]);
            if(count($tmp3) !== 2) {
                $hscode[$i - 1] = $hscode[$i - 1] . PHP_EOL . $hscode[$i];
                $hscode[$i] = '';
            }
        }
        print_r($hscode);
        echo '<br>';


        foreach($hscode as $row) {
            if(empty($row)) continue;
            $tmp2 = explode('-', $row);
            print_r($tmp2);
            $this->db->set('nation_seq', $nation_seq);
            $this->db->set('product_seq', $product_seq);
            $this->db->set('hscode', trim($tmp2[0]));
            $this->db->set('desc', trim($tmp2[1]));
            $this->db->set('is_delete', 'n');
            $this->db->set('created_by', 'admin');
            $this->db->set('created_at', 'now()', false);
            $this->db->set('updated_by', 'admin');
            $this->db->set('updated_at', 'now()', false);
            $this->db->insert('tb_overseas_pi02');
        }

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		} 

    }    

    public function insert_overseas_ei01($nation_seq, $product_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_seq', $product_seq);
        $this->db->set('product_name', trim($req[1]));
        $this->db->set('hscode', trim($req[2]));
        $this->db->set('title', trim($req[3]));
        $this->db->set('desc', trim($req[4]));
        $this->db->set('document', trim($req[5]));
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_ei01');

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		} 

    }    

    public function insert_overseas_ei02($nation_seq, $product_seq, $req)
    {
        $this->db->trans_begin();

        $this->db->set('nation_seq', $nation_seq);
        $this->db->set('product_seq', $product_seq);
        $this->db->set('nation_name', trim($req[1]));
        $this->db->set('hscode', trim($req[2]));
        $this->db->set('law', trim($req[3]));
        $this->db->set('desc', trim($req[4]));
        $this->db->set('is_delete', 'n');
        $this->db->set('created_by', 'admin');
        $this->db->set('created_at', 'now()', false);
        $this->db->set('updated_by', 'admin');
        $this->db->set('updated_at', 'now()', false);
        $this->db->insert('tb_overseas_ei02');

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