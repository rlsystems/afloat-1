<?php

$currentYear = $args['currentYear'];
$currentMonth = $args['currentMonth'];

$years = $args['years'];
$months = $args['months'];
$monthNames = $args['monthNames'];

//$itineraries = get_field('itineraries');

$days = [];
$lowest;
$highest;

$img = get_field('map');
?>

<div class="product-itineraries">

    <h2 class="page-divider u-margin-bottom-medium">
        Itinerary
    </h2>



    <!-- New -->
    <!-- Itinerary Slider Content -->
    <div class="product-itineraries__content">

        <!-- Itineraries Slide Item-->
        <div class="product-itinerary-slide">

            <!-- Map / Side Info - Top Section -->
            <div class="product-itinerary-slide__top">

                <!-- Map Area -->
                <div class="product-itinerary-slide__top__map-area">
                    <div class="product-itinerary-slide__top__map-area__title">
                    <?php echo get_field('tour_name') ?> - <?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night
                    </div>
                    <!-- Map -->
                    <a class="" id="itinerary-map-image" href="<?php echo $img['url']; ?>" title="<?php echo get_field('length') ?> Day / <?php echo (get_field('length') - 1) ?> Night - <?php echo get_field('tour_name') ?>">
                        <?php if ($img) : ?>
                            <img src="<?php echo $img['url']; ?>" alt="">
                        <?php endif ?>
                    </a>
                </div>

                <!-- Side Info Area -->
                <?php $count = 0; ?>
                <div class="product-itinerary-slide__top__info">
                    <div class="product-itinerary-slide__top__info__tabs">
                        <div class="product-itinerary-slide__top__info__tabs__item current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">Overview</div>
                        <div class="product-itinerary-slide__top__info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">Inclusions</div>
                        <div class="product-itinerary-slide__top__info__tabs__item" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">Exclusions</div>
                    </div>

                    <!-- Overview-->
                    <div class="product-itinerary-slide__top__info__content current" itinerary-tab="<?php echo $count; ?>" tab-type="overview">

                        <!-- Prices -->
                        <div class="product-itinerary-slide__top__info__content__widget">
                            <div class="product-itinerary-slide__top__info__content__widget__top-section">
                                <h4 class="product-itinerary-slide__top__info__content__widget__top-section__title">
                                    Prices
                                </h4>

                                <?php $yearCount = 0; ?>
                                <!-- Select-Box -->
                                <div class="itinerary-year-select-group">
                                    <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
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

                    </div>

                    <!-- Inclusions -->
                    <div class="product-itinerary-slide__top__info__content" itinerary-tab="<?php echo $count; ?>" tab-type="inclusions">
                        <h4>What's Incuded</h4>
                        <ul class="product-itinerary-slide__top__info__content__inclusions-list">
                            <?php
                            $inclusions = get_field('inclusions');
                            if ($inclusions) :
                                foreach ($inclusions as $inclusion) : ?>
                                    <li>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                        <span><?php echo $inclusion['inclusion'] ?></span>
                                    </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>

                    <!-- Exclusions -->
                    <div class="product-itinerary-slide__top__info__content" itinerary-tab="<?php echo $count; ?>" tab-type="exclusions">
                        <h4>What's Excluded</h4>
                        <ul class="product-itinerary-slide__top__info__content__inclusions-list">

                            <?php
                            $exclusions = get_field('exclusions');
                            if ($exclusions) :
                                foreach ($exclusions as $exclusion) : ?>
                                    <li>
                                        <svg>
                                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                                        </svg>
                                        <span><?php echo $exclusion['exclusion'] ?></span>
                                    </li>
                            <?php endforeach;
                            endif; ?>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- D2D - Bottom Section -->
            <div class="product-itinerary-slide__bottom">

                <!-- Slider -->
                <div class="product-itinerary-slide__bottom__days" id="slider-bottom-days-<?php echo $count ?>">
                <?php
                $days = get_field('daily_activities');
                $dayCount = 1;
                $img;
                if ($days) :
                    foreach ($days as $day) : ?>
                        <?php
                        $img = $day['day_image']
                        ?>

                            <!-- Day Slide -->
                            <div class="product-itinerary-slide__bottom__days__item">

                                <!-- Content -->
                                <div class="product-itinerary-slide__bottom__days__item__content">
                                    <div class="product-itinerary-slide__bottom__days__item__content__title">
                                    <?php echo $day['day_title']; ?>
                                    </div>
                                    <div class="product-itinerary-slide__bottom__days__item__content__text">
                                    <?php echo $day['day_description']; ?>
                                    </div>
                                </div>

                                <!-- Side / Image -->
                                <div class="product-itinerary-slide__bottom__days__item__side">
                                    <div class="product-itinerary-slide__bottom__days__item__side__image-area">
                                        <?php if ($img != null) : ?>

                                            <img src="<?php echo $img['url'] ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-itinerary-slide__bottom__days__item__side__detail">
                                        <div class="product-itinerary-slide__bottom__days__item__side__detail__item">
                                            <div class="product-itinerary-slide__bottom__days__item__side__detail__item__title">
                                                Location
                                            </div>
                                            <div class="product-itinerary-slide__bottom__days__item__side__detail__item__data">
                                                <?php echo $day['day_location']; ?>
                                            </div>
                                        </div>
                                        <div class="product-itinerary-slide__bottom__days__item__side__detail__item">
                                            <div class="product-itinerary-slide__bottom__days__item__side__detail__item__title">
                                                Day
                                            </div>
                                            <div class="product-itinerary-slide__bottom__days__item__side__detail__item__data">
                                                <span><?php echo $dayCount; ?></span> / <?php echo get_field('length') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    <?php
                            $dayCount++;
                        endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- New -->




</div>