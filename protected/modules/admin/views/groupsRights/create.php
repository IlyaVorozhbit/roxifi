<?php
/* @var $this GroupsRightsController */
/* @var $model GroupsRights */

$this->breadcrumbs=array(
	'Groups Rights'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupsRights', 'url'=>array('index')),
	array('label'=>'Manage GroupsRights', 'url'=>array('admin')),
);
?>

<h1>Create GroupsRights</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>