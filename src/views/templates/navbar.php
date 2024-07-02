<nav class="navbar navbar-expand-md bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-5 <?php if ($_SERVER['REQUEST_URI'] === '/'); ?>" href="/"><img src="assets/img/logo_2023.png" alt="Logo" width="40" class="d-inline-block align-text-top"></a>

    <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link text-light <?php if ($_SERVER['REQUEST_URI'] === '/') echo 'active'; ?>" aria-current="page" href="/">Accueil</a>
        </li>

        <li class="nav-item dropdown me-4">
          <a class="nav-link dropdown-toggle text-light <?php if ($_SERVER['REQUEST_URI'] === '/articles' || $_SERVER['REQUEST_URI'] === '/tag') echo 'active'; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Articles</a>
          <ul class="dropdown-menu bg-dark text-bg-light">
            <li><a class="dropdown-item text-light <?php if ($_SERVER['REQUEST_URI'] === '/articles') echo 'active'; ?>" href="/articles">Articles</a></li>
            <li>
              <hr class="dropdown-divider text-bg-light">
            </li>
            <li><a class="dropdown-item text-light <?php if ($_SERVER['REQUEST_URI'] === '/tag') echo 'active'; ?>" href="/tag">Tag</a></li>
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link text-light <?php if (strpos($_SERVER['REQUEST_URI'], '/connexion') !== false) echo 'active'; ?>" href="/connexion">Se connecter</a>
        </li>
      </ul>

      <form class="d-flex" role="search">
        <label for="search" class="visually-hidden">Rechercher</label>
        <input id="search" class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-dark text-light" type="submit">Rechercher</button>
      </form>
      </ul>
    </div>
  </div>
</nav>