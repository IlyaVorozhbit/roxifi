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
    $( "#comments_btn").html( $("#comments").css("display") == "none" ? '<?php echo Yii::t('materials','Show comments');?>' : '<?php echo Yii::t('materials','Hide comments');?>' );
  }
</script>

<h1><a href="/materials"><?php echo Yii::t('materials', 'Materials')?></a></h1>


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

        <div class="form">

            <?php $form=$this->beginWidget('CActiveForm'); ?>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <?php echo $form->textField($model,'text',array('placeholder'=>Yii::t('materials','Comment'),'class'=>'comment_input')); ?>
                <?php echo $form->error($model,'text'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('materials','Send comment')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->

        <br><a id="comments_btn" class="btn" onclick="showComments();"><?php echo Yii::t('materials','Show comments');?></a><br><br>

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

    <br><a class="btn" href="/materials/upload?folder=<?php echo $folder->id ?>"><?php echo Yii::t('materials', 'Upload a file')?></a><br><br>
</div>
