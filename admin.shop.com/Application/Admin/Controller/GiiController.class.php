<?php
/**
 * Created by PhpStorm.
 * User: 苏异
 * Date: 15-11-2
 * Time: 下午6:10
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        if(IS_POST){
            //header 头信息
            header('Content-Type:text/html;charset=utf-8');
            //提供模板中所需的数据  $meta_title
            $table_name=I('post.table_name');
            $name=parse_name($table_name,1);
            $sql="select table_comment from information_schema.TABLES".
            " where table_schema='".C('DB_NAME')."' and table_name='$table_name'";
            $rows=M()->query($sql);
            $meta_title=$rows[0]['table_comment'];
            //模板路径常量
            defined('TEMPLATE_PATH') or define('TEMPLATE_PATH',ROOT_PATH.'Template/');

            ////////////////////生成控制器/////////////////////////////
            //开启ob缓存 引入模板文件
            ob_start();
            require TEMPLATE_PATH.'Controller.tpl';
            //获取模板缓存文件内容 找到要生成的控制器文件路径
            $controller_content=ob_get_clean();
            $controller_content="<?php\n\r".$controller_content;
            $controller_path=APP_PATH.'Admin/Controller/'.$name.'Controller.class.php';
            //将文件内容加入文件
            file_put_contents($controller_path,$controller_content);

            ////////////////字段和注解////////////////////////
            //获取表中的每个字段的详细信息.
            $sql="show full columns from ".$table_name;
            $fields=M()->query($sql);
            //拆解注释
            foreach($fields as &$field){
                $comment = $field['comment'];
                preg_match('/(.*)@(\w*)\|?(.*)/',$field['comment'],$match);
                if(!empty($match)){
                    $field['comment']=$match[1];
                    $field['input_type']=$match[2];
                    if(!empty($match[3])){
                        parse_str($match[3],$output);
                        $field['option_values']=$output;
                    }
                }
            }
            unset($field);

            //////////////////生成模型////////////////////
            //开启ob缓存 引入模板文件
            ob_start();
            require TEMPLATE_PATH.'Model.tpl';
            //获取模板缓存文件内容 找到要生成的模型文件路径
            $model_content=ob_get_clean();
            $model_content="<?php\n\r".$model_content;
            $model_path=APP_PATH.'Admin/Model/'.$name.'Model.class.php';
            //将文件内容加入文件
            file_put_contents($model_path,$model_content);

            ////////////////////生成index页面/////////////////////////////
            //开启ob缓存 引入模板文件
            ob_start();
            require TEMPLATE_PATH.'index.tpl';
            //获取模板缓存文件内容 找到要生成的视图文件路径
            $index_content=ob_get_clean();
            $view_path=APP_PATH.'Admin/View/'.$name;
            if(!is_dir($view_path)){
                mkdir($view_path,0777,true);  //创建目录
            }
            $index_path=$view_path.'/index.html';
            //将文件内容加入文件
            file_put_contents($index_path,$index_content);



            ////////////////////生成edit页面/////////////////////////////
            //开启ob缓存 引入模板文件
            ob_start();
            require TEMPLATE_PATH.'edit.tpl';
            //获取模板缓存文件内容 找到要生成的视图文件路径
            $edit_content=ob_get_clean();
            $view_path=APP_PATH.'Admin/View/'.$name;
            if(!is_dir($view_path)){
                mkdir($view_path,0777,true);  //创建目录
            }
            $edit_path=$view_path.'/edit.html';
            //将文件内容加入文件
            file_put_contents($edit_path,$edit_content);

            $this->success('代码成功生成!');

        }else{
            $this->display('index');
        }
    }

}