<?php
/*$dbHost = "localhost";
$dbUser = "sunset_zag";
$dbPass = "9pmRWEc4;Hn%";
$dbDatabase = "mediates_elite";
$web_url = "http://174.121.85.124/~mediates/design_benefits/";
*/
$dbHost = "us-cdbr-azure-west-a.cloudapp.net";
$dbUser = "b075c74642244c";
$dbPass = "e2e1219d";
$dbDatabase = "zagtest";
/*$web_url = "http://www.zagtech.com/";*/

mysql_connect($dbHost,$dbUser,$dbPass);
mysql_select_db($dbDatabase);
?>