
<?php

$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    
    //Redirect
    case '/har-analyzer':
        header("Location: /auth");
        break;
    
    //Redirect
    case '/har-analyzer/':
        header("Location: auth");
        break;

    case  '/har-analyzer/auth' :
        require __DIR__ . '/views/auth.php';
        break;

    case '/har-analyzer/auth?error=emptyfields':
        $error = 'emptyfields';
        require __DIR__ . '/views/auth.php';
        break;

    case '/har-analyzer/auth?error=falsePassword':
        $error = 'falsePassword';
        require __DIR__ . '/views/auth.php';
        break;

    case '/har-analyzer/auth?error=falseUsername':
        $error = 'falseUsername';
        require __DIR__ . '/views/auth.php';
        break;

    case '/har-analyzer/auth?error=unSuccess-Login':
        $error = 'unSuccess-Login';
        require __DIR__ . '/views/auth.php';
        break;


    default:
        http_response_code(404);
        require __DIR__ . '/views/notFound.html';
        break;
}


?>