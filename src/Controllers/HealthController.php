<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Support\Response;

class HealthController
{
    public function index(): void
    {
        Response::json(200, [
            'status' => 'ok',
            'app' => 'Mini Medical Supplies Routing App',
            'message' => 'Medical supplies system is healthy',
            'time' => date('Y-m-d H:i:s'),
        ]);
    }
}
