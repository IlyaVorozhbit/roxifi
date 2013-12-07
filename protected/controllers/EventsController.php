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
                    'actions'=>array('eventslist','members','myevents','view','create','del','edit','invite','sendinvite','invites','accept','reject','join','leave','deletewallrecord'),
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

        public function actionMyEvents()
        {
            $events = Events::getUserEventsAndPages();
            $this->render('MyEvents',array(
                'events'=>$events['events'],
                'pages'=>$events['pages'],
            ));
        }

        public function actionMembers($id)
        {
            $event = Events::model()->findByPk($id);

            if(is_null($event))
                throw new CHttpException(404,Yii::t('events', 'Nothing found.'));

            $members = Events::getEventMembersAndPages($id);

            $this->render('EventMembers',array(
                'event'=>$event,
                'members'=>$members['members'],
                'pages'=>$members['pages'],
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

                    $event_member = new EventsMembers();
                    $event_member->event = $event->id;
                    $event_member->status = Events::USER_JOINED;
                    $event_member->user = Yii::app()->user->id;
                    $event_member->save();

                    if($event_right->save())
                        $this->redirect('/events/'.$event->id);
                }

            }

            $this->render('Create',array('event'=>$event));

        }

        public function actionView($id)
        {

            $event = Events::model()->findByPk($id);
            $model = new EventsWallRecords;

            if(is_null($event))
                throw new CHttpException(404,Yii::t('events', 'Nothing found.'));

            if(isset($_POST['EventsWallRecords']))
            {
                $model->attributes = $_POST['EventsWallRecords'];
                $model->user = Yii::app()->user->id;
                $model->event = $id;
                $model->time = date('Y-m-d H:i:s',time());
                if($model->save())
                    $this->redirect('/events/'.$id);
            }


            $this->render('View',array(
                'event'=>$event,
                'model'=>$model,
                'records'=>EventsWallRecords::getEventRecordsAndPages($id)
            ));

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

        public function actionJoin($id)
        {
            if(!Events::isMember(Yii::app()->user->id,$id))
                if(Events::joinUserToEvent(Yii::app()->user->id,$id))
                    $this->redirect('/events/'.$id);

        }

        public function actionLeave($id)
        {
            if(Events::isMember(Yii::app()->user->id,$id))
                if(Events::leaveEvent(Yii::app()->user->id,$id))
                    $this->redirect('/events/'.$id);
        }

        public function actionDel($id)
        {

            $event = Events::model()->findByPk($id);

            if(is_null($event))
                throw new CHttpException(404,Yii::t('events', 'Nothing found.'));

            $owner = EventsRights::model()->findByEvent($event->id)->user;

            if($owner != Yii::app()->user->id)
                throw new CHttpException(403,Yii::t('events', 'Access denied.'));

            if($event->delete())
                $this->redirect('/events');

        }

        public function actionInvite($id)
        {
            $event = Events::model()->findByPk($id);

            if(is_null($event))
                throw new CHttpException(404,'Nothing found.');

            $criteria=new CDbCriteria;
            $criteria->condition = '(user_to =:user or user_from=:user) and status = 1';
            $criteria->params = array(':user'=>Yii::app()->user->id);
            $pages=new CPagination(UsersFriends::model()->count($criteria));
            $pages->pageSize=10;
            $pages->applyLimit($criteria);

            $friends = UsersFriends::model()->findAll($criteria);
            $friends = UsersFriends::getUsersAccountsByRequests($friends);

            $this->render('invite',array(
                'event'=>$event,
                'friends'=>$friends,
                'pages'=>$pages,
            ));
        }

        public function actionsendinvite($id,$uid)
        {
            $event = Events::model()->findByPk($id);
            if(!is_null($event))
            {
                if(Users::model()->exists('id=:id',array(':id'=>$uid)))
                {
                    if(!Events::isMemberOrInvited($uid,$id))
                    {
                        $member = new EventsMembers();
                        $member->status = EventsMembers::STATUS_INVITED;
                        $member->event = $event->id;
                        $member->user = $uid;
                        if($member->save())
                            $this->redirect('/events/'.$event->id);
                    }
                }
            }
        }

        public function actionInvites()
        {
            $invites = EventsMembers::getInvitesAndPages(Yii::app()->user->id);

            $this->render('invites',array('invites'=>$invites));
        }

        public function actionAccept($id)
        {
            $invite = EventsMembers::model()->findByPk($id);
            if(!is_null($invite))
            {
                $invite->status = EventsMembers::STATUS_JOINED;
                if($invite->save())
                    $this->redirect('/events/myevents');
            }
        }

        public function actionReject($id)
        {
            $invite = EventsMembers::model()->findByPk($id);
            if(!is_null($invite))
            {
                $invite->status = EventsMembers::STATUS_LEAVED;
                if($invite->save())
                    $this->redirect('/events/myevents');
            }
        }

        public function actionDeleteWallRecord($id)
        {
            $record = EventsWallRecords::model()->findByPk($id);
            if(!is_null($record))
            {
                $event = $record->event;
                if($record->user = Yii::app()->user->id)
                    if($record->delete())
                        $this->redirect('/events/'.$event);
            }
        }
    }

?>