<h1><?php echo Yii::t('blog', 'Blog')?></h1>

<div class="form">

    <?php
        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));
    ?>

    <div class="blog">



        <?php

            if(Yii::app()->user->id == $_GET['id'])
                $this->renderPartial('blog/_form',array(
                    'model'=>$model
                ));

            if(!empty($messages))
                foreach($messages as $message)
                {
                    $this->renderPartial('blog/_preview',array(
                        'message'=>$message
                    ));
                }

            else
                echo Yii::t('blog', 'User don\'t have messages yet');

        ?>

    </div>

</div>