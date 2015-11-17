<?php
header('Content-Type:text/html;charset=utf-8');
$str1='状态@radio';
$str2='fdsfdf';

//$comment=strstr($str2,'@',true);

//preg_match('/(\D*)@(\w*)\|?(.*)/',$str1,$match);
//
//
//var_dump($match);

//$comment = strpos($field['comment'],'@')===false?$field['comment']:strstr($field['comment'],'@',true);



$arr=array(
    0=>'零',
    1=>'壹',
    2=>'贰',
    3=>'叁',
    4=>'肆',
    5=>'伍',
    6=>'陆',
    7=>'柒',
    8=>'捌',
    9=>'玖',
);
$num=13.54;
$num_arr=str_split($num);
$g=strlen(floor($num));
$weishu=array(
    1=>'元',
    2=>'拾',
    3=>'佰',
    4=>'仟',
    5=>'万',
);
switch($g){
    case $a=1:
        $w= '元';
        break;
    case $a=2:
        $w= '拾';
        break;
    case $a=3:
        $w= '佰';
        break;
    case $a=4:
        $w= '仟';
        break;
    case $a=5:
        $w= '万';
        break;
}
$xinwei=strstr($weishu,0);
print_r($xinwei);
exit;
$a=null;
$str='';
foreach($num_arr as $key=>$value){
    if($key=='.'){
        $a=$key;
    }
    foreach($arr as $i=>$d){
        if($value==$i){
        }
    }
}






