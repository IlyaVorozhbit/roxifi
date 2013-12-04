<div class="folder_comment">

    <div class="user">
        <div class="name">
            <?php echo $author->name.' '.$author->surname;?>
        </div>
    </div>

    <div class="time">
        <?php
            $lang = new Language;
            preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $comment->time, $arr);
            $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
            echo $time;
        ?>
    </div>

    <?php echo $comment->text;?>
</div>