<?php

    class HPolls
    {

        public static function Poll($id)
        {
            $poll = UsersPolls::model()->findByPk($id);

            if(is_null($poll))
                throw new CHttpException(403,'Poll with id '.$id.' not found. Access denied');

            $options = UsersPollsOptions::model()->findAll('poll=:poll',array(':poll'=>$poll->id));
            echo $poll->description;

            $form=Yii::app()->getController()->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            ));

            echo '<div class="poll">';

            $have_voted = UsersPollsVotes::model()->exists('user=:user and poll=:poll',array(
                ':user'=>Yii::app()->user->id,
                ':poll'=>$poll->id
            ));

            if(Yii::app()->user->isGuest)
            {
                $have_voted = 1;
            }

            $poll_votes_count = UsersPollsVotes::model()->count('poll=:poll',array(':poll'=>$poll->id));

            foreach($options as $key => $option)
            {
                if($poll_votes_count!=0)
                    $options[$key]->percentage = $option->votes_count/$poll_votes_count*100;
            }

            foreach($options as $key => $option)
            {
                if(!$have_voted)
                    echo '<div class="option_for_vote"><input type="radio" name="UsersPollsVotes[option]" value='.$option->id.'> '.$option->name.' ('.$option->votes_count.')</div><br>';
                else
                    if($option->percentage>0)
                        echo '<div class="option"><div class="background" style="width:'.$option->percentage.'%"></div>'.$option->name.' ('.$option->votes_count.')</div><br>';
                    else
                        echo '<div class="background_empty">'.$option->name.' ('.$option->votes_count.')</div><br>';

            }

            echo '</div>';

            if(!$have_voted)
            {
                echo '<div class="row buttons">';
                echo CHtml::submitButton('Vote');
                echo '</div>';
            }

            Yii::app()->getController()->endWidget();

            echo '</div>';

        }

    }

?>