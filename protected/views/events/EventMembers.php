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

<h1><?php echo Yii::t('events', 'Event Members')?></h1>
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