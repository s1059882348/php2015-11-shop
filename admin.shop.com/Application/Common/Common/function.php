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
//    foreach ($errors as $error) {
//        $msg .= "<li>$error</li>";
//    }
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
 * 实现array_column方法
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