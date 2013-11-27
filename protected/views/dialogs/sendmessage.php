<?php
/* @var $this DialogsController */
/* @var $model Messages */
/* @var $user Users */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    Yii::t('dialogs', 'Dialogs')=>array('/dialogs'),
    Yii::t('dialogs', 'Writing message'),
);
$fullname = UsersInfo::model()->getFullName($user->id);
?>

<h1><?php echo Yii::t('dialogs', 'Message for user ')?><a href="/u<?php echo $user->id;?>"><?php echo $fullname['name'].' '.$fullname['surname'];?></a></h1>

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'messages-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <div class="row" style="padding: 0px;">
        <?php echo $form->textArea($model,'text', array('placeholder'=>Yii::t('dialogs', 'Message'), 'style'=>'resize: none; width:600px; height:200px;')); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>

    <div class="row" style="padding: 0px;">
        <?php echo CHtml::submitButton(Yii::t('dialogs', 'Send message'));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
