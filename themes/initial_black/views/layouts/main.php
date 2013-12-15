<html>

<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAA
AAAAAAAAAAAASVKXAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARAAAAEQAAABEAAAERAAAAEQAAERAAAAARAAAR
AAAAABEAARAAAAAAEQAREAAAAAAREREREAAAABERERERAAAAEQAAABEAAAARAAAAEQAAABEAAAAR
AAAAEREREREAAAABEREREAAAAAAAAAAAAAD//wAA//8AAM/PAADPjwAAzx8AAM8/AADOfwAAzH8A
AMAfAADADwAAz88AAM/PAADPzwAAwA8AAOAfAAD//wAA" rel="shortcut icon" type="image/x-icon" />
</head>

<body>

<div class="logo">
    <a href="/">roxifi</a> <div class="alpha">alpha</div>
</div>


<div class="header">
    <?php
        $dialogs_label = '';
        $events_label = '';
        $friends_label = '';

        if(!Yii::app()->user->isGuest)
        {

            $dialogs_label = Messages::model()->count('(recipient=:user) and (status = 0 or status = 5)',array(
                ':user'=>Yii::app()->user->id
            ));

            $dialogs_label = $dialogs_label > 0 ? ' (+'.$dialogs_label.')' : '';

            $events_label = EventsMembers::model()->count('user=:user and status = 0',array(
                ':user'=>Yii::app()->user->id
            ));

            $events_label = $events_label > 0 ? ' (+'.$events_label.')' : '';

            $friends_label = UsersFriends::model()->count('user_to=:user and status = 0',array(
                ':user'=>Yii::app()->user->id
            ));

            $friends_label = $friends_label > 0 ? ' (+'.$friends_label.')' : '';
        }

        $this->widget('zii.widgets.CMenu',
        array(
            'htmlOptions' => array( 'class' => 'menu' ),
            'activeCssClass'	=> 'active',
            'items'=>array(
            array('label'=>Yii::t('nav_buttons', 'Profile'), 'url'=>array('/u'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Blog'), 'url'=>array('/blog/'.Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Register'), 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>Yii::t('dialogs', 'Dialogs').$dialogs_label, 'url'=>array('/dialogs'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('friends', 'Friends').$friends_label, 'url'=>array('/friends'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('materials', 'Materials'), 'url'=>array('/materials'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('events', 'Events').$events_label, 'url'=>array('/events'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'People'), 'url'=>array('/users'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>Yii::t('nav_buttons', 'Feedback'), 'url'=>array('/site/feedback')),
            array('label'=>Yii::t('nav_buttons', 'Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,
                //'itemOptions' => array('style' => 'float: right;')
            )
            ),
        ));
    ?>
</div>

<div class="content">
    <?php echo $content;?>

    <div class="footer">

        <div class="footer_menu">
            <a href="/site/rules"><?php echo Yii::t('main', 'Rules');?></a>
            <a href="/blog/0"><?php echo Yii::t('main', 'Developers\'s blog');?></a>
            <a href="/site/about"><?php echo Yii::t('main', 'About');?></a>
            <a href="/site/polls"><?php echo Yii::t('main', 'Polls');?></a>
        </div>

        Created by <i>0Medvedkoo</i> and <i>Porto</i>.
    </div>


</div>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter23306455 = new Ya.Metrika({id:23306455,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/23306455" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>
