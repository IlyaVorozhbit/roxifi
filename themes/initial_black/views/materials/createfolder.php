<?php


    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
    $this->breadcrumbs=array(
        Yii::t('materials', 'Materials'),
    );
?>

<h1><?php echo Yii::t('materials', 'Materials')?></h1>


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
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description'); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'privacy'); ?>
        <?php echo $form->dropDownList($model,'privacy',array(0=>Yii::t('blog', 'For everyone'),1=>Yii::t('blog', 'For friends only'))); ?>
        <?php echo $form->error($model,'privacy'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('materials', 'Create folder')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
