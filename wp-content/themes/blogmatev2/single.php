<?php get_header(); ?>

<div class="container">
    <div class="content-wrapper">
        <!-- 左侧内容区域 -->
        <main class="content-area">
            <?php
            while (have_posts()) : the_post();
            ?>
                <!-- 分类面包屑导航 -->
                <div class="breadcrumb">
                    <?php blogmate_breadcrumb(); ?>
                </div>
                
                <!-- 文章标题 -->
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <!-- 文章内容 -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </main>
        
        <!-- 右侧侧边栏 -->
        <aside class="sidebar">
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <?php dynamic_sidebar('sidebar-1'); ?>
            <?php else : ?>
                <!-- 默认侧边栏内容 -->
                <div class="widget">
                    <h3 class="widget-title">标签云</h3>
                    <?php wp_tag_cloud(); ?>
                </div>
                
                <div class="widget">
                    <h3 class="widget-title">全部分类</h3>
                    <ul>
                        <?php wp_list_categories(array('title_li' => '')); ?>
                    </ul>
                </div>
                
                <div class="widget">
                    <h3 class="widget-title">最近更新</h3>
                    <ul>
                        <?php
                        $recent_args = array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        );
                        $recent_posts = wp_get_recent_posts($recent_args);
                        foreach ($recent_posts as $post) :
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>