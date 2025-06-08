<?php get_header(); ?>

<main class="container article__posts">

    <h1 class="main__title" id="mainContent"><?= get_the_title() ?></h1>
    <img class="article__posts-img" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="img">
    <div class="main__content">
        <?= get_the_content() ?>
    </div>

    <div class="arrow__up">
        <a href="#mainContent" data-type="internal">
            <img src="<?php bloginfo('template_url'); ?>/assets/img/arrow-up.svg" alt="arrow-up">
        </a>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('a[href]:not([data-type="internal"])').forEach(function (link) {
            const href = link.getAttribute('href');

            // Пропускаем якорные ссылки и ссылки внутри header или footer
            if (
                href.startsWith('#') ||
                link.closest('header') ||
                link.closest('footer')
            ) {
                return;
            }

            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        });
    });

</script>

<?php get_footer(); ?>