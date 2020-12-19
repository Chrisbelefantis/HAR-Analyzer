<?php
session_start();
session_destroy();
$home_url = 'http://' . $_SERVER['HTTP_HOST']  . '/har-analyzer/auth';
header('Location: ' . $home_url);
?>