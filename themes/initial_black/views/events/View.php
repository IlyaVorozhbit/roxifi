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

    $owner = EventsRights::model()->findByEvent($event->id)->user;

?>

<h1><a href="/events"><?php echo Yii::t('events','Event')?></a> <?php echo $event->name?></h1>

<div class="events">

    <?php
    if($owner == Yii::app()->user->id)
    {
        echo '<a class="btn" href="/events/edit/'.$event->id.'">'.Yii::t('events', 'Edit').'</a> ';
        echo '<a class="btn btn-danger" href="/events/del/'.$event->id.'">'.Yii::t('events', 'Delete').'</a> ';
    }

    ?>
    <a class="btn" href="/events/members/<?php echo $event->id;?>"><?php echo Yii::t('events','Event Members');?></a>
    <?php
    if(Events::isMember(Yii::app()->user->id,$event->id))
        echo '<a class="btn btn-warning" href="/events/leave/'.$event->id.'">'.Yii::t('events', 'Leave').'</a>';
    else
        echo '<a class="btn" href="/events/join/'.$event->id.'">'.Yii::t('events', 'Join').'</a>';
    ?>

    <div class="event">

        <div class="time">
            <?php echo Yii::t('events', 'Date')?>: <?php echo  date('m/d/y',strtotime($event->time));?>
        </div>

        <div class="description">
            <?php echo $event->description;?>
        </div>



    </div>
</div>