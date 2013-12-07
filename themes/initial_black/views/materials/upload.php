<?php
    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
    $this->breadcrumbs=array(
        Yii::t('materials', 'Materials'),
    );
?>

<h1><?php echo Yii::t('materials', 'Materials')?></h1>

<div class="form">
<?php
  if (isset($_GET['folder']))
  {
    $folder = MaterialsFolders::model()->findByPk($_GET['folder']);
    if ($folder != NULL)
    {
      $form = $this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
        'htmlOptions'=>array('enctype'=>'multipart/form-data')
      ));
      echo Yii::t('materials', 'about').'<br><hr>';
      echo CHtml::form('', 'post',  array('enctype'=>'multipart/form-data'));
      echo Yii::t('materials', 'Name (optional)').':<br><br>';
      echo CHtml::activeTextField($model, 'name', array('style'=>'width: 600px')).'<br><br>';
      echo Yii::t('materials', 'Description (optional)').':<br><br>';
      echo CHtml::activeTextArea($model, 'description', array('rows'=>4, 'style'=>'resize: none; width: 600px')).'<br><br>';
      echo CHtml::activeFileField($model, 'image').'<br><br>';
      echo $form->hiddenField($model, 'folder', array('value'=>$folder->id));
      echo CHtml::submitButton(Yii::t('materials', 'Upload a file'));
      $this->endWidget();
    }
    else
      header('Location: /materials');
  }
?>

</div>
