<?php

function getAddress($dmsLatitude, $dmsLongitude, $latitude, $longitude){
    $url = "https://www.google.com/maps/place/".$dmsLatitude['deg']."%C2%B0".$dmsLatitude['min']."'".$dmsLatitude['sec']."%22N+".$dmsLongitude['deg']."%C2%B0".$dmsLongitude['min']."'".$dmsLongitude['sec']."%22E/".$latitude.",".$longitude.",17z/3d".$latitude."!4d".$longitude."?hl=vi-VN";
    
    $html = file_get_contents($url);

    $html_explope = explode('meta',$html);

    $htmlExplopeAddress = explode("<script",$html);

    //explode \"
    $addressExplode = explode('\"',$htmlExplopeAddress[8]);

    // echo $addressExplode[1677];

    return $addressExplode[1673];
};

function DMStoDD($deg,$min,$sec)
{
    // Converting DMS ( Degrees / minutes / seconds ) to decimal format
    return $deg+((($min*60)+($sec))/3600);
}    

function DDtoDMS($dec)
{
    // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}   

/**
 * test case 
 * TH1: 10.8858574,106.6380033
 * TH2: 10.8144116,106.7096421
 */

$latitude = 10.8144116;
$longitude = 106.7096421;

$dmsLatitude = DDtoDMS($latitude);
$dmsLongitude = DDtoDMS($longitude);
$address =  getAddress($dmsLatitude, $dmsLongitude,$latitude, $longitude);
echo $address;

?>