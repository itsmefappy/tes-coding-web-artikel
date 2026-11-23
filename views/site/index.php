<?php

use yii\helpers\Html;

$this->title = 'Beranda';

$getExcerpt = static function ($content, $limit = 180) {
    $content = trim(preg_replace(
        '/[\s\x{00A0}\x{200B}\x{FEFF}]+/u',
        ' ',
        html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8')
    ));

    if ($content === '') {
        return 'Ringkasan artikel belum tersedia.';
    }

    if (function_exists('mb_strlen') && mb_strlen($content, 'UTF-8') > $limit) {
        return mb_substr($content, 0, $limit, 'UTF-8') . '...';
    }

    return $content;
};
?>



<div class="home-page">
    <section class="home-hero">
        <div class="home-hero-content">
            <div class="home-hero-label">SELAMAT DATANG DI WEBSITE BLOG</div>
            <h1>Temukan Inspirasi,<br>Perluas Wawasan.</h1>
            <p>
                Selamat datang di website blog kami! Jelajahi berbagai artikel menarik
                dan informatif. Temukan pengetahuan baru, dapatkan inspirasi, dan
                perluas wawasan melalui beragam informasi yang kami sajikan.
            </p>
            <?= Html::a(
                '<span class="bx bx-book-open"></span> Jelajahi Artikel',
                ['post/index'],
                ['class' => 'btn btn-light']
            ) ?>
        </div>
    </section>

    <section class="home-articles">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="mb-1">Artikel Terbaru</h2>
                <p class="text-muted mb-0">Temukan tulisan terbaru untuk menambah wawasan.</p>
            </div>
        </div>

        <?php if (!empty($data)): ?>
            <div class="row g-4">
                <?php foreach ($data as $row): ?>
                    <div class="col-md-6 col-xl-4">
                        <article class="card home-article-card border">
                            <div class="card-body">
                                <div class="home-article-icon">
                                    <span class="bx bx-book-open"></span>
                                </div>

                                <h3><?= Html::encode($row->title) ?></h3>

                                <div class="home-article-meta">
                                    <span>
                                        <span class="bx bx-user"></span>
                                        <?= Html::encode($row->username) ?>
                                    </span>
                                    <span>
                                        <span class="bx bx-calendar"></span>
                                        <?= Html::encode($row->date) ?>
                                    </span>
                                </div>

                                <div class="home-article-content">
                                    <?= Html::encode($getExcerpt($row->content)) ?>
                                </div>

                                <div class="home-article-footer">
                                    <?= Html::a(
                                        'Baca Selengkapnya <span class="bx bx-chevron-right"></span>',
                                        ['post/view', 'id' => $row->idpost],
                                        ['class' => 'home-read-more']
                                    ) ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card home-empty p-5">
                <span class="bx bx-inbox"></span>
                <h3>Belum Ada Artikel</h3>
                <p class="text-muted mb-0">Saat ini belum ada artikel yang diterbitkan.</p>
            </div>
        <?php endif; ?>
    </section>
</div>
