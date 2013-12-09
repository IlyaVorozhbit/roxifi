<?php
    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('blog', 'Blogs');
?>

<h1><?php echo Yii::t('blog', 'Blogs')?></h1>

<div class="form">
    <?php
    $this->widget('CLinkPager',array(
        'pages'=>$pages,
        'maxButtonCount' => 1,
        'cssFile'=>'',
    ));
    ?>

    <?php
        if(!empty($writers))
            foreach($writers as $writer)
                $this->renderPartial('blog/_writer',array('writer'=>$writer->user))
    ?>

</div>