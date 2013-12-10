<?php
    $messages_count = Messages::model()->count('recipient='.Yii::app()->user->id.' and dialog = '.$dialog->id.' and (status=0 or status=5)');
    $dialogs_label = $messages_count > 0 ? ' +'.$messages_count.'' : '';
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="dialog" onclick="window.location.href='/dialogs/view/<?php echo $dialog->id;?>'">

    <div class="left_block">
        <div class="avatar">
            <img style='width: 100px; height: 100px;' src='<?php echo $profile_image;?>'>
        </div>
    </div>

    <div class="right_block">
        <div class="status" style='float: left;'>
            <?php
            if(time()-strtotime($user->last_update)<60*10)
                echo '<div class="online" style="margin-left: 2px; margin-top: 2px;"></div>';
            else
                echo '<div class="offline" style="margin-left: 2px; margin-top: 2px;"></div>';
            ?>
        </div>
        <div class="user_name">
            <a href="/dialogs/view/<?php echo $dialog->id;?>"><?php echo CHtml::encode($user->name).' '.CHtml::encode($user->surname).' '.$dialogs_label?></a>
        </div>

        <div class="last_update">
            <?php echo $dialog->last_update;?>
        </div>

    </div>

</div>




