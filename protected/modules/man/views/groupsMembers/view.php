<?php
/* @var $this GroupsMembersController */
/* @var $model GroupsMembers */

$this->breadcrumbs=array(
	'Groups Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupsMembers', 'url'=>array('index')),
	array('label'=>'Create GroupsMembers', 'url'=>array('create')),
	array('label'=>'Update GroupsMembers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupsMembers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupsMembers', 'url'=>array('admin')),
);
?>

<h1>View GroupsMembers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group',
		'user',
	),
)); ?>
