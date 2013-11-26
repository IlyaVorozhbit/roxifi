<?php
/* @var $this UsersController */

    $this->breadcrumbs=array(
        Yii::t('friends', 'Friends')=>'/friends',
        Yii::t('friends', 'Removing from friends'),
    );
?>
<h1><?php echo Yii::t('friends', 'Removing from friends');?></h1>

<p>


    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>


</p>
