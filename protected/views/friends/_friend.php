<?
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$friend->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$friend->id.'/'.$avatar->filename : '/images/no_avatar.png';
    $fullname = Users::model()->getFullName($friend->id);
?>

<table>
  <tr>
    <td style='width: 80%'>
      <a style='padding: 20px; width: 190px;' href="/u<?php echo $friend->id;?>">
        <img style='margin-right: 10px; width: 50px; height: 50px;' src='<?php echo $profile_image;?>'>
        <?php echo $fullname['name'].' '.$fullname['surname']?>
      </a>
    </td>
    <td style='text-align: right;'>
      <a class="btn" href="/friends/del/<?php echo $friend->id?>"><?php echo Yii::t('friends', 'Delete friend')?></a>
      <a class="btn" href="/dialogs/sendmessage/<?php echo $friend->id?>"><?php echo Yii::t('dialogs', 'Write message')?></a>
    </td>
  </tr>
</table>
