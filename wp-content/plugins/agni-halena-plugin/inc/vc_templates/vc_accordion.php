<?php

$output = $title = $el_class = '';
//
extract(shortcode_atts(array(
   'style' => '1',
	'alignment' => 'left',
    'el_class' => '',
    'choice' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
global $acc_id;
$acc_id = 'accordion-'.rand();
$output = '<div id="'.$acc_id.'" class="accordion '.$el_class.' panel-group accordion-style-'.$style.' text-'.$alignment.'">'.wpb_js_remove_wpautop($content).'</div>';

if( $choice == 'yes' ){
	$output = '<div class="accordion '.$el_class.' panel-group accordion-style-'.$style.' text-'.$alignment.'">'.wpb_js_remove_wpautop($content).'</div>';	
}

echo  $output;