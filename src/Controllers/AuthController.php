<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Support\Response;

class AuthController
{
    public function login(): void
    {
        Response::view('auth/login', [
            'title' => 'Login Demo',
        ]);
    }

    public function handleLogin(): void
    {
        Response::redirect('/?login=success');
    }

    public function logout(): void
    {
        Response::redirect('/');
    }
}
