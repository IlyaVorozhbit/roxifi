<?php
/* @var $this UsersInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Infos',
);

$this->menu=array(
	array('label'=>'Create UsersInfo', 'url'=>array('create')),
	array('label'=>'Manage UsersInfo', 'url'=>array('admin')),
);
?>

<h1>Users Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
