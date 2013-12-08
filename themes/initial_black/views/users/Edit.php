<?php $this->pageTitle .= Yii::t('profile','Profile edit');?>
<h1><?php echo Yii::t('profile', 'Profile edit')?></h1>

<div class="edit_page">
    <?php
        echo Yii::t('profile', 'Image').':';
    ?>
    <div style= "border: 1px solid #f3f3f3; height: 200px; width: 200px; background: url('<?php $avatar = UsersImages::model()->find('user = :user', array('user'=>$user->id));
        echo $avatar !== NULL ? '/avatars/u'.$user->id.'/'.$avatar->filename :
            '/images/no_avatar.png'; ?>') no-repeat center;"></div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'users-info-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));
    echo '<table><tr><td>';
    echo $form->fileField(UsersImages::model(), 'filename');
    echo '</td></tr><tr><td>';
    echo CHtml::submitButton(Yii::t('profile', 'Apply'), array('style'=>'margin: 0px;'));
    echo $avatar !== NULL ? '<a href="/u'.Yii::app()->user->id.'/edit?delete_image">'.CHtml::button(Yii::t('profile', 'Delete'), array('style'=>'margin-left: 2px;')).'</a>' : '';
    echo '</td></tr></table>';
    $this->endWidget();
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));?>

    <?php if(!empty($errors['avatar'])):?>
        <div class="error">
            <?php echo $errors['avatar'];?>
        </div>
    <?php endif?>

    <?php
    echo '<table><tr><td>';
    echo Yii::t('profile', 'Language').':';
    echo '</td></tr><tr><td>';
    echo '<select name="Users[language]">'.($user->language == 'en' ? '<option selected value="en">English</option><option value="ru">Русский</option>' :
        '<option value="en">English</option><option selected value="ru">Русский</option>').'</select>';
    echo '</td></tr><tr><td>';
    echo CHtml::submitButton(Yii::t('profile', 'Apply'), array('style'=>'margin: 0px;'));
    echo '</td></tr></table>';
    $this->endWidget();

    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'users-info',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));




    $fields = UsersFields::model()->findAll();
    echo '<table>';
    foreach($fields as $key=>$field)
    {
        $model = UsersInfo::model()->find('user = :user AND field = :field', array(':user'=>Yii::app()->user->id,
            ':field'=>$field->id));

        if(is_null($model))
        {
            $model = new UsersInfo();
            $model->field = $field->id;
            $model->user = Yii::app()->user->id;
        }


        echo '<tr><td>';
        echo Yii::t('profile', $field->name);
        echo '</td></tr><tr><td>';
        if ($field->name == 'about')
            echo '<textarea style = "resize: none; width:600px; height:100px;" name="Infos['.$field->id.']">'.($model === NULL ? '' : $model->value).'</textarea>';
        elseif($field->name=='sex')
        {
            $gender = array(
                0=>Yii::t('profile','male'),
                1=>Yii::t('profile','female'),
            );
            $gender_select = '<select name="Infos['.$field->id.']">';
            foreach($gender as $key => $entity)
            {

                if(!is_null($model->value))
                {
                    if($key==$model->value)
                        $gender_select .= '<option selected value='.$key.'>'.$entity.'</option>';
                }

                else
                    $gender_select .= '<option value='.$key.'>'.$entity.'</option>';
            }

            $gender_select .= '</select>';

            echo $gender_select;
        }
        elseif($field->name=='birthday')
        {
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'value'=>$model->value,
                'model'=>$model, 'name'=>'Infos['.$field->id.']',
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'yearRange'=>'-70:+0',
                    'changeYear'=>'true',
                    'changeMonth'=>'true',
                )));
        }
        elseif($field->name=='department')
        {
            $departments = Departments::model()->getDepartments();
            $departments_select = '<select name="Infos['.$field->id.']">';
            foreach($departments as $key => $department)
            {

                if(!is_null($model->value))
                {
                    if($key==$model->value)
                        $departments_select .= '<option selected value='.$key.'>'.$department.'</option>';
                }

                else
                    $departments_select .= '<option value='.$key.'>'.$department.'</option>';
            }

            $departments_select .= '</select>';

            echo $departments_select;
        }

        else
            echo '<input type="text" style = "width:600px;" name="Infos['.$field->id.']" value="'.($model === NULL ? '' : $model->value).'">';
        echo '</td></tr>';
    }



    echo '<tr><td>';
    echo CHtml::submitButton(Yii::t('profile', 'Apply'), array('style'=>'margin: 0px;'));
    echo '</td></tr></table>';
    $this->endWidget();
    ?>

</div>
