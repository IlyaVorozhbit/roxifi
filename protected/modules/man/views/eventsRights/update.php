<?php
/* @var $this EventsRightsController */
/* @var $model EventsRights */

$this->breadcrumbs=array(
	'Events Rights'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventsRights', 'url'=>array('index')),
	array('label'=>'Create EventsRights', 'url'=>array('create')),
	array('label'=>'View EventsRights', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventsRights', 'url'=>array('admin')),
);
?>

<h1>Update EventsRights <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>