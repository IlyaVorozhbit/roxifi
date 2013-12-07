<?php
/* @var $this UsersRegistryHashController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Registry Hashes',
);

$this->menu=array(
	array('label'=>'Create UsersRegistryHash', 'url'=>array('create')),
	array('label'=>'Manage UsersRegistryHash', 'url'=>array('admin')),
);
?>

<h1>Users Registry Hashes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
