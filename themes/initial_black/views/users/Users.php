<?php $this->pageTitle .= Yii::t('nav_buttons', 'People');?>

<h1><?php echo Yii::t('nav_buttons', 'People')?></h1>
<div class='form'>

  <?php
      $form = $this->beginWidget('CActiveForm', array(
        'id'=>'search-user',
        'enableAjaxValidation'=>false,
      ));
      echo $form->textField(Search::model(), 'criteria', array('placeholder'=>Yii::t('main', 'Search'), 'style'=>'resize: none; width:95%;'));
      echo CHtml::submitButton(Yii::t('main', 'Search'), array('style'=>'margin: 0px; margin-left: 10px;'));
      $this->endWidget();

      $this->widget('CLinkPager', array(
          'pages'=>$pages,
          'maxButtonCount' =>1,
          'cssFile'=>'',
      ));
      if (!empty($users))
      {
          echo '<div class="users_list">';
          foreach($users as $user)
              $this->renderPartial('_user', array(
                  'user'=>$user
              ));
          echo '</div>';
      }

      else
        echo Yii::t('main', 'No users found.');
  ?>
</div>
