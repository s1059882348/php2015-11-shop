<?php

/**
 * 将错误信息拼装成行
 * @param $model
 * @return string
 */
function showErrors($model)
{
    $errors = $model->getError();
    //将每一个错误信息使用一个li显示
    $msg = '<ul>';
    if(is_array($errors)){
        foreach ($errors as $error) {
            $msg .= "<li>$error</li>";
        }
    }else{
        $msg .= "<li>$errors</li>";
    }
    $msg .= '</ul>';
    return $msg;
}

/*
 * 实现array_column方法 从数组中取出某个字段的所有值
 */
if(!function_exists('array_column')){
    function array_column(array $rows,$key){
        $temp=array();
        foreach($rows as $row){
            $temp[]=$row[$key];
        }
        return $temp;
    }
}

/**
 * 根据一些数组的值构建表单select项
 * @param $name  name属性
 * @param $rows  值的集合
 * @param $defaultValue  默认值
 * @param string $fieldId  value的键名
 * @param string $fieldName 显示值的键名
 */
function arr2select($name,$rows,$defaultValue,$fieldId='id',$fieldName='name'){
    $html = "<select name='{$name}' class='{$name}'>
           <option value=''>--请选择--</option>";
    foreach ($rows as $row) {
        $select='';
        if($row[$fieldId]==$defaultValue){
            $select='selected="selected"';
        }
        $html .= "<option value='{$row[$fieldId]}' $select>--{$row[$fieldName]}--</option>";
    }
    $html .= "</select>";
    echo $html;
}

//登录时保存用户信息，无参数时表示获取用户信息从session中
function login($userinfo=null){
    if($userinfo){
        session('USERINFO',$userinfo);
    }else{
        return session('USERINFO');
    }
}

//验证用户是否登录，返回true时登录，返回false没有登录
function isLogin(){
    return login()!==null;
}

//退出，将session中的用户信息清空
function logout(){
    session('USERINFO',null);
    session('PERMISSIONURL',null);
    session('PERMISSIONID',null);
}

//登录时保存用户权限地址，无参数时表示获取用户权限地址从session中
//传参数不传值，清空用户权限地址
function savePermissionURL($urls=null){
    if($urls){
        session('PERMISSIONURL',$urls);
    }else{
        return session('PERMISSIONURL');
    }
}

//登录时保存用户权限id，无参数时表示获取用户权限id从session中
function savePermissionId($ids=null){
    if($ids){
        session('PERMISSIONID',$ids);
    }else{
        return session('PERMISSIONID');
    }
}

//判断当前用户是否是超级管理员
function isSuperUser(){
    $userinfo=login();
    $username=$userinfo['username'];
    $super_name=C('SUPER_USER');
    if($username==$super_name){
        return ture;
    }
}


/**
 * 发送邮件的方法
 * @param $mail_ads 收件人
 * @param $title  标题
 * @param $content 内容
 */
function sendMail($mail_ads,$title,$content){
    $sendMailThread = new SendMailThread($mail_ads,$title,$content);
    $sendMailThread->start();
//    $sendMailThread->detach();  如果加上这个方法是无法发送邮件
}

/**
 * 发送邮件的线程类
 * Class SendMailThread
 */
//class SendMailThread  extends Thread{
//    private $mail_str;
//    private $title;
//    private $content;
//    public function __construct($mail_str,$title,$content){
//        $this->mail_str = $mail_str;
//        $this->title = $title;
//        $this->content = $content;
//    }
//
//    public function run(){
//        vendor('PHPMailer.PHPMailerAutoload');
//        $mail_config =  C('MAIL_CONFIG');
//        $mail = new \PHPMailer;
//        $mail->isSMTP();                                      // 设置发送邮件协议: SMTP
//        $mail->Host = $mail_config['Host'];                         // 设置邮件的服务器
//        $mail->SMTPAuth = true;                               // 开启授权
//        $mail->Username = $mail_config['Username'];              // 登陆用户的用户名
//        $mail->Password = $mail_config['Password'];                    // 登陆用户的密码
//
//        /////////////////////准备邮件内容///////////////////////////////////////
//        $mail->setFrom($mail_config['From'], 'NOReply');          //发件人
//
//        $mail->addAddress($this->mail_str);     // 收件人
//        //$mail->addAddress('ellen@example.com');               // Name is optional
////            $mail->addReplyTo('itsource520@126.com', 'Information');
//
//        $mail->isHTML(true);                                  // 设置邮件为Html的邮件
//        $mail->CharSet = 'utf-8';                              //设置编码
//        $mail->Subject = $this->title;   //邮件的标题
//        $mail->Body    = $this->content;   //邮件的内容
//        if($mail->send()===false){
//            $this->error = $mail->ErrorInfo;
//            return false;
//        }
//    }
//}