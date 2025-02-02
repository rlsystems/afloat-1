<?php
get_header();
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
?>
<?php
while (have_posts()) :
  the_post();

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");




  $price_packages = get_field('price_packages');
  $lowestPrice = lowest_tour_price($price_packages, $currentYear);



  $args = array(
    'lowestPrice' => $lowestPrice,
    'propertyType' => 'Tour',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
  );


?>

  <!-- Product Page Container -->
  <div class="product-page">
    <?php
    get_template_part('template-parts/content', 'product-hero-nav');
    ?>
    <section class="product-content">

      <!-- 1. Overview Content -->
      <?php if (get_field('show_overview')) : ?>
        <div class="product-content__page tab-content current" id="overview">
          <?php
          get_template_part('template-parts/content', 'product-overview', $args);
          ?>
        </div>
      <?php endif; ?>
      <!-- 2. Itineraries Content -->
      <div class="product-content__page tab-content <?php echo (get_field('show_overview') ? '' : 'current') ?> " id="itineraries">
        <?php
        get_template_part('template-parts/content', 'product-itineraries-tour', $args);
        ?>
      </div>

      <!-- 3. Cabins Content -->
      <div class="product-content__page tab-content " id="cabins">
        <?php
        get_template_part('template-parts/content', 'product-cabins-tour', $args);
        ?>
      </div>

      <!-- 4. Prices Content -->
      <div class="product-content__page tab-content " id="prices">
        <?php
        get_template_part('template-parts/content', 'product-prices-tour', $args);
        ?>
      </div>

    </section>


    <?php
    $show_areas = get_field('show_areas');
    if ($show_areas) :
    ?>
      <!-- Areas -->
      <div class="page-divider">
        Explore
      </div>
      <section class="product-areas">
        <?php
        get_template_part('template-parts/content', 'product-explore', $args);
        ?>
      </section>
    <?php endif; ?>

    
    <!-- Reviews -->
    <?php if (get_field('show_testimonials')) : ?>
      <div class="page-divider">
        Guest Reviews
      </div>
      <section class="product-reviews">
        <?php
        get_template_part('template-parts/content', 'product-reviews', $args);
        ?>
      </section>
    <?php endif; ?>

    <!-- Related Travel -->

    <div class="page-divider">
      Related Tours
    </div>
    <section class="product-related">
      <?php
      get_template_part('template-parts/content', 'product-related', $args);
      ?>
    </section>


  </div>





  <script>
    var currentYear = '<?php echo $currentYear = date("Y"); ?>';
    var templateUrl = '<?php echo bloginfo('template_url') ?>';
  </script>

