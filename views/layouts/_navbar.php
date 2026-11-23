<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <!-- Tombol Toggle Menu di Layar Mobile -->
     <?php if (!Yii::$app->user->isGuest): ?>
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
             <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    <?php endif; ?>

    <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
        <!-- Menu Kanan (User / Login / Logout) -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <?php if (Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <a href="<?= Url::to(['/site/login']) ?>" class="navbar-login-button">
                        <i class="bx bx-log-in"></i>
                        <span>Login</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item me-2 me-xl-0">
                    <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);" id="theme-toggle" title="Ganti Tema">
                        <i class="bx bx-moon bx-sm" id="theme-toggle-icon"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-user navbar-dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <span class="avatar-initial rounded-circle bg-label-primary fw-bold">
                                <?= strtoupper(substr(Yii::$app->user->identity->username ?? 'U', 0, 1)) ?>
                            </span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                        <li>
                            <a class="dropdown-item py-2" href="javascript:void(0);">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <span class="avatar-initial rounded-circle bg-label-primary fw-bold">
                                                <?= strtoupper(substr(Yii::$app->user->identity->username ?? 'U', 0, 1)) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-heading"><?= Html::encode(Yii::$app->user->identity->name ?? Yii::$app->user->identity->username ?? 'User') ?></h6>
                                        <small class="text-muted text-capitalize"><?= Html::encode(Yii::$app->user->identity->role ?? 'User') ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider my-1"></div>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 text-danger" href="<?= Url::to(['/site/logout']) ?>" data-method="post">
                                <i class="bx bx-power-off bx-sm me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>