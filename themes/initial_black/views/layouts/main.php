<html>

<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
</head>

<body>

<div class="header">
    <?php
        $dialogs_label = '';
        $this->widget('zii.widgets.CMenu',
        array(
            'htmlOptions' => array( 'class' => 'menu' ),
            'activeCssClass'	=> 'active',
            'items'=>array(
            array('label'=>Yii::t('nav_buttons', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Register'), 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('dialogs', 'Dialogs').$dialogs_label, 'url'=>array('/dialogs'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('friends', 'Friends'), 'url'=>array('/friends'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Profile'), 'url'=>array('/u'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Users'), 'url'=>array('/users'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('events', 'Events'), 'url'=>array('/events'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Feedback'), 'url'=>array('/site/feedback'))
            ),
        ));
    ?>
</div>

<div class="content">
    <?php echo $content;?>
</div>

<div class="footer">
    footer
</div>

</body>

</html>
