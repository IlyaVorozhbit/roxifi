<div class="friend">
    <?php
        $avatar = UsersImages::model()->find('user = :user', array('user'=>$friend->id));
        $profile_image =  $avatar !== NULL ? '/avatars/u'.$friend->id.'/'.$avatar->filename : '/images/no_avatar.png';
    ?>
    <a href='/u<?php echo $friend->id;?>'><img src="<?php echo $profile_image;?>"/></a>

    <div class="name"><?php echo $friend->login;?></div>
</div>
