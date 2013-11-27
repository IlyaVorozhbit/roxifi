<?php
    /*
    * @var $this DialogsController
    * @var $lang Language
    */

    $this->breadcrumbs=array(
        Yii::t('events', 'Events')
    );

    $this->pageTitle .= Yii::t('events', 'Events');

?>

<h1><?php echo Yii::t('events', 'Events')?></h1>
<a href="/events/create"><?php echo Yii::t('events', 'Create event')?></a>
<hr>
<?php

    if(!empty($events))
        foreach($events as $event)
        {
            $this->renderPartial('_event',array(
                'event'=>$event
            ));
        }
    else
        echo Yii::t('events', 'Nothing found.');

?>