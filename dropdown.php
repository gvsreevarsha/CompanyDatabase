<?php
$con = new mysqli("localhost", "root", "NikiSiddu3014!", "Company_DB");
$query = "SELECT distinct Origin FROM `cdb`";
if ($result = $con->query($query)) {
    echo "<select name='Place'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Origin'] ."'>" . $row['Origin'] ."</option>";
    }
    $result->free();
}
?>