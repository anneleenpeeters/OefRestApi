<?php
//Headers
header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Taak.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate taak object
$taak = new Taak($db);

//GET id from url
$taak->taa_id = isset($_GET['id']) ? $_GET['id'] : die();

//GET taak
$taak->getSingle();

//Create taak array
$taak_arr = array(
    'id' => $taak->taa_id,
    'datum' => $taak->taa_datum,
    'omschrijving' => $taak->taa_omschr
);

//Make JSON
print_r(json_encode($taak_arr));

