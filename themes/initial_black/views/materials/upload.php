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
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )

)); ?>
    <?php

        if(MaterialsFolders::model()->count('user=:user',array(':user'=>Yii::app()->user->id))==0)
            echo Yii::t('materials', 'You don\'t have a directories. <a class="btn" href="/materials/createfolder">Create</a>');

        else
        {
            echo Yii::t('materials', 'about').'<br><br>';
            echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));
            echo $form->dropDownList($model,'folder',MaterialsFolders::model()->getFolders()).'<br><br>';
            echo CHtml::activeFileField($model, 'image').'<br><br>';
            echo CHtml::submitButton(Yii::t('materials', 'Upload a file'));
        }

    ?>

    <?php $this->endWidget(); ?>

</div>
