<?php

$sName ="localhost";
$uName = "root";
$pass = "";
$db_name = "burma";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Example query: selecting all data from a table named 'your_table'
    $stmt = $conn->prepare("SELECT * FROM your_table");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process the fetched data, for example:
    foreach ($result as $row) {
        echo "Column1: " . $row['column1_name'] . " - Column2: " . $row['column2_name'] . "<br>";
    }

    // Close the connection (optional as PHP will automatically close it at the end of script execution)
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
