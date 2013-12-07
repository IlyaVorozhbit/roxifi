

<?php
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
?>


    <div class="user" onclick="window.location.href='/u<?php echo $user->id;?>'">
        <div class="status" style='float: left;'>
            <?php
            if(time()-strtotime($user->last_update)<120)
                echo '<div class="online" style="margin-right: 0px; margin-top: 15px;"></div>';
            else
                echo '<div class="offline" style="margin-right: 0px; margin-top: 15px;"></div>';
            ?>
        </div>
        <a href='/u<?php echo $user->id;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7; position: absolute;" src='<?php echo $profile_image;?>'></a>
        <div class="name">
            <?php echo $user->name.' '.$user->surname;?>
        </div>
    </div>
