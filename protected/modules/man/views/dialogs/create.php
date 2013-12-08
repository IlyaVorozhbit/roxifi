<?php
/* @var $this DialogsController */
/* @var $model Dialogs */

$this->breadcrumbs=array(
	'Dialogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dialogs', 'url'=>array('index')),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>Create Dialogs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>