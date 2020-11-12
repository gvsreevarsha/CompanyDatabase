<?php
if(isset($_GET['let']))
$let = $_GET['let'];
else
$let='';
$query = "SELECT Name_of_the_Company FROM cdb WHERE Name_of_the_Company LIKE '$let%'";
$con = new mysqli("localhost", "root", "NikiSiddu3014!", "Company_DB");
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