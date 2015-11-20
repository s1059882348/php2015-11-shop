<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-20
 * Time: 下午6:33
 */

namespace Home\Model;


use Think\Model;

class AddressModel extends Model
{
    protected  $_auto=array(
        array('member_id',UID),
    );

    /**
     * 得到当前登陆用户的收货地址
     */
    public function getList(){  //必须要省市县都有才能查出数据？？？？？？
        /**
         * select a.id,a.receiver,province.name as province_name,city.name as city_name,area.name as area_name from
        address as a join region as province  on a.province_id = province.id
        join region as city  on a.city_id = city.id
        join region as area  on a.area_id = area.id   where a.member_id = 19
         */
        $this->field("a.id,a.receiver,a.detail_address,a.tel,a.is_default,province.name as province_name,city.name as city_name,area.name as area_name")->
        alias('a')->join('__REGION__ as  province  on a.province_id = province.id');
        $this->join('__REGION__ as  city  on a.city_id = city.id');
        $this->join('__REGION__ as  area  on a.area_id = area.id');
        return $this->where(array('a.member_id'=>UID))->select();
    }

    public function add(){
        //>>1.如果当时默认状态,请将其他的修改为非默认状态
        if(isset($this->data['is_default'])){
            $this->where(array('member_id'=>UID));
            parent::save(array('is_default'=>0));
        }
        return parent::add();
    }

    public function save(){
        if(isset($this->data['is_default'])){
            $this->where(array('member_id'=>UID));
            parent::save(array('is_default'=>0));
        }
        return parent::save();
    }

//    /**
//     * 根据id查询出一行数据
//     * @param $id
//     * @return mixed
//     */
//    public function get($id){
//        $this->field("a.id,a.receiver,a.detail_address,a.tel,a.is_default,province.name as province_name,city.name as city_name,area.name as area_name")->
//        alias('a')->join('__REGION__ as  province  on a.province_id = province.id');
//        $this->join('__REGION__ as  city  on a.city_id = city.id');
//        $this->join('__REGION__ as  area  on a.area_id = area.id');
//        return $this->where(array('a.id'=>$id))->find();
//    }

}