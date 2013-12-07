<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->breadcrumbs=array(
        Yii::t('events', 'Events')=>array('/events'),
        Yii::t('events', 'My Events')
    );

    $this->pageTitle .= Yii::t('events', 'My Events');

?>

<h1><?php echo Yii::t('events', 'My Events')?></h1>
<div class="events">

    <div class="menu">
        <a class="btn btn-mini" href="/events"><?php echo Yii::t('events', 'Events')?></a> |
        <a class="btn btn-mini" href="/events/create"><?php echo Yii::t('events', 'Create event')?></a>
        <?php

        $events_label = EventsMembers::model()->count('user=:user and status = 0',array(
            ':user'=>Yii::app()->user->id
        ));

        if($events_label>0)
        {
            $events_label = ' (+'.$events_label.')';

            echo  '| <a class="btn btn-mini" href="/events/invites">'.Yii::t('events', 'Invites').$events_label.'</a>';
        }

        else
            $events_label = '';

        ?>
    </div>

<?php

    if(!empty($events))
        foreach($events as $event)
        {
            $this->renderPartial('_event',array(
                'event'=>$event->event0
            ));
        }
    else
        echo Yii::t('events', 'Nothing found.');

?>

</div>