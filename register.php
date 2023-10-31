<?php
session_start();
if(!isset($_SESSION['loggedIn']))
{
    $_SESSION['loggedIn'] = false;
}
$errorMsg = null;
$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];
//  print_r($users);


# save users
function saveUser($user, $file)
{
    file_put_contents($file, json_encode($user, JSON_PRETTY_PRINT));
}
// form handling
if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
}

# form validation
if (empty($username) || empty($email) || empty($password))
{
    $errorMsg = "Please fill all the field";
}
else
{
    if (isset($users[$email]))
    {
        $errorMsg = "Email already exists. Please register with another email.";
    }
    else
    {
        $users[$email] = [
            "username" => $username,
            "password" => md5($password),
            "role" => 'user',
        ];


        # save user
        saveUser($users, $usersFile);
        $_SESSION['email'] = $email;
        $_SESSION['loggedIn'] = true;
        header('Location: update.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                                    <p class="alert <?php
                                                    if (isset($_POST['register']) && isset($errorMsg))
                                                    {
                                                        echo "alert-danger";
                                                    }
                                                    ?> ">
                                        <?php
                                        if (isset($_POST['register']) && isset($errorMsg))
                                        {
                                            echo $errorMsg;
                                        }
                                        ?>
                                    </p>
                                    <form class="mx-1 mx-md-4" method="post">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" name="username" id="username" class="form-control" />
                                                <label class="form-label" for="username">Username</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" name="email" id="form3Example3c" class="form-control" />
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="password" id="form3Example4c" class="form-control" />
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>

                                        <input type="hidden" id="role" name="role" class="form-control" />

     

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" class="btn btn-primary btn-lg" name="register" value="Register" />
                                        </div>
                                        <div class="text-center">
                                            <p>Already have an account? <a href="/login.php">Login</a></p>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">

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