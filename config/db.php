<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'. realpath(__DIR__."/../database")."/data.db",
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

