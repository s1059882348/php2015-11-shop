
namespace Admin\Model;


use Think\Model;

class <?php echo $name;?>Model extends BaseModel
{
    //自动验证定义
    protected $_validate =array(
        <?php foreach($fields as $field){
            if($field['key']=='PRI'  || $field['null']=='YES'){
                 continue;
            }
              $comment = $field['comment'];
              echo  "array('{$field['field']}','require','{$comment}不能够为空!'),\r\n";
        }?>
    );



}