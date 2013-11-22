<?php
/* @var $this MessagesController */
/* @var $data Messages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dialog')); ?>:</b>
	<?php echo CHtml::encode($data->dialog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sender')); ?>:</b>
	<?php echo CHtml::encode($data->sender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipient')); ?>:</b>
	<?php echo CHtml::encode($data->recipient); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />


</div>