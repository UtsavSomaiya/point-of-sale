<?php
session_start();
session_destroy();
header('location:/admin/auth/login.php');