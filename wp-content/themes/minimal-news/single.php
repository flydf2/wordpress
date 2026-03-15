<?php get_header(); ?>

<div class="container">
    <div class="single-post">
        <!-- 左侧内容 -->
        <div class="main-content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <!-- 分类面包屑导航 -->
                <div class="breadcrumb">
                    <?php minimal_news_breadcrumb(); ?>
                </div>
                
                <!-- 文章标题 -->
                <h1 class="post-title"><?php the_title(); ?></h1>
                
                <!-- 文章内容 -->
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
            <?php endwhile; endif; ?>
        </div>
        
        <!-- 右侧侧边栏 -->
        <div class="sidebar">
            <!-- 标签云 -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">标签云</h3>
                <div class="tag-cloud">
                    <?php wp_tag_cloud(array(
                        'smallest' => 12,
                        'largest' => 18,
                        'unit' => 'px',
                        'number' => 45,
                        'format' => 'flat',
                        'separator' => ' ',
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'link' => 'view',
                        'taxonomy' => 'post_tag',
                        'echo' => true
                    )); ?>
                </div>
            </div>
            
            <!-- 全部分类列表 -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">全部分类</h3>
                <ul class="category-list">
                    <?php 
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order' => 'ASC'
                    ));
                    foreach ($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                <?php echo esc_html($category->name); ?>
                                <span>(<?php echo $category->count; ?>)</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- 最近更新文章列表 -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">最近更新</h3>
                <ul class="recent-posts">
                    <?php 
                    $recent_posts = get_posts(array(
                        'posts_per_page' => 5,
                        'orderby' => 'modified',
                        'order' => 'DESC'
                    ));
                    foreach ($recent_posts as $post) : setup_postdata($post);
                    ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endforeach; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
