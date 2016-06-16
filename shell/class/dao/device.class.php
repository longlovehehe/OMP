<?php

/**
 * 设备实体类
 * @category OMP
 * @package OMP_Device_dao
 * @require {@see db}
 */
/**
 * 设备管理Model
 * @category  管理员管理
 * @package 设备管理
 * @subpackage  Model层
 */
class device extends db {

	public function __construct($data) {
		parent::__construct();
		$this->data = $data;
	}

	public function updateStatus($data) {
		if ($data[1] == '') {
			throw new Exception('device_id is null or device_status is null', -1);
		}

		$sql = 'UPDATE "T_Device" SET d_status=? WHERE d_id=?';
		$sth = $this->pdo->prepare($sql);
		try
		{
			$sth->execute($data);
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), -1);
		}

	}

	public function refreshList() {
		$list = implode(",", $this->data["checkbox"]);
		$sql = 'SELECT d_id FROM "T_Device" WHERE d_id IN(:list) AND (d_status = 0 OR d_status = 2)';
		$sql = str_replace(':list', $list, $sql);
		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$resultlist = array();
		foreach ($result as $value) {
			$resultlist[] = $value['d_id'];
		}

		$resultliststr = implode(',', $resultlist);

		if ($resultliststr == "") {
			throw new Exception(L("没有一项状态为处理失败或处理中的项"), -1);
		}

		$sql = 'UPDATE "T_Device" SET d_status = 0 WHERE d_id IN (:d_id)';
		$sql = str_replace(':d_id', $resultliststr, $sql);
		$this->pdo->query($sql);
		foreach ($resultlist as $value) {
			$log = DL('刷新了'.$_SESSION['ident'].'-Server设备状态 ID：【%s】');
			$log = sprintf($log
				, $value);
			$this->log($log, 2, 0);
		}

		return $resultlist;
	}

	function getDeviceWhere($order = FALSE) {
		/*
		if (trim((int) $this->data["d_id"]) > 0) {
		$where .= "AND TEXT(d_id) LIKE '%" . (int) $this->data["d_id"]."%'";
		}
		 */
		if ($this->data["d_id_self"] != "") {
			$where .= " AND d_id !=".$this->data["d_id_self"];
		}
		if ($this->data["d_id"] != "") {
			$where .= " AND TEXT(d_id) LIKE '%" . addslashes($this->data["d_id"]) . "%'";
		}
		if ($this->data["d_sip_port"] != "") {
			$where .= " AND d_sip_port = '" . addslashes($this->data["d_sip_port"]) . "'";
		}

		if ($this->data["d_name"] != "") {
			$where .= " AND d_name LIKE '%" . addslashes($this->data["d_name"]) . "%'";
		}

		if ($this->data['d_area'] != '') {
			$area = new area();
			$where .= " ".$area->getAcl('d_area', $this->data["d_area"]);
		}

		if ($this->data["d_ip1"] != "") {
			$where .= " AND d_ip1 LIKE '%" . addslashes($this->data["d_ip1"]) . "%'";
		}
		if ($this->data["d_ip2"] != "") {
			$where .= " AND d_ip2 LIKE '%" . addslashes($this->data["d_ip2"]) . "%'";
		}
		if ($this->data["d_status"] != "") {
			if ($this->data["d_status"] == "0" || $this->data["d_status"] == "1") {
				$where .= " AND d_status = '" . $this->data["d_status"] . "'";
			} else {
				$where .= " AND d_status NOT IN(0,1)";
			}
		}
		if ($this->data['d_deployment_id'] != '') {
			$where .= " AND d_deployment_id = '" . $this->data["d_deployment_id"] . "'";
		}
		if ($order) {
			$where .= ' ORDER BY d_id';
		}

		return $where;
	}

	public function getMDSListOption() {
		$sql = <<<ECHO
SELECT
	d_name,
	d_id,
	d_ip1,
        d_ip2,                
	d_user,
	d_call,
                   d_phone_user,
                   d_dispatch_user,
                   d_gvs_user,
                   d_deployment_id,
	d_user - sum_user AS diff_user,
	d_call - sum_call AS diff_call,
	d_phone_user - sum_phone AS diff_phone,
	d_dispatch_user - sum_dispatch AS diff_dispatch,
	d_gvs_user - sum_gvs AS diff_gvs,
	sum_phone AS sum_phone,
	sum_dispatch AS sum_dispatch,
	sum_gvs AS sum_gvs
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_mds_id,
		SUM (e_mds_users) AS sum_user,
		SUM (e_mds_call) AS sum_call,
		SUM (e_mds_phone) AS sum_phone,
		SUM (e_mds_dispatch) AS sum_dispatch,
		SUM (e_mds_gvs) AS sum_gvs
	FROM
		"T_Enterprise"
	GROUP BY
		e_mds_id
) AS device ON e_mds_id = d_id
WHERE
	d_type = 'mds'
AND d_status = 1
ECHO;
		$sql .= $this->getDeviceWhere();

		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $key => $value) {
			$result[$key]["diff_user"] = ($value["diff_user"] === NULL) ? $value["d_user"] : $value["diff_user"];
			$result[$key]["diff_call"] = ($value["diff_call"] === NULL) ? $value["d_call"] : $value["diff_call"];
			$result[$key]["diff_phone"] = ($value["diff_phone"] === NULL) ? $value["d_phone_user"] : $value["diff_phone"];
			$result[$key]["diff_dispatch"] = ($value["diff_dispatch"] === NULL) ? $value["d_dispatch_user"] : $value["diff_dispatch"];
			$result[$key]["diff_gvs"] = ($value["diff_gvs"] === NULL) ? $value["d_gvs_user"] : $value["diff_gvs"];
		}
		return $result;
	}

	public function getMDSListOption1() {
		$sql = <<<ECHO
SELECT
	d_name,
	d_id,
	d_ip1,
        d_ip2,                
	d_user,
	d_call,
                   d_phone_user,
                   d_dispatch_user,
                   d_gvs_user,
                   d_deployment_id,
	d_user - sum_user AS diff_user,
	d_call - sum_call AS diff_call,
	d_phone_user - sum_phone AS diff_phone,
	d_dispatch_user - sum_dispatch AS diff_dispatch,
	d_gvs_user - sum_gvs AS diff_gvs,
	sum_phone AS sum_phone,
	sum_dispatch AS sum_dispatch,
	sum_gvs AS sum_gvs
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_mds_id,
		SUM (e_mds_users) AS sum_user,
		SUM (e_mds_call) AS sum_call,
		SUM (e_mds_phone) AS sum_phone,
		SUM (e_mds_dispatch) AS sum_dispatch,
		SUM (e_mds_gvs) AS sum_gvs
	FROM
		"T_Enterprise"
	GROUP BY
		e_mds_id
) AS device ON e_mds_id = d_id
WHERE
	d_type = 'mds'
