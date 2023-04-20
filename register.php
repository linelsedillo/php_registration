<?php 
    include_once 'includes/dbc_inc.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $birthday = $_POST['birthday'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $size = $_POST['size'];

    
    $table_name = 'my_table';
    $tableQuery = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        gender VARCHAR(30) NOT NULL,
        category VARCHAR(30) NOT NULL,
        address1 VARCHAR(30) NOT NULL,
        address2 VARCHAR(30) NOT NULL,
        birthday VARCHAR(30) NOT NULL,
        contactNumber VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        size VARCHAR(50) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Calculate age in years
    $age = date_diff(date_create($birthday), date_create('today'))->y;

    // Determine classification based on age
    $category = $age < 18 ? 'Junior' : 'Senior';

    // check if DB exist, create if false
    if(!mysqli_select_db($conn,$dbName)) {
        $createDb = "CREATE DATABASE ".$dbName;
        if ($conn->query($createDb) === TRUE) {
            echo "Database created successfully";
        }else {
            echo "Error creating database: " . $conn->error;
        }    
    }

    //check if Table exist in DB, create if false
    if ($conn->query($tableQuery) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    
    // insert data
    $insertData = "INSERT INTO my_table (firstname, lastname, gender, category, address1, address2, birthday, contactNumber, email, size) VALUES ('$firstName', '$lastName','$gender', '$category', '$address1', '$address2', '$birthday', '$contactNumber', '$email', ' $size')";
    
    if($conn->query($insertData) === TRUE) {
        header("Location: registration.php?register=success");
    }

    $conn->close();
?>