<div class="blog_record">
    <?php
    if (Yii::app()->user->id == $_GET['id'])
    {
        echo '<div class="delete_btn">';
        echo ' <a href="/blog/edit/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Edit').'</a>';
        echo ' <a href="/blog/delete/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Delete').'</a>';
        echo '</div>';
    }
    ?>

    <div class="record_name">
        <a href="/blog/message/<?php echo $message->id;?>"><?php echo $message->name;?></a>
    </div>

    <?php
      if($message->privacy)
      {
          if(Yii::app()->user->id == $_GET['id'])
          {
              echo '<div class="record_privacy">';
              echo 'private';
              echo '</div>';
          }
      }
    ?>

    <div class="record_post_time_preview">
      <?php
        $lang = new Language;
        preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $message->time, $arr);
        $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
        echo $time;
      ?>
    </div>
</div>
