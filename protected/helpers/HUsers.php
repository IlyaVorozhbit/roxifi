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

    }


?>
