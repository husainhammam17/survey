<ul class="sidebar navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="ValidationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-solid fa-check-double"></i>
      <span>Validasi Survey</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="ValidationDropdown">
      <a class="dropdown-item" href="./validation.php?source=pasar_bandar">Pasar Bandar</a>
      <a class="dropdown-item" href="./validation.php?source=pasar_pahing">Pasar Pahing</a>
      <a class="dropdown-item" href="./validation.php?source=pasar_setonobetek">Pasar Setono Betek</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="grafikDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Grafik & Tabel</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="grafikDropdown">
      <a class="dropdown-item" href="./grafik_tabel.php?source=grafik_bandar">Pasar Bandar</a>
      <a class="dropdown-item" href="./grafik_tabel.php?source=grafik_pahing">Pasar Pahing</a>
      <a class="dropdown-item" href="./grafik_tabel.php?source=grafik_setonobetek">Pasar Setono Betek</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="UsersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Users</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="UsersDropdown">
      <a class="dropdown-item" href="./users.php">View All Users</a>
      <a class="dropdown-item" href="./users.php?source=add_user">Add Users</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profile.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Profile</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="password.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Change Password</span>
    </a>
  </li>
</ul>