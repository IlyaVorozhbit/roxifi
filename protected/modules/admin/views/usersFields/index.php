<?php
/* @var $this UsersFieldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Fields',
);

$this->menu=array(
	array('label'=>'Create UsersFields', 'url'=>array('create')),
	array('label'=>'Manage UsersFields', 'url'=>array('admin')),
);
?>

<h1>Users Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
