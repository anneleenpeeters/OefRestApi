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

//Taak query
$result = $taak->get();

//Get row count
$num = $result->rowCount();

//Check if there are taken
if($num > 0) {
    //taak array
    $taken_arr = array();
    $taken_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $taak_item = array(
            'id' => $taa_id,
            'datum' => $taa_datum,
            'omschrijving' => $taa_omschr
        );

        //push to 'data'
        array_push($taken_arr['data'], $taak_item);
    }

    //Turn PHP array to JSON
    echo json_encode($taken_arr);
} else {
    //Geen taken
    echo json_encode(
        array('message' => 'Geen taken gevonden')
    );
}


