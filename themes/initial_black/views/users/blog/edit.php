<h1><?php echo Yii::t('blog', 'Blog')?></h1>


<div class="blog">
    <?php

        $this->renderPartial('blog/_form',array(
            'model'=>$model
        ));

    ?>
</div>