
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

// =================================
// GLOBAL CSS
// =================================

$this->registerCss(<<<CSS

/* =================================
   GLOBAL
================================= */

html,
body {
    min-height: 100%;
    margin: 0;
}

html {
    overflow-y: scroll;
}

body {
    background-color: #f5f7fa;
    color: #344054;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

.wrap {
    min-height: calc(100vh - 70px);
    padding-top: 70px;
    padding-bottom: 35px;
}

/* =================================
   GLOBAL CONTAINER
================================= */

.container {
    width: 100% !important;
    max-width: 1170px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    padding-left: 15px;
    padding-right: 15px;
    box-sizing: border-box;
}

.wrap > .container {
    width: 100% !important;
    max-width: 1170px !important;
    margin-left: auto !important;
    margin-right: auto !important;
}

/* =================================
   NAVBAR
================================= */

.app-navbar {
    width: 100%;
    background: #337ab7 !important;
    border: none !important;
    border-radius: 0 !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    min-height: 60px;
}

.app-navbar > .container {
    width: 100% !important;
    max-width: 1170px !important;
    margin-left: auto !important;
    margin-right: auto !important;
}

/* Brand */

.app-navbar .navbar-brand {
    color: #fff !important;
    font-size: 20px;
    font-weight: 600;
    height: 60px;
    line-height: 30px;
    letter-spacing: 0.2px;
}

.app-navbar .navbar-brand:hover {
    color: #eaf3ff !important;
}

/* Menu navbar */

.app-navbar .navbar-nav > li > a {
    color: #eaf3ff !important;
    font-size: 14px;
    font-weight: 500;
    padding-top: 20px;
    padding-bottom: 20px;
    transition: background 0.2s ease;
}

.app-navbar .navbar-nav > li > a:hover,
.app-navbar .navbar-nav > li > a:focus {
    color: #fff !important;
    background: #286090 !important;
}

/* Menu aktif */

.app-navbar .navbar-nav > .active > a,
.app-navbar .navbar-nav > .active > a:hover,
.app-navbar .navbar-nav > .active > a:focus {
    color: #fff !important;
    background: #286090 !important;
    box-shadow: inset 0 -3px 0 #fff;
}

/* =================================
   NAVBAR LOGOUT
================================= */

.app-navbar .navbar-nav > li > form {
    margin: 0;
    padding: 0;
}

.app-navbar .navbar-nav > li > form .logout {
    display: block;
    height: 60px;
    line-height: 20px;
    padding: 20px 15px;
    margin: 0;
    border: none;
    border-radius: 0;
    background: transparent;
    color: #fff !important;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    box-shadow: none;
    transition: background 0.2s ease;
}

.app-navbar .navbar-nav > li > form .logout:hover,
.app-navbar .navbar-nav > li > form .logout:focus {
    background: #286090 !important;
    color: #fff !important;
    outline: none;
}

/* Navbar toggle */

.app-navbar .navbar-toggle {
    border-color: rgba(255,255,255,0.5);
    margin-top: 13px;
}

.app-navbar .navbar-toggle:hover,
.app-navbar .navbar-toggle:focus {
    background-color: #286090;
}

.app-navbar .navbar-toggle .icon-bar {
    background-color: #fff;
}

/* =================================
   BREADCRUMB
================================= */

.breadcrumb {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 6px;
    padding: 11px 16px;
    margin-bottom: 25px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}

.breadcrumb > li + li:before {
    color: #a0aec0;
}

.breadcrumb > .active {
    color: #667085;
}

/* =================================
   GLOBAL CONTENT
================================= */

.container > h1,
.container > .post-index > h1,
.container > .dashboard-index > h1,
.container > .account-index > h1 {
    color: #25364a;
    font-weight: 600;
    margin-top: 0;
    margin-bottom: 22px;
}

.panel,
.table,
.form-control {
    border-radius: 5px;
}

.panel {
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

/* Buttons */

.btn {
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary {
    background-color: #337ab7;
    border-color: #337ab7;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #286090;
    border-color: #204d74;
}

/* Form */

.form-control {
    border-color: #d0d5dd;
    box-shadow: none;
}

.form-control:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 2px rgba(51,122,183,0.12);
}

/* =================================
   ALERT
================================= */

.alert {
    border-radius: 5px;
    margin-bottom: 20px;
}

/* =================================
   TABLE
================================= */

.table {
    background: #fff;
}

.table > thead > tr > th {
    background: #f5f8fc;
    color: #344054;
    font-weight: 600;
}

.table > tbody > tr:hover {
    background-color: #f5f9ff;
}

/* =================================
   LOGOUT MODAL
================================= */

.logout-modal .modal-content {
    border: none;
    border-radius: 9px;
    overflow: hidden;
    box-shadow: 0 10px 35px rgba(0,0,0,0.18);
}

.logout-modal .modal-header {
    background: #fff;
    border-bottom: 1px solid #e8edf3;
    padding: 17px 22px;
}

.logout-modal .modal-title {
    color: #25364a;
    font-size: 17px;
    font-weight: 600;
}

.logout-modal .modal-title .glyphicon {
    color: #337ab7;
    margin-right: 7px;
}

.logout-modal .modal-body {
    background: #fff;
    padding: 28px 25px;
}

.logout-modal-icon {
    width: 65px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    background: #eaf3fc;
    color: #337ab7;
    border-radius: 50%;
    font-size: 27px;
}

.logout-modal .modal-body h4 {
    color: #25364a;
    font-size: 17px;
    font-weight: 600;
    margin: 0 0 10px;
}

.logout-modal .modal-body p {
    color: #667085;
    font-size: 13px;
    line-height: 1.7;
    margin: 0;
}

.logout-modal .modal-footer {
    background: #fff;
    border-top: 1px solid #e8edf3;
    padding: 14px 22px;
}

.logout-modal .modal-footer .btn {
    padding: 9px 15px;
    font-size: 13px;
}

.logout-modal .btn-danger {
    background: #d9534f;
    border-color: #d9534f;
}

/* =================================
   FOOTER
================================= */

.footer {
    width: 100%;
    background: #fff;
    border-top: 1px solid #e4e7ec;
    padding: 18px 0;
    color: #667085;
    margin-top: 25px;
}

.footer p {
    margin-bottom: 0;
}

.footer a {
    color: #337ab7;
}

/* =================================
   RESPONSIVE TABLET
================================= */

@media (max-width: 991px) {

    .container,
    .wrap > .container,
    .app-navbar > .container,
    .footer > .container {
        width: 100% !important;
        max-width: 100% !important;
    }

}

/* =================================
   RESPONSIVE MOBILE
================================= */

@media (max-width: 767px) {

    .wrap {
        padding-top: 65px;
    }

    .container,
    .wrap > .container,
    .app-navbar > .container,
    .footer > .container {
        width: 100% !important;
        max-width: 100% !important;
        padding-left: 15px;
        padding-right: 15px;
    }

    .app-navbar .navbar-nav > li > a {
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .app-navbar .navbar-nav > li > form .logout {
        height: auto;
        padding: 12px 15px;
        width: 100%;
        text-align: left;
    }

    .breadcrumb {
        font-size: 12px;
        padding: 9px 12px;
    }

    .footer {
        text-align: center;
    }

    .footer .pull-left,
    .footer .pull-right {
        float: none !important;
        margin: 5px 0;
    }

    .table-responsive {
        border: none;
    }

    .logout-modal .modal-dialog {
        margin: 20px 15px;
    }

}

CSS);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

</head>

<body>

<?php $this->beginBody() ?>

<div class="wrap">

    <?php

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top app-navbar',
        ],
    ]);

    $menuItems = [];

    // Menu Home
    $menuItems[] = [
        'label' => 'Home',
        'url' => ['/site/index'],
    ];

    if (!Yii::$app->user->isGuest) {

        // Dashboard
        $menuItems[] = [
            'label' => 'Dashboard',
            'url' => ['/dashboard/index'],
        ];

        // Artikel
        $menuItems[] = [
            'label' => 'Post',
            'url' => ['/post/index'],
        ];

        // Akun khusus Admin
        if (Yii::$app->user->can('Admin')) {
            $menuItems[] = [
                'label' => 'Akun',
                'url' => ['/account/index'],
            ];
        }

        // Logout dengan konfirmasi
        $menuItems[] = [
            'label' => 'Logout (' .
                Html::encode(Yii::$app->user->identity->username) .
                ')',
            'url' => '#logoutModal',
            'linkOptions' => [
                'data-toggle' => 'modal',
                'data-target' => '#logoutModal',
                'class' => 'logout-trigger',
            ],
        ];

    } else {

        // Login untuk Guest
        $menuItems[] = [
            'label' => 'Login',
            'url' => ['/site/login'],
        ];
    }

    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav navbar-right',
        ],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);

    NavBar::end();

    ?>


    <!-- LOGOUT CONFIRMATION MODAL -->

    <?php if (!Yii::$app->user->isGuest): ?>

        <div class="modal fade logout-modal"
             id="logoutModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="logoutModalLabel"
             aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <!-- HEADER -->

                    <div class="modal-header">

                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                        <h4 class="modal-title" id="logoutModalLabel">

                            <span class="glyphicon glyphicon-log-out"></span>

                            Konfirmasi Logout

                        </h4>

                    </div>


                    <!-- BODY -->

                    <div class="modal-body text-center">

                        <div class="logout-modal-icon">

                            <span class="glyphicon glyphicon-log-out"></span>

                        </div>

                        <h4>
                            Apakah Anda yakin ingin logout?
                        </h4>

                        <p>
                            Anda akan keluar dari aplikasi dan harus login
                            kembali untuk mengakses fitur akun.
                        </p>

                    </div>


                    <!-- FOOTER -->

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">

                            <span class="glyphicon glyphicon-remove"></span>

                            Batal

                        </button>


                        <?= Html::beginForm(
                            ['/site/logout'],
                            'post',
                            [
                                'style' => 'display:inline-block;',
                            ]
                        ) ?>

                            <?= Html::submitButton(
                                '<span class="glyphicon glyphicon-log-out"></span> Ya, Logout',
                                [
                                    'class' => 'btn btn-danger',
                                ]
                            ) ?>

                        <?= Html::endForm() ?>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- MAIN CONTENT -->

    <div class="container">

        <?php if (empty($this->params['hideBreadcrumbs'])): ?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs'])
                    ? $this->params['breadcrumbs']
                    : [],
            ]) ?>

        <?php endif; ?>

        <?= Alert::widget() ?>

        <?= $content ?>

    </div>

</div>


<!-- FOOTER -->

<footer class="footer">

    <div class="container">

        <p class="pull-left">
            &copy; My Company <?= date('Y') ?>
        </p>

        <p class="pull-right">
            <?= Yii::powered() ?>
        </p>

    </div>

</footer>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
