<?php
/*
 * @var $this DialogsController
 * @var $lang Language
 */

$this->breadcrumbs=array(
    Yii::t('dialogs', 'Dialogs')=>array('/dialogs'),
    Yii::t('dialogs', 'Dialog with user '). ' '.$user_friend->login,
);

    $this->pageTitle .= Yii::t('dialogs', 'Dialog with user '). ' '.$user_friend->login;

?>
<h1><?php echo Yii::t('dialogs', 'Dialog with user ') .' <a href="/u'.$user_friend->id.'">'.$user_friend->login.'</a>'?></h1>

<div class="dialog">

    <div class="form">


        <?php

        if(!Messages::model()->count('(dialog = '.$dialog->id.')>0  and ((show_sender = 1 and sender='.Yii::app()->user->id.') or (show_recipient = 1 and recipient='.Yii::app()->user->id.'))')==0)
            $this->widget('CLinkPager',array(
                'pages'=>$pages,
                'maxButtonCount' => 1,
                'cssFile'=>'',
            ));
        else
            echo Messages::model()->count('(dialog = '.$dialog->id.')>0  and ((show_sender = 1 and sender='.Yii::app()->user->id.') or (show_recipient = 1 and recipient='.Yii::app()->user->id.'))');

        $form=$this->beginWidget('CActiveForm', array(
        'id'=>'messages-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

        <div class="row">
            <?php echo $form->textArea($model,'text',array('rows'=>5, 'placeholder'=>Yii::t('dialogs', 'Message'), 'style'=>'resize: none; width: 600px;')); ?>
            <?php echo $form->error($model,'text'); ?>
        </div>

        <div class="row">
            <?php echo CHtml::submitButton(Yii::t('dialogs', 'Send message'));?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

        <?php
            foreach($messages as $key=>$message)
            {
              if (($message->sender == Yii::app()->user->id && $message->show_sender != 1) ||
                  ($message->recipient == Yii::app()->user->id && $message->show_recipient != 1))
                continue;
              else
                $this->renderPartial('_message',array(
                    'message'=>$message,
                    'friend'=>$user_friend,
                    'user'=>$user
                ));
            }
        ?>

</div>
