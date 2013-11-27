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

<h1><?php echo $event->name?></h1>
<?php if($owner == Yii::app()->user->id) echo '<a href="/events/edit/'.$event->id.'">'.Yii::t('events', 'Edit').'</a><hr>'?>
<?php echo Yii::t('events', 'Date')?>: <?php echo  date('m/d/y',strtotime($event->time));?><hr>
<?php echo $event->description;?><hr>