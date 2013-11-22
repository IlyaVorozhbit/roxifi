<?php
/* @var $this GroupsMembersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups Members',
);

$this->menu=array(
	array('label'=>'Create GroupsMembers', 'url'=>array('create')),
	array('label'=>'Manage GroupsMembers', 'url'=>array('admin')),
);
?>

<h1>Groups Members</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
