<?php

/**
 * 图片管理类
 * @package Common Model
 */
class pic extends db {

    public function __construct($data) {
        parent::__construct();
        $this->data = $data;
    }

    public function getFile() {
        $filetype = array("image/jpeg", "image/pjpeg");

        if ($_FILES['fileToUpload']['error'] != "") {
            switch ($_FILES['fileToUpload']['error']) {
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception(L("没有文件被选择"), -1);
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception(L("超出了大小限制"), -2);
                default:
                    throw new Exception(L("未知的上传错误"), -3);
            }
        }
        if ($_FILES['fileToUpload']['size'] > 2048 * 1000) {
            throw new Exception(L("文件太大，不给上传"), -4);
        }
        if (!in_array($_FILES['fileToUpload']["type"], $filetype)) {
            throw new Exception(L("未被允许的文件格式【仅支持jpg格式】"), -5);
        }

        $extension = pathinfo($_FILES['fileToUpload']['name']);
        $basename = uniqid() . "." . $extension['extension'];

        $file['name'] = $basename;
        $file['data'] = $_FILES['fileToUpload']["tmp_name"];
        return $file;
    }
    
    public function getFile_keeper() {
        $filetype = array("image/jpeg", "image/pjpeg");
        $n=1;
        foreach ($_FILES as $key => $value) {
            $nu=$n++;
            if($_FILES[$key]['size']==0){

            $file[$key]['name'] = null;
            $file[$key]['data'] = null;
            }else{
            if ($_FILES[$key]['error'] != "") {
                switch ($_FILES[$key]['error']) {
                    case UPLOAD_ERR_NO_FILE:
                        throw new Exception(L("没有文件被选择"), -1);
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new Exception(L("超出了大小限制"), -2);
                    default:
                        throw new Exception(L("未知的上传错误"), -3);
                }
            }
            if ($_FILES[$key]['size'] > 2048 * 1000) {
                throw new Exception(L("文件太大，不给上传"), -4);
            }
            if (!in_array($_FILES[$key]["type"], $filetype)) {
                throw new Exception(L("未被允许的文件格式【仅支持jpg格式】"), -5);
            }

            $extension = pathinfo($_FILES[$key]['name']);
            $basename = uniqid() . "." . $extension['extension'];

            $file[$key]['name'] = $basename;

        //var_dump($_SERVER['REMOTE_ADDR'].":8080/files/img/branch1.jpg");
        //move_uploaded_file($file['data'], "files/img/".$file['data']);
           move_uploaded_file($_FILES[$key]["tmp_name"], "./files/pic/banner".$nu.".jpg");
           $file[$key]['data'] ="./files/pic/banner".$nu.".jpg";
            }
        }
        return $file;
    }

    public function getId() {
        $file = $this->getFile();
        $pid = $this->md5r();

        $sql = <<<SQL
INSERT INTO
        "T_Pic"("p_id","p_data")
VALUES(:p_id,:p_data)
SQL;
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':p_id', $pid);
        $sth->bindValue(':p_data', file_get_contents($file['data']), PDO::PARAM_LOB);
        $sth->execute();
        return $pid;
    }
    /**
     * KEEPER banner图上传
     * @return type
     */
public function getId_keeper() {
        $file = $this->getFile_keeper();
        $n=1;
        foreach ($file as $key => $value) {
            $nu=$n++;
        //$pid = $this->md5r();
        //$p_id[$key]=  $this->get_pic_id();
                   
            if($value['name']==null){
                
            }else{
        if($this->get_pic_info("banner".$nu)==false){
            $sql = <<<SQL
INSERT INTO
        "T_Picture"("p_id","p_file","p_type","p_content","p_time")
VALUES(:p_id,:p_file,:p_type,:p_content,:p_time)
SQL;
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':p_id', "banner".$nu,PDO::PARAM_STR);
            $sth->bindValue(':p_file', "Banner".$nu);
            $sth->bindValue(':p_type', "banner");
            $sth->bindValue(':p_content', file_get_contents($value['data']), PDO::PARAM_LOB);
            $sth->bindValue(':p_time', time(),PDO::PARAM_INT);
            $sth->execute();
            }else{
            $sql = <<<SQL
UPDATE "T_Picture" SET p_content=:p_content,p_time=:p_time WHERE p_id=:p_id
SQL;
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':p_id', "banner".$nu,PDO::PARAM_STR);
            $sth->bindValue(':p_content', file_get_contents($value['data']), PDO::PARAM_LOB);
            $sth->bindValue(':p_time', time(),PDO::PARAM_INT);
            $sth->execute();    
            }
        }
        }
        $this->set_spc();
        return $pid;
        
    }
    /**
     * 终端类型图上传
     * @return type
     */
