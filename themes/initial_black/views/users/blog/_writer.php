<?php
    $lang = new Language;
    $user = Users::model()->findByPk($writer);
    $last_message = BlogsMessages::getUserLastMessage($writer);
    $image = BlogsImages::model()->find('blog_message = :message', array(':message'=>$last_message->id));
    preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $last_message->time, $arr);
    $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
?>

<div class="blog">
    <div class="blog_record">
        <div class="record_name">
            <a href="/blog/<?php echo $user->id;?>"><?php echo $user->name.' '.$user->surname;?></a>
        </div>
        <div class="record_image">
            <?php echo $image !== NULL ? '<a href="/bimages/'.$image->filename.'"><img style="max-width: 500px" src="/bimages/'.$image->filename.'"></a>' : ''; ?>
        </div>

        <div class="record_post_time">
            <?php echo $time;?>
        </div>

        <div class="record_text">
            <?php echo $last_message->text; ?>
        </div>
    </div>
</div>