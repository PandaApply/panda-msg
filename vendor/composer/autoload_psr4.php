<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'think\\' => array($vendorDir . '/topthink/framework/src/think', $vendorDir . '/topthink/think-helper/src', $vendorDir . '/topthink/think-orm/src'),
    'panda\\msg\\' => array($baseDir . '/src'),
    'Workerman\\' => array($vendorDir . '/workerman/workerman'),
    'Psr\\SimpleCache\\' => array($vendorDir . '/psr/simple-cache/src'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'GatewayWorker\\' => array($vendorDir . '/workerman/gateway-worker/src'),
    'GatewayClient\\' => array($vendorDir . '/workerman/gatewayclient'),
);