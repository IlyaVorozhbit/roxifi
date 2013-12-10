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
    <div class="menu_in_event">
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
    </div>
    <div class="event">

        <div class="time">
            <?php echo Yii::t('events', 'Date')?>: <?php echo  date('m/d/y',strtotime($event->time));?>
        </div>

        <div class="description">
            <?php echo CHtml::encode($event->description);?>
        </div>

    </div>

    <div class="wall">

        <h2><?php echo Yii::t('events','Wall');?></h2>

        <div class="form">
            <?php
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'events-form',
            )); ?>

            <div class="row description">
                <?php echo $form->textArea($model,'text',array('rows'=>5,'size'=>60,'maxlength'=>255,'placeholder'=>Yii::t('events', 'Comment'))); ?>
                <?php echo $form->error($model,'text'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::submitButton(Yii::t('events', 'Send'));?>
            </div>

            <?php $this->endWidget(); ?>
        </div>


            <?php

            $this->widget('CLinkPager',array(
                'pages'=>$records['pages'],
                'maxButtonCount' => 1,
                'cssFile'=>'',
                'header' => '',
            ));

            if(!empty($records['records']))
            {
                $authors = array();

                foreach($records['records'] as $record)
                    if(empty($authors[$record->user]))
                        $authors[$record->user] = Users::model()->findByPk($record->user);

                echo '<div class="records">';
                foreach($records['records'] as $record)
                    $this->renderPartial('_record',array('record'=>$record,'author'=>$authors[$record->user],'owner'=>$owner));
                echo '</div>';
            }

            else
                echo Yii::t('events','This event have no comments yet.')
            ?>
    </div>

</div>