<?php
session_start();
session_destroy();
header("Location: Acceuil.html");
exit();