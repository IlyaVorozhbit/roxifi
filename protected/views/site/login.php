<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Вход</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

  <table>
    <tr>
      <td>
      Логин:
      </td>
      <td>
		<?php echo $form->textField($model,'username'); ?>
      </td>
      <td>
		<?php echo $form->error($model,'username'); ?>
      </td>
    </tr>
    <tr>
      <td>
      Пароль:
      </td>
      <td>
		<?php echo $form->textField($model,'password'); ?>
      </td>
      <td>
		<?php echo $form->error($model,'password'); ?>
      </td>
    </tr>
  </table>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
