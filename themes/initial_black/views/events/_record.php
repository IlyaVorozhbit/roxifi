<?php
    $lang = new Language;
    preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $record->time, $arr);
    $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$record->user));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$record->user.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="record">
    <div class="user_status">
        <?php
        echo time()-strtotime($author->last_update) < 120 ? '<div class="online"></div>' : '<div class="offline"></div>';
        ?>
    </div>
    <div class="wall_record_avatar">
        <a href='/u<?php echo $record->user;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
    </div>
    <div class="wall_record_right_block">
        <div class="wall_record_username">
            <a href="/u<?php echo $record->user;?>"><?php echo $author->name.' '.$author->surname;?></a>, <!--сегодня в--> <?php echo $time;?>.
        </div>
        <div class="text">
            <?php echo $record->text;
            echo ($record->user == Yii::app()->user->id || $owner == Yii::app()->user->id) ?
                '<a href="/events/deletewallrecord/'.$record->id.'"><img style="height: 30px; width: 30px;" src="/images/delete.png" align="right"/></a>' : '';
            ?>
        </div>
    </div>
</div>