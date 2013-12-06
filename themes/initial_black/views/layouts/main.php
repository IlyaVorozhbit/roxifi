<html>

<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
</head>

<body>

<div class="logo">
    <?php
        $url = '/';

        if(!Yii::app()->user->isGuest)
            $url = '/u'.Yii::app()->user->id;
    ?>
    <a href="<?php echo $url;?>">roxifi</a>
</div>


<div class="header">
    <?php
        $dialogs_label = '';
        $events_label = '';

        if(!Yii::app()->user->isGuest)
        {

            $dialogs_label = Messages::model()->count('(recipient=:user) and (status = 0 or status = 5)',array(
                ':user'=>Yii::app()->user->id
            ));

            if($dialogs_label>0)
                $dialogs_label = ' (+'.$dialogs_label.')';
            else
                $dialogs_label = '';

            $events_label = EventsMembers::model()->count('user=:user and status = 0',array(
                ':user'=>Yii::app()->user->id
            ));

            if($events_label>0)
                $events_label = ' (+'.$events_label.')';
            else
                $events_label = '';
        }

        $this->widget('zii.widgets.CMenu',
        array(
            'htmlOptions' => array( 'class' => 'menu' ),
            'activeCssClass'	=> 'active',
            'items'=>array(
            array('label'=>Yii::t('nav_buttons', 'Profile'), 'url'=>array('/u'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Blog'), 'url'=>array('/blog/'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Register'), 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('dialogs', 'Dialogs').$dialogs_label, 'url'=>array('/dialogs'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('friends', 'Friends'), 'url'=>array('/friends'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('materials', 'Materials'), 'url'=>array('/materials'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('events', 'Events').$events_label, 'url'=>array('/events'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'People'), 'url'=>array('/users'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Feedback'), 'url'=>array('/site/feedback')),
            array('label'=>Yii::t('nav_buttons', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'logout_btn'))
            ),
        ));
    ?>
</div>

<div class="content">
    <?php echo $content;?>

    <div class="footer">

        <div class="footer_menu">
            <a href="/site/rules"><?php echo Yii::t('main','Rules');?></a>
            <a href="/site/about"><?php echo Yii::t('main','About');?></a>
        </div>

        Created by <i>0Medvedkoo</i> and <i>Porto</i>.
    </div>


</div>


</body>

</html>
