<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('nav_buttons', 'Feedback');

    $george = Users::model()->findByPk(1);
    $ilya = Users::model()->findByPk(2);

?>

<h1><?php echo Yii::t('nav_buttons', 'Feedback');?></h1>


<div class="form">

    Для связи с разработчиками вы можете написать следующим пользователям:<br><br>
    <a href='/u<?php echo $ilya->id;?>' class='btn'><?php echo $ilya->name.' '.$ilya->surname;?></a><br><br><br>
    <a href='/u<?php echo $george->id;?>' class='btn'><?php echo $george->name.' '.$george->surname;?></a><br><br>
</div><!-- form -->



