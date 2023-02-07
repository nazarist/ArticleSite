<?php

require __DIR__ . '/crud.php';

if(!empty($_GET['del'])){
    $result = selectProdAndPr_gr(['id' => $_GET['del']], 'WHERE prod.prod_id = :id');
    delete(['id' => $_GET['del']], 'product', 'WHERE prod_id = :id');
}elseif(!empty($_POST)){
    $result = update(['id' => $_POST['prod_id']], $_POST);
    header("location: http://test/?0=all");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="container pt-5 ">
            <?php if(!empty($_GET['del'])): ?>
                <div class="px-4 py-5 my-5 text-center">
                    <h1 class="display-5 fw-bold">removed: <big class="text-capitalize"><?= $result['0']['prod_name'] ?? 'nothing' ?> </big></h1>
                    <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 mt-4 d-sm-flex justify-content-sm-center">
                            <a type="button" href="http://test/?0=all" class="btn btn-primary btn-lg px-4 gap-3">Home</a>
                        </div>
                    </div>
                </div>
            <?php elseif(!empty($_GET['update'])): ?>
                
                <div style="padding-top: 10%" class="col col-sm-10 col-md-6 m-auto ">    
                    <h1 class="display-8 mb-4 fw-bold text-center">Update</h1>

                    <form action="" method="post">
                        <input type="text" name="prod_id" class="visually-hidden" value="<?= $_GET['update'] ?>">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="prod_name" class="form-control" id="colFormLabel" placeholder="name">
                            </div>
                        </div>
                        <div class="row md-3">
                            <div class="col">
                                <input type="text" name="prod_price" class="form-control" placeholder="price" aria-label="Price">
                            </div>
                            <div class="col">
                                <input type="text" name="prod_cost" class="form-control" placeholder="cost" aria-label="Cost">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                        <a type="button" href="http://test/?0=all" class="btn btn-secondary mt-3">Home</a>
                    </form>
                </div>
            <?php elseif(!empty($_POST)): ?>
                <div class="px-4 py-5 my-5 text-center">
                    <h1 class="display-5 fw-bold">you are Update: <big class="text-capitalize"><?= $result['0']['prod_name'] ?? 'nothing' ?> </big></h1>
                    <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 mt-4 d-sm-flex justify-content-sm-center">
                            <a type="button" href="http://test/?0=all" class="btn btn-primary btn-lg px-4 gap-3">Home</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</body>
</html>