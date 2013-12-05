<div class="form">
  <?php
    $form = $this->beginWidget('CActiveForm', array(
      'id'=>'login-form',
      'enableClientValidation'=>true,
      'clientOptions'=>array('validateOnSubmit'=>true),
      'htmlOptions'=>array('enctype'=>'multipart/form-data')
    ));
  ?>

  <div class="row">
      <?php echo $form->labelEx($model,'name').'<br>'; ?>
      <?php echo $form->textField($model,'name'); ?>
      <?php echo $form->error($model,'name'); ?>
  </div>

  <div class="row">
      <?php echo $form->labelEx($model,'text').'<br>'; ?>
      <?php echo $form->textArea($model,'text',array('class'=>'blog_form')); ?>
      <?php echo $form->error($model,'text'); ?>
  </div>

  <div class="row">
      <?php echo $form->labelEx($model,'privacy').'<br>'; ?>
      <?php echo $form->dropDownList($model,'privacy',array(0=>Yii::t('blog', 'For everyone'),1=>Yii::t('blog', 'For friends only'))); ?>
      <?php echo $form->error($model,'privacy'); ?>
  </div>

  <div class="row">
    <?php
      echo Yii::t('blog', 'Image').':<br>';
      $image = BlogsImages::model()->find('blog_message = :message', array(':message'=>$model->id));
      echo $image !== NULL ? '<div><img style="max-width: 100px" src="/bimages/'.$image->filename.'"><br><a href="/blog/edit/message/'.$model->id.'?delete_image">'.CHtml::button(Yii::t('blog', 'Delete'), array('style'=>'margin-left: 2px;')).'</div>' : '';
      echo $form->fileField(BlogsImages::model(), 'filename');
    ?>
  </div>

  <div class="row buttons">
      <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('blog', 'Add') : Yii::t('blog', 'Save'));?>
  </div>

  <?php $this->endWidget(); ?>
</div><!-- form -->
