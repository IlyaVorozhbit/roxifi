<?php
/* @var $this UsersInfoController */
/* @var $model UsersInfo */

$this->breadcrumbs=array(
	'Users Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersInfo', 'url'=>array('index')),
	array('label'=>'Manage UsersInfo', 'url'=>array('admin')),
);
?>

<h1>Create UsersInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>