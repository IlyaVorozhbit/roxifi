<?php
  $this->pageTitle=Yii::app()->name . ' - '.Yii::t('materials', 'Materials');
  $this->breadcrumbs=array(
      Yii::t('materials', 'Materials'),
  );
?>
<h1><?php echo Yii::t('materials', 'Materials')?></h1>
<div class="form">
    <?php
      echo Yii::t('materials', 'about').'<br><br>';
      $folders = MaterialsFolders::model()->findAll('user=:user', array(':user'=>$id));
      if ($folders !== NULL)
      {
        echo '<div class="folders">';
        foreach($folders as $folder)
          $this->renderPartial('/materials/_folder', array('folder'=>$folder));
        echo '</div>';
      }
    ?>
</div>
