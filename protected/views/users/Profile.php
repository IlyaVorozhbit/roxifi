<?php
  /* @var $this UsersController */
  $this->breadcrumbs=array(
      Yii::t('profile', 'Profile')
  );
?>
<h1><?php echo Yii::app()->language == 'en' ? $user->login.Yii::t('profile', '\'s profile') : Yii::t('profile', '\'s profile').$user->login;?></h1>
<div class="user_profile">
    <div class="profile_buttons">
        <?php
            if(UsersFriends::canRegisterRequest(Yii::app()->user->id, $user->id))
                echo '<a class="btn" href="/friends/add/'.$user->id.'">'.Yii::t('profile', 'Add to friends').'</a>';
            else
            {
                if(UsersFriends::isFriends(Yii::app()->user->id, $user->id))
                    echo '<a class="btn" href="/friends/delete/'.$user->id.'">'.Yii::t('profile', 'Remove from friends').'</a>';
            }

            if(!Yii::app()->user->isGuest)
                echo '<a class="btn" href="/dialogs/sendmessage/'.$user->id.'">'.Yii::t('profile', 'Send message').'</a>';

            ?>
    </div>

  <?php
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
  ?>
  <a href='<?php echo $profile_image;?>'><div class="avatar" style="background: url('<?php echo $profile_image;?>') no-repeat center;"></div></a>
  <div class="block_user_info">
    <div class="main_info">
      <p><?php echo Yii::t('profile', 'Profile').($user->id == Yii::app()->user->id ? '<a href="/u'.$user->id.'/edit"><img class="icon" src="/images/edit.png" align="right"/></a>' : ''); ?></p>
      <?php echo Yii::t('profile', 'Language').': '.($user->language == 'ru' ? Yii::t('language', 'Russian') : Yii::t('language', 'English')); ?>
      <?php echo '<hr><a href="/u'.$user->id.'/notes">'.Yii::t('profile', 'Notes').'</a>' ?>
    </div>
  </div>

  <div class="wall">
    <p><?php echo Yii::t('profile', 'Wall');?><p/>
    <?php
        $form = $this->beginWidget('CActiveForm', array(
          'id'=>'wall-records-form',
          'enableAjaxValidation'=>false,
        ));
        echo '<hr><table><tr><td>';
        echo Yii::t('profile', 'Write on the wall').':';
        echo '</td></tr><tr><td>';
        echo $form->textArea(WallRecords::model(), 'text', array('placeholder'=>Yii::t('profile', 'Content'), 'style'=>'resize: none; width:600px; height:200px;'));
        echo '</td></tr><tr><td>';
        echo CHtml::submitButton(Yii::t('profile', 'Write'), array('style'=>'margin: 0px;'));
        echo '</td></tr></table>';
        $this->endWidget();
        $authors = array();

        $this->widget('CLinkPager',array(
        'pages'=>$pages,
        'maxButtonCount' => 1,
        'cssFile'=>'',
        'header' => '',
        ));

        foreach($wallRecords as $key=>$record)
          if(empty($authors[$record->user_from]))
            $authors[$record->user_from] = Users::model()->findByPk($record->user_from);

        foreach($wallRecords as $key=>$record)
          $this->renderPartial('profile/wallRecord',array(
              'authors'=>$authors,
              'record'=>$record
          ));

        if (empty($wallRecords))
          echo Yii::t('profile', 'You have no records yet.');
    ?>
  </div>
</div>
