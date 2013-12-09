<?php $this->pageTitle .= Yii::t('minds','Minds');?>
<h1><?php echo Yii::t('minds','Minds');?></h1>

<?php

    $this->widget('CLinkPager',array(
        'pages'=>$pages,
        'maxButtonCount' => 1,
        'cssFile'=>'',
        'header' =>Yii::t('minds', 'Minds'),
    ));


    if(empty($minds))
        echo Yii::t('minds','No minds about you yet.');
    else
    {
        echo '<div class="minds">';
        foreach($minds['minds'] as $mind)
            $this->renderPartial('minds/_mind',array(
                'mind'=>$mind
            ));
        echo '</div>';
    }





?>
