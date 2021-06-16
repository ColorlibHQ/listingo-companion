<?php
function listingo_page_metabox( $meta_boxes ) {

	$listingo_prefix = '_listingo_';
	$meta_boxes[] = array(
		'id'        => 'listing_metaboxes',
		'title'     => esc_html__( 'Other Options', 'listingo-companion' ),
		'post_types'=> array( 'listing' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $listingo_prefix . 'listing_address',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Address', 'listingo-companion' ),
				'placeholder' => esc_html__( 'Detail Address for the Listing.', 'listingo-companion' ),
			),
			// array(
			// 	'id'    => $listingo_prefix . 'listing_country',
			// 	'type'  => 'text',
			// 	'required'  => true,
			// 	'name'  => esc_html__( 'Country', 'listingo-companion' ),
			// 	'placeholder' => esc_html__( 'Country for the Listing.', 'listingo-companion' ),
			// ),
			array(
				'id'            => $listingo_prefix . 'listing_map',
				'type'          => 'osm',
				'required'  => true,
				'name'          => esc_html__( 'Location', 'listingo-companion' ),
				'std'           => '-6.233406,-35.049906,15',
				'address_field' => $listingo_prefix . 'listing_address',
			),
			array(
				'id'    => $listingo_prefix . 'listing_price',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Price', 'listingo-companion' ),
				'placeholder' => esc_html__( 'Ex: 1000000', 'listingo-companion' ),
			),
			array(
				'id'    => $listingo_prefix . 'phone_number',
				'type'  => 'text',
				'name'  => esc_html__( 'Phone', 'listingo-companion' ),
				'placeholder' => esc_html__( 'Ex: 012 345 678', 'listingo-companion' ),
			),
			array(
				'id'    => $listingo_prefix . 'listing_email',
				'type'  => 'text',
				'name'  => esc_html__( 'Listing Email', 'listingo-companion' ),
			),
			array(
				'id'    => $listingo_prefix . 'listing_area',
				'type'  => 'text',
				'name'  => esc_html__( 'Area (Square Feet)', 'listingo-companion' ),
				'placeholder' => esc_html__( 'Ex: 1500', 'listingo-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'listingo_page_metabox' );
