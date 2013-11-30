
<h1><?php echo Yii::t('blog', 'Blog of user ');?> <a href="/blog/<?php echo $message->user;?>"><?php echo $author->name.' '.$author->surname;?></a></h1>

<div class="blog">

    <div class="blog_record">

        <?php
            if(Yii::app()->user->id == $message->user)
            {
                echo '<div class="delete_btn">';
                echo ' <a href="/blog/edit/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Edit').'</a>';
                echo ' <a href="/blog/delete/message/'.$message->id.'" class="btn">'.Yii::t('blog', 'Delete').'</a>';
                echo '</div>';
            }
        ?>

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
            <?php echo $message->name;?>
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


        <div class="record_post_time">
            <?php echo $message->time;?>
        </div>

        <div class="record_text">
            <?php echo $message->text;?>
        </div>



    </div>

</div>