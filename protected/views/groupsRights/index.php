<?php
/* @var $this GroupsRightsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups Rights',
);

$this->menu=array(
	array('label'=>'Create GroupsRights', 'url'=>array('create')),
	array('label'=>'Manage GroupsRights', 'url'=>array('admin')),
);
?>

<h1>Groups Rights</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
