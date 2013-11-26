<?php
/* @var $this DialogsController */
/* @var $model Messages */
/* @var $user Users */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    Yii::t('dialogs', 'Dialogs')=>array('/dialogs'),
    Yii::t('dialogs', 'Writing message'),
);
?>

<h1><?php echo Yii::t('dialogs', 'Message for user ')?> <a href="/u<?php echo $user->id;?>"><?php echo $user->login;?></a></h1>

<div class="form dialog">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'messages-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <div class="row">
        <?php echo $form->textArea($model,'text',array('size'=>60,'maxlength'=>255,'placeholder'=>Yii::t('dialogs', 'Message'))); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton(Yii::t('dialogs', 'Send message'));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->