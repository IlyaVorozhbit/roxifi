<?php

class DialogsController extends Controller
{

    public $defaultAction = 'DialogList';

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
                'actions'=>array('ban','view','dialoglist','sendmessage','deletemessage'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionBan()
	{
		$this->render('Ban');
	}

	public function actionView($id)
	{

        $dialog = Dialogs::model()->findByPk($id);
        $messagesAndPages = Dialogs::getDialogMessages($dialog->id);

        if (isset($_POST['Messages']))
        {
            if(Dialogs::WriteMessage(Yii::app()->user->id,Dialogs::recognizeUserFriend($dialog),$_POST['Messages']['text']))
                Yii::app()->user->setFlash('success', Yii::t('dialogs', 'Message was sent'));
            $this->redirect('/dialogs/view/'.$id);
        }

        $this->render('View',array(
            'messages'=>$messagesAndPages['messages'],
            'pages'=>$messagesAndPages['pages'],
            'user'=>Users::model()->findByPk(Yii::app()->user->id),
            'user_friend'=>Users::model()->findByPk(Dialogs::recognizeUserFriend($dialog)),
            'model'=>new Messages()
        ));

        Messages::makeMessagesReaded($messagesAndPages['messages']);

	}

	public function actionDialogList()
	{
        $dialogsAndPages = Dialogs::getUserDialogs(Yii::app()->user->id);

		$this->render('DialogList',array(
            'dialogs'=>$dialogsAndPages['dialogs'],
            'pages'=>$dialogsAndPages['pages'],
        ));
	}

    public function actionSendMessage($id)
    {

        if (isset($_POST['Messages']))
        {
            if(is_object($dialog = Dialogs::WriteMessage(Yii::app()->user->id,$id,$_POST['Messages']['text'])))
                Yii::app()->user->setFlash('success', Yii::t('dialogs', 'Message was sent'));
                $this->redirect('/dialogs/view/'.$dialog->id);
            die();
        }

        $this->render('sendmessage',array(
            'model'=>new Messages(),
            'user'=>Users::model()->findByPk($id)
        ));
    }

    public function actionDeleteMessage($id)
    {
      $message = Messages::model()->findByPk($id);
      Messages::deleteMessage($message);
      $this->redirect('/dialogs/view/'.$message->dialog);
    }

}
