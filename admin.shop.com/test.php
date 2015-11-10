<?php
header('Content-Type:text/html;charset=utf-8');
$str1='状态@radio';
$str2='fdsfdf';

//$comment=strstr($str2,'@',true);

preg_match('/(\D*)@(\w*)\|?(.*)/',$str1,$match);


var_dump($match);

//$comment = strpos($field['comment'],'@')===false?$field['comment']:strstr($field['comment'],'@',true);