<?php


    class HUsers {


        public static function getUserInfo($user)
        {

            $user_info = UsersInfo::getUserFilledFields($user);
            $new_user_info = array();

            foreach($user_info as $field)
            {
                $fieldDB = UsersFields::model()->findByPk($field->field);
                $new_user_info[$field->field] = $field;
                $new_user_info[$field->field]->label = Yii::t('profile', $fieldDB->name);
            }

            if(is_null($new_user_info))
                $new_user_info = array();

            return $new_user_info;

        }

        public static function getProfileName(Users $user)
        {
            if(!empty($user->user_info[2]) && !empty($user->user_info[3]))
                echo $user->user_info[2]->value.' '.$user->user_info[3]->value;
            else
                echo Yii::app()->language == 'en' ? $user->login.Yii::t('profile', '\'s profile') : Yii::t('profile', '\'s profile').$user->login;
        }

    }


?>