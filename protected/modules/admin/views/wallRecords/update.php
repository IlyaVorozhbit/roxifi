<?php
/* @var $this WallRecordsController */
/* @var $model WallRecords */

$this->breadcrumbs=array(
	'Wall Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WallRecords', 'url'=>array('index')),
	array('label'=>'Create WallRecords', 'url'=>array('create')),
	array('label'=>'View WallRecords', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WallRecords', 'url'=>array('admin')),
);
?>

<h1>Update WallRecords <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>