<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - Регистрация';
    $this->breadcrumbs=array(
        'Регистрация',
    );
?>

<h1>Регистрация</h1>


<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'surname'); ?>
        <?php echo $form->textField($model,'surname'); ?>
        <?php echo $form->error($model,'surname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'login'); ?>
        <?php echo $form->textField($model,'login'); ?>
        <?php echo $form->error($model,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'language'); ?>
        <?php echo $form->dropDownList($model,'language',array('ru'=>'Русский','en'=>'English')); ?>
        <?php echo $form->error($model,'language'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Регистрация'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
