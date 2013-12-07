<h1>Авторизация</h1>

<div class="form">

    Please, login

    <?php
    /* @var $this UsersInfoController */
    /* @var $model UsersInfo */
    /* @var $form CActiveForm */
    ?>

    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array('id'=>'users-info-form')); ?>

        <div class="row">
            <input type="password" name="password" placeholder="password">
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Log.in'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>