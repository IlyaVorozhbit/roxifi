<?php
/* @var $this UsersRegistryHashController */
/* @var $model UsersRegistryHash */

$this->breadcrumbs=array(
	'Users Registry Hashes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsersRegistryHash', 'url'=>array('index')),
	array('label'=>'Create UsersRegistryHash', 'url'=>array('create')),
	array('label'=>'Update UsersRegistryHash', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersRegistryHash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersRegistryHash', 'url'=>array('admin')),
);
?>

<h1>View UsersRegistryHash #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'hash',
	),
)); ?>
