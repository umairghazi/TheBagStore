<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/12/16
 * Time: 12:56 PM
 */

function sanitizeString($string){
    $blackList = array("/`/","/'/","/</","/>/",'/"/', "/%/", "/\(/", "/\)/", "/\\\/", "/\//", "/\_/", "/\|/");
    $string = htmlentities($string);
    $string = strip_tags($string);
    $string = stripslashes($string);
    $string = preg_replace($blackList,"",$string);
    $string =  trim($string);
    return $string;
}



function isImage($mimeType)
{
    $allowedMimeTypes=array("image/jpeg","image/png","image/bmp","image/jpg","image/gif");

    foreach ($allowedMimeTypes as $allowedMimeType ) {
        if($mimeType==$mimeType)
        {
            return true;
        }
        return false;
    }

}

function checkArrValues($keyVals,$arr)
{
    $resultArray = array("items"=>array(),"resultBol"=>true);

    foreach ($keyVals as $keyVal) {
        $k = explode(":", $keyVal);
        $val = $k[0];
        array_shift($k);
        //print_r($keyVal);
        if ( !isset($arr[$val]) ) {
            if (!cop($k,'ex')) {
                $resultArray=setResultArray($resultArray,$val,"Field not set!");
            }
        }
        else if(trim($arr[$val]) == '') {
            if (!cop($k,'ex')) {
                $resultArray=setResultArray($resultArray,$val,"Field was left blank!");
            }
        }
        else if (cop($k,'i')) {
            if (!preg_match('/^\d+$/',$arr[$val]) ) {
                $resultArray=setResultArray($resultArray,$val,"Only Numbers Allowed!");
            }
        }
        else if (cop($k,'d')) {
            if (!preg_match("/^-?(?:\d+|\d*\.\d+)$/",$arr[$val])) {
                $resultArray=setResultArray($resultArray,$val,"Only Decimal Numbers Allowed!");
            }
        }
        else if (cop($k,'e')) {
            if (!filter_var($arr[$val], FILTER_VALIDATE_EMAIL)) {
                $resultArray=setResultArray($resultArray,$val,"Only valid emails Allowed!");
            }
        }
        else if (cop($k,'s')) {
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$arr[$val])) {
                $resultArray=setResultArray($resultArray,$val,"Only valid URLs Allowed!");
            }
        }

    }
    return $resultArray;
}

function cop($arr,$op)
{
    if($arr)
    {
        foreach ($arr as $value) {
            if($value==$op)
                return true;
        }
    }
    return false;

}


function setResultArray($resultArray,$keyVal,$msg){
    if(!isset($resultArray["items"]["$keyVal"])) {
        $resultArray["items"]["$keyVal"] = array();
    }

    //$resultItem = array("msg" => "$msg");
    $resultArray["resultBol"]=false;
    array_push($resultArray["items"]["$keyVal"], $msg);
    return $resultArray;
}

function unsetByVal(&$arr,$value)
{
    if($index=array_search($value, $arr))
    {
        unset($arr[$index]);
    }
}

