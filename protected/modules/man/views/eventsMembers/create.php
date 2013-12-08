<?php
/* @var $this EventsMembersController */
/* @var $model EventsMembers */

$this->breadcrumbs=array(
	'Events Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventsMembers', 'url'=>array('index')),
	array('label'=>'Manage EventsMembers', 'url'=>array('admin')),
);
?>

<h1>Create EventsMembers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>