<?php include __DIR__ . '/../header.php' ?>
<main class="m-auto text-center">
    <div class="container">

    <div class="modal-content  rounded-4 ">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h1 class="fw-bold mb-0 fs-2">Login</h1>
      </div>

      <div class="modal-body p-5 pt-0">
        <form class="" action="http://mypsr/login" method="post">
          <div class="form-floating mb-3">
            <input type="email" class="form-control rounded-3" id="floatingInput" name="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control rounded-3" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Login</button>
          <?php if(isset($error)): ?>
            <p class="text-danger-emphasis"><?= $error ?></p>
          <?php endif; ?>
          <small class="text-muted">If you are not registered please to press <a href="http://mypsr/sign-up">sign-in</a></small>
        </form>
      </div>
    </div>

    </div>
</main>
<?php include __DIR__ . '/../footer.php' ?>

