<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    
    <title>Company Database</title>
</head>
<body class="bg-gradient-to-r from-teal-400 to-blue-500">
    <div>
        <form class="h-50 border rounded my-10 mx-10" method="post" action="index.php">
            <div class="flex flex-wrap justify-center my-10">
                <input type="text" class="h-12 border rounded p-1 ml-4 sm:my-2 " placeholder="Company Name" name="c_name">
                <select type="text" class="h-12 border rounded p-1 ml-4 sm:my-2"  placeholder="Select an Industry" name="type">
                    <option value="">All Industries</option>
                    <option value="manufacturing">All Manufacturing Companies</option>
                    <option value="services">All Services Companies</option>
                    <option value="advertising">Advertising</option>
                    <option value="media">Media</option>
                    <option value="airlines">Airlines</option>
                    <option value="aviation">Aviation</option>
                    <option value="defence">Defence</option>
                    <option value="media">Automobile</option>
                </select>
                <input type="text" class="h-12 border rounded p-1 ml-4 sm:my-2" placeholder="Select City" name="city">
                <button class="rounded border p-2 ml-4 sm:my-2 bg-red-400">Search</button>
            </div>
        </form>
    </div>
    <div class="border rounded my-10 mx-10">
            <div id="Sort"></div>
            <hr class="bg-black"/>
            <div id="Companies">
                <?php
if(isset($_POST['city']) && isset($_POST['type']) && isset($_POST['c_name']))
{
$con = new mysqli("localhost", "root", "", "Companies");
$city=$_POST['city'];
$type=$_POST['type'];
$name=$_POST['c_name'];
$query = "SELECT * FROM `cdb` WHERE `Name_of_the_Company` LIKE '%$name%' AND `Type_of_Organization` LIKE '%$type%' AND `Company_Address` LIKE '%$city%' ORDER BY `Name_of_the_Company`";
//echo $query;
if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
       
        echo '<div class="my-4 bg-gray-200 rounded ml-20 mr-20 p-2"><table width="100%">'.
        '<tr><td width="13%" style="vertical-align: text-top">Industry</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Name_of_the_Company"].'</td></tr>' .
        '<tr><td width="13%" style="vertical-align: text-top">Company Type</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Type_of_Organization"].'</td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Level of Office</td><td width="2%" style="vertical-align: text-top">:</td><td></td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Location</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Origin"].'</td></tr>'.
        '<tr><td width="13%" style="vertical-align: text-top">Phone No</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Contact_Person_Phone_No"].'</td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Website</td><td width="2%" style="vertical-align: text-top">:</td><td><a class="text-blue-500 hover:text-blue-800" href="'.$row["Website"].'">'.$row["Website"].'</a></td></tr>'.
        '</table></div>';    }
    $result->free();
}
}
else
{
$con = new mysqli("localhost", "root", "", "Companies");
$query = "SELECT * FROM `cdb`";
if ($result = $con->query($query)) {
    while ($row = $result->fetch_assoc()) {
       
        echo '<div class="my-4 bg-gray-200 rounded ml-20 mr-20 p-2"><table width="100%">'.
        '<tr><td width="13%" style="vertical-align: text-top">Industry</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Name_of_the_Company"].'</td></tr>' .
        '<tr><td width="13%" style="vertical-align: text-top">Company Type</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Type_of_Organization"].'</td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Level of Office</td><td width="2%" style="vertical-align: text-top">:</td><td></td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Location</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Origin"].'</td></tr>'.
        '<tr><td width="13%" style="vertical-align: text-top">Phone No</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Contact_Person_Phone_No"].'</td></tr> '.
        '<tr><td width="13%" style="vertical-align: text-top">Website</td><td width="2%" style="vertical-align: text-top">:</td><td><a class="text-blue-500 hover:text-blue-800" href="'.$row["Website"].'">'.$row["Website"].'</a></td></tr>'.
        '</table></div>';
    }
    $result->free();
}
}
?>
            </div>
    </div>
</body>
<script>
    var i;
    var b="<span class='ml-2 text-white p-2 my-2'>Sort By Company Name ></span>";
    for(i=0;i<26;i++){
        b+="<a href='search.php?let="+String.fromCharCode(65+i)+"'><button class='ml-2 text-white p-2 hover:bg-red-400 my-2'>"+String.fromCharCode(65+i)+"</button></a>";
    }
    document.getElementById("Sort").innerHTML=b;

    var details="";
</script>
</html>