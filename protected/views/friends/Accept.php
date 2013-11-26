<?php
/* @var $this UsersController */

    $lang = new Language;

    $this->breadcrumbs=array(
        Yii::t('friends', 'Friends')=>'/friends',
        Yii::t('friends', 'Request has been approved'),
    );

    $this->pageTitle .= Yii::t('friends', 'Request has been approved');

?>
<h1><?php echo Yii::t('friends', 'Request has been approved');?></h1>

<p>


    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>


</p>
