<?php
/* @var $this EventsRightsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events Rights',
);

$this->menu=array(
	array('label'=>'Create EventsRights', 'url'=>array('create')),
	array('label'=>'Manage EventsRights', 'url'=>array('admin')),
);
?>

<h1>Events Rights</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
