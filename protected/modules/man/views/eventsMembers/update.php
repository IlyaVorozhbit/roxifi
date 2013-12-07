<?php
/* @var $this EventsMembersController */
/* @var $model EventsMembers */

$this->breadcrumbs=array(
	'Events Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventsMembers', 'url'=>array('index')),
	array('label'=>'Create EventsMembers', 'url'=>array('create')),
	array('label'=>'View EventsMembers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventsMembers', 'url'=>array('admin')),
);
?>

<h1>Update EventsMembers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>