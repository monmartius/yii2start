<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2start',

//    'dsn' => 'sqlite:'. realpath(__DIR__."/../database")."/data.db",
    'username' => 'root',
    'password' => '',
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
    'charset' => 'utf8',
];

