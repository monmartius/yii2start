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

