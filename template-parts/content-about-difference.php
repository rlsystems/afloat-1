<?php

$difference = get_field('difference');
$headerText = get_field('difference_header');
?>

<div class="about-difference">
    <div class="about-difference__title">
        <?php echo $headerText ?>
    </div>
    <div class="about-difference__slider-area">
        <div class="about-difference__slider-area__slider" id="difference-slider">
            <?php
            if ($difference) :
                foreach ($difference as $slide) :

            ?>

                    <div class="difference-card">
                        <div class="difference-card__bg">
                            <?php $image =  $slide['image'] ?>
                            <img <?php afloat_responsive_image($image['id'], 'full-hero-large', array('full-hero-large')); ?> alt="">

                        </div>
                        <div class="difference-card__content">
                            <div class="difference-card__content__title">
                                <?php echo $slide['title'] ?>
                            </div>
                            <div class="difference-card__content__snippet">
                                <?php echo $slide['snippet'] ?>
                            </div>
                        </div>
                    </div>

            <?php
                endforeach;
            endif;

            ?>
        </div>

    </div>
</div>