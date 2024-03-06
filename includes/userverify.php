<?php include "../includes/db.php"; ?>

<?php ob_start(); ?>
<?php session_start(); ?>

<?php
if (isset($_SESSION['user_role'])) {

  if ($_SESSION['user_role'] == 'admin') {
    header("location: ../admin/index.php");
  } else if ($_SESSION['user_role'] == 'surveyor') {
    header("location: ../surveyor/index.php");
  } else {
    header("Location: ../index.php");
  }
} else {
  header("Location: ../login.php");
}

?>