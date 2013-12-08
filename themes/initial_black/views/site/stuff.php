<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('main','Stuff');

?>

<h1><?php echo Yii::t('main', 'Stuff')?></h1>

<div class="form">

    Модуль <b>фишки</b> - это сервис, позволяющий пользователям делится друг с другом их находками, т.н. "фишками". Например, уютное кафе, о котором никто не знал, а пользователь его нашел и решил поделиться.

    <hr>

    <p><?php echo Yii::t('main', 'Stuff')?></p>

    <?php HPolls::Poll(3)?>

</div>
