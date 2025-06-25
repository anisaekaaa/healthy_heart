<?php
session_start();
session_unset();
session_destroy();
header("Location: /healthy_heart/index.php");
exit;
