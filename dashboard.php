<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
</head>
<?php 
    include_once 'includes/dbc_inc.php';
   
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $all = "SELECT * FROM my_table ORDER BY id";
    $result = $conn->query($all);
    $sql_junior = "SELECT * FROM my_table WHERE birthday >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";
    $result_junior = $conn->query($sql_junior);

    $sql_senior = "SELECT * FROM my_table WHERE birthday < DATE_SUB(NOW(), INTERVAL 18 YEAR)";
    $result_senior = $conn->query($sql_senior);

    $queryG = "SELECT (SELECT count(*) FROM my_table WHERE gender='Male') AS Male, (SELECT count(*) FROM my_table WHERE gender='Female') AS Female";
    
    $dataG = $conn->query($queryG);
    $genderData = $dataG->fetch_assoc();

    function display_count_for_all($param) {  
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'register';
        $conn = new mysqli($servername,$username, $password, $dbName);
        
        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $all = "SELECT * FROM my_table ORDER BY id";
        $result = $conn->query($all);
        $queryG = "SELECT (SELECT count(*) FROM my_table WHERE gender='Male') AS Male, (SELECT count(*) FROM my_table WHERE gender='Female') AS Female";
        $dataG = $conn->query($queryG);
        $genderData = $dataG->fetch_assoc();

        if($param === "all") {
            echo $result->num_rows;
        }

        if($param === "male") {
            echo $genderData['Male']; 
        }

        if($param === "female") {
            echo $genderData['Female'];
        }
    }

    function display_count_for_jr($param) {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'register';
        $conn = new mysqli($servername,$username, $password, $dbName);
        
        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if($param === "all") {
            $sql_junior = "SELECT * FROM my_table WHERE birthday >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result_junior = $conn->query($sql_junior);

            echo $result_junior->num_rows;
        }

        if($param === "male") {
            $sql_c_m = "SELECT COUNT(*) FROM my_table WHERE gender = 'male' AND birthday >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result = $conn->query($sql_c_m);
            $row = $result->fetch_assoc();
            
            echo $row['COUNT(*)'];
        }

        if($param === "female") {
            $sql_c_f = "SELECT COUNT(*) FROM my_table WHERE gender = 'female' AND birthday >= DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result = $conn->query($sql_c_f);
            $row = $result->fetch_assoc();
            
            echo $row['COUNT(*)'];

        }
    }

    function display_count_for_sr($param) {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'register';
        $conn = new mysqli($servername,$username, $password, $dbName);
        
        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if($param === "all") {
            $sql_senior = "SELECT * FROM my_table WHERE birthday < DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result_senior = $conn->query($sql_senior);
            echo $result_senior->num_rows;
        }

        if($param === "male") {
            $sql_c_m = "SELECT COUNT(*) FROM my_table WHERE gender = 'male' AND birthday < DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result = $conn->query($sql_c_m);
            $row = $result->fetch_assoc();
            
            echo $row['COUNT(*)'];
        }

        if($param === "female") {
            $sql_c_f = "SELECT COUNT(*) FROM my_table WHERE gender = 'female' AND birthday < DATE_SUB(NOW(), INTERVAL 18 YEAR)";
            $result = $conn->query($sql_c_f);
            $row = $result->fetch_assoc();
            
            echo $row['COUNT(*)'];
        }
    }
