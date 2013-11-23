<?php
/* @var $this UsersController */

    $creator = Users::model()->findByPk($_GET['id']);

    $lang = new Language;

    $this->breadcrumbs=array(
        $lang->Translate(4). ' '. $creator->login=>array('/u'.$creator->id),
        $lang->Translate(13),
    );
?>

<h1><?php echo $lang->Translate(13)?></h1>

<?
    $this->widget('CLinkPager',array(
        'pages'=>$pages,
        'maxButtonCount' => 1,
        'cssFile'=>'',
        'header' =>$lang->Translate(13),
    ));



  foreach($notes as $key=>$note)
    $this->renderPartial('profile/notes',array(
        'creator'=>$creator,
        'note'=>$note
    ));

  if (empty($notes))
    echo $lang->Translate(16);

  if ($user->id == Yii::app()->user->id)
  {
    echo '<hr>';
    $form = $this->beginWidget('CActiveForm', array(
      'id'=>'notes-form',
      // Please note: When you enable ajax validation, make sure the corresponding
      // controller action is handling ajax validation correctly.
      // There is a call to performAjaxValidation() commented in generated controller code.
      // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation'=>false,
    ));
    echo '<table><tr><td>';
    echo $lang->Translate(14).':';
    echo '</td></tr><tr><td>';
    echo $form->textField(Notes::model(), 'name', array('style'=>'width:600px;', 'placeholder'=>$lang->Translate(11)));
    echo '</td></tr><tr><td>';
    echo $form->textArea(Notes::model(), 'text', array('placeholder'=>$lang->Translate(12), 'style'=>'resize: none; width:600px; height:200px;'));
    echo '</td></tr><tr><td>';
    echo CHtml::submitButton($lang->Translate(7), array('style'=>'margin: 0px;'));
    echo '</td></tr></table>';
    $this->endWidget();
  }
?>
