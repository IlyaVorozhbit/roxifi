<?php $this->pageTitle .= Yii::t('minds','Leave your mind');?>
<h1><?php echo Yii::t('minds','Leave your mind about ').'<a href="/u'.$user->id.'">'.CHtml::encode($user->name).' '.CHtml::encode($user->surname).'</a>';?></h1>

<div class="minds">

    <?php
        if(!empty($user_minds))
        {
            echo '<h2>'.Yii::t('minds','Your minds about person').'</h2>';
            foreach($user_minds as $mind)
            $this->renderPartial('minds/_mind',array(
                'mind'=>$mind
            ));
        }

    ?>

    <?php $this->renderPartial('minds/_form',array('model'=>$model));?>

</div><!-- form -->
