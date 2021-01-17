
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

    //Redirect
    case '/har-analyzer/user':
        header("Location: user/upload");       
        break;

    //Redirect
    case '/har-analyzer/admin':
        header("Location: admin/data-visualization");       
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
    case '/har-analyzer/user/visualization':
        require __DIR__ . '/views/user/visualization.php';
        break;
    case '/har-analyzer/user/upload':
        require __DIR__ . '/views/user/upload.php';
        break;
    case '/har-analyzer/user/data':
        require __DIR__ . '/views/user/data.php';
        break;

    case '/har-analyzer/admin/display-informations':
        require __DIR__ . '/views/admin/display-informations.php';
        break;
    case '/har-analyzer/admin/response-times':
        require __DIR__ . '/views/admin/response-times.php';
        break;
    case '/har-analyzer/admin/headers-analysis':
        require __DIR__ . '/views/admin/headers-analysis.php';
        break;
    case '/har-analyzer/admin/data-visualization':
        require __DIR__ . '/views/admin/data-visualization.php';
        break;
    case '/har-analyzer/accessDenied':
        require __DIR__ . '/views/accessDenied.html';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/notFound.html';
        break;
}


?>