public function getId_terminal($term_num,$d) {
        $file = $this->getFile();
        $pid=$this->data['tt_pic'];
        if($pid==""){
        $pid = $this->md5r();
        }
        //$p_id[$key]=  $this->get_pic_id();
        if($this->data['d']!='replace'){
            $sql = <<<SQL
INSERT INTO
        "T_Picture"("p_id","p_file","p_type","p_content","p_time")
VALUES(:p_id,:p_file,:p_type,:p_content,:p_time)
SQL;
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':p_id', $pid,PDO::PARAM_STR);
            $sth->bindValue(':p_file', $term_num);
            $sth->bindValue(':p_type', "device");
            $sth->bindValue(':p_content', file_get_contents($file['data']), PDO::PARAM_LOB);
            $sth->bindValue(':p_time', time(),PDO::PARAM_INT);
            try {
                $sth->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }

            }else{
            $sql = <<<SQL
UPDATE "T_Picture" SET p_content=:p_content,p_file=:p_file,p_time=:p_time WHERE p_id=:p_id
SQL;
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':p_id', $pid,PDO::PARAM_STR);
            $sth->bindValue(':p_file', $this->data['tt_type']);
            $sth->bindValue(':p_content', file_get_contents($file['data']), PDO::PARAM_LOB);
            $sth->bindValue(':p_time', time(),PDO::PARAM_INT);
                 $sth->execute();    
            }
        $this->set_spc();
        return $pid;
        
    }
    /**
     * 
     */
    public function get_term_pic($term_num){
        $where = <<<WHERE
                        p_file = '$term_num'
WHERE;
        $result = $this->table('T_Picture')->filed(array('p_id','p_file','p_time'), FALSE)->where($where)->select();
        return $result;
    }
   public function set_spc(){
       $sql="SELECT p_id,p_file,p_type,p_time FROM \"T_Picture\" WHERE p_id='0'";
       $sth = $this->pdo->query($sql);
        $result = $sth->fetch();
        if($result==false){
            $sql = <<<SQL
INSERT INTO
        "T_Picture"("p_id","p_file","p_type","p_content","p_time")
VALUES(:p_id,:p_file,:p_type,:p_content,:p_time)
SQL;
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':p_id', 0,PDO::PARAM_STR);
        $sth->bindValue(':p_file', NULL);
        $sth->bindValue(':p_type', "0");
        $sth->bindValue(':p_content', NULL, PDO::PARAM_LOB);
        $sth->bindValue(':p_time',  time(),PDO::PARAM_INT);
        $sth->execute();    
        }else{
             $sql = <<<SQL
UPDATE "T_Picture" SET p_time=:p_time WHERE p_id='0'
SQL;
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':p_time', time(),PDO::PARAM_INT);
        $sth->execute();    
        }
   }
    
/**
    * 获得部门ID
    * @return type
    */
   private function get_pic_id() {
           //$e_id = $this->data["e_id"];
           $sql = 'SELECT nextval(\'"T_Picture_p_id_seq"\'::regclass)';

           //$sql = str_replace(':e_id', $e_id, $sql);
           $sth = $this->pdo->query($sql);
           $result = $sth->fetch();
           return $result["nextval"];
   }
    public function show() {
        $pid = $this->data['pid'];

        if ($pid == '') {
            header('Content-type: image/jpg');
            echo file_get_contents('../www/images/face.jpg');
            return;
        }
        $where = <<<WHERE
                        p_id = '$pid'
WHERE;
        $result = $this->table('T_Pic')->filed(array('p_id', 'p_data::bytea'), FALSE)->where($where)->select();
        header('Content-type: image/jpg');

        //文件大小超出9999999，将停止读取
        /*
         * 以下情况也将停止读取
         * 读取了 length 个字节
          到达了文件末尾（EOF）
          a packet becomes available or the socket timeout occurs (for network streams)
          if the stream is read buffered and it does not represent a plain file, at most one read of up to a number of bytes equal to the chunk size (usually 8192) is made; depending on the previously buffered data, the size of the returned data may be larger than the chunk size.
         */
//        $cache_pic=$this->memcache->get(md5($pid));
//        if($cache_pic !=""){
//            print $cache_pic;
//            exit;
//        }else{
            if (!is_null($result[0]['p_data'])) {
//                $this->memcache->set(md5($pid),$result[0]['p_data']);
                print fread($result[0]['p_data'], 9999999);
                exit;
            }
//        }
        echo file_get_contents('../images/face.jpg');
    }
    public function show_terminal() {
        $pid = $this->data['pid'];

        if ($pid == '') {
            header('Content-type: image/jpg');
            echo file_get_contents('../www/images/face.jpg');
            return;
        }
        $where = <<<WHERE
                        p_id = '$pid'
WHERE;
        $result = $this->table('T_Picture')->filed(array('p_id', 'p_content::bytea'), FALSE)->where($where)->select();
        header('Content-type: image/jpg');

        //文件大小超出9999999，将停止读取
        /*
         * 以下情况也将停止读取
         * 读取了 length 个字节
          到达了文件末尾（EOF）
          a packet becomes available or the socket timeout occurs (for network streams)
          if the stream is read buffered and it does not represent a plain file, at most one read of up to a number of bytes equal to the chunk size (usually 8192) is made; depending on the previously buffered data, the size of the returned data may be larger than the chunk size.
         */
//         $cache_pic=$this->memcache->get(md5($pid));
//        if($cache_pic!=false){
//            print $cache_pic;
//            exit;
//        }else{
            if (!is_null($result[0]['p_content'])) {
//                $this->memcache->set(md5($pid),$result[0]['p_data']);
                print fread($result[0]['p_content'], 9999999);
                exit;
            }
//        }
        echo file_get_contents('../images/face.jpg');
    }
    
    public function get_pic_info($pid){
        $sql = <<<WHERE
                SELECT p_id,p_file,p_time FROM "T_Picture" WHERE p_id = '$pid'
WHERE;
        $sth = $this->pdo->query($sql);
       $result=$sth->fetch();
        return $result;
    }

    public function clearAll() {
        $sql = <<<SQL
                        DELETE
FROM
	"T_Pic"
WHERE
	p_id NOT IN (SELECT u_pic FROM "T_User")
SQL;
        $this->pdo->exec($sql);
    }
    public function del_pic() {
        $sql = <<<SQL
                        DELETE
FROM
	"T_Picture"
WHERE
	p_file='{$this->data['p_file']}'
SQL;
        $this->pdo->exec($sql);
    }
    
    /**
     * 更新设备图片
     */
    public function up_tem_pic(){
        $sql=<<<ECHO
                UPDATE "T_Picture" SET p_file='{$this->data['tt_type']}' WHERE p_id='{$this->data['tt_pic']}'
ECHO;
       $this->pdo->exec($sql);
    }

}
