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
  <tr>
    <td>
  		<?php echo $form->checkBox($model,'rememberMe'); ?>
    </td>
    <td>
      Запомнить
    </td>
    <td>
      <?php echo $form->error($model,'rememberMe'); ?>
    </td>
  </tr>
</table>
		<?php echo CHtml::submitButton('Login'); ?>

<?php $this->endWidget(); ?>
