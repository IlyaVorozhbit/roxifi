<?php
/* @var $this UsersInfoController */
/* @var $model UsersInfo */

$this->breadcrumbs=array(
	'Users Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersInfo', 'url'=>array('index')),
	array('label'=>'Create UsersInfo', 'url'=>array('create')),
	array('label'=>'View UsersInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersInfo', 'url'=>array('admin')),
);
?>

<h1>Update UsersInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>