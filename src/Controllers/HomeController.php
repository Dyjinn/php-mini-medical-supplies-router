<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Support\Response;

class HomeController
{
    public function index(): void
    {
        Response::view('home', [
            'title' => 'Mini Medical Supplies Routing App',
            'message' => 'Week 3 - Front Controller, Router and Standard Response',
        ]);
    }

    public function goHome(): void
    {
        Response::redirect('/');
    }
}
