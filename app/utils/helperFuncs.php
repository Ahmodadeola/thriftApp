<?php

function print_br(){
    echo "<br />";
};

function printWithBr(...$items){
    foreach($items as $item){
        echo $item;
        print_br();
    }
}

function getItemsOfLength($arr, $size){
    return array_filter($arr, function($item) use ($size){
        return strlen($item) === $size;
    });
}

function printArrayItems($arr, $name='item', $title="Items"){
    printWithBr($title);
    foreach($arr as $idx => $item){
        printWithBr("The ${name} at ${idx}: ${item}");
    }
    print_br();
}

function array_find($arr, $func){
    $result = -1;
    foreach($arr as $value){
        if($func($value)){
            $result = $value;
            break;
        }
    }
    return $result;
}