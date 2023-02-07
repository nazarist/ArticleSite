<?php
require __DIR__ . '/crud.php';


if(empty($_GET)  || !empty($_GET['0'])){
    $result = selectProdAndPr_gr();
}else{
    $result = selectProdAndPr_gr(['col' => current($_GET)], 'WHERE pr_gr.gr_name = :col',);
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
        <div class="container pt-4">
            <form action="" method="get">
                <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    group by
                </button>
                <ul class="dropdown-menu" >
                    <li><button class="dropdown-item" type="submit" name="0" value="all">all</button></li>
                    <li><button class="dropdown-item" type="submit" name="1" value="vegetables">vegetables</button></li>
                    <li><button class="dropdown-item" type="submit" name="2" value="fruits">fruits</button></li>
                </ul>
                
                </div>
                <a type="button" href="http://test/create.php" class="btn btn-danger">Cart</a>
            </form>
            <div class="row">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php if($_GET): ?>
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
                                        <form action="/create.php" method="get">
                                            <button type="submit" action="/create.php"  name="ord_prod" value="<?= $product['prod_id'] ?>" class="btn btn-outline-dark btn-sm">buy</button>
                                        </form>
                                        </div>
                                        <div class="col-auto">
                                            <form action="/delete.php" method="get">
                                                <button type="submit" name="del" value="<?= $product['prod_id'] ?>" class="btn btn-secondary btn-sm">Del</button>
                                                <button type="submit" name="update" value="<?= $product['prod_id'] ?>" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        const exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const recipient = button.getAttribute('data-bs-whatever')
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = `New message to ${recipient}`
        modalBodyInput.value = recipient
        })
    </script>
</body>
</html>