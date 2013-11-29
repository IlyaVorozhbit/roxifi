<?php


    $user->user_info = HUsers::getUserInfo($user->id);

    $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
    $profile_image =  $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename : '/images/no_avatar.png';
?>

<div class="user_profile">


    <div class="left_block">

        <div class="avatar">
            <img style="width: 222px; height: 222px; border: 1px solid #E7E7E7;" src="<?php echo $profile_image;?>"/>
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

            <div class="label">Связь</div>
            <div class="about">
                ICQ: 1228424<br>
                Skype: mazahaka-7<br>
            </div>

            <div class="label">Интересы</div>
            <div class="about">
                Игра на гитаре<br>
            </div>

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
                ?>

        </div>

    </div>

</div>
