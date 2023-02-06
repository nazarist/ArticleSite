<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>MyPsr</title>
</head>
<body class="d-flex flex-column h-100">

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="http://mypsr/" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="http://mypsr/create" class="nav-link px-2 link-dark">Create</a></li>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link px-2 link-dark">Exit</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <?php if(empty($_COOKIE['authToken'])): ?>
          <a type="button" href="http://mypsr/login" class="btn btn-outline-primary me-2">Login</a>
          <a type="button" href="http://mypsr/sign-up" class="btn btn-primary">Sign-up</a>
        <?php else: ?>
          <?php if($_COOKIE['role'] === 'admin'): ?>
            <a type="button" href="http://mypsr/create" class="btn btn-outline-primary me-2">Create</a>
          <?php endif; ?>
            <div class="btn-group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Profile
              </button>
            
              <ul class="dropdown-menu rounded-3 shadow overflow-hidden gap-1 p-2 rounded-3">
                <li><a class="dropdown-item rounded-2" href="http://mypsr/pofile/<?= $_COOKIE['nickname']; ?>">My profile</a></li>                
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item link-dark rounded-2" href="http://mypsr/exit"  data-bs-toggle="modal" data-bs-target="#exampleModal">Exit</a></li>
              </ul>
            </div>
        <?php endif; ?>
      </div>
    </header>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        you are indeed want exit
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="http://mypsr/exit" type="button" class="btn btn-primary">Yes i do</a>
        </div>
      </div>
    </div>
  </div>


</div>
