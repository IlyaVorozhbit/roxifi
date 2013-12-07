<?php
/* @var $this GroupsMembersController */
/* @var $model GroupsMembers */

$this->breadcrumbs=array(
	'Groups Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupsMembers', 'url'=>array('index')),
	array('label'=>'Manage GroupsMembers', 'url'=>array('admin')),
);
?>

<h1>Create GroupsMembers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>