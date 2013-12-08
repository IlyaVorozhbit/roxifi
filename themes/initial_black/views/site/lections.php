<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('main','Lections');

?>

<h1><?php echo Yii::t('main', 'Lections')?></h1>

<div class="form">

    Модуль <b>лекции</b> является предоставлением быстрого доступа до материалов, которые представляют из себя файлы (фотографии, документы).<br><br>
    Также может быть организовано разделение и поиск по предметам / курсам

    <hr>

    <p><?php echo Yii::t('main', 'Lections')?></p>

    <?php HPolls::Poll(1)?>

</div>