AND d_status = 1
ECHO;

		$aDevice = $this->getByid();
		// $aDevice['d_area'] = '["1436463855","1436463833"]';
		if($aDevice['d_area'] == '["#"]')
		{
			// $sql .= " AND d_area = '[\"#\"]'";
			$selectarea = "select am_id from \"T_AreaManage\"";
			$area = $this->pdo->query($selectarea);
			$aArea = $area->fetchAll(PDO::FETCH_ASSOC);
			if(!empty($aArea))
			{
				$areas = "";
				foreach ($aArea as $key => $value) {
					if($key == 0)
					{
						$areas .= "d_area like '%".$value["am_id"]."%'";
					}
					else
					{
						$areas .= " and d_area like '%".$value["am_id"]."%'";
					}
				}
				
			}
			$sql .= " AND d_id !='".$this->data['d_id']."' AND (d_area = '[\"#\"]' or (".$areas."))";
		}
		else //大于等于当前区域
		{
			$areas = str_replace("[", "", $aDevice['d_area']);
			$areas = str_replace("]", "", $areas);
			$areas = str_replace('"', '', $areas);
			$aArea = explode(",", $areas);
			$where = "";
			if(!empty($aArea))
			{
				foreach ($aArea as $key => $value) {
					if($key == 0)
					{
						$where .= "(d_area like '%".$value."%'";
					}
					else
					{
						$where .= " AND d_area like '%".$value."%'";
					}
					
				}
				$where .=")";
			}
			//$sql .= " AND (d_area = '[\"#\"]' or ".$where.")";
			$sql .= " AND d_id !='".$this->data['d_id']."' AND (d_area = '[\"#\"]' or ".$where.")";
		}

		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $key => $value) {
			$result[$key]["diff_user"] = ($value["diff_user"] === NULL) ? $value["d_user"] : $value["diff_user"];
			$result[$key]["diff_call"] = ($value["diff_call"] === NULL) ? $value["d_call"] : $value["diff_call"];
			$result[$key]["diff_phone"] = ($value["diff_phone"] === NULL) ? $value["d_phone_user"] : $value["diff_phone"];
			$result[$key]["diff_dispatch"] = ($value["diff_dispatch"] === NULL) ? $value["d_dispatch_user"] : $value["diff_dispatch"];
			$result[$key]["diff_gvs"] = ($value["diff_gvs"] === NULL) ? $value["d_gvs_user"] : $value["diff_gvs"];
		}
		return $result;
	}
	public function getMDSList($limit = '') {
		$sql = <<<ECHO
                SELECT
	d_name,
	d_id,
	d_ip1,
	d_ip2,
	d_user,
	d_call,
                   d_phone_user,
                   d_dispatch_user,
                   d_gvs_user,
                   d_deployment_type,
                   d_network_type,
                   d_deployment_id,
                	d_space,
	d_space_free,
	d_audiorec,
	d_videorec,
	d_max_rec_files,
	d_area,
	d_status,
                   d_sip_port,
	d_user - sum_user AS diff_user,
	d_call - sum_call AS diff_call,
	d_phone_user - sum_phone AS diff_phone,
	d_dispatch_user - sum_dispatch AS diff_dispatch,
	d_gvs_user - sum_gvs AS diff_gvs,
	(
		SELECT
			"T_Dev_Cluster".cluster_name
		FROM
			"T_Dev_Cluster"
		WHERE
			(
				"T_Dev_Cluster".cluster_id = d_deployment_id
			)
	) AS cluster_name
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_mds_id,
		SUM (e_mds_users) AS sum_user,
		SUM (e_mds_call) AS sum_call,
		SUM (e_mds_phone) AS sum_phone,
		SUM (e_mds_dispatch) AS sum_dispatch,
		SUM (e_mds_gvs) AS sum_gvs
	FROM
		"T_Enterprise"
	GROUP BY
		e_mds_id
) AS device ON e_mds_id = d_id
WHERE
	d_type = 'mds'
