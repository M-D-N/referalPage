<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php if (is_single()): ?>
        <?php
        global $post;
        $title = esc_html(get_the_title()) . ' — ' . get_bloginfo('name');
        $image = get_the_post_thumbnail_url($post, 'full') ?: 'https://tg-gifts.ru/wp-content/uploads/default.jpg';
        $url = get_permalink($post);

        $content = apply_filters('the_content', get_the_content(null, false, $post));
        preg_match('/<p>(.*?)<\/p>/i', $content, $matches);
        $first_paragraph = isset($matches[1]) ? wp_strip_all_tags($matches[1]) : '';
        ?>
        <meta property="og:title" content="<?= esc_attr($title); ?>">
        <meta property="og:description" content="<?= esc_attr($first_paragraph); ?>">
        <meta property="og:image" content="<?= esc_url($image); ?>">
        <meta property="og:url" content="<?= esc_url($url); ?>">
        <meta property="og:type" content="article">

        <meta name="description" content="<?= esc_attr($first_paragraph); ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?= esc_attr($title); ?>">
        <meta name="twitter:description" content="<?= esc_attr($first_paragraph); ?>">
        <meta name="twitter:image" content="<?= esc_url($image); ?>">
    <?php else: ?>
        <!-- Статичные мета-теги для главной и других страниц -->
        <meta name="description"
            content="Узнай, как продавать подарки в Telegram и зарабатывать. Инструкции, статьи, реферальные бонусы и всё для быстрого старта в цифровом подарочном бизнесе.">
        <meta property="og:title" content="Как зарабатывать на Telegram подарках — TG Gifts">
        <meta property="og:description"
            content="Пошаговая инструкция, статьи и бонусы — начни продавать Telegram подарки и зарабатывать уже сегодня.">
        <meta property="og:image" content="https://tg-gifts.ru/wp-content/themes/referalPage/assets/img/logo.png">
        <meta property="og:url" content="https://tg-gifts.ru/">
        <meta property="og:type" content="website">
    <?php endif; ?>


    <?php wp_head(); ?>
</head>

<body>


    <header class="container">
        <nav class="header__menu">
            <a href="/">
                <img class="header__logo" src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" alt="logo">
            </a>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/#articles-list">Статьи</a></li>
                <li><a href="/#news-list">Новости</a></li>
            </ul>
        </nav>
        <?php if (is_front_page()): ?>
            <nav class="header__nav">
                <h1><?= get_the_title() ?></h1>
                <?= get_the_content() ?>
                <!-- <a class="ref-button" href="<?= get_field('btn_link', get_the_ID()) ?>" target="_blank"><?= get_field('btn_name', get_the_ID()) ?></a> -->
            </nav>
        <?php endif; ?>
    </header>