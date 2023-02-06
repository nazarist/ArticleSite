<?php include __DIR__ . '/../header.php' ?>
<main class="flex-shrink-0">
    <div class="container">
          

    <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
            <div class="row md-2">
                <h1 class="display-4 fst-italic">Create your personality article</h1>
                <form action="/create" method="post">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title your articles</label>
                        <textarea class="form-control" id="exampleFormControlInput1" placeholder="Title"  name="title" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Text</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows=10" name="text" required></textarea>
                    </div>
                    <?php if(!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                    
                </form>
            </div>
    </div>
        
    </div>
</main>
<?php include __DIR__ . '/../footer.php' ?>
