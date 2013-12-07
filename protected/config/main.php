<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
    return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Roxifi',
        'theme'=>'initial_black',
        'language'=>'ru',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.helpers.*',
        ),

        'modules'=>array(
            // uncomment the following to enable the Gii tool
            'man',
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'1',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
            ),

        ),

        // application components
        'components'=>array(
            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
            ),
            // uncomment the following to enable URLs in path-format

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'caseSensitive'=>true,
                'rules'=>array(
                    'u<id:\d+>'=>'users/profile',
                    'u<id:\d+>/friends'=>'users/userfriends',
                    'events/members/invite/<id:\d+>'=>'events/invite',
                    'event/invite/e<id:\d+>/u<uid:\d+>'=>'events/sendinvite',
                    'events/invites/accept/<id:\d+>'=>'events/accept',
                    'events/invites/reject/<id:\d+>'=>'events/reject',
                    'blog/<id:\d+>'=>'users/blog',
                    'minds'=>'users/minds',
                    'minds/new/<id:\d+>'=>'users/NewMindToUser',
                    'minds/edit/<id:\d+>'=>'users/EditMind',
                    'minds/delete/<id:\d+>'=>'users/DeleteMind',
                    'blog/message/<id:\d+>'=>'users/BlogMessage',
                    'blog/delete/message/<id:\d+>'=>'users/BlogDelMessage',
                    'blog/edit/message/<id:\d+>'=>'users/BlogEditMessage',
                    'blog/comment/message/<id:\d+>'=>'users/BlogCommentMessage',
                    'u<id:\d+>/notes'=>'users/notes',
                    'u<id:\d+>/materials'=>'users/materials',
                    'u<id:\d+>/edit'=>'users/edit',
                    'u<id:\d+>/wall'=>'users/wall',
                    'verify/<hash:\w+>'=>'site/verify',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),

            'db'=>array(

                                'emulatePrepare' => true,
                                'charset' => 'utf8',
                ///*

                       'connectionString' => 'mysql:host=178.32.53.111;dbname=roxifi_roxifi',
                       'username' => 'roxifi_roxifi',
                       'password' => '12345678',
                //*/

                /*
                                   'connectionString' => 'mysql:host=localhost;dbname=roxifi',
                                   'username' => 'root',
                                   'password' => ''
                */

       ),

       'errorHandler'=>array(
           // use 'site/error' action to display errors
           'errorAction'=>'site/error',
       ),
       'log'=>array(
           'class'=>'CLogRouter',
           'routes'=>array(
               array(
                   'class'=>'CFileLogRoute',
                   'levels'=>'error, warning',
               ),
               // uncomment the following to show log messages on web pages
               /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
                ),
            ),
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
            // this is used in contact page
            'adminEmail'=>'webmaster@example.com',
        ),
    );
