<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title'); ?></title>
    <?= $this->Html->meta('icon'); ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'custom']); ?>

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/'); ?>"><span>Úloha</span></a>
        </div>
        <div class="top-nav-links">
            <?php
                if (!$logged_in) {
                    echo $this->Html->link(__('Log In'), ['controller' => 'Users', 'action' => 'login']);
                    echo $this->Html->link(__('Sign Up'), ['controller' => 'Users', 'action' => 'signup']);
                } elseif ($logged_in) {
                    echo $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']);
                    echo $this->Html->link(__('Dashboard'), ['controller' => 'Pages', 'action' => 'dashboard']);
                }
    ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content'); ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>