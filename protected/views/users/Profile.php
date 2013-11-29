<?php

    $user->user_info = HUsers::getUserInfo($user->id);

?>
<div class="user_profile">
<?php
  if(time()-strtotime($user->last_update)<120)
    echo '<div class="status_online">'.Yii::t('profile', 'Online').'</div>';
?>


<h1><?php HUsers::getProfileName($user);?></h1>

    <div class="profile_buttons">
        <?php
            HProfile::renderFriendsButtons($user);
            echo ' ';
            HProfile::renderSendMessageButton($user);
        ?>
    </div>

  <?php
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
  ?>
  <a href='<?php echo $profile_image;?>'><div class="avatar" style="background: url('<?php echo $profile_image;?>') no-repeat center;"></div></a>

    <div class="user_friends">
        <?php
            foreach($friends as $friend)
            {
              if ($friend->id == $_GET['id'])
                $friend = Users::model()->findByPk(Yii::app()->user->id);
              $this->renderPartial('profile/_friend',array('friend'=>$friend));
            }
        ?>
    </div>

  <div class="block_user_info">
    <div class="main_info">
      <p><?php echo '<h3>'.Yii::t('profile', 'Profile info').'</h3>'.($user->id == Yii::app()->user->id ? '<a href="/u'.$user->id.'/edit"><img class="icon" src="/images/edit.png" align="right"/></a>' : ''); ?></p>
      <?php echo Yii::t('profile', 'Language').': '.'<i>'.($user->language == 'ru' ? Yii::t('languages', 'Russian') : Yii::t('languages', 'English')).'</i>'; ?>
      <?php

        foreach($user->user_info as $field)
        {
          if($field->field <> 2 and $field->field<>3)
          {
              echo '<hr>';
              echo $field->label.': ';
              echo '<i>'.$field->value.'</i>';
          }
        }
        echo $user->id == Yii::app()->user->id ? '<hr><a href="/u'.$user->id.'/notes">'.Yii::t('profile', 'Notes').'</a>' : '';
       ?>
    </div>
  </div>

  <div class="wall">
    <p><?php echo '<h3>'.Yii::t('profile', 'Wall').'</h3>';?><p/>
    <?php
        $form = $this->beginWidget('CActiveForm', array(
          'id'=>'wall-records-form',
          'enableAjaxValidation'=>false,
        ));
        echo '<hr><table><tr><td>';
        echo Yii::t('profile', 'Write on the wall').':';
        echo '</td></tr><tr><td>';
        echo $form->textArea(WallRecords::model(), 'text', array('placeholder'=>Yii::t('profile', 'Content'), 'style'=>'resize: none; width:600px; height:70px;'));
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
