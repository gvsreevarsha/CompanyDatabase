<?php require 'header.php'?>
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
            <div id="Sort"></div>
            <hr class="bg-black"/>
            <div id="pagination" class="p-2" align="right"></div>
            <div id="Companies">
                <?php
                $row_cnt=0;   
                $name='';
                $type='';
                $city='';         
                if(isset($_GET['city']) && isset($_GET['type']) && isset($_GET['c_name']))
                {
                $con = new mysqli("localhost", "root", "", "Companies");
                $city=$_GET['city'];
                $type=$_GET['type'];
                $name=$_GET['c_name'];
                if(isset($_GET['page']))
                    $page=$_GET['page'];
                else
                    $page=1;
                $query = "SELECT * FROM `cdb` WHERE `Name_of_the_Company` LIKE '%$name%' AND `Type_of_Organization` LIKE '%$type%' AND `Company_Address` LIKE '%$city%' ORDER BY `Name_of_the_Company`";
                if ($result = $con->query($query)) {
                    $row_cnt=$result->num_rows;
                }
                $start=50*($page-1);
                $query = "SELECT * FROM `cdb` WHERE `Name_of_the_Company` LIKE '%$name%' AND `Type_of_Organization` LIKE '%$type%' AND `Origin` LIKE '%$city%' ORDER BY `Name_of_the_Company` LIMIT ".$start.",50";
                if ($result = $con->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="my-4 bg-gray-200 rounded ml-20 mr-20 p-2"><table width="100%">'.
                        '<tr><td width="13%" style="vertical-align: text-top">Company Name</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Name_of_the_Company"].'</td></tr>' .
                        '<tr><td width="13%" style="vertical-align: text-top">Company Type</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Type_of_Organization"].'</td></tr> '.
                        '<tr><td width="13%" style="vertical-align: text-top">Level of Office</td><td width="2%" style="vertical-align: text-top">:</td><td></td></tr> '.
                        '<tr><td width="13%" style="vertical-align: text-top">Location</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Origin"].'</td></tr>'.
                        '<tr><td width="13%" style="vertical-align: text-top">Phone No</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Contact_Person_Phone_No"].'</td></tr> '.
                        '<tr><td width="13%" style="vertical-align: text-top">Website</td><td width="2%" style="vertical-align: text-top">:</td><td><a class="text-blue-500 hover:text-blue-800" href="'.$row["Website"].'">'.$row["Website"].'</a></td></tr>'.
                        '</table></div>';  
                        $row_cnt++;  
                    }
                    $result->free();
                }
        }
        else
        {
        $con = new mysqli("localhost", "root", "", "Companies");
        $query = "SELECT * FROM `cdb`";
        $row_cnt=0;  
        if ($result = $con->query($query)) {
            while ($row = $result->fetch_assoc()) {
       
                echo '<div class="my-4 bg-gray-200 rounded ml-20 mr-20 p-2"><table width="100%">'.
                '<tr><td width="13%" style="vertical-align: text-top">Company Name</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Name_of_the_Company"].'</td></tr>' .
                '<tr><td width="13%" style="vertical-align: text-top">Company Type</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Type_of_Organization"].'</td></tr> '.
                '<tr><td width="13%" style="vertical-align: text-top">Level of Office</td><td width="2%" style="vertical-align: text-top">:</td><td></td></tr> '.
                '<tr><td width="13%" style="vertical-align: text-top">Location</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Origin"].'</td></tr>'.
                '<tr><td width="13%" style="vertical-align: text-top">Phone No</td><td width="2%" style="vertical-align: text-top">:</td><td>'.$row["Contact_Person_Phone_No"].'</td></tr> '.
                '<tr><td width="13%" style="vertical-align: text-top">Website</td><td width="2%" style="vertical-align: text-top">:</td><td><a class="text-blue-500 hover:text-blue-800" href="'.$row["Website"].'">'.$row["Website"].'</a></td></tr>'.
                '</table></div>';
                $row_cnt++;  
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
<script>
    var i;
    var b="";
    var name="<?php echo $_GET['c_name'];?>";
    var type="<?php echo $_GET['type'];?>";
    var city="<?php echo $_GET['city'];?>";
    var num="<?php echo $row_cnt;?>";
    for(i=1;i<num/50+1;i++){
        b+="<a href='index.php?c_name="+name+"&type="+type+"&city="+city+"&page="+i+"'><button class='text-white p-1 hover:bg-red border'>"+i+"</button></a>";
    }
    b+="&emsp;";
    document.getElementById("pagination").innerHTML=b;
    var details="";
</script>
<?php require 'footer.php'?>
