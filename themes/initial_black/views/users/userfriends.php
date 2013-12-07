<?php $this->pageTitle .= Yii::t('nav_buttons', 'People');?>

<h1><?php echo Yii::t('friends', 'Friends of user ').'<a href="/u'.$user->id.'">'.$user->name. ' '.$user->surname?></a></h1>
<div class='form'>

    <?php

    $this->widget('CLinkPager', array(
        'pages'=>$friends['pages'],
        'maxButtonCount' =>2    ,
        'cssFile'=>'',
    ));
    if (!empty($friends))
    {
        echo '<div class="users_list">';
        foreach($friends['friends'] as $user)
            $this->renderPartial('_user', array(
                'user'=>$user
            ));
        echo '</div>';
    }

    else
        echo Yii::t('main', 'No users found.');
    ?>
</div>
