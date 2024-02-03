<?php
require_once('config.php');
$stm = $conn->prepare("SELECT * FROM user");
$stm->execute(array());
$userData = $stm->fetchAll();
// print_r($userData);


?>
<!doctype html>
<html lang="en">

<head>
    <title>View All Data</title>
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
    <main class="p-3">
        <div class="contaner">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="card text-start shadow p-2">
                        <div class="card-body">
                            <h4 class="card-title">See All Data</h4>

                            <div class="table-responsive p-3">
                                <table class="table table-primary">
                                    <thead>

                                        <tr>
                                            <th scope="col">SL No</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>



                                        <tr class="">
                                            <?php $i = 1;
                                            foreach ($userData as $user) :  ?>
                                                <td scope="row"><?php echo $i; ?></td>
                                                <td scope="row"><?php echo $user['id'] ?></td>
                                                <td scope="row"><?php echo $user['name'] ?></td>
                                                <td scope="row"><?php echo $user['email'] ?></td>
                                                <td scope="row"><?php echo $user['phone'] ?></td>
                                                <td scope="row"><?php echo $user['gender'] ?></td>

                                                <td scope="row">
                                                    <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-info">Edit</a>
                                                    <a href="view.php?id=<?php echo $user['id'] ?>" class="btn btn-success">View</a>
                                                    <a onclick="return confirm('Are You Sure')" href="delete.php?id=<?php echo $user['id'] ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                        </tr>
                                    <?php $i++;
                                            endforeach;  ?>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>