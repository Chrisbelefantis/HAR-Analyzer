
<?php

$request = $_SERVER['REQUEST_URI'];





switch ($request) {
    case '/har-analyzer/login':
        require __DIR__ . '/views/auth.php';
    case  '/har-analyzer/' :
        header("Location: /har-analyzer/views/auth.php");
        break;
    case  __DIR__ .'/har-analyzer' :
        header("Location: har-analyzer//views/auth.php");
        //require __DIR__ . '/views/auth.php';
       // break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/notFound.html';
        break;
}


?>