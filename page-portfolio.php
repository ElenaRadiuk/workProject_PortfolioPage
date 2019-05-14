<?php
    /***********************
    THE Portfolio TEMPLATE FILE
    Template Name: Portfolio
    ***********************/

get_header(); ?>

<?php 
// Define variables
$bento_parent_page_id = get_the_ID();
?>

<div class="bnt-container">
    
    <div class="content content-page">
        <main class="site-main">
        
        <div class="filter-wrapper">
            <ul>

                <?php
                $categories = get_categories(array(
                    'type'                     => 'post',
                    'child_of'                 => 0,
                    'orderby'                  => 'ID',
                    'order'                    => 'ASC',
                    'hide_empty'               => 0,
                    'taxonomy'                 => 'portfolio_tax',
                    'pad_counts'               => false ));
                if ($categories) {
                    echo '<li data-attr="all" class="selected">All</li>';
                }
                foreach($categories as $category) {
                    echo '<li data-attr="'.$category->cat_name.'">'.$category->cat_name.'</li>';
                } ?>
            </ul>
        </div>

            <section class="portfolio">
                <?php
                $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 100, 'orderby' => 'title', 'order' => 'ASC', 'taxonomy' => 'portfolio_tax');
                $loop = new WP_Query( $args );

                $i = 1;

                while ( $loop->have_posts() ) : $loop->the_post();
                    if( have_rows("portfolio_item_block") ): ?>
                        <?php while( have_rows('portfolio_item_block') ): the_row(); ?>
                                <div class="portfolio-item <?php echo (($i % 2) === 0) ? 'even' : 'odd';?>" data-attr="<?php echo get_field('name_for_filter'); ?>">
                                    <figure class="image-wrapper">
                                        <?php $portfolio_img = get_sub_field('portfolio_img'); ?>
                                        <img src="<?php echo $portfolio_img['url']; ?>" alt="picture" class="picture">

                                        <figcaption>
                                            <a href="<?php echo get_sub_field('portfolio_link'); ?>" target="_blank" rel="nofollow">
                                                <p class="icon-links">
                                                    <span class="fa fa-link"></span>
                                                </p>
                                                <p class="description"><?php echo get_sub_field('project_name');?></p>
                                            </a>
                                        </figcaption>
                                    </figure>
                                    <div class="technologies-wrapper">
                                    <?php while( have_rows('portfolio_technologies') ): the_row(); ?>
                                        <div class="technologies-item">
                                            <?php $url_tech = get_sub_field('portfolio_technologies_img'); ?>
                                            <img src="<?php echo $url_tech['url']; ?>" alt="<?php echo get_sub_field('portfolio_technologies_title'); ?>" class="techologies">
                                            <span class="tooltip-for-tech"><?php echo get_sub_field('portfolio_technologies_title'); ?></span>
                                        </div>
                                    <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php $i++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                 <?php endwhile; wp_reset_query(); ?>
            </section>

        </main>
    </div>
    
    <?php get_sidebar(); ?>
    
</div>

<?php get_footer(); ?>