<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php
    $url = 'https://www.karnbibeln.se/app/v1/dailyverse_json/' . date('Y') . '.json';
    $json = file_get_contents($url);

    $data = json_decode($json, true);
    $date = '20' . date('y-m-d');

    $reference = explode('_',$data[$date]['reference']);
    $link = 'https://www.karnbibeln.se/las/?b=' . $reference[1] . '&mark=1#' . $reference[2] . '_' . $reference[3];
    ?>
    <a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $data[$date]['image']; ?>"></a>
</p>
