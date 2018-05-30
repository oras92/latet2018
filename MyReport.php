 <!DOCTYPE HTML>

<html dir="rtl">
    
    <style>
    table {
        width:60%;
        margin:0px auto;
    
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color:  #ffff66;
    }
     tr:nth-child(odd) {
       background-color: #fff;
    }
    th {
        background-color: #14BBB1;
        color: white;
    }
    </style>

    <head>
      		 <title>Latet</title>   
      		 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      		 <link rel="stylesheet" type="text/css" href= "stylesheet.css">
    		  <link rel="stylesheet" type="text/css" href= "bootstrap.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    		  
      		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      		 <script> 
    			$(document).ready(function(){
    				$("#by_storage").click(function(){
    					$("#storage").slideToggle("slow");
    				});
    			});
    			
    				$(document).ready(function(){
    				$("#by_month").click(function(){
    					$("#month").slideToggle("slow");
    				});
    			});
    			
    				$(document).ready(function(){
    				$("#by_date").click(function(){
    					$("#date").slideToggle("slow");
    				});
    			});
    			
    				$(document).ready(function(){
    				$("#by_unstaffed").click(function(){
    					$("#unstaffed").slideToggle("slow");
    				});
    			});
    			
    		</script>
    </head>
    
    <body>
        <?php
            session_start();
            
            $servername = "zebra.mtacloud.co.il";
            $username = "shiranya";
            $password = "latet";
            $dbname = "shiranya_Latet2018";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                 die("Connection failed: " . $conn->connect_error);
            } 
             mysqli_set_charset($conn, "utf8");
        ?>
     <header>
        <div class="logo">
            <a href="http://shiranya.mtacloud.co.il/home_admin.php"><img src="/img/LOGO.jpeg" alt="latet" ;width="120" height="120"></a>
        </div>
		 <nav class="topnav" id="myTopnav">
           <ul id="navbar">
		   <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">תפריט</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/Constraint.php"> אילוצי משמרות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/Manage_Users.php"> ניהול משתמשים</a></li>
			   <li><a href="http://shiranya.mtacloud.co.il/MyReport.php"> דוחות</a></li>
              <li><a href="http://shiranya.mtacloud.co.il/OurStorages_admin.html"> המחסנים שלנו</a></li>
              <li><a href="https://www.latet.org.il/">אתר לתת</a></li>
            </ul>
        </nav>
		<a id="logout" href="logout.php">התנתקות</a>
     </header>
        
        <div class="main">

          
          <h1 style="color: #14BBB1;">הדוחות שלי<i style="font-size:24px" class="fa">&#xf02e;</i></h1>
            <p> נא ללחוץ על הדוח אותו אתה מעוניין לקבל</p>
            <h2 id="by_storage"> דוחות מלגאים לפי מחסן</h2>
              <form id="storage" action="MyReport.php" method="post">
                    <p><lable> בחר מחסן:
                        <select name="storage" size="1">
                          <option value="--בחר--"> --בחר-- </option>
                          <option value="102">באר שבע</optioin>
                          <option value="105">קריית ביאליק</optioin>
                          <option value="120">הר טוב</optioin>
                        </select>
                    </lable></p>
                    <p><input type="submit" name="storage1" value="הצג דוח"></p>
                </form>
                <?php
                    $_get_storage= $_POST['storage'];
                    if(isset($_POST['storage1']))
                        {
                            if($_get_storage == "--בחר--")
                            {
                                echo "לא נבחר מחסן, אנא בחר שוב";
                            }
                            else{    
                        $sql_storage= "SELECT User_Id,Shift_Date, Storage_Name  FROM assignments join Storages on assignments.Storage_Id = Storages.Storage_Id WHERE Storages.Storage_Id= $_get_storage order by Shift_Date";
                        $result = $conn->query($sql_storage);
                                if ($result->num_rows > 0) {
                                    echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>שם מחסן</th></tr>";
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td></tr>";
                                    }
                                    echo "</table>";
                                }
                                else {echo "לא נמצאו מתנדבים הרשומים למחסן זה";}
                        }
                    }
                ?>
              
            <h2 id="by_month"> דוח מלגאים לפי חודש</h2>
                <form id="month" action="MyReport.php" method="POST">
                    <p><lable> בחר חודש להצגת דוח:
                            <select name="month" size="1">
                              <option value="--בחר--"> --בחר-- </option>
                              <option value="1"> ינואר </option>
                              <option value="2"> פברואר</option>
                              <option value="3"> מרץ </option>
                              <option value="4"> אפריל </option>
                              <option value="5"> מאי </option>
                              <option value="6"> יוני </option>
                              <option value="7"> יולי </option>
                              <option value="8"> אוגוסט </option>
                              <option value="9"> ספטמבר </option>
                              <option value="10"> אוקטובר </option>
                              <option value="11"> נובמבר </option>
                              <option value="12"> דצמבר </option>
                            </select>
                           </lable></p>
                    <p><input type="submit" name="byMonth" value="הצד דוח"></p>
                </form>
                
                <?php
                        $_get_month= $_POST['month'];
                        if(isset($_POST['byMonth']))
                            { 
                                if($_get_month == "--בחר--")
                            {
                                echo "לא נבחר חודש, אנא בחר שוב.";
                            }
                            else{  
                                $sql_month= "SELECT DISTINCT User_Id,Shift_Date, Storage_Name  FROM assignments join Storages on assignments.Storage_Id = Storages.Storage_Id WHERE MONTH(Shift_Date) = $_get_month order by Shift_Date";
                                $result = $conn->query($sql_month);
                                   if ($result->num_rows > 0) {
                                        echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>שם מחסן</th></tr>";
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td></tr>";
                                        }
                                        echo "</table>";
                                   }
                                   
                                   else {echo "לא נמצאו מתנדבים הרשומים לחודש זה";}
                                }
                            }
                    ?>
              
            <!--
            <h2 id="by_date"> דוח מלגאים לפי תאריך( אם נצליח לתקן)</h2>
                <form id="date" action="MyReport.php" method="POST">
                    <p> בחר תאריך תחילה  <input type="date" value="start"</p>
                    <p> בחר תאריך סיום   <input type="date" value="finish"</p>
                    <p><input type="submit" name="date" value="Submit"></p>
                </form>
                
                <?php
                    $_get_start= $_POST['start'];
                    $_get_finish= $_POST['finish'];
                    if(isset($_POST['date']))
                        {
                        $sql_date= "SELECT DISTINCT User_Id,Shift_Date, Storage_Name  FROM assignments join Storages on assignments.Storage_Id = Storages.Storage_Id WHERE Shift_Date BETWEEN #$_get_start# AND #$_get_finish# order by Shifts.Shift_Date";
                        $result = $conn->query($sql_date);
                           if ($result->num_rows > 0) {
                                echo "<table><tr><th>ת.ז מתנדב</th><th>תאריך משמרת</th> <th>שם מחסן</th></tr>";
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["User_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td></tr>";
                                }
                                echo "</table>";
                           }
                           else {echo "0 results";}
                        }
                ?>
            -->
    
            <h2 id="by_unstaffed"> דוח משמרות לא מאויישות</h2>
                <form id="unstaffed" action="MyReport.php" method="POST">
                    <p><input type="submit" name="unstaffedShifts" value="הצג דוח"></p>
    
                </form>
                
                 <?php
                        if(isset($_POST['unstaffedShifts']))
                            {
                            $sql_unstaffed= "SELECT Shifts.Shift_Id, Shifts.Shift_Date, Storages.Storage_Name,Milgaie_Quantity-Registered_Quantity  FROM Shifts join Storages on Shifts.Storage_Id=Storages.Storage_Id WHERE Shifts.Milgaie_Quantity > Shifts.Registered_Quantity order by Shifts.Shift_Date";
                            $result = $conn->query($sql_unstaffed);
                               if ($result->num_rows > 0) {
                                    echo "<table><tr><th>קוד משמרת</th><th>תאריך משמרת</th> <th>שם מחסן</th><th> כמות מתנדבים חסרה </th></tr>";
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["Shift_Id"]. "</td><td>" . $row["Shift_Date"]. " </td><td>" . $row["Storage_Name"]. "</td>
                                        <td>" . $row["Milgaie_Quantity-Registered_Quantity"]. "</td></tr>";
                                    }
                                    echo "</table>";
                               }
                               else {echo "לא קיימות משמרות לא מאויישות";}
                            }
                    ?>
        </div> 
        <br><br>
    					  <footer>&copy; כל הזכויות שמורות לשירן יניב, עדי טבת ואור אשכנזי</footer>
    
    	  <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
            </script>
    </body>	

</html>