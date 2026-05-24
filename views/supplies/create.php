<?php
$title = $title ?? 'Create Medical Supply';
$error = $error ?? null;
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
        <h1>Create Medical Supply</h1>
        <p>This form submits to <code>POST /supplies</code>.</p>

        <?php if ($error): ?>
            <div class="alert danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form class="form-card" method="POST" action="/supplies">
            <div class="form-group">
                <label>Supply name</label>
                <input type="text" name="name" placeholder="Surgical Mask Box">
            </div>
            <div class="form-group">
                <label>Group</label>
                <input type="text" name="group" placeholder="Personal Protection">
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <input type="text" name="supplier" placeholder="MedCare Vietnam">
            </div>
            <div class="form-group">
                <label>Unit price</label>
                <input type="number" name="unit_price" placeholder="85000">
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="20">
            </div>
            <button class="button" type="submit">Save Supply</button>
            <a class="button secondary" href="/supplies">Back to Supplies</a>
        </form>
    </main>
</body>
</html>