?>
<body>
    <div class="dashboard">
    <div class="wrap">
        <h2>List of Participants</h2>
        <hr>
        <div class="results">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="side-btn">
                            <form method="post">
                                <input type="submit" name="all" class="button" value="All" />
                                <input type="submit" name="junior" class="button" value="Junior (18 & below)" />
                                <input type="submit" name="senior" class="button" value="Senior (18 above)" />
                            </form>                            
                        </div>                        
                    </div>
                    <div class="col-md-9">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="label d-flex flex-row">
                                    <div class="label-content">
                                        <span class="lc-text">
                                            Total: <?php 
                                            if(isset($_POST['all'])) { 
                                                display_count_for_all("all");                               
                                            }
                                            if(isset($_POST['junior'])) { 
                                                display_count_for_jr("all");                               
                                            }
                                            if(isset($_POST['senior'])) { 
                                                display_count_for_sr("all");                                            
                                            }
                                            
                                            ?>
                                        </span>
                                    </div>
                                    <div class="label-content">
                                        <span class="lc-text">
                                            Male: <?php 
                                                if(isset($_POST['all'])) { 
                                                    display_count_for_all("male");                           
                                                }
                                                if(isset($_POST['junior'])) { 
                                                    display_count_for_jr("male");                               
                                                }
                                                if(isset($_POST['senior'])) { 
                                                    display_count_for_sr("male");                                            
                                                } 
                                            
                                            ?>
                                        </span>
                                    </div>
                                    <div class="label-content">
                                        <span class="lc-text">
                                            Female: <?php 
                                                if(isset($_POST['all'])) { 
                                                    display_count_for_all("female");                                
                                                }
                                                if(isset($_POST['junior'])) { 
                                                    display_count_for_jr("female");                               
                                                }
                                                if(isset($_POST['senior'])) { 
                                                    display_count_for_sr("female");                                            
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="show-entries d-flex flex-row flex-v-center">
                                        <span class="normal-txt">Show: </span>
                                        <select name="show">
                                            <option value="10">10</option>
                                            <option value="50">50</option>
                                            <option value="50">100</option>
                                        </select>
                                        <span class="normal-txt"> entries</span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="search-entries d-flex flex-row flex-v-center">
                                        <span class="normal-txt">Search: </span>
                                        <input type="text">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">                    
                                <div class="col-md">                        
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Age</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Email Address</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Date Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if(isset($_POST['all'])) {
                                                
                                                if ($result->num_rows > 0) { 
                                                    while($row = $result->fetch_assoc()) {
                                                        $age = date_diff(date_create($row['birthday']), date_create('today'))->y;
                                                        echo "<tr>";
                                                        echo "<td>".$row["firstname"]. " " . $row["lastname"]."</td>";
                                                        echo "<td>".$age. "</td>";
                                                        echo "<td>".$row["gender"]."</td>";
                                                        echo "<td>".$row["address1"]." ".$row["address2"]. "</td>";
                                                        echo "<td>".$row["email"]."</td>";
                                                        echo "<td>".$row["contactNumber"]."</td>";
                                                        echo "<td>".$row["reg_date"]."</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "No record found";
                                                }                                               
                                            }

                                            if(isset($_POST['junior'])) {
                                                
                                                
                                                if ($result_junior->num_rows > 0) {
                                                    while($row = $result_junior->fetch_assoc()) {
                                                        $jrage = date_diff(date_create($row['birthday']), date_create('today'))->y;
                                                        echo "<tr>";
                                                        echo "<td>".$row["firstname"]. " " . $row["lastname"]."</td>";
                                                        echo "<td>".$jrage. "</td>";
                                                        echo "<td>".$row["gender"]."</td>";
                                                        echo "<td>".$row["address1"]." ".$row["address2"]. "</td>";
                                                        echo "<td>".$row["email"]."</td>";
                                                        echo "<td>".$row["contactNumber"]."</td>";
                                                        echo "<td>".$row["reg_date"]."</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "No Junior Participants found";
                                                }
                                            }

                                            if(isset($_POST['senior'])) {
                                                
                                                

                                                if ($result_senior->num_rows > 0) {
                                                    while($row = $result_senior->fetch_assoc()) {
                                                        $srage = date_diff(date_create($row['birthday']), date_create('today'))->y;
                                                        echo "<tr>";
                                                        echo "<td>".$row["firstname"]. " " . $row["lastname"]."</td>";
                                                        echo "<td>".$srage. "</td>";
                                                        echo "<td>".$row["gender"]."</td>";
                                                        echo "<td>".$row["address1"]." ".$row["address2"]. "</td>";
                                                        echo "<td>".$row["email"]."</td>";
                                                        echo "<td>".$row["contactNumber"]."</td>";
                                                        echo "<td>".$row["reg_date"]."</td>";
                                                        echo "</tr>";
                                                    }
                                                  } else {
                                                    echo "No Senior Participants found";
                                                  }
                                            }

                                            // if ($result->num_rows > 0) { 
                                            //     while($row = $result->fetch_assoc()) {
                                            //         $age = date_diff(date_create($row['birthday']), date_create('today'))->y;
                                            //         echo "<tr>";
                                            //         echo "<td>".$row["firstname"]. " " . $row["lastname"]."</td>";
                                            //         echo "<td>".$age. "</td>";
                                            //         echo "<td>".$row["gender"]."</td>";
                                            //         echo "<td>".$row["address1"]." ".$row["address2"]. "</td>";
                                            //         echo "<td>".$row["email"]."</td>";
                                            //         echo "<td>".$row["contactNumber"]."</td>";
                                            //         echo "<td>".$row["reg_date"]."</td>";
                                            //         echo "</tr>";
                                            //     }
                                            // } else {
                                            //     echo "No record found";
                                            // }
                                            $conn->close();
                                        ?>
                                        </tbody>
                                    </table>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
            
        </div>
    </div>
    </div>
    
</body>
</html>