<?php
/* @var $this UsersInfoController */
/* @var $model UsersInfo */

$this->breadcrumbs=array(
	'Users Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsersInfo', 'url'=>array('index')),
	array('label'=>'Create UsersInfo', 'url'=>array('create')),
	array('label'=>'Update UsersInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersInfo', 'url'=>array('admin')),
);
?>

<h1>View UsersInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'field',
		'value',
	),
)); ?>
