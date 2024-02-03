<?php
require_once('config.php');
session_start();
$id = $_REQUEST['id'];

// registration from code 
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $stm = $conn->prepare("SELECT phone FROM user WHERE phone=? AND id=?");
    $stm->execute(array($phone, $id));
    $mob = $stm->rowCount();

    $stm = $conn->prepare("SELECT email FROM user WHERE email=? AND id=?");
    $stm->execute(array($email, $id));
    $ema = $stm->rowCount();


    $emialCount = rowCount('user', 'email', $email);
    $mobileCount = rowCount('user', 'phone', $phone);


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
    } elseif ($emialCount != 0 && $ema != 1) {
        $error = "Email Alrady Used!";
    } elseif ($mobileCount != 0 && $mob != 1) {
        $error = "Phone Number Alrady Used!";
    } elseif (empty($gender)) {
        $error = "Please Enter Your Gender";
    } else {
        // unset($_POST);

        $created_At = date("Y-m-d H:i:s");

        $stm = $conn->prepare("UPDATE user SET  name=?,email=?,phone=?,gender=?,created_At=? WHERE id=?");
        $stm->execute(array($name, $email, $phone, $gender, $created_At, $id));

        $success = "Data Update Successfully!";

        header('location:index.php?success=Data Update Success');
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
                            <h4 class="card-title border-bottom py-3">Update Form Data</h4>

                            <div class="form">
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

                                <?php
                                $editData = UpdateData('user', $id);
                                ?>

                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $editData['name'] ?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $editData['email'] ?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $editData['phone'] ?>" />
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($editData['gender'] == 'male') {
                                                                                                                                echo "checked";
                                                                                                                            } ?> />
                                        <label class="form-check-label" for="male"> Male </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($editData == "female") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?> />
                                        <label class="form-check-label" for="female"> Female </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="gender" id="custom" value="custom" <?php if ($editData == "custom") {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?> />
                                        <label class="form-check-label" for="custom"> Custom </label>
                                    </div>

                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-success" name="update" value="Update Data">
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