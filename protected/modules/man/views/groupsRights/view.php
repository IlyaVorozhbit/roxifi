<?php
/* @var $this GroupsRightsController */
/* @var $model GroupsRights */

$this->breadcrumbs=array(
	'Groups Rights'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupsRights', 'url'=>array('index')),
	array('label'=>'Create GroupsRights', 'url'=>array('create')),
	array('label'=>'Update GroupsRights', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupsRights', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupsRights', 'url'=>array('admin')),
);
?>

<h1>View GroupsRights #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group',
		'user',
		'rights',
	),
)); ?>
