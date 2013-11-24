<?php
  $lang = new Language;
  echo $lang->Translate(36).'<hr>';
  echo $lang->Translate(35).':'; ?>
  <div style="border: 1px solid #f3f3f3; height: 300px; width: 300px; background: url('<?php $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
                                                                                 echo $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename :
                                                                                  '/images/no_avatar.png'; ?>') no-repeat center;"></div>
<?php
  $form = $this->beginWidget('CActiveForm', array(
    'id'=>'users-info-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
  ));
  echo '<table><tr><td>';
  echo $form->fileField(UsersImages::model(), 'filename');
  echo '</td></tr><tr><td>';
  echo CHtml::submitButton($lang->Translate(37), array('style'=>'margin: 0px;'));
  echo '<a href="/u'.Yii::app()->user->id.'/edit?delete_image">'.CHtml::button($lang->Translate(38), array('style'=>'margin-left: 2px;')).'</a>';
  echo '</td></tr></table>';
  $this->endWidget();
?>
