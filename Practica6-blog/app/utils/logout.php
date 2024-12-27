<?php

session_start();
session_unset();
session_destroy();
header("Location: http://localhost/2DAW/Practica6-blog");
exit();