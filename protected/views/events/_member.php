<div class="member">
    <?php
        $avatar = UsersImages::model()->find('user = :user', array('user'=>$member->id));
        $profile_image =  $avatar !== NULL ? '/avatars/u'.$member->id.'/'.$avatar->filename : '/images/no_avatar.png';
        $fullname = UsersInfo::model()->getFullName($member->id);
    ?>
    <a href='/u<?php echo $member->id;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
    <div class="name"><?php echo $fullname['name'].' '.$fullname['surname']?></div>
</div>
