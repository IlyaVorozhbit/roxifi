<?php
/* @var $this UsersFieldsController */
/* @var $model UsersFields */

$this->breadcrumbs=array(
	'Users Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersFields', 'url'=>array('index')),
	array('label'=>'Manage UsersFields', 'url'=>array('admin')),
);
?>

<h1>Create UsersFields</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>