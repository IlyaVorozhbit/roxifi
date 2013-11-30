

<?php
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="friend_list">

    <div class="friend">
        <div class="friend_avatar">

        </div>
        <a href='/u<?php echo $user->id;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
        <div class="name">
            <?php echo $user->name.' '.$user->surname;?>
        </div>
    </div>

</div>