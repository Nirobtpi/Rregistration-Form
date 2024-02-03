<?php
$id = $_REQUEST['id'];
require_once('config.php');
$stm = $conn->prepare("SELECT * FROM user WHERE id=?");
$stm->execute(array($id));
$userData = $stm->fetch();
// print_r($userData);




?>
<!doctype html>
<html lang="en">

<head>
    <title>View Data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main class="py-4">

        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="card text-start shadow p-2">
                        <div class="card-body">
                            <h4 class="card-title">The Id Of User <span class="text-danger"> <?php echo $userData['id'] ?></span></h4>

                            <div class="table-responsive p-3">
                                <table class="table table-primary">
                                    <thead>

                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr class="">

                                            <td scope="row"><?php echo $userData['id'] ?></td>
                                            <td scope="row"><?php echo $userData['name'] ?></td>
                                            <td scope="row"><?php echo $userData['email'] ?></td>
                                            <td scope="row"><?php echo $userData['phone'] ?></td>
                                            <td scope="row"><?php echo $userData['gender'] ?></td>
                                        </tr>
                                        <!-- <tr class="">
                    <td scope="row">Item</td>
                </tr> -->
                                    </tbody>
                                </table>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>