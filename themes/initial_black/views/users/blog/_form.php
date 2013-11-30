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
        <?php echo $form->labelEx($model,'text'); ?>
        <?php echo $form->textArea($model,'text',array('class'=>'blog_form')); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'privacy'); ?>
        <?php echo $form->dropDownList($model,'privacy',array(0=>Yii::t('blog', 'For everyone'),1=>Yii::t('blog', 'For friends only'))); ?>
        <?php echo $form->error($model,'privacy'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('blog', 'Add') : Yii::t('blog', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->