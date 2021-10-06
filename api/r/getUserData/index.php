<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$id = $_GET["id"];
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

$sql = "SELECT * FROM gebruikers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
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
            } 
        }
 

mysqli_close($conn);

echo json_encode($user);
