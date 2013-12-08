<?php
/* @var $this BlogsMessagesController */
/* @var $model BlogsMessages */

$this->breadcrumbs=array(
	'Blogs Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BlogsMessages', 'url'=>array('index')),
	array('label'=>'Manage BlogsMessages', 'url'=>array('admin')),
);
?>

<h1>Create BlogsMessages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>