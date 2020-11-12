<?php
$con = new mysqli("localhost", "root", "NikiSiddu3014!", "Company_DB");
$query = "SELECT * FROM `cdb`";
if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
       echo '<tr>
        <td>'.$row["CNo"].'&nbsp</td>
        <td>'.$row["Name_of_the_Company"].'&nbsp</td>
        <td>'.$row["Origin"].'&nbsp</td><br>';
    }
    $result->free();
}
?>