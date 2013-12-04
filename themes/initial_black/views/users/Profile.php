<?php
  $this->pageTitle .= $user->name.' '.$user->surname;
  $user->user_info = HUsers::getUserInfo($user->id);
  $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
  $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="user_profile">


    <div class="left_block">

        <div class="avatar">
            <img style="width: 222px; height: 222px; border: 1px solid #E7E7E7;" src="<?php echo $profile_image;?>"/>
        </div>

        <div class="profile_buttons">
            <?php echo $user->id == Yii::app()->user->id ? '<a class="btn" href="u'.$user->id.'/edit">Редактировать профиль</a>' : '';?>
            <?php HProfile::renderSendMessageButton($user);?>
            <a class="btn" href="/blog/<?php echo $user->id;?>"><?php echo Yii::t('blog', 'Blog');?></a>
            <?php echo $user->id == Yii::app()->user->id ? '<a class="btn" href="u'.$user->id.'/notes">Заметки</a>' : '';?>
            <a class="btn" href="/u<?php echo $user->id;?>/materials"><?php echo Yii::t('materials', 'Materials');?></a>
        </div>

        <div class="friends">

            <div class="friends_label">
                Friends
            </div>

            <?php
                foreach($friends as $friend)
                {
                    if ($friend->id == $_GET['id'])
                        $friend = Users::model()->findByPk(Yii::app()->user->id);
                    $this->renderPartial('profile/_friend',array('friend'=>$friend));
                }
            ?>

        </div>

    </div>

    <div class="right_block">

        <div class="user_info">

            <div class="user_status">
                <?php
                    if(time()-strtotime($user->last_update)<120)
                        echo '<div class="online"></div>';
                    else
                        echo '<div class="offline"></div>';
                ?>
            </div>

            <div class="user_name">
                <?php echo $user->name.' '.$user->surname;?>
            </div>

            <?php

            foreach($user->user_info as $field)
            {
                if($field->field <> 2 and $field->field<>3)
                {
                    echo '<div class="label">'.$field->label.'</div>';
                    echo '<div class="about">'.$field->value.'</div>';
                }
            }
            ?>

        </div>

        <div class="wall">

            <?php

            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'wall-records-form',
                'enableAjaxValidation'=>false,
            ));
            echo '<table><tr><td>';
            echo Yii::t('profile', 'Write on the wall').':';
            echo '</td></tr><tr><td>';
            echo $form->textArea(WallRecords::model(), 'text', array('placeholder'=>Yii::t('profile', 'Content'), 'class'=>'input_form'));
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
                  echo Yii::t('profile', ($user->id == Yii::app()->user->id ? 'You' : 'User').' have no records yet.');
                ?>

        </div>

    </div>

</div>
