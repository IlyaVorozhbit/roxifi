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