<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>



























    <!-- Itinerary -->
    <div class="product-itineraries__itinerary  tab-content current" id="tab-itinerary-1">
        <div class="product-itineraries__itinerary__title">
            <h2 class="page-divider product-itineraries__itinerary__title__main">
                Tour Itinerary
            </h2>
            <div class="product-itineraries__itinerary__title__subtitle">
                <?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night
            </div>
        </div>



        <!-- D2D -->
        <div class="product-itineraries__itinerary__d2d">

            <!-- Days  -->
            <!-- First Day style set inline for slide toggle to function correctly -->

            <div class="product-itineraries__itinerary__d2d__days">
                <?php
                $days = get_field('daily_activities');
                $dayCount = 1;
                $img;
                if ($days) :
                    foreach ($days as $day) : ?>
                        <?php
                        $img = $day['day_image']
                        ?>
                        <!-- Day -->
                        <div class="product-itineraries__itinerary__d2d__days__day <?php echo $dayCount == 1 ? 'product-itineraries__itinerary__d2d__days__day--active' : ''; ?> ">

                            <?php if ($img != null) { ?>
                                <div class="product-itineraries__itinerary__d2d__days__day__image-content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                    <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges">
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__count-badge">
                                            <span>Day <?php echo $dayCount; ?></span> / <?php echo get_field('length_in_days'); ?>
                                        </div>
                                        <div class="product-itineraries__itinerary__d2d__days__day__image-content__badges__location-badge">
                                            <?php echo $day['day_location']; ?>
                                        </div>
                                    </div>

                                    <?php echo '<img src="' . esc_html($img['url']) . '" alt="' . esc_html($img['alt']) . '" class="product-itineraries__itinerary__d2d__days__day__image-content__img">'; ?>
                                </div>
                            <?php } ?>
                            <div class="product-itineraries__itinerary__d2d__days__day__count">
                                <span>Day <?php echo $dayCount; ?></span> / <?php echo get_field('length_in_days'); ?>
                            </div>
                            <h5 class="product-itineraries__itinerary__d2d__days__day__header">
                                <?php echo $day['day_title']; ?>
                            </h5>
                            <div class="product-itineraries__itinerary__d2d__days__day__snippet" <?php echo $dayCount == 1 ? 'style="display: none;"' : ''; ?>>
                                <p>
                                    <?php
                                    echo substr(strip_tags($day['day_description']), 0, 160);
                                    ?>...
                                </p>
                            </div>
                            <div class="product-itineraries__itinerary__d2d__days__day__content" <?php echo $dayCount == 1 ? 'style="display: block;"' : ''; ?>>
                                <?php echo $day['day_description']; ?>
                            </div>
                            <button class="btn-expand btn-expand--down product-itineraries__itinerary__d2d__days__day__button">
                                <svg class="btn-expand--arrow-main">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                                <svg class="btn-expand--arrow-animate">
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-down"></use>
                                </svg>
                            </button>
                        </div>
                <?php
                        $dayCount++;
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <aside class="product-itineraries__itinerary__side-content">
            <!-- Details - Availability / Prices -->
            <div class="product-itineraries__itinerary__side-content__detail">

                <?php if (get_field('has_summary') == false) : ?>
                    <div class="product-itineraries__itinerary__side-content__detail__widget">
                        <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                            <h4 class="heading-4">
                                Route Map
                            </h4>

                        </div>
                        <!-- Map -->
                        <?php $img = get_field('map'); ?>
                        <a class="product-itineraries__itinerary__map product-itineraries__itinerary__map--no-summary" id="map-lightbox" href="<?php echo $img['url']; ?>" title="<?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night - <?php echo get_field('tour_name') ?>">
                            <?php if ($img) : ?>
                                <img src="<?php echo $img['url']; ?>" alt="">
                                <svg>
                                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                                </svg>
                            <?php endif ?>
                        </a>
                    </div>


                <?php endif; ?>

                <!-- Prices -->
                <div class="product-itineraries__itinerary__side-content__detail__widget">

                    <?php $yearCount = 0; ?>
                    <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                        <h4 class="heading-4">
                            Prices
                        </h4>
                        <!-- Select-Box -->
                        <div class="itinerary-year-select-group">
                            <select class="itinerary-year-select" data-tab="1">
                                <?php while ($yearCount <= 1) { ?>
                                    <option><?php echo ($currentYear + $yearCount) ?></option>
                                <?php $yearCount++;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <!-- Price-Grid  -->
                    <?php
                    $pricePackages = get_field('price_packages');
                    $yearCount = 0;
                    ?>

                    <?php while ($yearCount <= 1) { ?>
                        <div class="price-grid price-grid__<?php echo ($currentYear + $yearCount) ?>" data-tab="1">

                            <?php
                            if ($pricePackages) {
                                foreach ($pricePackages as $pricePackage) {
                                    $price_level = $pricePackage['price_level'];
                                    if ($pricePackage['year'] == ($currentYear + $yearCount)) { ?>
                                        <div class="price-grid__item">
                                            <div class="price-grid__item__cabin">
                                                <?php echo get_the_title($price_level); ?>
                                            </div>
                                            <div class="price-grid__item__price">
                                                <?php echo "$ " . number_format($pricePackage['price'], 0);  ?>
                                            </div>
                                        </div>

                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    <?php $yearCount++;
                    } ?>

                </div>
                <!-- Inclusions -->
                <div class="product-itineraries__itinerary__side-content__detail__widget">
                    <div class="product-itineraries__itinerary__side-content__detail__widget__top-section">
                        <h4 class="heading-4" id="InclusionsTitle" data-tab="1">
                            What's Included
                        </h4>
                    </div>
                    <div class="inclusions-area">
                        <!-- Inclusions List -->
                        <div class="inclusions-area__itinerary-inclusions" id="inclusions-list" data-tab="1">
                            <ul class="list-svg">
                                <?php
                                $inclusions = get_field('inclusions');
                                if ($inclusions) {
                                    foreach ($inclusions as $inclusion) { ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $inclusion['inclusion'] ?></span>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-exclusions" value="1">
                                    View List of Exclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Exclusions List -->
                        <div class="inclusions-area__itinerary-inclusions inclusions-area__itinerary-inclusions--hidden" id="exclusions-list" data-tab="1">
                            <ul class="list-svg">
                                <?php
                                $exclusions = get_field('exclusions');
                                if ($exclusions) {
                                    foreach ($exclusions as $exclusion) { ?>
                                        <li>
                                            <svg>
                                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                            </svg>
                                            <span><?php echo $exclusion['exclusion'] ?></span>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="inclusions-area__itinerary-inclusions__view">
                                <button class="inclusions-area__itinerary-inclusions__view__button text-button text-button--large view-inclusions" value="1">
                                    View List of Inclusions
                                    <svg>
                                        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>