<?php
$cn = mysqli_connect("localhost", "root", "", "bdsistema");

if (!$cn) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}
?>