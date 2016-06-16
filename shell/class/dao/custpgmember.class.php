<?php
/**
 * 企业自建组Model
 * @package 企业管理
 * @subpackage Model层
 * @require {@see db}
 */
class custpgmember extends db
{
    public function __construct ( $data )
    {
        parent::__construct ();
        $this->data = $data;
    }
/**
 * [当前企业的自建组]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T14:16:02+0800
 * @return   [array]                   [一维数组当前企业的自建组]
 */
    public function getbyid ()
    {
        $e_id = $this->data["e_id"];
        $table = "T_Custom_PttGrp_$e_id";
        $sql = "SELECT * FROM \"$table\" WHERE c_pg_number = :c_pg_number";
        $sth = $this->pdo->prepare ( $sql );
        $sth->bindValue ( ':c_pg_number' , $this->data["c_pg_number"] );
        $sth->execute ();
        $data = $sth->fetch ();
        return $data;
    }
/**
 * [获取自建组名称]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T14:17:09+0800
 * @param    [string]                   $number [自建组ID]
 * @return   [string]                           [返回 自建组名称]
 */
    public function getcustPgname ( $number )
    {
        $e_id = $this->data["e_id"];
        $cmtable = sprintf ( '"T_Custom_PttGrp_%s"' , $e_id );
        $sql = "SELECT
                        *
                FROM
                        :cmtable
        ";

        $sql = str_replace ( ":cmtable" , $cmtable , $sql );
        //$sql = $sql . $this->getWhere(true);

        $sth = $this->pdo->query ( $sql );
        $result = $sth->fetchAll ();
        foreach ( $result as $key => $val )
        {
            if ( strpos ( $val['c_pg_mem_list'] , $number ) !== false )
            {
                $cust_pgname[] = $val['c_pg_name'];
            }
        }
        return $cust_pgname;
    }

}
