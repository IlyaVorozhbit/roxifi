<?php

    class HProfile
    {

        public static function renderFriendsButtons(Users $user)
        {
            if(UsersFriends::canRegisterRequest(Yii::app()->user->id, $user->id))
                echo '<a class="btn" href="/friends/add/'.$user->id.'">'.Yii::t('profile', 'Add to friends').'</a>';
            else
                if(UsersFriends::isFriends(Yii::app()->user->id, $user->id))
                    echo '<a class="btn" href="/friends/delete/'.$user->id.'">'.Yii::t('profile', 'Remove from friends').'</a>';

        }

        public static function renderSendMessageButton(Users $user)
        {
            if($user->id == Yii::app()->user->id)
                return 0;

            if(!Yii::app()->user->isGuest)
                echo '<a class="btn" href="/dialogs/sendmessage/'.$user->id.'">'.Yii::t('profile', 'Send message').'</a>';
        }

    }



?>