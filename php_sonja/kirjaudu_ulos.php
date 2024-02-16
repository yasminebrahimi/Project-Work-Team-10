<?php
session_start();
session_destroy();
// palaa etusivulle
header('Location: ../components/index.html');
?>