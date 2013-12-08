<?php
/* @var $this GroupsRightsController */
/* @var $model GroupsRights */

$this->breadcrumbs=array(
	'Groups Rights'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupsRights', 'url'=>array('index')),
	array('label'=>'Create GroupsRights', 'url'=>array('create')),
	array('label'=>'View GroupsRights', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupsRights', 'url'=>array('admin')),
);
?>

<h1>Update GroupsRights <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>