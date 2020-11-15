<?php
$con = new mysqli("localhost", "root", "", "Companies");
if(isset($_GET['page']))
    $page=$_GET['page'];
else
    $page=1;
if(isset($_GET['let']))
$let = $_GET['let'];
else
$let='';
$query1 = "SELECT * FROM cdb WHERE Name_of_the_Company LIKE '$let%'";
if ($result = $con->query($query1)) {
    $row_cnt=$result->num_rows;
}
$start=50*($page-1);
$query1 = "SELECT * FROM cdb WHERE Name_of_the_Company LIKE '$let%' LIMIT ".$start.",50";
?>
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
        <form class="h-50 border rounded my-10 mx-10" method="GET" action="index.php">
            <div class="flex flex-wrap justify-center my-10">
                <input type="text" class="h-12 border rounded p-1 ml-4 sm:my-2 " placeholder="Company Name" name="c_name">
                <select class="h-12 border rounded p-1 ml-4 sm:my-2 text-gray-500"  placeholder="Select an Industry" name="type">
                    <option value=''>Select a Industry</option>
                    <?php
                        $con = new mysqli("localhost", "root", "", "Companies");
                        $query="SELECT DISTINCT `Type_of_Organization` FROM `cdb` WHERE LENGTH(`Type_of_Organization`)<51 ORDER BY LENGTH(`Type_of_Organization`)";
                        if ($result = $con->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['Type_of_Organization'] ."'>" . $row['Type_of_Organization'] ."</option>";
                            }
                            $result->free();
                        }
                    ?>
                </select>
                <select class="h-12 border rounded p-1 ml-4 sm:my-2 text-gray-500"  placeholder="Select City" name="city">
                    <option value=''>Select a city</option>
                    <?php
                        $con = new mysqli("localhost", "root", "", "Companies");
                        $query="SELECT DISTINCT `Origin` FROM `cdb` WHERE LENGTH(`Origin`)<51 ORDER BY LENGTH(`Origin`)";
                        if ($result = $con->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['Origin'] ."'>" . $row['Origin'] ."</option>";
                            }
                            $result->free();
                        }
                    ?>
                </select>
                <button class="rounded border p-2 ml-4 sm:my-2 bg-red-400">Search</button>
            </div>
        </form>
    </div>
    <div class="border rounded my-10 mx-10">
            <div id="Sort">A</div>
            <hr class="bg-black"/>
            <div id="pagination" class="p-2" align="right"></div>
            <div id="Companies">
                <?php
                    $con = new mysqli("localhost", "root", "", "Companies");
                    if ($result = $con->query($query1)) {
                        while ($row = $result->fetch_assoc()) {
       
                            echo '<div class="my-4 bg-gray-200 rounded ml-20 mr-20 p-2"><table width="100%">'.'<tr><td width="13%" style="vertical-align: text-top">Industry</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Name_of_the_Company"].'</td></tr>' .'<tr><td width="13%" style="vertical-align: text-top">Company Type</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Type_of_Organization"].'</td></tr> '.'<tr><td width="13%" style="vertical-align: text-top">Level of Office</td><td width="2%" style="vertical-align: text-top">:</td><td></td></tr> '.'<tr><td width="13%" style="vertical-align: text-top">Location</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Origin"].'</td></tr>'.'<tr><td width="13%" style="vertical-align: text-top">Phone No</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Contact_Person_Phone_No"].'</td></tr> '.'<tr><td width="13%" style="vertical-align: text-top">Website</td><td width="2%" style="vertical-align: text-top">:</td><td><a class="text-blue-500 hover:text-blue-800" href="'.$row["Website"].'">'.$row["Website"].'</a></td></tr>'.'</table></div>';
                        }
                        $result->free();
                    }
                    ?>
            </div>
    </div>
</body>
<script>
    var i;
    var b="<span class='ml-2 text-white p-2 my-2'>Sort By Company Name ></span>";
    var url="";
    for(i=0;i<26;i++){
        b+="<a href='search.php?let="+String.fromCharCode(65+i)+"'><button class='ml-2 text-white p-2 hover:bg-red-400 my-2'>"+String.fromCharCode(65+i)+"</button></a>";
    }
    document.getElementById("Sort").innerHTML=b;

    var details="";
</script>
<script>
    var i;
    var b="";
    var let="<?php echo $_GET['let'];?>";
    var num="<?php echo $row_cnt;?>";
    for(i=1;i<num/50+1;i++){
        b+="<a href='search.php?let="+let+"&page="+i+"'><button class='text-white p-1 hover:bg-red border'>"+i+"</button></a>";
    }
    b+="&emsp;";
    document.getElementById("pagination").innerHTML=b;
    var details="";
</script>
</html>