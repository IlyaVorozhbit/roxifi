<?php


    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
    $this->breadcrumbs=array(
        Yii::t('materials', 'Materials'),
    );
?>

<h1><?php echo Yii::t('materials', 'Materials')?></h1>


<div class="form">

    <div class="folder">

        <div class="folder_name">
            <?php echo $folder->name?>
        </div>

        <?php

        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));

        foreach($files as $file)
            $this->renderPartial('_file',array('file'=>$file));
        ?>
    </div>
    <hr>
    <br><a class="btn" href="/materials/upload?folder=<?php echo $folder->id ?>"><?php echo Yii::t('materials', 'Upload a file')?></a><br><br>
</div>
