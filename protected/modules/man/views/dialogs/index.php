<?php
/* @var $this DialogsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dialogs',
);

$this->menu=array(
	array('label'=>'Create Dialogs', 'url'=>array('create')),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>Dialogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
