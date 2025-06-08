<?php
/*
Template Name: home
*/
?>

<?php get_header(); ?>

<main class="container">
    <h2>Статьи</h2>
    <section class="articles" id="articles-list">
        <?php
        $my_posts = get_posts(array(
            'numberposts' => 10,
            'orderby' => 'date',
            'post_type' => 'article',
            'offset' => 0,
        ));

        foreach ($my_posts as $slide) { ?>
            <a href="<?php the_permalink($slide->ID); ?>" class="article">
                <img src="<?= get_the_post_thumbnail_url($slide->ID, 'full'); ?>" alt="img">
                <span class="article-date"><?= get_the_date('d.m.Y', $slide->ID); ?></span>
                <h2>
                    <?= get_the_title($slide->ID); ?>
                </h2>
                <?php
                $content = strip_tags(get_the_content(null, false, $slide->ID));
                if (mb_strlen($content) > 100) {
                    $content = mb_substr($content, 0, 100) . '...';
                }
                echo $content;
                ?>
            </a>
        <?php } ?>
    </section>
    <!-- Кнопка подгрузки -->
    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
        <button style="border: none; outline: none;" class="ref-button" id="load-more" data-offset="10">Загрузить
            ещё</button>
    </div>

    <h2>Новости</h2>
    <section class="articles" id="news-list">
        <?php
        $my_posts = get_posts(array(
            'numberposts' => 10,
            'orderby' => 'date',
            'post_type' => 'news',
            'offset' => 0,
        ));

        foreach ($my_posts as $slide) { ?>
            <a href="<?php the_permalink($slide->ID); ?>" class="article">
                <img src="<?= get_the_post_thumbnail_url($slide->ID, 'full'); ?>" alt="img">
                <span class="article-date"><?= get_the_date('d.m.Y', $slide->ID); ?></span>
                <h2>
                    <?= get_the_title($slide->ID); ?>
                </h2>
                <?php
                $content = strip_tags(get_the_content(null, false, $slide->ID));
                if (mb_strlen($content) > 100) {
                    $content = mb_substr($content, 0, 100) . '...';
                }
                echo $content;
                ?>
            </a>
        <?php } ?>
    </section>

    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
        <button style="border: none; outline: none;" class="ref-button" id="load-more-news" data-offset="10">Загрузить
            ещё</button>
    </div>

</main>

<script>
    document.getElementById('load-more').addEventListener('click', function () {
        const button = this;
        const offset = parseInt(button.dataset.offset);

        fetch(`<?= admin_url('admin-ajax.php'); ?>?action=load_more_articles&offset=${offset}`)
            .then(res => res.text())
            .then(html => {
                const container = document.getElementById('articles-list');
                container.insertAdjacentHTML('beforeend', html);
                button.dataset.offset = offset + 10;

                if (!html.trim()) {
                    button.style.display = 'none'; // Скрыть кнопку, если больше нечего загружать
                }
            });
    });
    document.getElementById('load-more-news').addEventListener('click', function () {
        const button = this;
        const offset = parseInt(button.dataset.offset);

        fetch(`<?= admin_url('admin-ajax.php'); ?>?action=load_more_news&offset=${offset}`)
            .then(res => res.text())
            .then(html => {
                const container = document.getElementById('news-list');
                container.insertAdjacentHTML('beforeend', html);
                button.dataset.offset = offset + 10;

                if (!html.trim()) {
                    button.style.display = 'none'; // скрыть кнопку, если всё загружено
                }
            });
    });

</script>


<?php get_footer(); ?>