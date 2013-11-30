<div class="blog_record">

    <?php
    if(Yii::app()->user->id == $_GET['id'])
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
        <?php echo $message->time;?>
    </div>


</div>