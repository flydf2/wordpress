<?php
// 主题支持
function minimal_news_setup() {
    // 添加RSS订阅链接
    add_theme_support('automatic-feed-links');
    
    // 支持标题标签
    add_theme_support('title-tag');
    
    // 支持文章缩略图
    add_theme_support('post-thumbnails');
    
    // 注册导航菜单
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'minimal-news'),
    ));
}
add_action('after_setup_theme', 'minimal_news_setup');

// 面包屑导航函数
function minimal_news_breadcrumb() {
    echo '<a href="' . home_url() . '">首页</a>';
    
    if (is_category() || is_single()) {
        $categories = get_the_category();
        if ($categories) {
            foreach ($categories as $category) {
                echo ' &gt; <a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
            }
        }
        if (is_single()) {
            echo ' &gt; ' . get_the_title();
        }
    } elseif (is_page()) {
        echo ' &gt; ' . get_the_title();
    }
}

// 入队脚本和样式
function minimal_news_scripts() {
    // 加载主题样式
    wp_enqueue_style('minimal-news-style', get_stylesheet_uri());
    
    // 加载markdown-it库
    wp_enqueue_script('markdown-it', get_stylesheet_directory_uri() . '/js/markdown-it.min.js', array(), '14.1.0', true);
    
    // 加载Mermaid.js
    wp_enqueue_script('mermaid', 'https://cdn.jsdelivr.net/npm/mermaid@11.10.0/dist/mermaid.min.js', array(), '11.10.0', true);
    
    // 加载自定义markdown脚本
    wp_enqueue_script('blogmate-markdown', get_stylesheet_directory_uri() . '/js/blogmate-markdown.js', array('jquery', 'markdown-it'), '1.0.0', true);
    
    // 加载自定义mermaid脚本
    wp_enqueue_script('blogmate-mermaid', get_stylesheet_directory_uri() . '/js/blogmate-mermaid.js', array('jquery', 'mermaid'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'minimal_news_scripts');

// Markdown支持检测和设置
function minimal_news_markdown_support() {
    // Check if Jetpack Markdown module is active
    if (class_exists('Jetpack') && Jetpack::is_module_active('markdown')) {
        // Jetpack Markdown is active
        add_filter('the_content', 'wpautop');
    }

    // Add support for Gutenberg Markdown block
    add_theme_support('wp-block-styles');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'minimal_news_markdown_support');

// 自定义 excerpt 长度
function minimal_news_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'minimal_news_excerpt_length', 999);

// 自定义 excerpt 结尾
function minimal_news_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'minimal_news_excerpt_more');
