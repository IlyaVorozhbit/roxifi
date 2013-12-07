<?php
/* @var $this WallRecordsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Wall Records',
);

$this->menu=array(
	array('label'=>'Create WallRecords', 'url'=>array('create')),
	array('label'=>'Manage WallRecords', 'url'=>array('admin')),
);
?>

<h1>Wall Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
