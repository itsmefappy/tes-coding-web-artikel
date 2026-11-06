
<?php

use yii\helpers\Html;

$this->title = 'Beranda';

// Membuat ringkasan artikel
$getExcerpt = function ($content, $limit = 180) {

    $content = html_entity_decode(
        strip_tags($content),
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );

    $content = preg_replace(
        '/[\s\x{00A0}\x{200B}\x{FEFF}]+/u',
        ' ',
        $content
    );

    $content = trim($content);

    if ($content === '') {
        return 'Ringkasan artikel belum tersedia.';
    }

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($content, 'UTF-8') > $limit) {
            $content = mb_substr($content, 0, $limit, 'UTF-8') . '...';
        }
    } else {
        if (strlen($content) > $limit) {
            $content = substr($content, 0, $limit) . '...';
        }
    }

    return $content;
};

?>

<style>

/* =================================
   HOME PAGE
================================= */

.home-page {
    color: #344054;
}

/* =================================
   HERO SECTION
================================= */

.home-hero {
    position: relative;
    background: linear-gradient(135deg, #337ab7, #245580);
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
    color: #286090;
    border: 1px solid #fff;
    border-radius: 5px;
    padding: 11px 19px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.home-hero .btn:hover {
    background: #edf5fc;
    color: #204d74;
}

/* =================================
   SECTION HEADER
================================= */

.home-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}

.home-section-header h2 {
    color: #25364a;
    font-size: 21px;
    font-weight: 600;
    margin: 0 0 6px;
}

.home-section-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* =================================
   ARTICLE GRID
================================= */

.home-article-grid {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
}

.home-article-column {
    display: flex;
    padding: 10px;
    margin-bottom: 10px;
    width: 50%;
}

.home-article-card {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: 280px;
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 7px;
    padding: 21px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.035);
    transition: all 0.2s ease;
}

.home-article-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.07);
    border-color: #d4e5f5;
}

/* ARTICLE ICON */

.home-article-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eaf3fc;
    color: #337ab7;
    border-radius: 7px;
    font-size: 18px;
    margin-bottom: 16px;
}

/* ARTICLE TITLE */

.home-article-card h3 {
    color: #25364a;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.5;
    margin: 0 0 12px;
    overflow-wrap: anywhere;
}

/* ARTICLE META */

.home-article-meta {
    color: #98a2b3;
    font-size: 11px;
    margin-bottom: 14px;
}

.home-article-meta span {
    margin-right: 12px;
}

/* ARTICLE CONTENT */

.home-article-content {
    color: #667085;
    font-size: 13px;
    line-height: 1.7;
    margin-bottom: 20px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;

    overflow-wrap: anywhere;
}

/* READ MORE */

.home-article-footer {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid #edf0f4;
}

.home-read-more {
    color: #337ab7;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none !important;
}

.home-read-more:hover {
    color: #23527c;
}

/* =================================
   EMPTY STATE
================================= */

.home-empty {
    background: #fff;
    border: 1px dashed #d0d5dd;
    border-radius: 7px;
    padding: 45px 20px;
    text-align: center;
}

.home-empty .glyphicon {
    color: #98a2b3;
    font-size: 35px;
    margin-bottom: 15px;
}

.home-empty h3 {
    color: #344054;
    font-size: 17px;
    font-weight: 600;
}

.home-empty p {
    color: #667085;
    font-size: 13px;
}

/* =================================
   RESPONSIVE
================================= */

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

    .home-section-header h2 {
        font-size: 19px;
    }

    .home-article-column {
        width: 100%;
    }

    .home-article-card {
        min-height: 250px;
    }

}

</style>


<div class="home-page">

    <!-- HERO SECTION -->

    <section class="home-hero">

        <div class="home-hero-content">

            <div class="home-hero-label">
                SELAMAT DATANG DI WEBSITE BLOG
            </div>

            <h1>
                Temukan Inspirasi,<br>
                Perluas Wawasan.
            </h1>

            <p>
                Selamat datang di website blog kami!
                Jelajahi berbagai artikel menarik dan informatif.
                Temukan pengetahuan baru, dapatkan inspirasi,
                dan perluas wawasan melalui beragam informasi
                yang kami sajikan.

                Baca, pelajari, dan terus berkembang bersama kami.
            </p>

            <?= Html::a(
                '<span class="glyphicon glyphicon-book"></span> Jelajahi Artikel',
                ['post/index'],
                [
                    'class' => 'btn',
                ]
            ) ?>

        </div>

    </section>


    <!-- LATEST ARTICLES -->

    <section class="home-articles">

        <div class="home-section-header">

            <div>
                <h2>Artikel Terbaru</h2>

                <p>
                    Temukan artikel terbaru dan informasi menarik
                    untuk menambah wawasan Anda.
                </p>
            </div>

        </div>


        <?php if (!empty($data)): ?>

            <div class="home-article-grid">

                <?php foreach ($data as $row): ?>

                    <div class="home-article-column">

                        <article class="home-article-card">

                            <div class="home-article-icon">
                                <span class="glyphicon glyphicon-book"></span>
                            </div>

                            <h3>
                                <?= Html::encode($row->title) ?>
                            </h3>

                            <div class="home-article-meta">

                                <span>
                                    <span class="glyphicon glyphicon-user"></span>
                                    <?= Html::encode($row->username) ?>
                                </span>

                                <span>
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    <?= Html::encode($row->date) ?>
                                </span>

                            </div>

                            <div class="home-article-content">
                                <?= Html::encode(
                                    $getExcerpt($row->content)
                                ) ?>
                            </div>

                            <div class="home-article-footer">

                                <?= Html::a(
                                    'Baca Selengkapnya <span class="glyphicon glyphicon-arrow-right"></span>',
                                    [
                                        'post/view',
                                        'id' => $row->idpost,
                                    ],
                                    [
                                        'class' => 'home-read-more',
                                    ]
                                ) ?>

                            </div>

                        </article>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="home-empty">

                <span class="glyphicon glyphicon-inbox"></span>

                <h3>Belum Ada Artikel</h3>

                <p>
                    Saat ini belum ada artikel yang diterbitkan.
                    Silakan kunjungi kembali nanti.
                </p>

            </div>

        <?php endif; ?>

    </section>

</div>
