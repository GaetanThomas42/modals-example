<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/public/">
    <img src="photo.jpg" class="rounded-circle" width="30" height="30" alt="img">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-light">
      <li class="nav-item <?php echo ($page == "index" ? "active" : "") ?>">
        <a class="nav-link" href="/public/index.php">Home</a>
      </li>
      <li class="nav-item <?php echo ($page == "info" ? "active" : "") ?>">
        <a class="nav-link" href="/public/info.php">Info</a>
      </li>
      <li class="nav-item <?php echo ($page == "var" ? "active" : "") ?>">
        <a class="nav-link" href="/public/var.php">Var</a>
      </li>
      <li class="nav-item <?php echo ($page == "structure" ? "active" : "") ?>">
        <a class="nav-link" href="/public/structure.php">Stucture</a>
      </li>
      <li class="nav-item <?php echo ($page == "cards" ? "active" : "") ?>">
        <a class="nav-link" href="/public/cards.php">Cards</a>
      </li>
      <li class="nav-item <?php echo ($page == "function" ? "active" : "") ?>">
        <a class="nav-link" href="/public/function.php">Function</a>
      </li>
      <li class="nav-item <?php echo ($page == "pagePost" ? "active" : "") ?>">
        <a class="nav-link" href="/public/mobileDiv.php">Mobile Div</a>
      </li>
      <li class="nav-item <?php echo ($page == "pagePost" ? "active" : "") ?>">
        <a class="nav-link" href="/public/pagePost.php">Page Post</a>
      </li>
      <li class="nav-item <?php echo ($page == "mail" ? "active" : "") ?>">
        <a class="nav-link" href="/public/mail.php">Mail Form</a>
      </li>
      <li class="nav-item <?php echo ($page == "chart" ? "active" : "") ?>">
        <a class="nav-link" href="/public/chart.php">Charts</a>
      </li>
      <li class="nav-item <?php echo ($page == "chart" ? "active" : "") ?>">
        <a class="nav-link" href="/public/chart.php">Charts</a>
      </li>
      <li class="nav-item <?php echo ($page == "faker" ? "active" : "") ?>">
        <a class="nav-link" href="/public/faker.php">Faker</a>
      </li>
      <li class="nav-item <?php echo ($page == "map" ? "active" : "") ?>">
        <a class="nav-link" href="/public/map.php">Map</a>
      </li>
      <li class="nav-item <?php echo ($page == "exam" ? "active" : "") ?>">
        <a class="nav-link" href="/public/exam.php">Exam</a>
      </li>
      <li class="nav-item <?php echo ($page == "class" ? "active" : "") ?>">
        <a class="nav-link" href="/public/class.php">Class</a>
      </li>
      <li class="nav-item <?php echo ($page == "books" ? "active" : "") ?>">
        <a class="nav-link" href="/public/books.php">My Books</a>
      </li>
      <li class="nav-item <?php echo ($page == "addbook" ? "active" : "") ?>">
        <a class="nav-link" href="/public/addbook.php">Add Book</a>
      </li>
      <li class="nav-item <?php echo ($page == "pdocars" ? "active" : "") ?>">
        <a class="nav-link" href="/public/pdocars.php">PDO cars</a>
      </li>
      <li class="nav-item <?php echo ($page == "pdoaddbooks" ? "active" : "") ?>">
        <a class="nav-link" href="/public/pdoaddbooks.php">PDO books</a>
      </li>
      <li class="nav-item <?php echo ($page == "bdd" ? "active" : "") ?>">
        <a class="nav-link" href="/public/bdd.php">BDD</a>
      </li>
      <li class="nav-item <?php echo ($page == "seedPDO" ? "active" : "") ?>">
        <a class="nav-link" href="/public/seedPDO.php">Seed PDO</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>
    <?php
      echo '<span class="badge badge-info">User: ';
      if (isset($_SESSION['user'])) {
        echo $_SESSION['user'] . "</span>";
      } else {
        echo "anonymous</span>";
      }
      ?>
    </form>
    <form class="form-inline my-2 my-lg-0">
      <?php echo '<span class="badge badge-info">Visited: ' . $_SESSION['counter'] . '</span>'; ?>
    </form>
  </div>
</nav>

<div id="messages">
</div>

