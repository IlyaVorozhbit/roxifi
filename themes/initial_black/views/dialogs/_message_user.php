<div class="user_message">
    <?php
    if ($message->status == 0 or $message->status == 5)
        echo '<span class="label">new</span>';

    preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $message->time, $arr);
    $time = $arr[4].':'.$arr[5].':'.$arr[6].', '.$arr[3].'.'.$arr[2].'.'.$arr[1];
    ?>
    <a href="/u<?php echo $author->id;?>"><div class="user_name"><?php echo $author->name.' '.$author->surname;?></div></a>
    <div class="time">
        <?php echo $time;?>
    </div>
    <?php echo $message->text;?>
    <div align='right'>
        <a class="btn delete_btn" href="/dialogs/deletemessage/<?php echo $message->id;?>"><?php echo Yii::t('profile', 'Delete')?></a>
    </div>
</div>
