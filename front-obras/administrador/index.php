<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- My CSS -->
  <link rel="stylesheet" href="style.css">
  <title>Admin</title>
  <base href="http://localhost/projetos/trablho%20software%2%FAnual/front-obras/administrador/">
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <i class='bx bxs-smile'></i>
      <span class="text">AdminHub</span>
    </a>
    <ul class="side-menu top">
      <li>
        <a href="#" onclick="loadPage('adm-crud.php')">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Acesso ao CRUD</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="loadPage('ger-adm.php')">
          <i class='bx bxs-shopping-bag-alt'></i>
          <span class="text">Administradores</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="loadPage('ger-operario.php')">
          <i class='bx bxs-doughnut-chart'></i>
          <span class="text">Operário de Campo</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="loadPage('ger-responsavel.php')">
          <i class='bx bxs-message-dots'></i>
          <span class="text">Responsável pela obra</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="loadPage('ger-empresa.php')">
          <i class='bx bxs-group'></i>
          <span class="text">Empresa</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <li>
        <a href="#" class="logout">
          <i class='bx bxs-log-out-circle'></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
      </form>
      <input type="checkbox" id="switch-mode" hidden>
      <label for="switch-mode" class="switch-mode"></label>
      <a href="#" class="profile">
        <img src="img/adm.png">
      </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      <iframe id="content-frame" src=""></iframe>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>
  <script>
    function loadPage(page) {
  document.getElementById('content-frame').src = "http://localhost/projetos/trablho%20software%2%FAnual/front-obras/administrador/" + page;
}
  </script>
</body>

</html>
