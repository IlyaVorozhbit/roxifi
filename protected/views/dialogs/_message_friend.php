<div class="friend">
    <?php
      if ($message->status == 0)
        echo '<span class="label">new</span>';
      $fullname = UsersInfo::model()->getFullName($author->id);
      preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $message->time, $arr);
      $time = $arr[3].'.'.$arr[2].'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
    ?>
    <a href="/u<?php echo $author->id;?>"><?php echo $fullname['name']?></a>, <?php echo $time;?> <br>
    <?php echo $message->text;?>
    <div align="right">
        <?php /*<a href="/dialogs/deletemessage/<?php echo $message->id;?>"><i class="icon-trash"></i></a>*/?>
    </div>
</div>
