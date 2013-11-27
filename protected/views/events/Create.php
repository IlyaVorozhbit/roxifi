<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->breadcrumbs=array(
        Yii::t('events', 'Events')=>array('/events'),
        Yii::t('events', 'Event creation')
    );

    $this->pageTitle .= Yii::t('events', 'Event creation');

?>

<h1><?php echo Yii::t('events', 'Event creation')?></h1>

<div class="form">

    <?php


    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'events-form',
    )); ?>

    <div class="row">
        <?php echo $form->textField($event,'name',array('size'=>60,'maxlength'=>255,'placeholder'=>Yii::t('events', 'Name'))); ?>
        <?php echo $form->error($event,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->textArea($event,'description',array('size'=>60,'maxlength'=>255,'placeholder'=>Yii::t('events', 'Description'))); ?>
        <?php echo $form->error($event,'description'); ?>
    </div>

    <div class="row">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>'time',
            'value'=>$event->time,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
            ),
            'htmlOptions'=>array(
                'style'=>'height:20px;',
                'placeholder'=>Yii::t('events', 'Date')
            ),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton(Yii::t('events', 'Create event'));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

