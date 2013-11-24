<?php
  /* @var $this UsersController */

  $lang = new Language;

  $this->breadcrumbs=array(
    $lang->Translate(4),
  );
?>
<h1><?php echo $lang->lang == 'en' ? $user->login.$lang->Translate(39) : $lang->Translate(39).$user->login;?></h1>
<div class="user_profile">
    <div class="profile_buttons">
        <?php
            if(UsersFriends::canRegisterRequest(Yii::app()->user->id, $user->id))
                echo '<a class="btn" href="/friends/add/'.$user->id.'">'.$lang->Translate(20).'</a>';
            else
            {
                if(UsersFriends::isFriends(Yii::app()->user->id, $user->id))
                    echo '<a class="btn" href="/friends/delete/'.$user->id.'">'.$lang->Translate(21).'</a>';
            }
            ?>
    </div>

  <?php
    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
  ?>
  <a href='<?php echo $profile_image;?>'><div class="avatar" style="background: url('<?php echo $profile_image;?>') no-repeat center;"></div></a>
  <div class="block_user_info">
    <div class="main_info">
      <p><?php echo $lang->Translate(4).($user->id == Yii::app()->user->id ? '<a href="/u'.$user->id.'/edit"><img class="icon" src="/images/edit.png" align="right"/></a>' : ''); ?></p>
      <?php echo $lang->Translate(2).': '.($user->language == 'ru' ? $lang->Translate(6) : $lang->Translate(3)); ?>
      <?php echo '<hr><a href="/u'.$user->id.'/notes">'.$lang->Translate(13).'</a>' ?>
    </div>
  </div>

  <div class="wall">
    <p><?php echo $lang->Translate(5);?><p/>
    <?php
        $form = $this->beginWidget('CActiveForm', array(
          'id'=>'wall-records-form',
          'enableAjaxValidation'=>false,
        ));
        echo '<hr><table><tr><td>';
        echo $lang->Translate(17).':';
        echo '</td></tr><tr><td>';
        echo $form->textArea(WallRecords::model(), 'text', array('placeholder'=>$lang->Translate(12), 'style'=>'resize: none; width:600px; height:200px;'));
        echo '</td></tr><tr><td>';
        echo CHtml::submitButton($lang->Translate(18), array('style'=>'margin: 0px;'));
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
          echo $lang->Translate(8);
    ?>
  </div>
</div>
