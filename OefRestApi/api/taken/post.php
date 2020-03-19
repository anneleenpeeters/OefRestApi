<?php
//Headers
header('Access-Control-Allow-Orgin: *');
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
header('Access-Controle-Allow-Headers: Access-Controle-Allow-Headers, Content-Type, Access-Controle-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Taak.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate taak object
$taak = new Taak($db);

//GET raw posted data
$data = json_decode(file_get_contents('php://input'));

//assign data to taak object
$taak->taa_omschr = $data->taa_omschr;
$taak->taa_datum = $data->taa_datum;

//Create post
if($taak->post()) {
    echo json_encode(
        array('message' => 'Taak aangemaakt')
    );
} else {
    echo json_encode(
        array('message' => 'Taak NIET aangemaakt')
    );
}

