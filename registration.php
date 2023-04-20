<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
</head>
<?php 
    include_once 'includes/dbc_inc.php';
    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
?>
<body>
    <div id="after-register" >
    <div class="wrap">
        <h2>Congratulations!</h2>
        <hr>
        <p>Quisque turpis velit, vulputate scelerisque luctus at, tincidunt a quam. Vivamus tincidunt mollis nisi ac ultricies. Vivamus dignissim risus quis pulvinar consectetur. Vestibulum malesuada ut elit euismod fermentum. Integer placerat condimentum mauris, sit amet pretium quam tincidunt vitae. Vivamus congue viverra erat. Maecenas id aliquam nibh. Maecenas eleifend, mauris vitae tincidunt laoreet, erat est semper quam, nec elementum diam quam a arcu. Praesent a ex dictum, tincidunt massa quis, posuere risus. Nulla ac ligula vel sem imperdiet viverra. Maecenas pharetra dapibus rutrum. Donec viverra volutpat diam, et venenatis metus hendrerit ut. Aliquam id augue eget magna pretium suscipit a a neque.</p>
        <?php
            $data = "SELECT firstname, lastname, category, gender, size, reg_date FROM my_table ORDER BY id DESC LIMIT 1";

            $result = $conn->query($data);                       
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
        ?>
        <div class="results">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="normal-txt">
                            Participant/s:
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="normal-txt">
                            Date Registered: <?php echo $row["reg_date"]; ?>
                        </div>                    
                    </div>
                </div>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Race Category</th>
                        <th scope="col">Race Segment</th>
                        <th scope="col">Race Shirt Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
        <?php                            
                    echo "<td>".$row["firstname"]. " " . $row["lastname"]."</td>";
                    echo "<td>".$row["category"]."</td>";
                    echo "<td>".$row["gender"]."</td>";
                    echo "<td>".$row["size"]."</td>";
                }                    
                        
        ?>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <?php 
            } else {
                echo "No record found";
           }
            $conn->close();
        ?>
    </div>
    <div>

    <div class="txt_center" style="margin-top:50px">
        <a href="index.html" class="btn btn-primary bg-green elm-center">Back</a>
    </div>
    
</body>
</html>