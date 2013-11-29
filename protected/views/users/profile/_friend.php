<div class="friend">
    <?php
        $avatar = UsersImages::model()->find('user = :user', array('user'=>$friend->id));
        $profile_image =  $avatar !== NULL ? '/avatars/u'.$friend->id.'/'.$avatar->filename : '/images/no_avatar.png';
        $fullname = UsersInfo::model()->getFullName($friend->id);
    ?>
    <a href='/u<?php echo $friend->id;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
    <div class="name"><?php echo $fullname['name'].' '.$fullname['surname']?></div>
</div>
