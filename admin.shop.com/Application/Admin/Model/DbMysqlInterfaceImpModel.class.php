<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-6
 * Time: 下午1:36
 */

namespace Admin\Model;

//执行顺序 getRow  query  insert  ????
class DbMysqlInterfaceImpModel implements DbMysqlInterfaceModel
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect';
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo 'free';
        exit;
    }

    public function query($sql, array $args = array())
    {
        // TODO: Implement query() method.
//        echo 'query';
//        exit;
        //获取sql语句
        $targetSQL = $this->buildSQL(func_get_args());
        //执行sql语句
        return M()->execute($targetSQL);  //为什么M()->query($targetSQL);
    }

    public function insert($sql, array $args = array())
    {
        // TODO: Implement insert() method.
//        echo 'insert';
//        exit;1223
//        var_dump(func_get_args());
//        exit;
        $params = func_get_args();
        $sql = $params[0];
        $sql =  str_replace('?T',$params[1],$sql);

        //将插入的值的连接
        $values = array();
        foreach($params[2] as $k=>$v){
            if($k=='id'){     //过滤id
                continue;
            }
            $values[] = "$k='$v'";
        }
        $values = implode(',',$values);
//        var_dump($values);
//        exit;

        //将插入的值替换到$sql中
        $sql =  str_replace('?%',$values,$sql);
        $result = M()->execute($sql);
        if($result!==false){
            //执行成功之后要返回id
            return M()->getLastInsID();
        }else{
            return false;//执行失败,返回false
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo 'update';
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo 'getAll';
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc';
        exit;
    }

    public function getRow($sql, array $args = array())
    {
        // TODO: Implement getRow() method.
//        echo 'getRow';
//        exit;
//        var_dump(func_get_args());
//        array (size=8)
    //  0 => string 'SELECT ?F, ?F, ?F, ?F FROM ?T WHERE ?F = ?N' (length=43)
    //  1 => string 'parent_id' (length=9)
    //  2 => string 'lft' (length=3)
    //  3 => string 'rght' (length=4)
    //  4 => string 'level' (length=5)
    //  5 => string 'goods_category' (length=14)
    //  6 => string 'id' (length=2)
    //  7 => int 9
//        exit;
        //获取sql语句
        $targetSQL = $this->buildSQL(func_get_args());
        //执行sql语句
        $rows=M()->query($targetSQL);
        //或者 $rows=$this->query(func_get_args());
        //返回结果
//        var_dump($rows);
//        exit;
        if(!empty($rows)){
            return $rows[0];
        }
    }

    /**
     * 根据参数拼sql
     */
    private function buildSQL($params){
//        var_dump($params);
//        exit;
        //弹出第一个元素，返回值是第一个元素，原数组将改变
        $sql = array_shift($params);  //将params中的第一个元素弹出, 弹出的是一个sql模板
//        var_dump($params);
//        exit;
        $sqls = preg_split("/\?[FNT]/",$sql);  //将sql模板进行分隔
        $targetSQL = '';  //保存拼接好的sql
        foreach($sqls as $k=>$v){
            $targetSQL.=$v.$params[$k];   //将sql模板和实际参数进行拼接为完整的sql
        }
        return $targetSQL;
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo 'getCol';
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        // TODO: Implement getOne() method.
//        echo 'getOne';
//        exit;
        $sql = $this->buildSQL(func_get_args());
        $rows = M()->query($sql);
        //获取关联数组中的第一个值
//        var_dump($rows);
//        exit;
        $values = array_values($rows[0]);
        return $values[0];
    }


}