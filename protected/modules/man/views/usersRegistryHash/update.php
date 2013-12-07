<?php
/* @var $this UsersRegistryHashController */
/* @var $model UsersRegistryHash */

$this->breadcrumbs=array(
	'Users Registry Hashes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersRegistryHash', 'url'=>array('index')),
	array('label'=>'Create UsersRegistryHash', 'url'=>array('create')),
	array('label'=>'View UsersRegistryHash', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersRegistryHash', 'url'=>array('admin')),
);
?>

<h1>Update UsersRegistryHash <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>