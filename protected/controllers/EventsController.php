<?php

    class EventsController extends Controller {

        public $defaultAction = 'EventsList';

        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete', // we only allow deletion via POST request
            );
        }

        public function accessRules()
        {
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions'=>array('eventslist','view','create','delete','edit','invite','accept','reject','join','leave'),
                    'users'=>array('@'),
                ),

                array('deny',  // deny all users
                    'users'=>array('*'),
                ),
            );
        }

        public function actionEventsList()
        {
            $events = Events::getEventsAndPages();
            $this->render('EventsList',array(
                'events'=>$events['events'],
                'pages'=>$events['pages'],
            ));
        }

        public function actionCreate()
        {

            $event = new Events;

            if(isset($_POST['Events']))
            {
                $event->attributes = $_POST['Events'];
                $event->time = date('Y-m-d',strtotime($_POST['time']));
                if($event->save())
                {
                    $event_right = new EventsRights();
                    $event_right->event = $event->id;
                    $event_right->user = Yii::app()->user->id;
                    $event_right->rights = 1;
                    if($event_right->save())
                        $this->redirect('/events/'.$event->id);
                }

            }

            $this->render('Create',array('event'=>$event));

        }

        public function actionView($id)
        {

            $event = Events::model()->findByPk($id);

            if(is_null($event))
                throw new CHttpException(404,Yii::t('events', 'Nothing found.'));

            $this->render('View',array('event'=>$event));

        }

        public function actionEdit($id)
        {

            $event = Events::model()->findByPk($id);

            if(is_null($event))
                throw new CHttpException(404,Yii::t('events', 'Nothing found.'));

            $owner = EventsRights::model()->findByEvent($event->id)->user;

            if($owner != Yii::app()->user->id)
                throw new CHttpException(403,Yii::t('events', 'Access denied.'));

            if(isset($_POST['Events']))
            {

                $event->attributes = $_POST['Events'];
                $event->time = date('Y-m-d',strtotime($_POST['time']));
                if($event->save())
                    $this->redirect('/events/'.$event->id);
            }

            $this->render('Edit',array('event'=>$event));

        }
    }

?>