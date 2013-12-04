<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<?php
    $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
    $this->breadcrumbs=array(
        Yii::t('materials', 'Materials'),
    );
?>

<script>
  function showComments()
  {
    $("#comments").css("display", $("#comments").css("display") == "none" ? "block" : "none");
  }
</script>

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
        ?>

        <br><a class="btn" href="#" onclick="showComments();"><?php echo Yii::t('materials','Show comments');?></a><br><br>

        <div class="comments" id="comments" style="display: none;">
            <?php
            $authors = array();

            foreach($comments as $key=>$comment)
                if(empty($authors[$comment->user]))
                    $authors[$comment->user] = Users::model()->findByPk($comment->user);

            foreach($comments as $comment)
                $this->renderPartial('_comment',array(
                    'comment'=>$comment,
                    'author'=>$authors[$comment->user],
                ));
            ?>
        </div>
        <br><br>

        <?php
        foreach($files as $file)
            $this->renderPartial('_file',array('file'=>$file));
        ?>
    </div>
    <hr>
    <br><a class="btn" href="/materials/upload?folder=<?php echo $folder->id ?>"><?php echo Yii::t('materials', 'Upload a file')?></a><br><br>
</div>
