<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Support\Response;

class SupplyController
{
    public function index(): void
    {
        $supplies = $this->getSupplies();

        Response::view('supplies/index', [
            'title' => 'Medical Supply List',
            'supplies' => $supplies,
            'created' => ($_GET['created'] ?? '') === '1',
        ]);
    }

    public function create(): void
    {
        Response::view('supplies/create', [
            'title' => 'Create Medical Supply',
            'error' => null,
        ]);
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $group = trim($_POST['group'] ?? '');
        $supplier = trim($_POST['supplier'] ?? '');
        $unitPrice = (int) ($_POST['unit_price'] ?? 0);
        $quantity = (int) ($_POST['quantity'] ?? 0);

        if ($name === '' || $group === '' || $supplier === '' || $unitPrice <= 0 || $quantity < 0) {
            Response::view('supplies/create', [
                'title' => 'Create Medical Supply',
                'error' => 'Please enter supply name, group, supplier, unit price and quantity correctly.',
            ], 422);
        }

        Response::redirect('/supplies?created=1');
    }

    private function getSupplies(): array
    {
        return require dirname(__DIR__) . '/Data/supplies.php';
    }
}
