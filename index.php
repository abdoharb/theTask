<?php
ob_start();
session_start();

require_once 'config.php';

generateCRFToken();
require_once 'template/form.php';

function generateCRFToken(): void
{
    $crfToken = md5(uniqid(mt_rand(), true));
    $_SESSION['token'] = $crfToken;
}

