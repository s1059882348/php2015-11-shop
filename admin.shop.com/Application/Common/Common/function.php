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
}

//登录时保存用户权限地址，无参数时表示获取用户权限地址从session中
function savePermissionURL($urls=null){
    if($urls){
        session('PERMISSIONURL',$urls);
    }else{
        return session('PERMISSIONURL');
    }
}