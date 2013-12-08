<?php
/* @var $this BlogsMessagesController */
/* @var $model BlogsMessages */

$this->breadcrumbs=array(
	'Blogs Messages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BlogsMessages', 'url'=>array('index')),
	array('label'=>'Create BlogsMessages', 'url'=>array('create')),
	array('label'=>'View BlogsMessages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BlogsMessages', 'url'=>array('admin')),
);
?>

<h1>Update BlogsMessages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>