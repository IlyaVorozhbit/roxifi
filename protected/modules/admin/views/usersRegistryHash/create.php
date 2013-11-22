<?php
/* @var $this UsersRegistryHashController */
/* @var $model UsersRegistryHash */

$this->breadcrumbs=array(
	'Users Registry Hashes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersRegistryHash', 'url'=>array('index')),
	array('label'=>'Manage UsersRegistryHash', 'url'=>array('admin')),
);
?>

<h1>Create UsersRegistryHash</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>