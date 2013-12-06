<?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
    ));
?>

<div class="row">
    <?php echo $form->textArea($model,'text', array('class'=>'blog_form', 'cols'=>140,'rows'=>3, 'placeholder'=>Yii::t('minds', 'Your mind about person'))); ?>
    <?php echo $form->error($model,'text'); ?>
</div>


<div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord? Yii::t('minds', 'Leave your mind') : Yii::t('minds', 'Edit'));?>
</div>

<?php $this->endWidget(); ?>