<?php

session_start();

session_destroy();

header('location:Teacher/TeacherLogin.php');

?>