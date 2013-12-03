<?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
    $this->breadcrumbs=array(
        Yii::t('materials', 'Materials'),
    );
?>

<h1><?php echo Yii::t('materials', 'Materials')?></h1>


<div class="form">

    <?php echo Yii::t('materials', 'about')?><br><br>
    <h2><?php echo Yii::t('materials', 'Folders')?></h2>

    <?php

        if(!empty($folders))
        {
            echo "<div class='folders'>";
                foreach($folders as $folder)
                {
                    $this->renderPartial('_folder',array('folder'=>$folder));
                }
            echo "</div>";
        }


        echo Yii::t('materials', '<br><br><a class="btn" href="/materials/createfolder">Create a new folder</a><br><br>');


    ?>

    <div class="files">

        <?php
            if(!empty($materials))
            {
                echo '<h2>'.Yii::t('materials', 'Latest files').'</h2>';

                foreach($materials as $material)
                {
                    $this->renderPartial('_material',array('material'=>$material));
                }
            }
            else
                echo Yii::t('materials', 'Nothing found. <a href="/materials/upload">Upload a file</a>?');
        ?>
    </div>
</div>
