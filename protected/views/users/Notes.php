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

    if (isset($_GET['edit']) && $user->id != Yii::app()->user->id)
      header('Location: notes');
    if (!isset($_GET['edit']))
    {
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
    }
    if ($user->id == Yii::app()->user->id)
    {
      $form = $this->beginWidget('CActiveForm', array(
        'id'=>'notes-form',
        'enableAjaxValidation'=>false,
      ));
      echo '<table><tr><td>';
      echo $lang->Translate(32).':';
      echo '</td></tr><tr><td>';

      if (isset($_GET['note_id']) && isset($_GET['edit']))
      {
        $note = Notes::model()->findByPk($_GET['note_id']);
        if ($note !== NULL)
        {
          echo $form->textField(Notes::model(), 'name', array('style'=>'width:600px;', 'value'=>$note->name));
          echo $form->hiddenField(Notes::model(), 'id', array('value'=>$note->id));
          echo '</td></tr><tr><td>';
          echo $form->textArea(Notes::model(), 'text', array('value'=>$note->text, 'style'=>'resize: none; width:600px; height:200px;'));
          echo '</td></tr><tr><td>';
          echo CHtml::submitButton($lang->Translate(33), array('style'=>'margin: 0px;'));
        }
        else
          header('Location: notes');        
      }
      else
      {
        echo $form->textField(Notes::model(), 'name', array('style'=>'width:600px;', 'placeholder'=>$lang->Translate(11)));
        echo '</td></tr><tr><td>';
        echo $form->textArea(Notes::model(), 'text', array('placeholder'=>$lang->Translate(12), 'style'=>'resize: none; width:600px; height:200px;'));
        echo '</td></tr><tr><td>';
        echo CHtml::submitButton($lang->Translate(7), array('style'=>'margin: 0px;'));
      }
      echo '</td></tr></table>';
      $this->endWidget();
    }
?>
