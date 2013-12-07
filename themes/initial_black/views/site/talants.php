<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('main','Talants');

?>

<h1><?php echo Yii::t('main', 'Talants')?></h1>

<div class="form">

    Раздел <b>таланты</b> является площадкой для людей, которые хотят проявить свои способности.<br><br>
    Мы приглашаем всех творческих людей, увлекающихся рисованием, сочиняющих песни, стихотворения, рассказы, принять эстафету и опубликовать свои труды.<br><br>
    Может быть введена оценчная система этих произведений.

    <hr>

    <p><?php echo Yii::t('main', 'Talants')?></p>

    <?php HPolls::Poll(2)?>

</div>
