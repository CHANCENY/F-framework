<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'UI\\' => array($baseDir . '/Core/UI'),
    'Sessions\\' => array($baseDir . '/Core/Sessions'),
    'ResponseHandler\\' => array($baseDir . '/Core/ApiHandler'),
    'PHPMailer\\PHPMailer\\' => array($vendorDir . '/phpmailer/phpmailer/src'),
    'Modules\\' => array($baseDir . '/Core/Modules'),
    'MiddlewareSecurity\\' => array($baseDir . '/Core/Middleware'),
    'Manipulator\\' => array($baseDir . '/Views/DefaultViews'),
    'Mailling\\' => array($baseDir . '/Core/Mailling'),
    'Installation\\' => array($baseDir . '/Core/Installation'),
    'GlobalsFunctions\\' => array($baseDir . '/Core/Globals'),
    'FormViewCreation\\' => array($baseDir . '/Core/Forms'),
    'FileHandler\\' => array($baseDir . '/Core/FileHandler'),
    'Datainterface\\' => array($baseDir . '/Core/Datainterface'),
    'CustomInstallation\\' => array($baseDir . '/Core/CustomInstallation'),
    'Curls\\' => array($baseDir . '/Core/Curl'),
    'CrudClassCollection\\' => array($baseDir . '/Core/Datainterface'),
    'Core\\' => array($baseDir . '/Core/Router/RouterController'),
    'ConfigurationSetting\\' => array($baseDir . '/Core/ConfigurationSetting'),
    'Commerce\\' => array($baseDir . '/Core/Commerce'),
    'Assest\\' => array($baseDir . '/Core/Assest'),
    'ApiHandler\\' => array($baseDir . '/Core/ApiHandler'),
    'Alerts\\' => array($baseDir . '/Core/Alerts'),
);
