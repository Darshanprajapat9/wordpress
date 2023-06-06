<?php
/**
* Template Name: About page
*/?>
<?php
get_header();
?>
<div class="about-page mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <img src="<?php the_post_thumbnail('single-img');?>" class="card-img-top" alt="...">
            <h2><?php the_title()?></h2>
            <p><?php the_content()?></p>
            </div>
       </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-lg-12 justify-content-center">
                <h4 class="text-center text-info">Custom post type</h4>

                    <?php
                    $the_query = new WP_Query( array('posts_per_page'=>1,
                                    'post_type'=>'Movies',
                                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1) 
                                ); 
                                ?>
                        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                        <div class="col-xs-12 file">
                            
                        <h3  class="mt-2 mb-2 "> <?php echo get_the_title(); ?> </h3>
                        <div class="row">
                            <div class="col-md-5"> <?php the_post_thumbnail('single-img')?></div>
                            <div class="col-md-6">  
                        <div class="file-description"><?php the_content(); ?></div></div>
                        </div>
                       
                        </div>
                        <?php
                        endwhile; ?>
                      
   
                       <h5><strong>Published Date: </strong><?php echo  get_post_meta( get_the_ID(), '_date', true ) ; ?></h5>
                       <h5><strong>Price: </strong><?php echo  get_post_meta( get_the_ID(), '_price', true ) ; ?></h5>

                        <div class="pagination justify-content-center">
                         <div class="row  text-center">
                            <div class="col-md-12 d-flex mt-3 mb-3 text-center">

                            <?php
                        $big = 10; // need an unlikely integer
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $the_query->max_num_pages
                        ) );

                        wp_reset_postdata();
                                            
                        ?>

                                    </div>
                                </div>
                            </div>
                        
                        </div>

                   

                    </div>
                </div>
                <?php 
                get_footer()
                ?>
  