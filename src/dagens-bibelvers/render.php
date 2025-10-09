<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<p <?php echo wp_kses_data(get_block_wrapper_attributes()); ?>>
    <?php
    $url = 'https://www.karnbibeln.se/app/v1/dailyverse_json/' . gmdate('Y') . '.json';
    $json = wp_remote_get($url)["body"];

    $data = json_decode($json, true);
    $date = gmdate('Y-m-d');
    if($attributes["width"]){
        $width = $attributes["width"];
    } else {
        $width = "100%";
    }
    
    if($attributes['imgLink']) {
        $reference = explode('_',$data[$date]['reference']);
        
        if(str_contains($reference[3], '-')){
            $verses = explode('-', $reference[3]);


            $link = 'https://www.karnbibeln.se/las/?b=' . $reference[1] . '&mark=1&toverse=' . $verses[1] . '#' . $reference[2] . '_' . $verses[0];
        }
        else {
            $link = 'https://www.karnbibeln.se/las/?b=' . $reference[1] . '&mark=1#' . $reference[2] . '_' . $reference[3];
        }
        
        
        ?>
        <p><a tabindex="-1" class="dagens-bibelvers-link" style="display: block; max-width:<?php echo esc_html($width); ?>; height: auto;" href="<?php echo esc_html($link); ?>" target="_blank"><img class="dagens-bibelvers-image" style="max-width: 100%; height: auto;" src="<?php echo esc_html($data[$date]['image']); ?>"></a></p>
        <?php
    }
    else {
        ?>
        <p><img class="dagens-bibelvers-image" style="max-width: <?php echo esc_html($width); ?>; height: auto;" src="<?php echo esc_html($data[$date]['image']); ?>"></p>
        <?php
    }
    ?>
</p>