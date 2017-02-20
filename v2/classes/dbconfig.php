<?php

$url_base = "http://isaiasfaria.com.br/isima_base_donne_tp1/";
$url_site = $url_base."v2/";

$DB_host = "localhost";
$DB_user = "dvjgo267_fariasi";
$DB_pass = "fariasilva";
$DB_name = "dvjgo267_fariasilva_tp1_basedonee_isima";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}



?>