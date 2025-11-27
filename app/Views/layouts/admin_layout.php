<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Offerte Systeem</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-item <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="<?= base_url('admin/submissions') ?>" class="nav-item <?= uri_string() == 'admin/submissions' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    Inzendingen
                </a>
                <a href="<?= base_url('admin/submissions/archive') ?>" class="nav-item <?= uri_string() == 'admin/submissions/archive' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v1h-1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3V5zm3 1v9h8V6H6zm1 2h6v2H7V8z" clip-rule="evenodd"/>
                    </svg>
                    Archief
                </a>
                <a href="<?= base_url('admin/offers') ?>" class="nav-item <?= uri_string() == 'admin/offers' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    Offertes
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <p><strong><?= session()->get('username') ?></strong></p>
                    <p><?= session()->get('email') ?></p>
                </div>
                <a href="<?= base_url('admin/logout') ?>" class="btn btn-logout">Uitloggen</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-header">
                <h1><?= $page_title ?? 'Dashboard' ?></h1>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif ?>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-error">
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <div class="content-body">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>
</body>
</html>
