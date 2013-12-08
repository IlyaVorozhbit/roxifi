<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $this->render('index',array(
            'users_count'=>Users::model()->count(),
            'friends_count'=>UsersFriends::model()->count('status = 1'),
            'messages_count'=>Messages::model()->count(),
            'materials_count'=>MaterialsFiles::model()->count(),
            'blog_records'=>BlogsMessages::model()->count(),
        ));
	}
}