<div class="blog_record">
    <div class="blog_record">
        <?php
          if (Yii::app()->user->id == $message->user || Yii::app()->user->id == $_GET['id'])
          {
            echo '<div class="delete_btn">';
            echo ' <a href="/blog/edit/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Edit').'</a>';
            echo ' <a href="/blog/delete/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Delete').'</a>';
            echo '</div>';
          }
          $lang = new Language;
          preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $message->time, $arr);
          $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
        ?>
        <div class="record_name">
          <?php echo '<a href="/blog/message/'.$message->id.'">'.CHtml::encode($message->name).'</a>';?>
        </div>

        <?php
            if ($message->privacy)
                if (Yii::app()->user->id == $_GET['id'])
                {
                    echo '<div class="record_privacy">';
                    echo 'private';
                    echo '</div>';
                }
            $image = BlogsImages::model()->find('blog_message = :message', array(':message'=>$message->id));
            $comments = BlogsComments::model()->count('blog_message = :message', array(':message'=>$message->id));
        ?>


        <div class="record_post_time">
            <?php echo $time;?>
        </div>

        <div class="record_text">
          <?php echo $message->text; ?>
        </div>

        <div class="record_image">
           <?php echo $image !== NULL ? '<a href="/bimages/'.$image->filename.'"><img style="max-width: 500px" src="/bimages/'.$image->filename.'"></a>' : ''; ?>
        </div>

        <div class="record_text">
          <?php echo '<i><a href="/blog/message/'.$message->id.'">'.CHtml::button(Yii::t('blog', 'Comments').' ('.$comments.')').'</a></i>';?>
        </div>       
    </div>

</div>
