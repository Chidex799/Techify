<?php
include('../utility.php');
$error = "";
$message = "";
$db = connect();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location:/techify/student/");
}

$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $db->query($sql);

if ($result->num_rows == 0) {
    header("location:/techify/student/");
}
$user = $result->fetch_assoc();

if (isset($_POST['submit'])) {

    $fname = clean_input($_POST['fname']);
    $lname = clean_input($_POST['lname']);
    $gender = clean_input($_POST['gender']);
    $email = clean_input($_POST['email']);
    $it_center = clean_input($_POST['it_center']);
    $address = clean_input($_POST['address']);
    $course = clean_input($_POST['course']);

    if (
        empty($fname) || empty($lname) || empty($gender)
        || empty($email) || empty($it_center) || empty($address)
        || empty($course)
    ) {
        $error .= " All fields are required.";
    } else {

        $sql = "UPDATE users SET fname='$fname', lname='$lname', gender='$gender', 
            course='$course', it_center='$it_center', `address`='$address' WHERE id='$id'";
        $result = $db->query($sql);
        if ($result) {
            $message .= " User Updated successfully.";
        } else {
            $error .= " Sorry. Something went wrong! Try again." . $db->error;
            // $error .= "Error occurred ".$db->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title> Students | View</title>
</head>

<body style="background: aliceblue;">
    <div class="row header-top">
        <a class="navbar-brand" href="index.php">
            <img src="../images/pepperest-logo-white.png"></a>
    </div>

    <?php include('../navigation.php') ?>

    <main class="container-fluid mt-2">
        <div class="row justify-content-center">
            <section class="col-md-8 mt-5">
                <h4 class="course-title">User Details</h4>
            
            <table class="table table-striped table-responsive  mb-5" style="margin-bottom:20px;">
           
                <thead>
                        <th>ID</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>GENDER</th>
                        <th>EMAIL</th>
                        <th>ADDRESS</th>
                        <th>COURSE</th>
                        <th> CENTER</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td><?php echo $user['id']?></td>
                        <td><?php echo $user['fname'] ?></td>
                        <td><?php echo $user['lname'] ?></td>
                        <td><?php echo $user['gender']?> </td>
                        <td><?php echo $user['email'] ?></td>
                        <td> <?php echo $user['address'] ?></td>
                        <td><?php echo $user['course']?> </td>
                        <td> <?php echo $user['it_center']?></td>
                        </tr>
                        </tbody>
            </table>                
                        
                    
    
                   

                   
                
                    

                   

                    
                  
                   
                        
                           
                    
                    
                   
            
                          
                  
                            

            </section>
        </div>

    </main>
    

    <?php include('../footer.php') ?>
</body>

</html>