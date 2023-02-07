<?php

require __DIR__ . '/crud.php';

if(!empty($_GET['ord_prod'])){
    $result = create('order', $_GET);
}

if(!empty($_GET['del-cart'])){
    delete(['id' => $_GET['del-cart']], 'order', 'WHERE ord_id = :id');
}
$result = selectOrderAndProd();


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
 
            <?php if(!empty($_GET['ord_prod'])): ?>
                <div class="px-4 py-5 my-5 text-center">
                    <h1 class="display-5 fw-bold">you bought: <big class="text-capitalize"><?= $result['0']['prod_name'] ?? 'nothing' ?> </big></h1>
                    <div class="col-lg-6 mx-auto">
                        <div class="d-grid gap-2 mt-4 d-sm-flex justify-content-sm-center">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <a type="button" href="http://test/?0=all" class="btn btn-primary btn-lg px-4 gap-3">Home</a>
            <div class="row">

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach($result as $product): ?>
                        <div class="col col-lg-3 col-md-4 col-sm-6">
                            <div class="card">
                                <div class="card-header text-capitalize d-flex justify-content-between">
                                    <div class=""><?= $product['gr_name'] ?></div>
                                    
                                    <div class=""><a data-bs-toggle="tooltip" data-bs-title="store at this temperature"> temp: <?= $product['gr_temp']?>°C </a></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><?= $product['prod_name'] ?></h5>
                                    <div class="row">
                                        <div class="col">price <?= $product['prod_price'] ?> ₴</div>
                                    </div>
                                    <div class="row mt-2 d-flex justify-content-between">  
                                        <div class="col-4">
                                            <form action="" method="get">
                                                <button type="submit" name="del-cart" value="<?= $product['ord_id'] ?>" class="btn btn-secondary btn-sm">Delete</button>
                                            </form>

                                        </div>
                                        <div class="col-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>
</body>
</html>