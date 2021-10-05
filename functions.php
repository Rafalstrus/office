<?php
if(!defined('Access')) {
    header("location: login.php");
}

function updataData($data){
    require_once('connection.php');
    $updateData = new ConnectToDb;
    $updateData->makeConnection();
    $updateData->doQuery($data);
}

function isseter($data){
    return isset($data) && $data !=null;
}

?>