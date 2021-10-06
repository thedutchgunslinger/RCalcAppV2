<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$userInputWachtwoord = $_GET["w"];
$userInputEmail = $_GET["e"];   
$servername = "localhost";
$username = "root";
$password = null;
$dbname = "test";

$user = [];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM gebruikers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userInputEmail);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        if($row["email"] == $userInputEmail){
            if ($row["wachtwoord"] == $userInputWachtwoord) {
            // $img = $row["image"];
            // $img = "http://localhost/jacky/backEnd/" . $img;
            array_push($user, array(
                "code" => 600,
                "id" => $row["id"],
                "voornaam" => $row["voornaam"],
                "achternaam" => $row["achternaam"],
                "email" => $row["email"],
                "datum" => $row["datum"]
            ));
        }else {
                array_push($user, array(
                    "code" => 602
                ));
        }
        
        }
    }
}else {
    array_push($user, array(
        "code" => 601
    ));
}

mysqli_close($conn);

echo json_encode($user);
