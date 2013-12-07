<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('main','Polls');

?>

<h1><?php echo Yii::t('main', 'Polls')?></h1>

<div class="form">

    На данной странице размещены ссылки на все опросы, от которых зависит появление новых разделов на сайте.<br><br>

    <hr>

    <a class="btn" href="/site/lections">Лекции</a><br>
    <a class="btn" href="/site/talants">Таланты</a><br>


</div>
