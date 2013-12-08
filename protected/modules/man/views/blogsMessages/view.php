<?php
/* @var $this BlogsMessagesController */
/* @var $model BlogsMessages */

$this->breadcrumbs=array(
	'Blogs Messages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BlogsMessages', 'url'=>array('index')),
	array('label'=>'Create BlogsMessages', 'url'=>array('create')),
	array('label'=>'Update BlogsMessages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BlogsMessages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BlogsMessages', 'url'=>array('admin')),
);
?>

<h1>View BlogsMessages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'name',
		'text',
		'time',
		'privacy',
	),
)); ?>
