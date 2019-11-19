<?php

function debug($obj, $returnString = false){

    $out = "<pre>" . print_r($obj, true) . "</pre>";

    if($returnString){
        return $out;
    }
    else{
        echo $out;
    }
}

function debugf($obj, $fname = "D:/projects/yii2start/runtime/logs/debugf.log"){

    if($fname != "D:/projects/yii2start/runtime/logs/debugf.log"){

        $fname =  "D:/projects/yii2start/runtime/logs/" . $fname ;
    }

    $out = "<pre>" . print_r($obj, true) . "</pre>";

    file_put_contents($fname, $out);
}

function debugd($obj){

    $out = "<pre>" . print_r($obj, true) . "</pre>";

    echo $out;
    die();
}

