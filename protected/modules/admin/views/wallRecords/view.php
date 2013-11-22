<?php
/* @var $this WallRecordsController */
/* @var $model WallRecords */

$this->breadcrumbs=array(
	'Wall Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WallRecords', 'url'=>array('index')),
	array('label'=>'Create WallRecords', 'url'=>array('create')),
	array('label'=>'Update WallRecords', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WallRecords', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WallRecords', 'url'=>array('admin')),
);
?>

<h1>View WallRecords #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_from',
		'user_to',
		'text',
		'time',
		'status',
	),
)); ?>
