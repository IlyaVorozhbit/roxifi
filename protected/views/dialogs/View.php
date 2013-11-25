<?php
/*
 * @var $this DialogsController
 * @var $lang Language
 */

$this->breadcrumbs=array(
    $lang->Translate(43)=>array('/dialogs'),
    $lang->Translate(45). ' '.$user_friend->login,
);
?>
<h1><?php echo $lang->Translate(45) .' <a href="/u'.$user_friend->id.'">'.$user_friend->login.'</a>'?></h1>

<div class="dialog">

    <div class="form">


        <?php

        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));


        $form=$this->beginWidget('CActiveForm', array(
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

        <?php
            foreach($messages as $key=>$message)
            {
                $this->renderPartial('_message',array(
                    'message'=>$message,
                    'friend'=>$user_friend,
                    'user'=>$user
                ));
            }
        ?>

</div>