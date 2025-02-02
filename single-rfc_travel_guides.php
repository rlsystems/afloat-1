<?php
get_header();
wp_enqueue_script('page-travel-guide', get_template_directory_uri() . '/js/page-travel-guide.js', array('jquery'), false, true);
?>

<?php
while (have_posts()) :
  the_post();
  $image  = get_field('featured_image');
  $categories  = get_field('categories');
  $displayCategory = "";

  if ($categories) {
    $firstCategoryPost = $categories[0];
    $displayCategory = get_the_title($firstCategoryPost);
  }


  //breadcrumbs
  //destination / region
  $breadcrumbDestinationPage  = get_field('breadcrumb_destination_page');
  $breadcrumbDestinationURL = get_permalink($breadcrumbDestinationPage);

  $templateType = get_page_template_slug($breadcrumbDestinationPage->ID);
  $breadcrumbDestinationText = "";
  if ($templateType == 'template-destinations-destination.php' || $templateType == 'template-destinations-cruise.php') {
    $destinationPost = get_field('destination_post', $breadcrumbDestinationPage);
    $breadcrumbDestinationText  = get_field('navigation_title', $destinationPost);
  }
  if ($templateType == 'template-destinations-region.php') {
    $regionPost = get_field('region_post', $breadcrumbDestinationPage);
    $breadcrumbDestinationText  = get_field('navigation_title', $regionPost);
  }

  //breadcrumbs
  //travel guide
  $breadcrumbTravelGuidePage  = get_field('breadcrumb_travel_guide_page');
  $breadcrumbTravelGuideURL = get_permalink($breadcrumbTravelGuidePage);

  $guideType = get_field('destination_type', $breadcrumbTravelGuidePage);
  console_log($guideType);
  $breadcrumbTravelGuideText  = "";

  if ($guideType == 'rfc_destinations') {
    $destinationPost = get_field('destination', $breadcrumbTravelGuidePage);
    $breadcrumbTravelGuideText  = get_field('navigation_title', $destinationPost);
  }
  if ($guideType == 'rfc_regions') {
    $regionPost = get_field('region', $breadcrumbTravelGuidePage);
    $breadcrumbTravelGuideText  = get_field('navigation_title', $regionPost);
  }
  if ($guideType == 'rfc_locations') {
    $locationPost = get_field('location', $breadcrumbTravelGuidePage);
    $breadcrumbTravelGuideText  = get_field('navigation_title', $destinationPost);
  }

  //related posts
  $queryArgs = array(
    'post_type' => 'rfc_travel_guides',
    'posts_per_page' => -1,
    'post__not_in' => array($post->ID)
  );

  $queryArgsDestination = array();
  $queryArgsDestination['relation'] = 'OR';
  $destinations = get_field('destinations');
  if ($destinations) {
    foreach ($destinations as $d) {
      $queryArgsDestination[] = array(
        'key'     => 'destinations',
        'value'   => serialize(strval($d->ID)),
        'compare' => 'LIKE'
      );
    }
  };

  $queryArgs['meta_query'][] = $queryArgsDestination;
  $travelGuidePosts = new WP_Query($queryArgs);

?>


  <!-- Product Page Container -->
  <div class="travel-guide-page">
    <div class="travel-guide">
      <!-- Breadcrumb -->
      <ol class="travel-guide__breadcrumb">

        <li>
          <a href=" <?php echo $breadcrumbDestinationURL; ?>"><?php echo $breadcrumbDestinationText; ?></a>
        </li>
        <li>
          <a href=" <?php echo $breadcrumbTravelGuideURL; ?>"><?php echo $breadcrumbTravelGuideText; ?> Travel Guide</a>
        </li>
        <li>
          <?php echo get_field('navigation_title'); ?>
        </li>
      </ol>
   
      <h1 class="travel-guide__title">
        <?php echo get_field('navigation_title'); ?>
      </h1>
      <div class="travel-guide__category">
        <?php echo $displayCategory ?>
      </div>
      <div class="travel-guide__image">
        <?php if ($image) : ?>
          <img <?php afloat_responsive_image($image['ID'], 'featured-largest', array('featured-small', 'featured-medium', 'featured-large', 'featured-largest')); ?> alt="">
        <?php endif; ?>
      </div>

    


      <div class="travel-guide__content drop-cap-1a">
        <?php echo the_content(); ?>
      </div>
      
      <div class="travel-guide__disclaimer">
        <div class="travel-guide__disclaimer__header">
          Disclaimer
        </div>
        <?php echo get_field('disclaimer', 'options'); ?>
      </div>
      <div class="travel-guide__entry">
        This entry was posted <?php echo get_the_date(); ?>
      </div>
      
    </div>
    <div class="travel-guide-related">
      <div class="travel-guide-related__title">
        You may also like
      </div>
      <div class="travel-guide-related__slider-area">
        <div class="travel-guide-related__slider-area__slider" id="related-slider">

          <?php
          if ($travelGuidePosts->have_posts()) :
            while ($travelGuidePosts->have_posts()) : $travelGuidePosts->the_post();
              $post_featured_image = get_field('featured_image');
          ?>
              <!-- Item -->
              <div class="travel-guide-related__slider-area__slider__item">
                <img <?php afloat_responsive_image($post_featured_image['id'], 'featured-medium', array('featured-medium', 'featured-small')); ?> alt="" class="travel-guide-related__slider-area__slider__item__image">
                <div class="travel-guide-related__slider-area__slider__item__content">
                  <a class="travel-guide-related__slider-area__slider__item__content__title" href="<?php echo the_permalink(); ?>">
                    <?php echo the_title(); ?>
                  </a>
                  <div class="travel-guide-related__slider-area__slider__item__content__text">
                    <?php echo the_excerpt(); ?>
                  </div>
                  <div class="travel-guide-related__slider-area__slider__item__content__cta">
                    <a class="goto-button goto-button--small" href="<?php echo the_permalink(); ?>">
                      Read More
                      <svg>
                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-arrow-right"></use>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
          <?php
            endwhile;
            wp_reset_postdata(); //very important to rest after custom query
          endif;
          ?>
        </div>
      </div>

    </div>

    <?php
    get_template_part('template-parts/content', 'shared-newsletter');
    ?>
  </div>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>


<script>
  var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>