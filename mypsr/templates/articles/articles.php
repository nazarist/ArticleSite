<?php include __DIR__ . '/../header.php' ?>
<main class="flex-shrink-0">
    <div class="container">
          

        <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
            <div class="row md-2">

                <div class="col-md-9">
                    <h1 class="display-4 fst-italic"><?= $articles->getTitle() ?></h1>
                    <p class="lead my-3"><?= $articles->getText() ?></p>                    
                </div>
                <div class="col-md-3 position-relative">
                    <p class="text-capitalize position-absolute bottom-0 end-0 mb-0">author: 
                        <a class="text-white" href="http://mypsr/user/<?= $articles->getAuthorId() ?>"><?= $articles->getAuthor()->getNickname(); ?></a>
                    </p>
                </div>
            </div>
        </div>

        
    </div>
</main>
<?php include __DIR__ . '/../footer.php' ?>

