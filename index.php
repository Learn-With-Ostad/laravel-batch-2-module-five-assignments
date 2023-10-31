<?php
session_start();
if(!isset($_SESSION['loggedIn']))
{
    $_SESSION['loggedIn'] = false;
}

# logout
include('logout.php');


$errorMsg = null;
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
</head>

<body>


    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-12 order-lg-1">
                                    <div class="float-end">
                                        <?php 
                                            if($_SESSION['loggedIn'] == false)  :                    
                                        ?>
                                        <a class="" href="/login.php">Login</a>
                                        <?php 
                                            else :          
                                        ?>
                                         <form class="mx-1 mx-md-4" method="post">
                                        <input type="submit" class="" name="logout" value="Logout" />
                                        </form>
                                        <?php 
                                            endif;         
                                        ?>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
            foreach ($users as $key =>  $user) {
               
           
                                            ?>
                                            <tr>
                                                <td><?php echo $user['username'] ?></td>
                                                <td><?php echo $key ?></td>
                                                <td><?php echo $user['role'] ?></td>
                                                <td><a href="http://">Edit</a> <a href="http://">Delete</a></td>
                                            </tr>
                                            <?php 
           }
           
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
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
</body>

</html>