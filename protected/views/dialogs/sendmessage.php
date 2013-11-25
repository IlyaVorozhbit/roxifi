<?php
/* @var $this DialogsController */
/* @var $model Messages */
/* @var $user Users */
/* @var $lang Language */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
    $lang->Translate(43)=>array('/dialogs'),
    $lang->Translate(44),
);
?>

<h1><?php echo $lang->Translate(42);?> <a href="/u<?php echo $user->id;?>"><?php echo $user->login;?></a></h1>

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
        <?php echo $form->textArea($model,'text',array('size'=>60,'maxlength'=>255,'placeholder'=>$lang->Translate(12))); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton($lang->Translate(40));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->