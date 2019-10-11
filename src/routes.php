<?php

use App\Controllers\ApiController;

// GET
$app->get("/", ApiController::class . ":theGET");
$app->post("/", ApiController::class . ":thePOST");
