<?php 


//Product Date Search
add_action('wp_ajax_productSearch', 'search_filter_product_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_productSearch', 'search_filter_product_search');

function search_filter_product_search()
{
    //Set up 
    //Start / End dates
    //Pass Along Post Id (WP ID of Product)

    $productId = $_POST['productId'];


    if (isset($_POST['dates-itinerary-select']) && $_POST['dates-itinerary-select'])
        $selectedItinerary = $_POST['dates-itinerary-select'];

    if (isset($_POST['dates-month-select']) && $_POST['dates-month-select'])
        $selectedMonth = $_POST['dates-month-select'];

    if (isset($_POST['dates-year-select']) && $_POST['dates-year-select'])
        $selectedYear = $_POST['dates-year-select'];


    $args = array(
        'selectedItinerary' => $selectedItinerary,
        'selectedMonth' => $selectedMonth,
        'selectedYear' => $selectedYear,
        'productId' => $productId,
    );
    get_template_part('template-parts/content', 'product-dates-results', $args);



    die();
}


//Main Search
add_action('wp_ajax_mainSearch', 'search_filter_main_search'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_mainSearch', 'search_filter_main_search');

function search_filter_main_search()
{

    //--------------WP Categories
    //Travel Type
    $travelType = array('rfc_cruises', 'rfc_tours', 'rfc_lodges');
    if (isset($_POST['travel-select']) && $_POST['travel-select'])
        $travelType = $_POST['travel-select'];



    $args = array(
        'posts_per_page' => -1,
        'post_type' => $travelType, 
    );


    if (isset($_POST['destination-select']) && $_POST['destination-select'])
        $args['meta_query'][] = array(
            'key' => 'destination',
            'value' => '"' . $_POST['destination-select'] . '"',
            'compare' => 'LIKE'
        );



    $posts = get_posts($args);


    //Capture Meta Input
    //-------------Meta Parameters
    //Length
    //Sorting
    //Dates
    //Budget

    $sortOrder = '';
    if (isset($_POST['result-sort']) && $_POST['result-sort'])
        $sortOrder = $_POST['result-sort'];

    $startDate = '';
    if (isset($_POST['startDate']) && $_POST['startDate']) {
        $startDate = $_POST['startDate'];
    }
    $endDate = '';
    if (isset($_POST['endDate']) && $_POST['endDate']) {
        $endDate = $_POST['endDate'];
    }
    $minLength = '';
    if (isset($_POST['minLength']) && $_POST['minLength']) {
        $minLength = $_POST['minLength'];
    }
    $maxLength = '';
    if (isset($_POST['maxLength']) && $_POST['maxLength']) {
        $maxLength = $_POST['maxLength'];
    }

    $postsAndCriteria = new stdClass();
    $postsAndCriteria->products = $posts;
    $postsAndCriteria->sortOrder = $sortOrder;
    $postsAndCriteria->startDate = $startDate;
    $postsAndCriteria->endDate = $endDate;
    $postsAndCriteria->minLength = $minLength;
    $postsAndCriteria->maxLength = $maxLength;


    get_template_part('template-parts/content', 'main-search-results', $postsAndCriteria);



    die();
}



?>