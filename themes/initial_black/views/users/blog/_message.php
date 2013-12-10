<?php $this->pageTitle .= $message->name;?>
<a href="/blog/<?php echo $message->user;?>"><h1><?php echo Yii::t('blog', 'Blog of user ');?><?php echo CHtml::encode($author->name).' '.CHtml::encode($author->surname);?></h1></a>

<div class="blog">

    <div class="blog_record">

        <?php
          if(Yii::app()->user->id == $message->user || Yii::app()->user->id == $_GET['id'])
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
            <?php echo CHtml::encode($message->name);?>
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
            <?php echo $time;?>
        </div>

        <div class="record_text">
          <?php echo $message->text; ?>
        </div>

        <div class="record_image">
           <?php echo $image !== NULL ? '<a href="/bimages/'.$image->filename.'"><img style="max-width: 500px" src="/bimages/'.$image->filename.'"></a>' : ''; ?>
        </div>

        <?php

            echo '<hr><div class="record_name">'.Yii::t('blog', 'Comments').':</div>';

            $this->widget('CLinkPager',array(
                'pages'=>$pages,
                'maxButtonCount' => 1,
                'cssFile'=>'',
                'header' => '',
            ));

            if (empty($comments))
              echo '<div class="record_text">'.Yii::t('blog', 'No comments found').'</div>';
            else
              foreach($comments as $key=>$comment)
                  $this->renderPartial('blog/_comment',array(
                      'comment'=>$comment
                  ));

            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'wall-records-form',
                'enableAjaxValidation'=>false,
            ));
            echo '<table><tr><td>';
            echo $form->textArea(BlogsComments::model(), 'text', array('placeholder'=>Yii::t('profile', 'Content'), 'class'=>'input_form'));
            echo '</td></tr><tr><td>';
            echo CHtml::submitButton(Yii::t('profile', 'Write'), array('style'=>'margin: 0px;'));
            echo '</td></tr></table>';
            $this->endWidget();
         ?>
    </div>

</div>
