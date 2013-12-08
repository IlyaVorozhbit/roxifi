<?php
/* @var $this EventsRightsController */
/* @var $model EventsRights */

$this->breadcrumbs=array(
	'Events Rights'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventsRights', 'url'=>array('index')),
	array('label'=>'Manage EventsRights', 'url'=>array('admin')),
);
?>

<h1>Create EventsRights</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>