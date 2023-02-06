<?php include __DIR__ . '/../header.php' ?>
<main class="m-auto">
    <div class="container border rounded-4 p-3 shadow text-center">
            <h1 class="fw-bold mb-0 fs-2">Sign in</h1>
            <form action="http://mypsr/sign-up" method="post" action="http://mypsr/sign-up" class="row mt-2 m-0" style="max-width: 500px;">
                <div class="row mb-3 has-validation">
                    <label for="autoSizingInput" class="col-sm-2 col-form-label">Nickname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Name" name="nickname" id="autoSizingInput" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" placeholder="email" name="email" id="inputEmail3" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="password" name="password" id="inputPassword3" required>
                    </div>
                </div>

                <div class="row">    
                    <div class="col-md-6 mb-3">
                        <label class="visually-hidden" for="autoSizingSelect">lkmp</label>
                        <select class="form-select" id="autoSizingSelect" name="role">
                            <option selected value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary w-100">sign in</button>
                    </div>
                </div>
                <?php if(!empty($error)): ?>
                    <p class="text-danger-emphasis"><?= $error ?></p>
                <?php endif; ?>
                <small class="text-muted">If you are registered please to press <a href="http://mypsr/login">login</a></small>


            </form>
    </div>
</main>
<?php include __DIR__ . '/../footer.php' ?>

