<?php

use yii\helpers\Url;


$controllerId = Yii::$app->controller->id;
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo py-3 mb-2">
        <a href="<?= Url::to(['/site/index']) ?>" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder fs-4">Blog App</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <?php if (!Yii::$app->user->isGuest): ?>
        <ul class="menu-inner py-1 pt-2">
            <li class="menu-item <?= $controllerId === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= Url::to(['/dashboard/index']) ?>" class="menu-link">
                    <div>Dashboard</div>
                </a>
            </li>

            <li class="menu-item <?= $controllerId === 'post' ? 'active' : '' ?>">
                <a href="<?= Url::to(['/post/index']) ?>" class="menu-link">
                    <div>Artikel / Post</div>
                </a>
            </li>

            <li class="menu-item <?= $controllerId === 'account' ? 'active' : '' ?>">
                <a href="<?= Url::to(['/account/index']) ?>" class="menu-link">
                    <div>Akun</div>
                </a>
            </li>
        </ul>
    <?php endif; ?>
</aside>