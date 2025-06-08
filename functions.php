<?php
add_action('wp_enqueue_scripts', function () {

    if (is_front_page()) {
        // Фавиконки
        echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_template_directory_uri() . '/assets/img/apple-touch-icon.png">';
        echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_template_directory_uri() . '/assets/img/favicon-32x32.png">';
        echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_template_directory_uri() . '/assets/img/favicon-16x16.png">';
        echo '<link rel="manifest" href="' . get_template_directory_uri() . '/site.webmanifest">';
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
        echo '<link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">';

        // СТИЛИ
        wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');
        wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700');
    }

    if (is_single()) {
        // Фавиконки
        echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_template_directory_uri() . '/assets/img/apple-touch-icon.png">';
        echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_template_directory_uri() . '/assets/img/favicon-32x32.png">';
        echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_template_directory_uri() . '/assets/img/favicon-16x16.png">';
        echo '<link rel="manifest" href="' . get_template_directory_uri() . '/site.webmanifest">';
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
        echo '<link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">';

        // СТИЛИ
        wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');
        wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700');
        wp_enqueue_style('editor-style', get_theme_file_uri('/editor-style.css'));
    }

});

add_action('wp_ajax_load_more_articles', 'load_more_articles');
add_action('wp_ajax_nopriv_load_more_articles', 'load_more_articles');

function load_more_articles()
{
    $offset = intval($_GET['offset']);

    $posts = get_posts(array(
        'numberposts' => 10,
        'orderby' => 'date',
        'post_type' => 'article',
        'offset' => $offset,
    ));

    foreach ($posts as $slide) {
        ?>
        <a href="#!" class="article">
            <img src="<?= get_the_post_thumbnail_url($slide->ID, 'full'); ?>" alt="img">
            <span class="article-date"><?= get_the_date('d.m.Y', $slide->ID); ?></span>
            <h2>
                <?php
                $title = get_the_title($slide->ID);
                if (mb_strlen($title) > 27) {
                    $title = mb_substr($title, 0, 27) . '...';
                }
                echo $title;
                ?>
            </h2>
            <?php
            $content = strip_tags(get_the_content(null, false, $slide->ID));
            if (mb_strlen($content) > 55) {
                $content = mb_substr($content, 0, 55) . '...';
            }
            echo $content;
            ?>
        </a>
        <?php
    }

    wp_die(); // Обязательно завершаем обработчик
}

add_action('wp_ajax_load_more_news', 'load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'load_more_news');

function load_more_news()
{
    $offset = intval($_GET['offset']);

    $posts = get_posts(array(
        'numberposts' => 10,
        'orderby' => 'date',
        'post_type' => 'news',
        'offset' => $offset,
    ));

    foreach ($posts as $slide) {
        ?>
        <a href="#!" class="article">
            <img src="<?= get_the_post_thumbnail_url($slide->ID, 'full'); ?>" alt="img">
            <span class="article-date"><?= get_the_date('d.m.Y', $slide->ID); ?></span>
            <h2>
                <?php
                $title = get_the_title($slide->ID);
                if (mb_strlen($title) > 27) {
                    $title = mb_substr($title, 0, 27) . '...';
                }
                echo $title;
                ?>
            </h2>
            <?php
            $content = strip_tags(get_the_content(null, false, $slide->ID));
            if (mb_strlen($content) > 55) {
                $content = mb_substr($content, 0, 55) . '...';
            }
            echo $content;
            ?>
        </a>
        <?php
    }
    wp_die();
}

// Включение поддержки тем
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
?>