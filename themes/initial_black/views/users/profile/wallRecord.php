<?php
    $lang = new Language;
    preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $record->time, $arr);
    $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    $user = Users::model()->findByPk($record->user_from);
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$record->user_from));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$record->user_from.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="record">
  <div class="user_status">
    <?php
      echo time()-strtotime($user->last_update) < 120 ? '<div class="online"></div>' : '<div class="offline"></div>';
    ?>
  </div>
  <div class="wall_record_avatar">
    <a href='/u<?php echo $record->user_from;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
  </div>
  <div class="wall_record_right_block">
    <div class="wall_record_username">
      <a href="/u<?php echo $record->user_from;?>"><?php echo $user->name.' '.$user->surname;?></a>, <!--сегодня в--> <?php echo $time;?>.
    </div>
    <div class="text">
      <?php  echo CHtml::encode($record->text);
      echo ($record->user_to == Yii::app()->user->id || $record->user_from == Yii::app()->user->id) ?
      '<a href="/u'.$record->user_to.'/wall?record_id='.$record->id.'&delete"><img style="height: 30px; width: 30px;" src="/images/delete.png" align="right"/></a>' : '';
      ?>
    </div>
  </div>
</div>
