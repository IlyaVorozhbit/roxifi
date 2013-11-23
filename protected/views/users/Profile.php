<?php
  /* @var $this UsersController */

  $lang = new Language;

  $this->breadcrumbs=array(
    $lang->Translate(4),
  );
  $form = $this->beginWidget('CActiveForm', array(
    'id'=>'wall-records-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
  ));
?>
<h1><?php echo $user->login;?></h1>
<div class="user_profile">
  <div class="avatar">
    <img src="/images/no_avatar.png"/>
  </div>
  <div class="block_user_info">
    <div class="main_info">
      <p><?php echo $lang->Translate(4);?><img class='icon' src="/images/edit.png" align='right'/><p/>
      <?php echo $lang->Translate(2).': '.($user->language == 'ru' ? $lang->Translate(6) : $lang->Translate(3)); ?>
    </div>
  </div>
  <div class="wall">
    <p><?php echo $lang->Translate(5);?><p/>
    <?php
        echo $form->textField(WallRecords::model(), 'text');
        echo CHtml::submitButton($lang->Translate(7)).'<br>';
        $this->endWidget();
        $authors = array();
        foreach($user['wallRecords'] as $key=>$record)
          if(empty($authors[$record->user_from]))
            $authors[$record->user_from] = Users::model()->findByPk($record->user_from);
        foreach($user['wallRecords'] as $key=>$record)
          $this->renderPartial('profile/wallRecord',array(
              'authors'=>$authors,
              'record'=>$record
          ));
        if (empty($user['wallRecords']))
          echo $lang->Translate(8);
    ?>
  </div>
</div>
