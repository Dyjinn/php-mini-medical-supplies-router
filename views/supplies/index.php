<?php
$title = $title ?? 'Medical Supplies';
$supplies = $supplies ?? [];
$created = $created ?? false;

function supplyStatus(int $quantity): string
{
    if ($quantity <= 0) {
        return 'Out of stock';
    }

    if ($quantity <= 10) {
        return 'Low stock';
    }

    return 'Available';
}

function supplyStatusClass(int $quantity): string
{
    if ($quantity <= 0) {
        return 'danger';
    }

    if ($quantity <= 10) {
        return 'warning';
    }

    return 'success';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <header class="topbar">
        <strong>PHP Mini Medical Supplies Router</strong>
        <nav>
            <a href="/">Home</a>
            <a href="/supplies">Supplies</a>
            <a href="/supplies/create">Create Supply</a>
            <a href="/health">Health</a>
            <a href="/login">Login</a>
        </nav>
    </header>

    <main class="container">
        <?php if ($created): ?>
            <div class="alert success">
                Medical supply form submitted successfully. Redirect response worked.
            </div>
        <?php endif; ?>

        <div class="page-header">
            <div>
                <h1>Medical Supply List</h1>
                <p>This page is handled by <code>SupplyController@index</code>.</p>
            </div>
            <a class="button" href="/supplies/create">Create Supply</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Group</th>
                    <th>Supplier</th>
                    <th>Unit price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($supplies as $supply): ?>
                    <tr>
                        <td><?= htmlspecialchars($supply['code']) ?></td>
                        <td><?= htmlspecialchars($supply['name']) ?></td>
                        <td><?= htmlspecialchars($supply['group']) ?></td>
                        <td><?= htmlspecialchars($supply['supplier']) ?></td>
                        <td><?= number_format((int) $supply['unit_price']) ?> VND</td>
                        <td><?= htmlspecialchars((string) $supply['quantity']) ?></td>
                        <td>
                            <span class="badge <?= supplyStatusClass((int) $supply['quantity']) ?>">
                                <?= supplyStatus((int) $supply['quantity']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
