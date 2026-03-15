<?php get_header(); ?>

<div class="container">
    <div class="category-grid">
        <?php
        // 获取所有分类
        $categories = get_categories(array(
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        // 为每个分类获取最新文章的发布日期
        $categories_with_date = array();
        foreach ($categories as $category) {
            $latest_post = get_posts(array(
                'category__in' => array($category->term_id),
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($latest_post) {
                $categories_with_date[] = array(
                    'category' => $category,
                    'latest_date' => strtotime($latest_post[0]->post_date)
                );
            }
        }
        
        // 按最新文章日期排序分类（降序）
        usort($categories_with_date, function($a, $b) {
            return $b['latest_date'] - $a['latest_date'];
        });
        
        // 遍历排序后的分类
        foreach ($categories_with_date as $item) :
            $category = $item['category'];
            // 获取该分类下的最新10篇文章
            $args = array(
                'category__in' => array($category->term_id),
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $posts = get_posts($args);
            
            // 如果该分类有文章，则显示区块
            if ($posts) :
        ?>
        
        <div class="category-section">
            <div class="category-header">
                <h2 class="category-title"><?php echo esc_html($category->name); ?></h2>
                <a href="<?php echo get_category_link($category->term_id); ?>" class="view-more">查看更多</a>
            </div>
            <ul class="post-list">
                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                <?php endforeach; wp_reset_postdata(); ?>
            </ul>
        </div>
        
        <?php endif; endforeach; ?>
    </div>
</div>

<?php get_footer(); ?>
