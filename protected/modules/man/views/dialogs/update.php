<?php
/* @var $this DialogsController */
/* @var $model Dialogs */

$this->breadcrumbs=array(
	'Dialogs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dialogs', 'url'=>array('index')),
	array('label'=>'Create Dialogs', 'url'=>array('create')),
	array('label'=>'View Dialogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>Update Dialogs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>