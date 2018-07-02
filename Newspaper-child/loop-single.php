<?php
/**
 * The single post loop Default template
 **/

if (have_posts()) {
    the_post();

    $td_mod_single = new td_module_single($post);
    ?>

    <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
        <div class="td-post-header">

            <?php echo $td_mod_single->get_category(); ?>

            <header class="td-post-title">
                <?php echo $td_mod_single->get_title();?>


                <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                    <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
                <?php } ?>


                <div class="td-module-meta-info">
                    <?php echo $td_mod_single->get_author();?>
                    <?php echo $td_mod_single->get_date(false);?>
                    <?php echo $td_mod_single->get_comments();?>
                    <?php echo $td_mod_single->get_views();?>
                </div>

            </header>

        </div>

        <?php echo $td_mod_single->get_social_sharing_top();?>


        <div class="td-post-content">

        <?php
        // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
        if (!empty(td_global::$load_featured_img_from_template)) {
            echo $td_mod_single->get_image(td_global::$load_featured_img_from_template);
        } else {
            echo $td_mod_single->get_image('td_696x0');
        }
        ?>


            <div class="share-container">

              <div class="shareboxes">

                <a id="shareBtn" role="button" class="sharebox sharefacebook">
                  <i class="td-icon-font td-icon-facebook"></i><span class="results_share"></span>
                </a>

                <a role="button" class="sharebox sharetwitter" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink() ?>">
                  <i class="td-icon-font td-icon-twitter"></i>
                </a>

                <a role="button" class="sharebox sharegoogle" href="https://plus.google.com/share?url=<?php echo get_the_permalink() ?>">
                  <i class="td-icon-font td-icon-googleplus"></i>
                </a>

                <a role="button" class="sharebox sharewhatsapp" href="whatsapp://send?text=<?php echo get_the_permalink() ?>">
                  <i class="td-icon-font td-icon-whatsapp"></i>
                </a>

              </div><!-- .shareboxes -->

            </div><!-- .share-container -->


        <?php echo $td_mod_single->get_content();?>
        </div>


        <!-- Mediamatic Player -->
        <div id="mm-player"></div>
        

        <footer>
            <?php echo $td_mod_single->get_post_pagination();?>
            <?php echo $td_mod_single->get_review();?>

            <div class="td-post-source-tags">
                <?php echo $td_mod_single->get_source_and_via();?>
                <?php echo $td_mod_single->get_the_tags();?>
            </div>

            <?php echo $td_mod_single->get_social_sharing_bottom();?>
            <?php echo $td_mod_single->get_next_prev_posts();?>
            <?php echo $td_mod_single->get_author_box();?>
	        <?php echo $td_mod_single->get_item_scope_meta();?>
            <?php echo $td_mod_single->related_posts();?>


            <?php if ( !in_category('video') && function_exists('player_mediamatic') ) {
                player_mediamatic();
            } else {
                //
            } ?>


            <?php if (function_exists('adv_in_article')) {
              adv_in_article();
            } ?>
            
            <?php if (function_exists('adv_top_mobile_single')) {
              adv_top_mobile_single();
            } ?>
            
            
             <?php if (function_exists('correlati_adsense')) {
              correlati_adsense();
            } ?>


            <!-- Correlati 4W -->
            <?php if (function_exists('correlati_4w')) {
              correlati_4w();
            } ?>
            

        </footer>

    </article> <!-- /.post -->


<?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}
