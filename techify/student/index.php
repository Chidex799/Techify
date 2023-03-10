<?php
session_start();

include('../utility.php');
$db = connect();

$user_email = $_SESSION["user"];
$sql = "SELECT * FROM users WHERE email = '$user_email'";
$result = $db->query($sql);
$user = $result->fetch_assoc();

if (!$_SESSION["user"]) {
    header("location:/techify/login.php");
} 
if ($user["role"] != "admin") {
    header("location:/techify/student/dashboard.php");
}


$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $db->query($sql);
$count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/fontawesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Techify | Student</title>
</head>

<body style="background: rgb(242,241,237);">
    <div class="row header-top container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../images/pepperest-logo-white.png"></a>
    </div>
    <?php include('../navigation.php') ?>


    <main class="container mt-2">
        <div class="row justify-content-center">
            <section class="m-5 ">
                <h4 class="course-title">Students</h4>
                <hr>
                <table class="table table-striped table-responsive mb-5" style="margin-bottom:20px;">
                    <thead>
                        <th>ID</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>GENDER</th>
                        <th>EMAIL</th>
                        <th>ADDRESS</th>
                        <th>COURSE</th>
                        <th>IT CENTER</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                        if ($count == 0) {
                        ?>
                            <tr>
                                <td colspan="9" class="text-center">
                                    NO RECORD FOUND
                                </td>
                            </tr>
                        <?php
                        }
                        ?>


                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['fname'] ?></td>
                                <td><?php echo $row['lname'] ?></td>
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['course'] ?></td>
                                <td><?php echo $row['it_center'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id'] ?>">
                                        <button class="btn btn-warning"></i>Edit</button>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id'] ?>">
                                        <button onclick="confirmDelete()"; class= "btn btn-danger">Delete</button>
                                    </a>
                                    <a href="view.php?id=<?php echo $row['id'] ?>">
                                        <button class="btn btn-success">view</button>
                                    </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
                <a href="/techify/student/logout.php">
                <button class="btn btn-info">Logout</button>
                </a>
               
            </section>
        </div>

    </main>


    <?php include('../footer.php') ?>

    <script>
        const confirmDelete = () => {
            swal({
                    title: "Are you sure to Delete?",
                    text: "Once deleted, you will not be able to recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("User has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Action Cancelled!", {
                            icon: "error",
                        });

                    }
                });
                

        }
    </script>
</body>

</html>