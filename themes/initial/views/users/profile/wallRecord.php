<?php
<<<<<<< HEAD
      $lang = new Language;
=======

>>>>>>> 4a03daea0cacae7eaf43d5586ebf90c4bc0a263c
      preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $record->time, $arr);
      $record->time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
      $info = UsersInfo::model()->findAll('user = :user AND field IN (2, 3)', array('user'=>$record->user_from));
      foreach($info AS $field)
          if ($field->field == 2)
              $name = $field->value;
          else
              $surname = $field->value;

?>
<div class="record">

    <div class="wall_record_avatar">
        Avatar
    </div>

    <div class="wall_record_right_block">
        <div class="wall_record_username">
            <a href="/u<?php echo $record->user_from;?>"><?php echo $name.' '.$surname;?></a>, <!--сегодня в--> <?php echo $record->time;?>.

        </div>

        <div class="text">
            <?php echo $record->text;
            echo ($record->user_to == Yii::app()->user->id || $record->user_from == Yii::app()->user->id) ?
                '<a href="/u'.$record->user_to.'/wrec?record_id='.$record->id.'&delete"><img style="height: 30px; width: 30px;" src="/images/delete.png" align="right"/></a>' : '';
            ?>
        </div>
    </div>

<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> 4a03daea0cacae7eaf43d5586ebf90c4bc0a263c
