<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('build_tree_html')) {

	function build_tree_html($array,$parent_id = 0) {
		$ci = & get_instance();
		$html = '<ol class="dd-list">';

		foreach ($array as $tree) {

			$html .= '<li class="dd-item" data-id="' . $tree['id'] . '" data-parent="'.$parent_id.'" data-itemname="'.$tree['name'].'">';
			$html .= '<div class="dd-handle">' . $tree['name'] ;
			$html .= '<div class="pull-right action-buttons">';
			$html .= '<a class="blue edit" href="javascript:void(0);"><i class="fa fa-edit mr5"></i></a>';
			$html .= '<a class="blue delete" href="javascript:void(0);"><i class="fa fa-trash-o mr5"></i></a>';
			$html .= '</div>';
			$html .= '</div>';
			if (isset($tree['children']) && count($tree['children'])) {
				$html .= build_tree_html($tree['children'],$tree['id']);
			}
			$html .= '</li>';
		}

		$html .= '</ol>';

		return $html;
	}
}

if ( ! function_exists('popup_atts')) {

	function popup_atts() {
		return array(
            'width' => '1000',
            'height' => '600',
            'scrollbars' => 'yes',
            'status' => 'no',
            'resizable' => 'yes',
            'screenx' => '300',
            'screeny' => '100'
        );
	}
}