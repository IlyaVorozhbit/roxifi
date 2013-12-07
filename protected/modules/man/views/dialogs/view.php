<?php
/* @var $this DialogsController */
/* @var $model Dialogs */

$this->breadcrumbs=array(
	'Dialogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Dialogs', 'url'=>array('index')),
	array('label'=>'Create Dialogs', 'url'=>array('create')),
	array('label'=>'Update Dialogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Dialogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>View Dialogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'creator',
		'invited',
		'status',
	),
)); ?>
