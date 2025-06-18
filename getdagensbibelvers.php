<?php

add_action('get_dagens_bibelvers');


function get_dagens_bibelvers(){
    check_ajax_referer('dagens_bibelvers');



    $url = 'https://www.karnbibeln.se/app/v1/dailyverse_json/' . date('Y') . '.json';
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    $date = '20' . date('y-m-d');

    $reference = explode('_',$data[$date]['reference']);
    $link = 'https://www.karnbibeln.se/las/?b=' . $reference[1] . '&mark=1#' . $reference[2] . '_' . $reference[3];
    echo '<a href="' . $link . '" target="_blank"><img src="' . $data[$date]['image'] . '"></a>';
    
    wp_die();
}