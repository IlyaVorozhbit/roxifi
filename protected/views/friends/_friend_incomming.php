<?
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$friend->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$friend->id.'/'.$avatar->filename : '/images/no_avatar.png';
    $fullname = Users::model()->getFullName($friend->id);
?>

<div class="friend" onclick="location.href='/u<?php echo $friend->id;?>'">
    <div class="user_status" style='float: left;'>
        <?php
            if(time()-strtotime($friend->last_update)<120)
                echo '<div class="online" style="margin-right: 0px; margin-top: 15px;"></div>';
            else
                echo '<div class="offline" style="margin-right: 0px; margin-top: 15px;"></div>';
        ?>
    </div>
    <div class="user_name">
        <?php echo $fullname['name'].' '.$fullname['surname']?>
    </div>
    <a style='padding: 20px; width: 190px;' href="/u<?php echo $friend->id;?>">
        <img style='margin-right: 10px; width: 50px; height: 50px;' src='<?php echo $profile_image;?>'>
    </a>
    <div class="right_block">
       <a class="btn" href="/friends/accept/<?php echo $friend->id?>"><?php echo Yii::t('friends', 'Accept request')?></a>
       <a class="btn" href="/friends/reject/<?php echo $friend->id?>"><?php echo Yii::t('friends', 'Reject request')?></a>
    </div>
</div>
