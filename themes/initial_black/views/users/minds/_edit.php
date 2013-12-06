<?php $this->pageTitle .= Yii::t('minds','Editing your mind');?>
<h1><?php echo Yii::t('minds','Editing your mind');?></h1>

<div class="minds">

    <?php $this->renderPartial('minds/_form',array('model'=>$model));?>

</div><!-- form -->
