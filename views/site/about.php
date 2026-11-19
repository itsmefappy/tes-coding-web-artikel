<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-1">
                <i class="bx bx-info-circle me-2 text-primary"></i>
                <?= Html::encode($this->title) ?>
            </h4>
            <p class="text-muted mb-0">
                This is the About page. You may modify the following file to customize its content:
            </p>
            <code class="d-block mt-3 p-2 bg-light rounded"><?= Html::encode(__FILE__) ?></code>
        </div>
    </div>
</div>
