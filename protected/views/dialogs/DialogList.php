<?php
/*
 * @var $this DialogsController
 * @var $lang Language
 */

$this->breadcrumbs=array(
    Yii::t('dialogs', 'Dialogs')=>array('/dialogs'),
);
?>
<h1><?php echo Yii::t('dialogs', 'Dialog list')?></h1>

<p>
    <?php
        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));

        foreach($dialogs as $key=>$dialog)
        {
            $user_friend = $dialog->invited;

            if($user_friend == Yii::app()->user->id)
                $user_friend = $dialog->creator;

            $user = Users::model()->findByPk($user_friend);

            $this->renderPartial('_user',array(
                'user'=>$user,
                'dialog'=>$dialog
            ));
        }

    ?>
</p>
