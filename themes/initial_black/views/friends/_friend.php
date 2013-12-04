<?
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$friend->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$friend->id.'/'.$avatar->filename : '/images/no_avatar.png';
    $fullname = Users::model()->getFullName($friend->id);
?>

<div class="friend" onclick="location.href='/u<?php echo $friend->id;?>'">

    <div class="user_name">
        <?php echo $fullname['name'].' '.$fullname['surname']?>
    </div>

    <a style='padding: 20px; width: 190px;' href="/u<?php echo $friend->id;?>">
        <img style='margin-right: 10px; width: 50px; height: 50px;' src='<?php echo $profile_image;?>'>

    </a>

    <div class="right_block">
        <a class="btn" href="/friends/del/<?php echo $friend->id?>"><?php echo Yii::t('friends', 'Delete friend')?></a>
        <a class="btn" href="/dialogs/sendmessage/<?php echo $friend->id?>"><?php echo Yii::t('dialogs', 'Write message')?></a>
    </div>

</div>
