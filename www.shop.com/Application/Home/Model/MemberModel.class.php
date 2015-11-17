<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-15
 * Time: 下午3:09
 */

namespace Home\Model;


use Org\Util\String;
use Think\Model;

class MemberModel extends Model
{
    protected $_auto=array(
        array('add_time',NOW_TIME),
        array('salt','\Org\Util\String::randString','','function'),
        array('status',-1),
        array('mail_key','randomKey','','callback'),
    );

    public function randomKey(){
        return md5(String::randString(10));
    }


    public function checkRepeat($params){
        $result=$this->where($params)->find();
        return empty($result);
    }

    public function add(){
        $this->data['password'] = md5($this->data['password'].$this->data['salt']);
        $id=parent::add();
        $mail=$this->data['email'];
        $mail_key=$this->data['mail_key'];

        // 发送激活邮件
        $content = "<a href='http://www.shop.com/index.php/Member/fire/id/$id/key/{$mail_key}'>请点击这里激活你的账号</a>";
        $result = sendMail($mail,'京西的激活邮件',$content);
        if($result===false){
            $this->error  = '请重新填写Email发送邮件';
            return false;
        }
        return $id;
    }


    public function fire($id,$key){
        //>>1.根据id找到数据表中的$key
        $mail_key  = $this->getFieldById($id,'mail_key');
        //>>2.验证key
        if($key==$mail_key){
            //>>3.修改状态
            return $this->where(array('id'=>$id))->setField('status',1);
        }else{
            return false;
        }
    }


    //发送短信
    public function sendSMS($tel){
        //>>1. 随机生成一个数字
        $randomNumber = String::randString(6,1);
        session('SMS_CODE',$randomNumber);  //为了和用户输入的短信验证码进行验证码
        //>>2.将该数字发送到$tel手机号


//        include "TopSdk.php";   //加载了TopSdk.php之后,下面的代码就可以使用自动加载
        vendor('SMS.TopSdk');
        date_default_timezone_set('Asia/Shanghai');  //设置时区

        $c = new \TopClient;
        $c->appkey = '23268404';                              //创建的应用上的appkey
        $c->secretKey = 'e97393a47d88d7533d3e014c0678e69c';   //创建的应用上的secretKey

        $req = new \AlibabaAliqinFcSmsNumSendRequest;
//        $req->setExtend("123456");
        $req->setSmsType("normal");  //固定的
        $req->setSmsFreeSignName("注册验证");   //你发送的短信是干什么的?
        $req->setSmsTemplateCode("SMS_2245271");  //模板的id
        $req->setSmsParam("{'code':'$randomNumber','product':'源代码商城'}");
        $req->setRecNum($tel);  //发送的手机号
        $resp = $c->execute($req);
        //判定发送的状态
        return ((string)$resp->result->success)==='true';
    }

    public function login(){
        $username=$this->data['username'];
        $password=$this->data['password'];
        $row=$this->getByusername($username);
        if($row){
            if($row['status']!=1){
                $this->error='用户被禁用';
                return false;
            }
            if($row['password']==md5($password.$row['salt'])){
                return $row;
            }else{
                $this->error='密码错误';
                return false;
            }
        }else{
            $this->error='用户名错误';
            return false;
        }
    }


}