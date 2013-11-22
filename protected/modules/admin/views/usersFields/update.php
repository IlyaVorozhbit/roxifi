<?php
/* @var $this UsersFieldsController */
/* @var $model UsersFields */

$this->breadcrumbs=array(
	'Users Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersFields', 'url'=>array('index')),
	array('label'=>'Create UsersFields', 'url'=>array('create')),
	array('label'=>'View UsersFields', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersFields', 'url'=>array('admin')),
);
?>

<h1>Update UsersFields <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>