ECHO;
		$sql .= $this->getDeviceWhere(TRUE);
		$sql .= $limit;

		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll();

		foreach ($result as &$val) {
			$val['status'] = $this->getStatus($val['d_id'], "e_mds_id", $val["d_area"]);
		}

		return $result;
	}

	public function del() {
		$data = $this->getByid();

		$sql = 'DELETE FROM "T_Device"WHERE"T_Device".d_id =:d_id';
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':d_id', $this->data["d_id"], PDO::PARAM_INT);

		$sth->execute();
		if($data['d_type'] == 'mds')
		{
			$type = "SERVER";
		}
		else if($data['d_type'] == 'rs')
		{
			$type = "RS";
		}
		else if($data['d_type'] == 'ss')
		{
			$type = "SS";
		}
		$log = DL('删除'.$_SESSION['ident'].'-【%s】设备成功 ID：【%s】设备地址【%s】，设备端口【%s】，映射地址【%s】，映射端口【%s】，区域【%s】');
		$log = sprintf($log
			, $type
			, $data["d_id"]
			, $data["d_ip1"]
			, $data["d_port1"]
			, $data["d_ip2"]
			, $data["d_port2"]
			, mod_area_name($data['d_area'])
		);
		$this->log($log, 2, 1);
	}

	public function delMDSList() {
		$count = 0;
		if (!empty($this->data['checkbox'])) {
			foreach ($this->data['checkbox'] as $value) {
				$count++;
				$data['d_id'] = $value;
				$this->set($data);
				$this->del();
			}
		}
		return $count;
	}

	public function getMDSTotal($type='mds') {
		$sql = 'SELECT COUNT(d_id)AS total FROM"public"."T_Device" WHERE "T_Device".d_type = \''.$type.'\'';
		$sql = $sql . $this->getDeviceWhere();
		$pdoStatement = $this->pdo->query($sql);
		$result = $pdoStatement->fetch();
		return $result["total"];
	}

	

	// public function delVCRList($list) {
	// 	$list = rtrim($list, ", ");

	// 	$sql = 'DELETE FROM "T_Device"WHERE"T_Device".d_id IN (' . $list . ') AND "T_Device".d_type = \'vcr\'';
	// 	$count = $this->pdo->exec($sql);
	// 	return $count;
	// }

	// public function getVCRTotal() {
	// 	$sql = 'SELECT COUNT(d_id)AS total FROM"public"."T_Device" WHERE(("T_Device".d_type) :: TEXT = \'vcr\' :: TEXT)';
	// 	$sql = $sql . $this->getVCRWhere();
	// 	$pdoStatement = $this->pdo->query($sql);
	// 	$result = $pdoStatement->fetch();
	// 	return $result["total"];
	// }

	function makeSEQ() {
		$seqname = "t_device_:d_id_seq";
		$seqname = str_replace(":d_type", $this->data["d_type"], $seqname);
		$seqname = str_replace(":d_id", $this->data["d_id"], $seqname);

		$sql = "CREATE SEQUENCE :seqname START 100000 MAXVALUE 999999;";
		$sql = str_replace(":seqname", $seqname, $sql);
		try
		{
			$this->pdo->exec($sql);
		} catch (Exception $e) {
			throw new Exception("seq create fail" . $e->getMessage(), -1);
		}
	}

	//->VCR-S
	// function getVCRSWhere() {
	// 	//$where = " WHERE 1=1 ";
	// 	if ($this->data["d_id"] != "") {
	// 		$where .= "AND d_id = " . $this->data["d_id"];
	// 	}

	// 	if ($this->data["d_name"] != "") {
	// 		$where .= "AND d_name LIKE '%" . $this->data["d_name"] . "%'";
	// 	}

	// 	if ($this->data["d_area"] != "") {
	// 		$where .= "AND d_area = " . $this->data["d_area"];
	// 	}

	// 	if ($this->data["d_ip"] != "") {
	// 		$where .= "AND d_ip1 LIKE '%" . $this->data["d_ip"] . "%'";
	// 		$where .= "OR d_ip2 LIKE '%" . $this->data["d_ip"] . "%'";
	// 	}

	// 	if ($this->data["d_status"] != "") {
	// 		$where .= "AND d_status = " . $this->data["d_status"];
	// 	}

	// 	return $where;
	// }

	// public function getVCRSList($limit) {
	// 	$sql = 'SELECT
 //                    "T_Device".d_id,
 //                    "T_Device".d_ip1,
 //                    "T_Device".d_port1,
 //                    "T_Device".d_ip2,
 //                    "T_Device".d_port2,
 //                    "T_Device".d_name,
 //                    "T_Device".d_area,
 //                    "T_Device".d_type,
 //                    "T_Device".d_user,
 //                    "T_Device".d_call,
 //                    "T_Device".d_space,
 //                    "T_Device".d_space_free,
 //                    "T_Device".d_audiorec,
 //                    "T_Device".d_videorec,
 //                    "T_Device".d_max_rec_files,
 //                    "T_AreaManage".am_name,
 //                    "T_Device".d_status
 //            FROM
 //                    (
 //                            "T_Device"
 //                            LEFT JOIN "T_AreaManage" ON (
 //                                    (
 //                                            "T_AreaManage".am_id = "T_Device".d_area
 //                                    )
 //                            )
 //                    )
 //            WHERE
 //                  "T_Device".d_type = \'vcrs\'';

	// 	$areaid = $this->getArea();
	// 	if ($areaid) {
	// 		$sql = $sql . $this->getVCRSWhere() . "and d_area in($areaid)";
	// 	} else {
	// 		$sql = $sql . $this->getVCRSWhere();
	// 	}

	// 	$sql = $sql . $limit;

	// 	$stat = $this->pdo->query($sql);
	// 	$result = $stat->fetchAll();

	// 	return $result;
	// }

	// public function delVCRSList($list) {
	// 	$list = rtrim($list, ", ");
	// 	$sql = 'DELETE FROM "T_Device"WHERE"T_Device".d_id IN (' . $list . ') AND "T_Device".d_type = \'vcrs\'';
	// 	$count = $this->pdo->exec($sql);
	// 	return $count;
	// }

	// public function getVCRSTotal() {
	// 	$sql = 'SELECT COUNT(d_id)AS total FROM"public"."T_Device" WHERE(("T_Device".d_type) :: TEXT = \'vcrs\' :: TEXT)';
	// 	$sql = $sql . $this->getDeviceWhere();
	// 	$pdoStatement = $this->pdo->query($sql);
	// 	$result = $pdoStatement->fetch();
	// 	return $result["total"];
	// }

	public function getSEQ() {
		$sql = 'SELECT nextval(\'"T_Device_d_id_seq"\'::regclass)';
		$sth = $this->pdo->query($sql);
		$result = $sth->fetch();
		return $result["nextval"];
	}

    /**
     * 增加设备区域
     * @return type
     * @throws Exception
     */
    public function up_area() {

            $d_area1 = $_REQUEST["d_area"];
            $d_area_diff = $_REQUEST["d_area_diff"];
            if ($d_area_diff == "") {
                    $msg["status"] = 0;
                    $msg["msg"] = L("未增加任何区域");
                    return $msg;
            }
            $d_id = $_REQUEST["d_id"];
            //获得全部的区域 判断所选区域是否和全部的区域相同
            $area = new area();
            $Res=$area->getAllList();
            $area_arr=array();
            foreach ($Res as $key => $value) {
                $area_arr[]=$value['am_id'];
            }
            $d_area = json_encode($d_area1);
            $d_area_diff = json_encode($d_area_diff);
            if (!(substr_count($d_area, ']') > 0)) {

            }
            $sql = 'UPDATE "T_Device" SET d_area = :d_area WHERE d_id = :d_id';
            if (substr_count($d_area, '#') > 0) {
                    $d_area = '["#"]';
            }else{
                 if(count($area_arr)==count($d_area1)){
                     $d_area = '["#"]';
                }
            }

            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':d_area', $d_area, PDO::PARAM_INT);
            $sth->bindValue(':d_id', $d_id, PDO::PARAM_INT);
            try
            {
                    $sth->execute();
            } catch (Exception $ex) {
                    throw new Exception($ex->getMessage(), $ex->getCode());
            }
            $msg["status"] = 0;
            $log = DL('增加'.$_SESSION['ident'].'-Server设备区域【%s】');
            $log = sprintf($log
                    , mod_area_name($d_area_diff)
            );
            $this->log($log, 2, 0);
            $msg["msg"] = L('增加'.$_SESSION['ident'].'-Server设备区域【%s】');
            $msg["msg"] = sprintf($msg["msg"]
                    , mod_area_name($d_area_diff)
            );
            return $msg;
    }
	public function getDevice($aKey,$edit)
	{
		$sql = "select * from \"T_Device\" ";
		if($edit)
		{
			$where = "where d_id != '".$aKey['d_id']."'";
		}
		else
		{
			$where  = "where 1=1";
		}
		if(!empty($aKey))
		{
			foreach ($aKey as $key => $value) {
				if($key != 'd_id')
				{
					$where .= " and ".$key." = '".$value."'";
				}
					
			}
		}
		$sql .= $where;
		// echo $sql."<br>";die;
		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		if($result)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function save() {
		$edit = false;
		$jsonarea = '';
		if ($this->data["d_id"] != "") {
			$aKey['d_id'] = $this->data['d_id'];
			$edit = true;
		}
		//相同设备类型、相同IP、相同网络类型的设备只允许添加一个
		$aKey['d_ip1'] = $this->data['d_ip1'];
		$aKey['d_ip2'] = $this->data['d_ip2'];
		$aKey['d_type'] = $this->data['d_type'];
		$aKey['d_network_type'] = $this->data['d_network_type'];
		$aRes = $this->getDevice($aKey,$edit);
		if(!$aRes)
		{
			throw new Exception('存在内网ip和外网ip相同的设备，请重新添加');
		}
                /*
		$aKey['d_ip1'] = $this->data['d_ip1'];
		$aKey['d_ip2'] = $this->data['d_ip2'];
		$aKey['d_type'] = $this->data['d_type'];
		$aKey['d_deployment_id'] = $this->data['d_deployment_id'];
		$aRes = $this->getDevice($aKey,$edit);
		if(!$aRes)
		{
			throw new Exception('存在内网ip和外网ip相同的设备，请重新添加');
		}
*/
		
		if ($edit) {
			if($this->data["d_type"] == 'mds')
			{
				$sql = 'UPDATE "T_Device" SET d_ip1 = :d_ip1,d_port1 = :d_port1,d_ip2 = :d_ip2,d_port2 = :d_port2,d_name = :d_name,d_area = :d_area,d_type = :d_type,d_network_type = :d_network_type,d_deployment_id=:d_deployment_id,d_deployment_type=:d_deployment_type WHERE d_id = :d_id';
			} 
			else
			{
				$sql = 'UPDATE "T_Device" SET d_ip1 = :d_ip1,d_ip2 = :d_ip2,d_name = :d_name,d_type = :d_type,d_network_type = :d_network_type,d_deployment_id=:d_deployment_id,d_deployment_type=:d_deployment_type WHERE d_id = :d_id';
			}
						
		} else {

				$sql = 'INSERT INTO "public"."T_Device" (d_id,"d_ip1", "d_port1", "d_ip2", "d_port2","d_name", "d_area", "d_type","d_network_type","d_deployment_id","d_deployment_type") VALUES (:d_id,:d_ip1,:d_port1 ,:d_ip2 ,:d_port2 ,:d_name,:d_area,:d_type,:d_network_type,:d_deployment_id,:d_deployment_type)';
				$this->data["d_id"] = $this->getSEQ();
			
		}

		if($this->data["d_area"])
		{
			$d_area = json_encode($this->data["d_area"]);
			if (substr_count($jsonarea, '#') > 0) {
				$d_area = '["#"]';
			}
		}
		

		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':d_ip1', $this->data["d_ip1"], PDO::PARAM_STR);
		if($this->data["d_port1"])
		{
			$sth->bindValue(':d_port1', $this->data["d_port1"], PDO::PARAM_STR);
		}
		$sth->bindValue(':d_ip2', $this->data["d_ip2"], PDO::PARAM_STR);
		if($this->data["d_port2"])
		{
			$sth->bindValue(':d_port2', $this->data["d_port2"], PDO::PARAM_STR);
		}
		$sth->bindValue(':d_name', $this->data["d_name"], PDO::PARAM_STR);
		if($this->data["d_area"])
		{
			$sth->bindValue(':d_area', $d_area, PDO::PARAM_INT);
		}
		$sth->bindValue(':d_type', $this->data["d_type"], PDO::PARAM_STR);
		$sth->bindValue(':d_network_type', $this->data["d_network_type"], PDO::PARAM_INT);
		$sth->bindValue(':d_deployment_id', $this->data["d_deployment_id"], PDO::PARAM_INT);
		$sth->bindValue(':d_deployment_type', $this->data["d_deployment_type"], PDO::PARAM_INT);
		$sth->bindValue(':d_id', $this->data["d_id"], PDO::PARAM_INT);

		try
		{
			//$info = $this->getByid ();
			$sth->execute();
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
		$msg["status"] = 0;
        // if($this->data["d_ip2"]==""){
        //     $info="";
        // }else{
          	$info="设备内网IP【{$this->data["d_ip1"]}】，";
        // }
        if($this->data['d_type'] == 'mds')
		{
			$type = "SERVER";
		}
		else if($this->data['d_type'] == 'rs')
		{
			$type = "RS";
		}
		else if($this->data['d_type'] == 'ss')
		{
			$type = "SS";
		}
		if ($edit) 
		{
        	$log = DL("修改".$_SESSION["ident"]."-【%s】设备成功 ID：【%s】，内网地址【%s】，外网地址【%s】");
    		$msg["msg"] = L("修改".$_SESSION["ident"]."-【%s】设备成功 ID：【%s】，内网地址【%s】，外网地址【%s】");
			$msg["msg"] = sprintf($msg["msg"]
				, $type
				, $this->data["d_id"]
				, $this->data["d_ip1"]
				, $this->data["d_ip2"]
				, mod_area_name($d_area)
			);
            $log = sprintf($log
            		, $type
                    , $this->data["d_id"]
                    , $this->data["d_ip1"]
                    , $this->data["d_ip2"]
                    , mod_area_name($d_area)
            );

		}
		else 
		{
      		$log = DL("添加".$_SESSION["ident"]."-【%s】设备成功 ID：【%s】，内网地址【%s】，外网地址【%s】");
			$msg["msg"] = L("添加".$_SESSION["ident"]."-【%s】设备成功 ID：【%s】，内网地址【%s】，外网地址【%s】");
			$msg["msg"] = sprintf($msg["msg"]
				, $type
				, $this->data["d_id"]
				, $this->data["d_ip1"]
				, $this->data["d_ip2"]
				, mod_area_name($d_area)
			);
                $log = sprintf($log
                    , $type
                    , $this->data["d_id"]
                    , $this->data["d_ip1"]
                    , $this->data["d_ip2"]
                    , mod_area_name($d_area)
            );
          
		}
		$this->log($log, 2, 0);

		return $msg;
	}

	public function getByid() {
		$sql = 'SELECT * FROM "T_Device" WHERE d_id = :d_id';
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(":d_id", $this->data["d_id"], PDO::PARAM_INT);
		$sth->execute();
		$data = $sth->fetch();
		return $data;
	}

	public function GetJsonByMDSId() {
		$sql = 'SELECT * FROM "T_Device" WHERE d_id = :d_id';
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':d_id', $this->data["d_id"], PDO::PARAM_INT);

		$sth->execute();

		$data = $sth->fetch();
		$sql = <<<ECHO
SELECT
	d_name,
	d_id,
	d_ip1,
	d_ip2,
	d_user,
	d_call,
                   d_phone_user,
                   d_dispatch_user,
                   d_gvs_user,
                   sum_phone,
                   sum_dispatch,
                   sum_gvs,
	d_user - sum_user AS diff_user,
	d_call - sum_call AS diff_call,
                   d_phone_user - sum_phone AS diff_phone,
	d_dispatch_user - sum_dispatch AS diff_dispatch,
	d_gvs_user - sum_gvs AS diff_gvs
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_mds_id,
		SUM (e_mds_users) AS sum_user,
		SUM (e_mds_call) AS sum_call,
                                      SUM (e_mds_phone) AS sum_phone,
		SUM (e_mds_dispatch) AS sum_dispatch,
		SUM (e_mds_gvs) AS sum_gvs
	FROM
		"T_Enterprise"
	GROUP BY
		e_mds_id
) AS t2 ON e_mds_id = d_id
WHERE
	d_type = 'mds'
