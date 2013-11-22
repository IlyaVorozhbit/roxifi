<?php
/* @var $this WallRecordsController */
/* @var $model WallRecords */

$this->breadcrumbs=array(
	'Wall Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WallRecords', 'url'=>array('index')),
	array('label'=>'Manage WallRecords', 'url'=>array('admin')),
);
?>

<h1>Create WallRecords</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>