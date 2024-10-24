<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <div class="nav-link">
                    <span class="badge" id="sin-status"></span>
                </div>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <div class="nav-link">
                    <span class="badge" id="cufd-status"></span>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/logout" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link d-flex justify-content-center align-items-center" style="text-decoration: none; padding: 9px">
            <h2 class="m-0" style="font-weight: bold; text-align: center;">
                Tienda<span class="text-primary">Online</span>
            </h2>
        </a>
        <div class="sidebar">
            <div class="user-panel d-flex align-items-center">
                <div class="image">
                    <?php if (!empty($_SESSION['photo'])): ?>
                        <img src="/uploads/users/<?= $_SESSION['photo'] ?>" class="img-circle elevation-2" alt="User Image" style="width: 45px; height: 45px; margin: 5px;">
                    <?php else: ?>
                        <i class="fas fa-user-circle" style="color: #c2c7d0; font-size: 45px; margin: 5px;"></i>
                    <?php endif; ?>
                </div>
                <div class="info">
                    <input type="hidden" name="usuarioLoggin" value="<?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>">
                    <a href="#" class="d-block" style="font-size: 18px;">
                        <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                    <span style="color: #AAAAAA; font-size: 16px;">
                        <?= ucwords(strtolower(htmlspecialchars($_SESSION['rol'], ENT_QUOTES, 'UTF-8'))) ?>
                    </span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <?php echo $content ?? ''; ?>
    </div>
    <footer class="main-footer"></footer>
</div>