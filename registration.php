<?php
require_once('config.php');
session_start();

// registration from code 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmpassword'];
    $gender = $_POST['gender'];

    $emialCount= rowCount('user','email',$email);
    $mobileCount= rowCount('user','phone',$phone);
    

    if (empty($name)) {
        $error = "Please Enter Your Name";
    } elseif (empty($email)) {
        $error = "Please Enter Your Email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please Enter A Valid Email";
    } elseif (empty($phone)) {
        $error = "Please Enter Your Phone Number";
    } elseif (!is_numeric($phone)) {
        $error = "Phone Number Must Be Use Number";
    } elseif (strlen($phone) < 11) {
        $error = "Phone Number Must Be Used 11 Digit";
    }elseif(empty($password)){
        $error="Enter Your Password";
    }elseif($password != $confirmPassword){
        $error="Password Does Not Match";
    }elseif(strlen($password) <6 || strlen($password) >11){
        $error="Password Must Be Used 6 to 11 Digit";
    }
    elseif($emialCount !=0){
        $error="Email Alrady Used!";
    }
    elseif($mobileCount !=0){
        $error="Phone Number Alrady Used!";
    }
     elseif (empty($gender)) {
        $error = "Please Enter Your Gender";
    }else{
        unset($_POST);

        $password=sha1($password);
        $created_At=date("Y-m-d H:i:s");
        
        $stm=$conn->prepare("INSERT INTO user (name,email,phone,password,gender,created_At) VALUES(?,?,?,?,?,?)");
        $stm->execute(array($name,$email,$phone,$password,$gender,$created_At));

        $success="Data Insert Successfully!";

        header('location:index.php');
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Student Registration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">MyCompany</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" aria-current="page">Home
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    </ul>
                    <form class="d-flex my-2 my-lg-0">
                        <input class="form-control me-sm-2" type="text" placeholder="Search" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </nav>

    </header>
    <main class="p-4">

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-2">
                    <div class="card text-start p-3 shadow">
                        <div class="card-body">
                            <h4 class="card-title border-bottom py-3">Registration Form</h4>

                            <div class="form ">
                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($success)) : ?>
                                    <div class="alert alert-success">
                                        <?php echo $success;  ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="<?php value('name') ?>" placeholder="Enter Your Name" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php value('email') ?>" placeholder="Enter Your Email" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php value('phone') ?>" placeholder="Enter Your Phone Number" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="<?php value('password') ?>" placeholder="Enter Your Phone Password" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmpassword" class="form-label">Confir Password</label>
                                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="<?php value('confirmpassword') ?>" placeholder="Enter Your Phone Confirm Password" />
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] === 'male') {
                                                                                                                                echo "checked";
                                                                                                                            } ?> />
                                        <label class="form-check-label" for="male"> Male </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] === "female") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?> />
                                        <label class="form-check-label" for="female"> Female </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="gender" id="custom" value="custom" <?php if (isset($_POST['gender']) && $_POST['gender'] === 'custom') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?> />
                                        <label class="form-check-label" for="custom"> Custom </label>
                                    </div>

                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-success" name="submit" value="Registration Now">
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>