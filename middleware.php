<?php
session_start();
function requireadmin() {
  if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Admin') {
    header('Location: ../metodos/accesoDenegado.php');
    exit;
  }
}