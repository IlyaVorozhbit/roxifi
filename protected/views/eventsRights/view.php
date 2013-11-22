<?php
/* @var $this EventsRightsController */
/* @var $model EventsRights */

$this->breadcrumbs=array(
	'Events Rights'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventsRights', 'url'=>array('index')),
	array('label'=>'Create EventsRights', 'url'=>array('create')),
	array('label'=>'Update EventsRights', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventsRights', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventsRights', 'url'=>array('admin')),
);
?>

<h1>View EventsRights #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'event',
		'user',
		'rights',
	),
)); ?>
