<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tela Administrador</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>

  <div class="wrapper">
    <div class="top_navbar">
      <div class="hamburger">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
      </div>
      <div class="top_menu">
        <div class="logo">logo</div>
        <ul>
          </a></li>
          <li><a href="#">
              <i class="fas fa-user"></i>
            </a></li>
        </ul>
      </div>
    </div>

    <div class="sidebar">
      <ul>
        <li><a href="#">
            <span class="icon"><i class="fas fa-book"></i></span>
            <span class="title">Acesso ao CRUD</span></a></li>
        <li><a href="ger-adm.php">
            <span class="icon"><i class="fas fa-file-video"></i></span>
            <span class="title">Administradores</span>
          </a></li>
        <li><a href="ger-operario.php">
            <span class="icon"><i class="fas fa-volleyball-ball"></i></span>
            <span class="title">Operário</span>
          </a></li>
        <li><a href="ger-responsavel.php">
            <span class="icon"><i class="fas fa-blog"></i></span>
            <span class="title">Responsável</span>
          </a></li>
        <li><a href="ger-empresa_materiais.php">
            <span class="icon"><i class="fas fa-leaf"></i></span>
            <span class="title">Empresa</span>
          </a></li>
        <li><a href="ger-materiais.php">
            <span class="icon"><i class="fas fa-cube"></i></span>
            <span class="title">Materiais</span>
          </a></li>
        <li><a href="ger-obras.php">
            <span class="icon"><i class="fas fa-building"></i></span>
            <span class="title">Obras</span>
          </a></li> <!-- Adicionado o link para a página de Obras -->

      </ul>
    </div>

    <div class="main_container">
      <div class="item">
        
      </div>
      <div class="item">
       
      </div>
      <div class="item">
       
      </div>
      <div class="item">
       
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelector(".hamburger").addEventListener("click", function () {
        document.querySelector(".wrapper").classList.toggle("collapse");
      });
    });
  </script>

</body>

</html>
