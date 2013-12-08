<?php
/* @var $this BlogsMessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blogs Messages',
);

$this->menu=array(
	array('label'=>'Create BlogsMessages', 'url'=>array('create')),
	array('label'=>'Manage BlogsMessages', 'url'=>array('admin')),
);
?>

<h1>Blogs Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