AND d_status = 1
AND d_id = :d_id
ECHO;
		$sql .= $this->getDeviceWhere();

		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':d_id', $this->data["d_id"], PDO::PARAM_INT);

		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$result["diff_user"] = ($result["diff_user"] === NULL) ? $result["d_user"] : $result["diff_user"];
		$result["diff_call"] = ($result["diff_call"] === NULL) ? $result["d_call"] : $result["diff_call"];
		return $result;
	}

	public function get() {
		return $this->data;
	}

	public function set($data) {
		$this->data = $data;
	}

	//获取设备id用于判断是否已使用
	private function getStatus($id, $type, $d_area) {
		$sql = "SELECT \"e_mds_id\" FROM \"T_Enterprise\" WHERE $type = $id ";
		$sth = $this->pdo->query($sql);
		$list = $sth->fetchAll();
		//if (count($list) != 0 && $d_area == '["#"]') {
		if (count($list) != 0) {
			return "yes";
		} else {
			return "no";
		}
	}

	//根据登陆的管理员获取管理地区id
	private function getArea() {
		if (!empty($_SESSION['own']['om_area']) || $_SESSION['own']['om_area'] != 0) {
			$areaid = str_replace("|", ",", trim($_SESSION['own']['om_area'], "|"));
			return $areaid;
		} else {
			return false;
		}
	}
        /*
         * 作者 hongyuan.li
         * 时间 2015.7.29
         * 功能 rs设备添加、编辑
         */
        
        public function rs_save() {
			$edit = false;
			$jsonarea = '';
			if ($this->data["d_id"] != "") {
				$edit = true;
			}
			if ($edit) {
				$sql = 'UPDATE "T_Device"SET d_ip1 = :d_ip1,d_port1 = :d_port1,d_ip2 = :d_ip2,d_port2 = :d_port2,d_name = :d_name,d_area = :d_area,d_type = :d_type,d_network_type = :d_network_type WHERE d_id = :d_id';
			} else {
				$sql = 'INSERT INTO "public"."T_Device" (d_id,"d_ip1", "d_port1", "d_ip2", "d_port2","d_name", "d_area", "d_type","d_network_type") VALUES (:d_id,:d_ip1,:d_port1 ,:d_ip2 ,:d_port2 ,:d_name,:d_area,:d_type,:d_network_type)';
				$this->data["d_id"] = $this->getSEQ();
			}

			$d_area = json_encode($this->data["d_area"]);
			if (substr_count($jsonarea, '#') > 0) {
				$d_area = '["#"]';
			}

			$sth = $this->pdo->prepare($sql);
			$sth->bindValue(':d_ip1', $this->data["d_ip1"], PDO::PARAM_STR);
			$sth->bindValue(':d_port1', $this->data["d_port1"], PDO::PARAM_STR);
			$sth->bindValue(':d_ip2', $this->data["d_ip2"], PDO::PARAM_STR);
			$sth->bindValue(':d_port2', $this->data["d_port2"], PDO::PARAM_STR);
			$sth->bindValue(':d_name', $this->data["d_name"], PDO::PARAM_STR);
			$sth->bindValue(':d_area', $d_area, PDO::PARAM_INT);
			$sth->bindValue(':d_type', $this->data["d_type"], PDO::PARAM_STR);
			$sth->bindValue(':d_network_type', $this->data["d_network_type"], PDO::PARAM_INT);
			$sth->bindValue(':d_id', $this->data["d_id"], PDO::PARAM_INT);

			try
			{
				//$info = $this->getByid ();
				$sth->execute();
			} catch (Exception $ex) {
				throw new Exception($ex->getMessage(), $ex->getCode());
			}
			$msg["status"] = 0;
            if($this->data["d_ip2"]==""){
                $info="";
            }else{
                $info="设备内网IP【{$this->data["d_ip2"]}】，设备内网端口【{$this->data["d_port2"]}】，";
            }
			if ($edit) 
			{
                if($this->data["d_ip2"]==""){
                    $log = DL("修改".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备地址【%s】，设备端口【%s】，区域【%s】");
					$msg["msg"] = L("修改".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备地址【%s】，设备端口【%s】，区域【%s】");
					$msg["msg"] = sprintf($msg["msg"]
						, $this->data["d_id"]
						, $this->data["d_ip1"]
						, $this->data["d_port1"]
						, mod_area_name($d_area)
					);
            		$log = sprintf($log
                            , $this->data["d_id"]
                            , $this->data["d_ip1"]
                            , $this->data["d_port1"]
                            , mod_area_name($d_area)
                    );
                    }else{
                        $log = DL("修改".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备地址【%s】，设备端口【%s】，映射地址【%s】，映射端口【%s】，区域【%s】");
						$msg["msg"] = L("修改".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备地址【%s】，设备端口【%s】，映射地址【%s】，映射端口【%s】，区域【%s】");
						$msg["msg"] = sprintf($msg["msg"]
							, $this->data["d_id"]
							, $this->data["d_ip1"]
							, $this->data["d_port1"]
							, $this->data["d_ip2"]
							, $this->data["d_port2"]
							, mod_area_name($d_area)
						);
                        $log = sprintf($log
                            , $this->data["d_id"]
                            , $this->data["d_ip1"]
                            , $this->data["d_port1"]
                            , $this->data["d_ip2"]
                            , $this->data["d_port2"]
                            , mod_area_name($d_area)
                    	);
                    }
			
		} 
        else 
        {
            if($this->data["d_ip2"]=="")
            {
                $log = DL("添加".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备外网地址【%s】，设备外网端口【%s】，区域【%s】");
                $msg["msg"] = L("添加".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备外网地址【%s】，外网设备端口【%s】，区域【%s】");
                $msg["msg"] = sprintf($msg["msg"]
                        , $this->data["d_id"]
                        , $this->data["d_ip1"]
                        , $this->data["d_port1"]
                        , mod_area_name($d_area)
                );
                $log = sprintf($log
                        , $this->data["d_id"]
                        , $this->data["d_ip1"]
                        , $this->data["d_port1"]
                        , mod_area_name($d_area)
                   );
            }
            else
            {
                $log = DL("添加".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备外网地址【%s】，设备外网端口【%s】，设备内网地址【%s】，设备内网端口【%s】，区域【%s】");
				$msg["msg"] = L("添加".$_SESSION["ident"]."-".$this->data["d_type"]."设备成功 ID：【%s】设备外网地址【%s】，设备外网端口【%s】，设备内网地址【%s】，设备内网端口【%s】，区域【%s】");
				$msg["msg"] = sprintf($msg["msg"]
				, $this->data["d_id"]
				, $this->data["d_ip1"]
				, $this->data["d_port1"]
				, $this->data["d_ip2"]
				, $this->data["d_port2"]
				, mod_area_name($d_area)
			);
                $log = sprintf($log
                        , $this->data["d_id"]
                        , $this->data["d_ip1"]
                        , $this->data["d_port1"]
                        , $this->data["d_ip2"]
                        , $this->data["d_port2"]
                        , mod_area_name($d_area)
                );
            }
		}
		$this->log($log, 2, 0);

		return $msg;
	}
    /*
    * 作者 hongyuan.li
    * 时间 2015.7.30
    * 功能 获取设备列表
    */
    public function getRsList($limit = '') {
		$sql = <<<ECHO
                SELECT
				d_name,
				d_id,
				d_ip1,
				d_ip2,
				d_area,
				d_deployment_id,
				d_network_type,
				d_deployment_type,
				d_status,
                d_sip_port,
                d_recnum,
                sum_recnum,
	d_recnum - sum_recnum AS diff_recnum,
	(
		SELECT
			"T_Dev_Cluster".cluster_name
		FROM
			"T_Dev_Cluster"
		WHERE
			(
				"T_Dev_Cluster".cluster_id = d_deployment_id
			)
	) AS cluster_name
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_vcr_id,
		SUM (e_rs_rec) AS sum_recnum
	FROM
		"T_Enterprise"
	GROUP BY
		e_vcr_id
) AS device ON e_vcr_id = d_id
WHERE
	d_type = 'rs'
ECHO;
		$sql .= $this->getDeviceWhere(TRUE);
		$sql .= $limit;

		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll();

		foreach ($result as &$val) {
			$val['status'] = $this->getStatus($val['d_id'], "e_vcr_id", $val["d_area"]);
		}

		return $result;
	} 

	/*
    * 作者 hongyuan.li
    * 时间 2015.7.30
    * 功能 获取设备列表
    */
    public function getSsList($limit = '') {
		$sql = <<<ECHO
                SELECT
				d_name,
				d_id,
				d_ip1,
				d_ip2,
				d_area,
				d_deployment_id,
				d_network_type,
				d_deployment_type,
				d_status,
                d_sip_port,
                d_space,
	d_space_free,
	(
		SELECT
			"T_Dev_Cluster".cluster_name
		FROM
			"T_Dev_Cluster"
		WHERE
			(
				"T_Dev_Cluster".cluster_id = d_deployment_id
			)
	) AS cluster_name
FROM
	"T_Device"
WHERE
	d_type = 'ss'
ECHO;
		$sql .= $this->getDeviceWhere(TRUE);
		$sql .= $limit;

		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll();

		foreach ($result as &$val) {
			$val['status'] = $this->getStatus($val['d_id'], "e_ss_id", $val["d_area"]);
		}

		return $result;
	} 
	/*
	* 获取ss设备使用空间和总空间
	*/
	public function getSpace()
	{

		$sql = 'SELECT d_id,d_ip1,d_ip2,d_name,d_space,d_space_free,d_space-d_space_free as space,d_deployment_id from "T_Device" where d_id=\''.$this->data['device_id'].'\'';
		$stat = $this->pdo->query($sql);
		$result = $stat->fetch();
		return $result;
	}
	/*
	* 获取ss设备已用和总并发数
	*/
	public function getRec()
	{
		//获取总并发数
		$sql = 'SELECT d_id,d_name,d_ip1,d_ip2,COALESCE(d_recnum,0) as d_recnum,d_deployment_id from "T_Device" where d_id=\''.$this->data['device_id'].'\'';
		$stat = $this->pdo->query($sql);
		$recnum = $stat->fetch();
		$result['d_id'] = $recnum['d_id'];
		$result['d_name'] = $recnum['d_name'];
		$result['d_ip1'] = $recnum['d_ip1'];
		$result['d_ip2'] = $recnum['d_ip2'];
		$result['d_recnum'] = $recnum['d_recnum'];
		$result['d_deployment_id'] = $recnum['d_deployment_id'];
		//获取已用并发数
		$sql1 = 'SELECT COALESCE(sum(e_rs_rec),0) as sum_recnum from "T_Enterprise" where e_vcr_id=\''.$this->data['device_id'].'\'';
		$stat1 = $this->pdo->query($sql1);
		$recnum1 = $stat1->fetch();
		$result['sum_recnum'] = $recnum1['sum_recnum'];
		return $result;
	}
	public function getClusterId() {
		$sql = 'SELECT nextval(\'"T_Dev_Cluster_cluster_id_seq"\'::regclass)';
		$sth = $this->pdo->query($sql);
		$result = $sth->fetch();
		return $result["nextval"];
	}
	/*
	* 作者 hongyuan.li
    * 时间 2015.7.30
    * 功能 部署id保存
	*
	*/
	public function cluster_save()
	{
		$edit = false;
		$jsonarea = '';
		if ($this->data["cluster_id"] != "") {
			$edit = true;
		}
		if($edit)
		{
			$select = "select * from \"T_Dev_Cluster\" where cluster_name ='".$this->data["cluster_name"]."' and cluster_id != '".$this->data["cluster_id"]."'";
		}
		else
		{
			$select = "select * from \"T_Dev_Cluster\" where cluster_name ='".$this->data["cluster_name"]."'";
		}
		$stat = $this->pdo->query($select);
		$result = $stat->fetchAll();
		if(!empty($result))
		{
			throw new ErrorException(L('名称已存在'), -1);
		}
		if ($edit) {
			$sql = 'UPDATE "T_Dev_Cluster"SET cluster_name = :cluster_name,cluster_desc = :cluster_desc WHERE cluster_id = :cluster_id';
		} else {
			$sql = 'INSERT INTO "public"."T_Dev_Cluster" ("cluster_id", "cluster_name", "cluster_desc") VALUES (:cluster_id, :cluster_name,:cluster_desc)';
			$this->data["cluster_id"] = $this->getClusterId();
		}
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(':cluster_id', $this->data["cluster_id"], PDO::PARAM_STR);
		$sth->bindValue(':cluster_name', $this->data["cluster_name"], PDO::PARAM_STR);
		$sth->bindValue(':cluster_desc', $this->data["cluster_desc"], PDO::PARAM_STR);

		try
		{
			//$info = $this->getByid ();
			$sth->execute();
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
		$msg["status"] = 0;
		if ($edit) 
		{ 
    		$log = DL("修改部署ID".$this->data["cluster_id"]."名称：【%s】备注【%s】");
			$msg["msg"] = L("修改部署ID成功 ID：【%s】，名称【%s】，备注【%s】");
			$msg["msg"] = sprintf($msg["msg"]
			, $this->data["cluster_id"]
			, $this->data["cluster_name"]
			, $this->data["cluster_desc"]
			);
    		$log = sprintf($log
            , $this->data["cluster_id"]
			, $this->data["cluster_name"]
			, $this->data["cluster_desc"]
            );      
		}
		else 
		{
    		$log = DL("添加部署ID".$this->data["cluster_id"]."成功 ID：【%s】名称【%s】，备注【%s】");
			$msg["msg"] = L("添加部署ID成功 ID：【%s】，名称【%s】，备注【%s】");
			$msg["msg"] = sprintf($msg["msg"]
			, $this->data["cluster_id"]
			, $this->data["cluster_name"]
			, $this->data["cluster_desc"]
			);
			 $log = sprintf($log
		    , $this->data["cluster_id"]
			, $this->data["cluster_name"]
			, $this->data["cluster_desc"]
			);

		}
		$this->log($log, 2, 0);

		return $msg;

	}
	/*
	* 部署id总数
	*/
	public function getClusterTotal($type='mds') {
		$sql = 'SELECT COUNT(cluster_id)AS total FROM"public"."T_Dev_Cluster"';
		$pdoStatement = $this->pdo->query($sql);
		$result = $pdoStatement->fetch();
		return $result["total"];
	}

	public function getClusterList($limit = '') {
		$sql = <<<ECHO
                SELECT * from "T_Dev_Cluster" ORDER BY cluster_id
ECHO;
		$sql .= $limit;

		$stat = $this->pdo->query($sql);
		$result = $stat->fetchAll();
		foreach ($result as &$val) {
			$val['status'] = $this->getClusterStatus($val['cluster_id'], "d_deployment_id");
		}
		return $result;
	} 
	/*
	* 获取部署ID是否被使用
	*/
	public function getClusterStatus($id, $type) {
		$sql = "SELECT \"d_id\" FROM \"T_Device\" WHERE $type = $id ";
		$sth = $this->pdo->query($sql);
		$list = $sth->fetchAll();
		if (count($list) != 0) {
			return "yes";
		} else {
			return "no";
		}
	}

	public function getCluster() {
		$sql = 'SELECT * FROM "T_Dev_Cluster" WHERE cluster_id = :cluster_id';
		$sth = $this->pdo->prepare($sql);
		$sth->bindValue(":cluster_id", $this->data["cluster_id"], PDO::PARAM_INT);
		$sth->execute();
		$data = $sth->fetch();
		return $data;
	}

	public function delCluster() {
		$sql = "DELETE FROM \"T_Dev_Cluster\" WHERE cluster_id = '{$this->data['cluster_id']}'";
		$res=$this->pdo->exec($sql);
        return $res;
	}

	/*
	* RS OPTION列表
	*
	*/
	public function getRSListOption() {
		$sql = <<<ECHO
SELECT
	d_name,
	d_id,
	d_ip1,
	d_ip2,
                   d_recnum,
                   d_deployment_id,
	COALESCE(sum_rec,0) as sum_rec
	
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_vcr_id,
		SUM (e_rs_rec) AS sum_rec
	FROM
		"T_Enterprise"
	GROUP BY
		e_vcr_id
) AS device ON e_vcr_id = d_id
WHERE
	d_type = 'rs'
AND d_status = 1
ECHO;
		$sql .= $this->getDeviceWhere();

		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getRsDevice($d_id,$edit) {
		if($edit)
		{
			$where = " where e_id != '".$edit."'";
		}
		else
		{
			$where = '';
		}
		$sql = <<<ECHO
SELECT
	d_name,
	d_id,
	d_ip1,
	d_ip2,
                   d_recnum,
                   d_deployment_id,
	COALESCE(sum_rec,0) as sum_rec
	
FROM
	"T_Device"
LEFT JOIN (
	SELECT
		e_vcr_id,
		SUM (e_rs_rec) AS sum_rec
	FROM
		"T_Enterprise"
	$where
	GROUP BY
		e_vcr_id
) AS device ON e_vcr_id = d_id
WHERE
	d_type = 'rs'
AND d_status = 1
AND d_id = '$d_id'
ECHO;


		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	/*
	* SS OPTION列表
	*
	*/
	public function getSSListOption() {
		$sql = <<<ECHO
SELECT
	d_id,
	d_name,
	d_id,
	d_ip1,
	d_ip2,
                   d_space,
                   d_space_free
FROM
	"T_Device"
WHERE
	d_type = 'ss'
AND d_status = 1
ECHO;
		$sql .= $this->getDeviceWhere();

		$sth = $this->pdo->query($sql);
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
/**
 * 获得是否公网IP和内网IP是否可以重复（此方法作废）
 * @param array $aKey  设备配置信息数组
 * @param boolean $edit 标识判断
 * @return boolean
 */
/*
	public function getDevice($aKey,$edit)
	{

		if($aKey)
		{
			//同类设备
			if($edit)
			{
				$sql = "select * from \"T_Device\" where (d_ip1='".$aKey['d_ip1']."'  or d_ip2='".$aKey['d_ip2']."')  and d_type='".$aKey['d_type']."' and d_id != '".$aKey['d_id']."'"; 
			}
			else
			{
				$sql = "select * from \"T_Device\" where (d_ip1='".$aKey['d_ip1']."'  or d_ip2='".$aKey['d_ip2']."')  and d_type='".$aKey['d_type']."'"; 
			}
			
			 $sth = $this->pdo->query($sql);
			 $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			//不同设备同一部署id，要么ip都相同，要么ip都不同
			 if($edit)
			 {
			 		$sql1 = "select * from \"T_Device\" where ((d_ip1 = '".$aKey['d_ip1']."' and d_ip2 != '".$aKey['d_ip2']."') or (d_ip1 != '".$aKey['d_ip1']."' and d_ip2 = '".$aKey['d_ip2']."' ) )
			 and d_type != '".$aKey['d_type']."'and d_deployment_id = '".$aKey['d_deployment_id']."' and d_id != '".$aKey['d_id']."'";  
			 }
			 else
			 {
			 		$sql1 = "select * from \"T_Device\" where ((d_ip1 = '".$aKey['d_ip1']."' and d_ip2 != '".$aKey['d_ip2']."') or (d_ip1 != '".$aKey['d_ip1']."' and d_ip2 = '".$aKey['d_ip2']."' ) )
			 and d_type != '".$aKey['d_type']."' and d_deployment_id = '".$aKey['d_deployment_id']."'"; 
			 }
			 $sth = $this->pdo->query($sql1);
			 $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);

			 //不同设备不同设备id，外网ip不同
			 if($edit)
			 {
			 		$sql2 = "select * from \"T_Device\" where d_ip2 = '".$aKey['d_ip2']."' and d_type != '".$aKey['d_type']."' and d_deployment_id != '".$aKey['d_deployment_id']."' and d_id != '".$aKey['d_id']."'";  
			 }
			 else
			 {
			 		$sql2 = "select * from \"T_Device\" where d_ip2 = '".$aKey['d_ip2']."' and d_type != '".$aKey['d_type']."' and d_deployment_id != '".$aKey['d_deployment_id']."'"; 
			 }
			 $sth = $this->pdo->query($sql2);
			 $result2 = $sth->fetchAll(PDO::FETCH_ASSOC);
		}
// echo $sql."<br>".$sql1."<br>".$sql2;die;
		if($result || $result1 || $result2)
		{
			return false;
		}
		else
		{
			return true;
		}
		// return $result;
	}
	*/
}
