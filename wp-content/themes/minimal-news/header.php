<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="<?php echo home_url(); ?>" class="site-title"><?php bloginfo('name'); ?></a>
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'main-menu')); ?>
            </div>
        </div>
    </header>
