<?php
/* @var $this EventsMembersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events Members',
);

$this->menu=array(
	array('label'=>'Create EventsMembers', 'url'=>array('create')),
	array('label'=>'Manage EventsMembers', 'url'=>array('admin')),
);
?>

<h1>Events Members</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
