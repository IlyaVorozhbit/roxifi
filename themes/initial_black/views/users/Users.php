<h1><?php echo Yii::t('nav_buttons', 'Users')?></h1>

<div class="form">

    <?php

        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));

        if(!empty($users))
            foreach($users as $user)
                $this->renderPartial('_user',array(
                    'user'=>$user
                ));

    ?>

</div>
