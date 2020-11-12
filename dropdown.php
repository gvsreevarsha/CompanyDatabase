<?php
$con = new mysqli("localhost", "root", "NikiSiddu3014!", "Company_DB");
$query = "SELECT distinct Type_of_Organization FROM `cdb`";
if ($result = $con->query($query)) {
    echo "<select name='Place'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Type_of_Organization'] ."'>" . $row['Type_of_Organization'] ."</option>";
    }
    $result->free();
}
?>