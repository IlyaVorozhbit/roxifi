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
<?php
    if($owner == Yii::app()->user->id)
    {
        echo '<a class="btn" href="/events/edit/'.$event->id.'">'.Yii::t('events', 'Edit').'</a> ';
        echo '<a class="btn btn-danger" href="/events/del/'.$event->id.'">'.Yii::t('events', 'Delete').'</a> ';
    }

?>
<a class="btn" href="/events/members/<?php echo $event->id;?>">Участники</a>
<?php
    if(Events::isMember(Yii::app()->user->id,$event->id))
        echo '<a class="btn btn-warning" href="/events/leave/'.$event->id.'">'.Yii::t('events', 'Leave').'</a>';
    else
        echo '<a class="btn" href="/events/join/'.$event->id.'">'.Yii::t('events', 'Join').'</a>';
?>
<hr>
<?php echo Yii::t('events', 'Date')?>: <?php echo  date('m/d/y',strtotime($event->time));?><hr>
<?php echo $event->description;?><hr>

