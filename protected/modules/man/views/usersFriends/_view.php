<?php
/* @var $this UsersFriendsController */
/* @var $data UsersFriends */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_from')); ?>:</b>
	<?php echo CHtml::encode($data->user_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_to')); ?>:</b>
	<?php echo CHtml::encode($data->user_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>