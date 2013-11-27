<?php

    $messages_count = Messages::model()->count('recipient='.Yii::app()->user->id.' and dialog = '.$dialog->id.' and status=0');
    $dialogs_label = $messages_count > 0 ? ' +'.$messages_count.'' : '';
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
    $info = UsersInfo::model()->findAll('user = :user AND field IN (2, 3)', array('user'=>$user->id));
    foreach($info AS $field)
      if ($field->field == 2)
        $name = $field->value;
      else
        $surname = $field->value;
?>

<a class="btn" style='padding: 20px; width: 220px;' href="/dialogs/view/<?php echo $dialog->id;?>">
  <img style='margin-right: 10px; width: 50px; height: 50px;' src='<?php echo $profile_image;?>'>
  <?php echo $name.' '.$surname.' '.$dialogs_label?>
</a>

<hr/>
