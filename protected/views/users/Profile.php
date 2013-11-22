<?php
/* @var $this UsersController */

$this->breadcrumbs=array(
	'Профиль',
);
?>
<h1><?php echo $user->login;?></h1>

<div class="user_profile">

    <div class="avatar">
        <img src="/images/no_avatar.png"/>
    </div>

    <div class="block_user_info">

        <div class="main_info">
            <p>О себе: Люблю покушать.</p>
            <p>Увлечения: Программирование, спорт, музыка.</p>
        </div>

    </div>

    <div class="wall">

        <p>Стена.<p/>

        <?php

            $authors = array();

            foreach($user['wallRecords'] as $key=>$record)
            {
                if(empty($authors[$record->user_from]))
                    $authors[$record->user_from] = Users::model()->findByPk($record->user_from);
            }

            foreach($user['wallRecords'] as $key=>$record)
            {
                $this->renderPartial('profile/wallRecord',array(
                    'authors'=>$authors,
                    'record'=>$record
                ));
            }

            if(empty($user['wallRecords']))
            {
                echo 'У Вас еще нет записей.';
            }
        ?>

    </div>
</div>
