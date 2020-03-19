<?php

function callAPI($method, $url, $data){

    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;

        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'APIKEY: 111111111111111111111',
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>API tester taken</h1>
</div>
<div class="container">
        <form id="form_get" method="post" action="#">
            <input name="submitGet" type="submit" value="GET alle taken">
            <br><br>
            <input type="text" placeholder="Vul id nummer in">
            <input name="submitGetId" type="submit" value="GET id taak">
        </form>

</div>

<?php
//SUBMIT GET
if ( $_POST['submitGet'] == "GET alle taken" )
{
    $get_data = callAPI('GET', 'http://localhost/OefRestApi/api/taken/get.php', false);
    $response = json_decode($get_data, true);
    $errors = $response['response']['errors'];
    $data = $response['response']['data'][0];
?>

<table class="table">
    <tr>
        <th>Taak nummer </th>
        <th>Datum</th>
        <th>Omschrijving</th>
    </tr>

<?php

for ($x = 0; $x < sizeof($response['data']); $x++) {
    echo '<tr><td>';
    echo $response['data'][$x]['id'];
    echo '</td><td>';
    echo $response['data'][$x]['datum'];
    echo '</td><td>';
    echo $response['data'][$x]['omschrijving'];
    echo '</td></tr>';}
}

?>
</table>

</body>
</html>