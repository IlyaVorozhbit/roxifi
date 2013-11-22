<?php
/* @var $this GroupsMembersController */
/* @var $model GroupsMembers */

$this->breadcrumbs=array(
	'Groups Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupsMembers', 'url'=>array('index')),
	array('label'=>'Create GroupsMembers', 'url'=>array('create')),
	array('label'=>'View GroupsMembers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupsMembers', 'url'=>array('admin')),
);
?>

<h1>Update GroupsMembers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>