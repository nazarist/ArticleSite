<?php include __DIR__ . '/../header.php' ?>
<main class="flex-shrink-0">
    <div class="container">
        







        
<div class="row mb-2">
    <?php foreach($articles as $article): ?>

    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary text-capitalize"><?= $article->getAuthor()->getNickname() ?></strong>
          <h3 class="mb-0"><?= $article->getTitle(); ?></h3>
          <div class="mb-1 text-muted"><?= $article->getDateAsWord(); ?></div>
          <p class="card-text mb-auto"><?= $article->getPortionText() ?></p>
          <a href="http://mypsr/articles/<?= $article->getId() ?>" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="30%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
    <?php endforeach; ?>



  </div>




    </div>
</main>
<?php include __DIR__ . '/../footer.php' ?>

