<?php
/* Template Name: Custom Search */
?>
<?php get_header();
$image = "";
if(empty($image)){
  $query= new WP_Query(array(
    'post_type'  => 'page', 
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'homepage.php',
  ));
  if( $query->have_posts() ) : 
  while( $query->have_posts() ) : $query->the_post();
  $homepage_id = get_the_id();
  endwhile;
  endif; 
  wp_reset_query();
  $image = wp_get_attachment_url( get_post_thumbnail_id($homepage_id));
}
?>
    <div class="background-single-lyrics" style="<?php echo "background: url(".$image.") center center; background-size:cover;" ?>">
        <div class="single-lyrics-overlay">
            <?php get_template_part('menu'); ?>
            <div class="container">
                <div class="lyrics-title marginb20">
                  <div class="pull-left"><h1> <?php echo '"'.$s.'"'; ?> <?php echo __('Search Results', '2035Themes-fm'); ?> </h1> </div>
                </div>
            </div>
        </div>
    </div>
<div class="container content-capsule">
  <div class="content-pull">
    <div class="page-container clearfix"><!-- Album Content -->
      <div class="container">
        <div class="second-container second-padding clearfix">

          <div class="row margint10 marginb10">
              <?php $search_sidebar = $theme_prefix['search-sidebar'];
              if($search_sidebar != ""){ ?><div class="col-lg-8 col-sm-8"><?php }else { ?> <div class="col-lg-12 col-sm-12"><?php } ?>
               <?php if ( have_posts() ) : ?>
              <div class="album-line clearfix margint10">
                <div class="col-lg-6 col-sm-6 col-xs-6">
                  <div class="table-title"><?php if($post_type == "lyrics"){ echo __('Song Name', '2035Themes-fm'); }elseif($post_type == "artist"){ echo __('Artist', '2035Themes-fm'); }elseif($post_type == "album"){ echo __('Album Name', '2035Themes-fm'); } ?></div>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3">
                  <div class="table-title"><?php if($post_type == "lyrics"){ echo __('Album Name', '2035Themes-fm'); } ?></div>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3">
                  <div class="table-title"><?php if($post_type == "lyrics"){ echo __('Artist', '2035Themes-fm'); } ?></div>
                </div>
              </div>

  <?php
  $number=0;
  if(get_query_var('page')){$paged = get_query_var('page');}else if(get_query_var('paged')){$paged = get_query_var('paged');}
  while ( have_posts() ) : the_post();
  $pid = $post->ID;
  ?> 
              <div class="list-line margint10 clearfix">
                <div class="col-lg-6 col-sm-6 col-xs-6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
  <?php
  $albumId = get_post_meta( $pid, 'theme2035_album_name', true );
  if($albumId == ""){
    $album_name = __('No Information', '2035Themes-fm');
    $album_link = "";
  }else{
    $get_album_name = new WP_Query( array( 
        'post_type' => 'album',
        'posts_per_page' => -1,
        'p' => $albumId,
    ));
    if( $get_album_name->have_posts() ) : 
        while( $get_album_name->have_posts() ) : $get_album_name->the_post(); 
        $album_name = get_the_title();
        $album_link = get_permalink();
    endwhile;
    endif;
    wp_reset_query();
  }
  ?>
                <div class="col-lg-3 col-sm-3 col-xs-3"><?php if($post_type == "lyrics"){ ?><a href="<?php echo esc_attr($album_link); ?>"><?php echo esc_attr($album_name); ?></a><?php } ?></div>
  <?php
  $artistId = get_post_meta( $pid, 'theme2035_artist_name', true );
  $second_artist_id = get_post_meta( get_the_ID(), 'theme2035_second_artist_name', true );
  if($artistId == ""){
    $artist_name = __('No Information', '2035Themes-fm');
    $artist_link = "";
  }else{
    $get_artist_name = new WP_Query( array( 
        'post_type' => 'artist',
        'posts_per_page' => -1,
        'p' => $artistId,
    ));
    if($second_artist_id != ""){
                  $get_second_artist_name = new WP_Query( array( 
                      'post_type' => 'artist',
                      'posts_per_page' => -1,
                      'p' => $second_artist_id,
                  ));
                }
    if( $get_artist_name->have_posts() ) : 
        while( $get_artist_name->have_posts() ) : $get_artist_name->the_post(); 
        $artist_name = get_the_title();
        $artist_link = get_permalink();
    endwhile;
    endif;
    wp_reset_query();
    if($second_artist_id != ""){
                  if( $get_second_artist_name->have_posts() ) : 
                      while( $get_second_artist_name->have_posts() ) : $get_second_artist_name->the_post(); 
                      $second_artist_name = get_the_title();
                      $second_artist_link = get_permalink();
                  endwhile;
                  endif;
                  wp_reset_query();
                }
  }
  ?>
                <div class="col-lg-3 col-sm-3 col-xs-3"><?php if($post_type == "lyrics"){ ?><a href="<?php echo esc_attr($artist_link); ?>"><?php echo esc_attr($artist_name); ?></a> <?php if($second_artist_id != ""){ ?>ft. <a href="<?php echo esc_attr($second_artist_link); ?>"><?php echo esc_attr($second_artist_name); ?></a><?php }} ?></div>
              </div>
              <?php endwhile; else : ?>
                  <div class="margint10 big-font"><p><?php echo __('Your search returned no results. Please try a different keyword!','2035Themes-fm') ?></p></div>
              <?php endif; wp_reset_query(); ?> 
              <div class="row margint40">
                <div class="col-lg-12"><?php Theme2035_custom_pagination(); ?></div>
              </div>
          </div>
          <?php if($search_sidebar != ""){ ?>
          <div class="col-lg-4 col-sm-4"><!-- Sidebar -->
            <?php if($theme_prefix['search-sidebar'] != "" ){ ?>
            <div class="single-lyric-ads margint10 single-widget">
                <div class="title"><h4><?php echo __( 'ADVERTISEMENT', '2035Themes-fm' ); ?></h4></div>
                <?php $search_sidebar = $theme_prefix['search-sidebar']; ?>
                <?php echo $search_sidebar; ?>
            </div>
            <?php } ?>

          </div>
          <?php } ?>
        </div>
        </div>
  </div>
</div>
<?php get_footer(); ?>