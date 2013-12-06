<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->breadcrumbs=array(
        Yii::t('events', 'Events')=>array('/events'),
        $event->name
    );

    $this->pageTitle .= $event->name;

?>

<h1><?php echo Yii::t('events', 'Inviting friends to event ').' <a href="/events/'.$event->id.'">'.$event->name.'</a>'?></h1>

<div class="events">

    <div class="event event_without_border">

        <div class="friends_to_invite">
            <?php

            $this->widget('CLinkPager',array(
                'pages'=>$pages,
                'maxButtonCount' => 1,
                'cssFile'=>'',
            ));

            if(!empty($friends))
                foreach ($friends as $friend)
                    $this->renderPartial('_friend',array('friend'=>$friend,'event'=>$event));
            ?>
        </div>

    </div>

</div>
