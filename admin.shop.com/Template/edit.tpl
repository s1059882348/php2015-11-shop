<extend name="Public:edit" />

<block name="form">
    <form method="post" action="{:U()}" name="listForm" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <?php foreach($fields as $field):
                    if($field['key']=='PRI'){
                         continue;
                    }
                    $comment = $field['comment'];
            ?>
            <tr>
                <td class="label"><?php echo $comment;?></td>
                <td>
                    <?php
                        if($field['input_type']=='text'){
                             echo "<textarea  name=\"{$field['field']}\" cols=\"60\" rows=\"4\"  >{\${$field['field']}}</textarea>\r\n";
                        }else if($field['input_type']=='file'){
                             echo "<input type=\"file\" name=\"{$field['field']}\">";
                        }else if($field['input_type']=='radio'){
                             if($field['field']=='status'){
                                    foreach($field['option_values'] as $key=>$value){
                                           echo "<input type=\"radio\" class=\"status\" name=\"{$field['field']}\" value=\"$key\" />{$value}";
                                    }
                             }else{
                                    foreach($field['option_values'] as $key=>$value){
                                            echo "<input type=\"radio\"  name=\"{$field['field']}\" value=\"$key\" />{$value}";
                                    }
                             }
                        }else{
                             if($field['field']=='sort'){
                                  echo  "<input type=\"text\" name=\"{$field['field']}\" maxlength=\"60\" value=\"{\$sort|default=20}\" />\r\n";
                             }else{
                                  echo  "<input type=\"text\" name=\"{$field['field']}\" maxlength=\"60\" value=\"{\${$field['field']}}\" />\r\n";
                             }
                        }
                    ?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <?php endForeach;?>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden" name="id" value="{$id}" class="button"/>
                    <input type="submit" class="button ajax-post" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</block>