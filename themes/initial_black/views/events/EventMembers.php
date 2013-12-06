<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->breadcrumbs=array(
        Yii::t('events', 'Events')=>array('/events'),
        $event->name=>array('/events/'.$event->id),
        Yii::t('events', 'Event Members')
    );

    $this->pageTitle .= Yii::t('events', 'Event Members');

?>

<h1><?php echo Yii::t('events', 'Event Members').' <a href="/events/'.$event->id.'">'.$event->name.'</a>'?></h1>

<div class="events">

    <?php
        if(EventsRights::model()->findByEvent($event->id)->user == Yii::app()->user->id)
            echo '<a class="btn" href="/events/members/invite/'.$event->id.'">'.Yii::t('events','Invite friends').'</a>';
    ?>

    <div class="event event_without_border">
        <div class="members">
            <?php

            if(!empty($members))
                foreach($members as $member)
                {
                    $this->renderPartial('_member',array(
                        'member'=>$member->user0
                    ));
                }
            else
                echo Yii::t('events', 'Nothing found.');

            ?>
        </div>
    </div>
</div>
