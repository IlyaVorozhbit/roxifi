
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
            if ($message->privacy)
                if (Yii::app()->user->id == $_GET['id'])
                {
                    echo '<div class="record_privacy">';
                    echo 'private';
                    echo '</div>';
                }
            $image = BlogsImages::model()->find('blog_message = :message', array(':message'=>$message->id));
        ?>


        <div class="record_post_time">
            <?php echo $message->time;?>
        </div>

        <div class="record_text">
          <?php echo $message->text; ?>
        </div>

        <div class="record_image">
           <?php echo $image !== NULL ? '<img style="max-width: 500px" src="/bimages/'.$image->filename.'">' : ''; ?>
        </div>

        <?php

            echo '<h2>'.Yii::t('blog', 'Comments').':</h2>';

            $this->widget('CLinkPager',array(
                'pages'=>$pages,
                'maxButtonCount' => 1,
                'cssFile'=>'',
                'header' => '',
            ));

            foreach($comments as $key=>$comment)
                $this->renderPartial('blog/_comment',array(
                    'comment'=>$comment
                ));

            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'wall-records-form',
                'enableAjaxValidation'=>false,
            ));
            echo '<table><tr><td>';
            echo Yii::t('blog', 'Comment').':';
            echo '</td></tr><tr><td>';
            echo $form->textArea(BlogsComments::model(), 'text', array('placeholder'=>Yii::t('profile', 'Content'), 'class'=>'input_form'));
            echo '</td></tr><tr><td>';
            echo CHtml::submitButton(Yii::t('profile', 'Write'), array('style'=>'margin: 0px;'));
            echo '</td></tr></table>';
            $this->endWidget();
         ?>
    </div>

</div>
