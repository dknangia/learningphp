<?php 
require "Item.php";

$myObject = new Item();
$myObject->name  = "Item name"; 
$myObject->description; 

//Dynamic property 
$myObject->price = 0.25; 

echo $myObject->getName();

// var_dump($myObject);
