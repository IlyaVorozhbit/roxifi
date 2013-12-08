<?php
/* @var $this EventsMembersController */
/* @var $model EventsMembers */

$this->breadcrumbs=array(
	'Events Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventsMembers', 'url'=>array('index')),
	array('label'=>'Create EventsMembers', 'url'=>array('create')),
	array('label'=>'Update EventsMembers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventsMembers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventsMembers', 'url'=>array('admin')),
);
?>

<h1>View EventsMembers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'event',
		'status',
	),
)); ?>
