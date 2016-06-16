<?php
/**
 * 公告控制器
 * @category  其他
 * @package 公告管理
 * @subpackage  Model层
 */
class announcement extends db {

	public function __construct($data) {
		parent::__construct();
		$this->data = $data;
	}
/**
 * [返回 公告的Where 筛选条件]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:52:31+0800
 * @param    boolean                  $order [是否排序 TRUE 排序 | FALSE 不排序]
 * @return   [String]                          [Where SQL 条件语句]
 */
function getWhere($order = false) {
	$where = " WHERE 1=1 ";
	if ($this->data["an_title"] != "") {
		$where .= "AND an_title LIKE E'%" . addslashes($this->data["an_title"]) . "%'";
	}
	if ($_SESSION['own']['om_id'] != 'admin') {
		$this->data["an_user"] = $_SESSION['own']['om_id'];
	}

	if ($this->data["an_user"] != "") {
		$where .= "AND an_user LIKE E'%" . addslashes($this->data["an_user"]) . "%'";
	}

	if ($this->data["an_status"] != "") {
		$where .= "AND an_status = " . "'" . $this->data["an_status"] . "'";
	}

	if ($this->data["an_area"] != "") {
		$area = new area();
		$where .= $area->getAcl('an_area', $this->data["an_area"]);
	}

	if ($this->data["start"] != "" || $this->data["end"] != "") {
		$where .= 'AND an_time ' . getDateRange($this->data["start"], $this->data["end"]);
		/*
	$start = $this->data["start"];
	$end = $this->data["end"];
	$start = $start != "" ? $start : "0000-00-00";
	$end = $end != "" ? $end : "9999-99-99";
	$where .= "AND an_time BETWEEN to_date('" . $start . "', 'yyyy-mm-dd') AND to_date('" . $end . "', 'yyyy-mm-dd')";
	 *
	 */
	}
	if ($order) {
		$where .= ' ORDER BY an_time desc';
	}

	return $where;
}
/**
 * [获得 所有符合条件的 公告列表]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:55:25+0800
 * @param    [string]                   $limit [分条查询条件]
 * @return   [array]                          [所有符合条件的 公告列表]
 */
public function getList($limit) {
	$sql = 'SELECT
            an_id,
            an_title,
            an_content,
            an_status,
            an_user,
            an_time,
            an_area
    FROM
            "T_Announcement"';
	$sql = $sql . $this->getWhere(TRUE);
	$sql = $sql . $limit;

	$stat = $this->pdo->query($sql);
	$result = $stat->fetchAll();
	return $result;
}
/**
 * [删除 某个公告]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:56:28+0800
 * @return   [int]                   [返回删除结果]
 */
public function delList() {
	$edit = false;
	if ($this->data["id"] != "") {
		$edit = true;
	}
	if ($edit) {
		$sql = 'DELETE FROM "T_Announcement"WHERE"T_Announcement".an_id = :an_id';
	}
	$sth = $this->pdo->prepare($sql);
	if ($edit) {
		$sth->bindValue(':an_id', $this->data["id"], PDO::PARAM_INT);
	}
	$count = $sth->execute();
	$this->log(DL("删除了公告"), 8, 0);
	return $count;
}
/**
 * [获得 某个公告的详细信息]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:57:24+0800
 * @return   [array]                   [返回 某个公告的详细信息]
 */
public function an_details() {
	$sql = 'SELECT* FROM "T_Announcement" WHERE an_id = :an_id';
	$sth = $this->pdo->prepare($sql);
	$sth->bindValue(':an_id', $this->data["an_id"], PDO::PARAM_INT);
	$sth->execute();
	$data = $sth->fetch(PDO::FETCH_ASSOC);
	return $data;
}
/**
 * [公告 保存(新建,编辑)]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:58:12+0800
 * @return   [array]                   [操作结果]
 */
public function an_save() {
	$user = $_SESSION['own']['om_id'];
	$date = date('Y-m-d H:i:s');
	$edit = false;
	if ($this->data["an_id"] != "") {
		$edit = true;
	}

	if ($edit) {
		$sql = 'UPDATE "T_Announcement"SET an_title = :an_title,an_content = :an_content,an_status = :an_status,an_user = :an_user,an_area = :an_area,an_time = :an_time WHERE an_id = :an_id';
	} else {
		$sql = 'INSERT INTO "public"."T_Announcement" ("an_title", "an_content", "an_status", "an_user","an_area", "an_time") VALUES (:an_title,:an_content ,:an_status ,:an_user ,:an_area,:an_time)';
	}
	$sth = $this->pdo->prepare($sql);

	$jsonarea = json_encode($this->data["an_area"]);

	if (substr_count($jsonarea, '#') > 0) {
		$jsonarea = '["#"]';
	}

	if ($edit) {
		$sth->bindValue(':an_id', $this->data["an_id"], PDO::PARAM_INT);
		$sth->bindValue(':an_title', $this->data["an_title"]);
		$sth->bindValue(':an_content', $this->data["content"]);
		$sth->bindValue(':an_status', $this->data["an_status"]);
		$sth->bindValue(':an_user', $user);
		$sth->bindValue(':an_area', $jsonarea);
		$sth->bindValue(':an_time', $date, PDO::PARAM_INT);
	} else {
		$sth->bindValue(':an_title', $this->data["an_title"]);
		$sth->bindValue(':an_content', $this->data["content"]);
		$sth->bindValue(':an_status', $this->data["an_status"]);
		$sth->bindValue(':an_user', $user);
		$sth->bindValue(':an_area', $jsonarea);
		$sth->bindValue(':an_time', $date, PDO::PARAM_INT);
	}
	try {
		$sth->execute();
	} catch (Exception $ex) {
		if ($ex->getCode() == 23505) {
			return $this->msg(L("公告标题重复")."！".L("请更换公告标题"), -1);
		}
		$this->log(DL("公告添加失败") . ":" . $ex->getMessage(), 0, 2);
		return $this->msg(L('公告添加失败'), -1);
	}
	$msg["status"] = 0;

	if ($this->data["an_id"] != "") {
		$aid = DL("公告ID") . " " . $this->data["an_id"];
		$aid_msg = L("公告ID") . " " . $this->data["an_id"];
	}

	if ($this->data['an_status'] == '1') {
		$log = L("公告发布成功") . " " . $aid_msg;

		$this->log(DL("公告发布成功") . " " . $aid, 8, 0);
		$msg["msg"] = $log;
	} else {
		$log = L("草稿保存成功") . $aid_msg;
		$this->log(DL("草稿保存成功") . $aid, 8, 0);
		$msg["msg"] = $log;
	}
	return $msg;
}
/**
 * [获得 公告的总个数]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:59:01+0800
 * @return   [integer]                   [返回公告个数]
 */
public function getTotal() {
	$sql = 'SELECT COUNT(an_id)AS total FROM "T_Announcement"';
	$sql = $sql . $this->getWhere();

	$sth = $this->pdo->query($sql);
	$result = $sth->fetch();
	return $result["total"];
}

}
