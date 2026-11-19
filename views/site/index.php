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

<style>
.home-hero {
    position: relative;
    background: linear-gradient(135deg, var(--app-primary), #245580);
    border-radius: 9px;
    padding: 55px 45px;
    margin-bottom: 30px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(51,122,183,0.15);
}

.home-hero::after {
    content: "";
    position: absolute;
    width: 230px;
    height: 230px;
    border: 35px solid rgba(255,255,255,0.07);
    border-radius: 50%;
    right: -65px;
    top: -75px;
}

.home-hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
}

.home-hero-label {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    color: #fff;
    padding: 7px 13px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 17px;
}

.home-hero h1 {
    color: #fff;
    font-size: 34px;
    font-weight: 700;
    line-height: 1.35;
    margin: 0 0 15px;
}

.home-hero p {
    color: rgba(255,255,255,0.88);
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 25px;
}

.home-hero .btn {
    background: #fff;
    color: var(--app-primary-dark);
    border: 1px solid #fff;
    border-radius: 5px;
    padding: 11px 19px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.home-hero .btn:hover {
    background: #edf5fc;
    color: var(--app-primary-dark);
}

@media (max-width: 767px) {
    .home-hero {
        padding: 35px 23px;
    }

    .home-hero h1 {
        font-size: 25px;
    }

    .home-hero p {
        font-size: 13px;
    }
}

.home-article-card {
    height: 100%;
    transition: transform .2s ease, box-shadow .2s ease;
}

.home-article-card:hover {
    box-shadow: 0 .25rem 1rem rgba(38, 60, 85, .12);
    transform: translateY(-3px);
}

.home-article-card .card-body {
    display: flex;
    flex-direction: column;
}

.home-article-icon {
    align-items: center;
    background: #eae8fd;
    border-radius: .375rem;
    color: var(--app-primary);
    display: flex;
    height: 2.5rem;
    justify-content: center;
    margin-bottom: 1rem;
    width: 2.5rem;
}

.home-article-card h3 {
    color: var(--app-heading);
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: .75rem;
}

.home-article-meta {
    color: var(--app-muted);
    font-size: .75rem;
    margin-bottom: 1rem;
}

.home-article-meta span + span {
    margin-left: .75rem;
}

.home-article-content {
    color: var(--app-muted);
    display: -webkit-box;
    font-size: .8125rem;
    line-height: 1.7;
    margin-bottom: 1.25rem;
    overflow: hidden;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}

.home-article-footer {
    border-top: 1px solid var(--app-border);
    margin-top: auto;
    padding-top: 1rem;
}

.home-read-more {
    color: var(--app-primary);
    font-size: .8125rem;
    font-weight: 600;
    text-decoration: none;
}

.home-read-more:hover {
    color: var(--app-primary-dark);
}

.home-empty {
    text-align: center;
}

.home-empty .bx {
    color: var(--app-muted);
    font-size: 2.25rem;
    margin-bottom: 1rem;
}
</style>

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
