<?php
include_once('conf/config.php');
include_once(STARTUP);
include_once('core/controller.php');

startup();

require_once 'core/route.php';
Route::start();
