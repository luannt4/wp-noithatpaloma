<?php
// Add custom Theme Functions here

/*Sắp xếp lại thứ tự các field*/
add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {
 
  //Shipping
  $order_shipping = array(
    "shipping_last_name",
    "shipping_phone",
    "shipping_address_1"
  );
  foreach($order_shipping as $field_shipping)
  {
    $ordered_fields2[$field_shipping] = $fields["shipping"][$field_shipping];
  }
  $fields["shipping"] = $ordered_fields2;
  return $fields;
}
 
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields',99 );
function custom_override_checkout_fields( $fields ) {
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_first_name']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_address_2']);
  $fields['billing']['billing_last_name'] = array(
    'label' => __('Họ và tên', 'devvn'),
    'placeholder' => _x('Nhập đầy đủ họ và tên của bạn', 'placeholder', 'devvn'),
    'required' => true,
    'class' => array('form-row-wide'),
    'clear' => true
  );
  $fields['billing']['billing_address_1']['placeholder'] = 'Ví dụ: Số xx Ngõ xx Phú Kiều, Bắc Từ Liêm, Hà Nội';
 
  unset($fields['shipping']['shipping_company']);
  unset($fields['shipping']['shipping_postcode']);
  unset($fields['shipping']['shipping_country']);
  unset($fields['shipping']['shipping_city']);
  unset($fields['shipping']['shipping_state']);
  unset($fields['shipping']['shipping_address_2']);
 
  $fields['shipping']['shipping_phone'] = array(
    'label' => __('Điện thoại', 'devvn'),
    'placeholder' => _x('Số điện thoại người nhận hàng', 'placeholder', 'devvn'),
    'required' => true,
    'class' => array('form-row-wide'),
    'clear' => true
  );
  $fields['shipping']['shipping_last_name'] = array(
    'label' => __('Họ và tên', 'devvn'),
    'placeholder' => _x('Nhập đầy đủ họ và tên của người nhận', 'placeholder', 'devvn'),
    'required' => true,
    'class' => array('form-row-wide'),
    'clear' => true
  );
  $fields['shipping']['shipping_address_1']['placeholder'] = 'Ví dụ: Số xx Ngõ xx Phú Kiều, Bắc Từ Liêm, Hà Nội';
 
  return $fields;
}
 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
  echo '<p><strong>'.__('Số ĐT người nhận').':</strong> <br>' . get_post_meta( $order->id, '_shipping_phone', true ) . '</p>';
}


add_filter( 'woocommerce_email_recipient_new_order', 'disable_new_order_for_on_hold_order_status', 10, 2 );
function disable_new_order_for_on_hold_order_status( $recipient, $order = false ) {
    if ( ! $order || ! is_a( $order, 'WC_Order' ) ) 
        return $recipient;

    return $order->get_status() === 'on-hold' ? '' : $recipient;
}

wp_enqueue_style( '6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');

function ttit_add_element_ux_builder(){
  add_ux_builder_shortcode('title_with_cat', array(
    'name'      => __('Title With Category'),
    'category'  => __('Content'),
    'info'      => '{{ text }}',
    'wrap'      => false,
    'options' => array(
      'ttit_cat_ids' => array(
        'type' => 'select',
        'heading' => 'Categories',
        'param_name' => 'ids',
        'config' => array(
          'multiple' => true,
          'placeholder' => 'Select...',
          'termSelect' => array(
            'post_type' => 'product_cat',
            'taxonomies' => 'product_cat'
          )
        )
      ),
      'style' => array(
        'type'    => 'select',
        'heading' => 'Style',
        'default' => 'normal',
        'options' => array(
          'normal'      => 'Normal',
          'center'      => 'Center',
          'bold'        => 'Left Bold',
          'bold-center' => 'Center Bold',
        ),
      ),
      'text' => array(
        'type'       => 'textfield',
        'heading'    => 'Title',
        'default'    => 'Lorem ipsum dolor sit amet...',
        'auto_focus' => true,
      ),
      'tag_name' => array(
        'type'    => 'select',
        'heading' => 'Tag',
        'default' => 'h3',
        'options' => array(
          'h1' => 'H1',
          'h2' => 'H2',
          'h3' => 'H3',
          'h4' => 'H4',
        ),
      ),
      'color' => array(
        'type'     => 'colorpicker',
        'heading'  => __( 'Color' ),
        'alpha'    => true,
        'format'   => 'rgb',
        'position' => 'bottom right',
      ),
      'width' => array(
        'type'    => 'scrubfield',
        'heading' => __( 'Width' ),
        'default' => '',
        'min'     => 0,
        'max'     => 1200,
        'step'    => 5,
      ),
      'margin_top' => array(
        'type'        => 'scrubfield',
        'heading'     => __( 'Margin Top' ),
        'default'     => '',
        'placeholder' => __( '0px' ),
        'min'         => - 100,
        'max'         => 300,
        'step'        => 1,
      ),
      'margin_bottom' => array(
        'type'        => 'scrubfield',
        'heading'     => __( 'Margin Bottom' ),
        'default'     => '',
        'placeholder' => __( '0px' ),
        'min'         => - 100,
        'max'         => 300,
        'step'        => 1,
      ),
      'size' => array(
        'type'    => 'slider',
        'heading' => __( 'Size' ),
        'default' => 100,
        'unit'    => '%',
        'min'     => 20,
        'max'     => 300,
        'step'    => 1,
      ),
      'link_text' => array(
        'type'    => 'textfield',
        'heading' => 'Link Text',
        'default' => '',
      ),
      'link' => array(
        'type'    => 'textfield',
        'heading' => 'Link',
        'default' => '',
      ),
    ),
  ));
}
add_action('ux_builder_setup', 'ttit_add_element_ux_builder');


function title_with_cat_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    '_id' => 'title-'.rand(),
    'class' => '',
    'visibility' => '',
    'text' => 'Lorem ipsum dolor sit amet...',
    'tag_name' => 'h3',
    'sub_text' => '',
    'style' => 'normal',
    'size' => '100',
    'link' => '',
    'link_text' => '',
    'target' => '',
    'margin_top' => '',
    'margin_bottom' => '',
    'letter_case' => '',
    'color' => '',
    'width' => '',
    'icon' => '',
  ), $atts ) );
  $classes = array('container', 'section-title-container');
  if ( $class ) $classes[] = $class;
  if ( $visibility ) $classes[] = $visibility;
  $classes = implode(' ', $classes);
  $link_output = '';
  if($link) $link_output = '<a href="'.$link.'" target="'.$target.'">'.get_flatsome_icon('icon-angle-right').$link_text.'</a>';
  $small_text = '';
  if($sub_text) $small_text = '<small class="sub-title">'.$atts['sub_text'].'</small>';
  if($icon) $icon = get_flatsome_icon($icon);
  // fix old
  if($style == 'bold_center') $style = 'bold-center';
  $css_args = array(
   array( 'attribute' => 'margin-top', 'value' => $margin_top),
   array( 'attribute' => 'margin-bottom', 'value' => $margin_bottom),
  );
  if($width) {
    $css_args[] = array( 'attribute' => 'max-width', 'value' => $width);
  }
  $css_args_title = array();
  if($size !== '100'){
    $css_args_title[] = array( 'attribute' => 'font-size', 'value' => $size, 'unit' => '%');
  }
  if($color){
    $css_args_title[] = array( 'attribute' => 'color', 'value' => $color);
  }
  if ( isset( $atts[ 'ttit_cat_ids' ] ) ) {
    $ids = explode( ',', $atts[ 'ttit_cat_ids' ] );
    $ids = array_map( 'trim', $ids );
    $parent = '';
    $orderby = 'include';
  } else {
    $ids = array();
  }
  $args = array(
    'taxonomy' => 'product_cat',
    'include'    => $ids,
    'pad_counts' => true,
    'child_of'   => 0,
  );
  $product_categories = get_terms( $args );
  $hdevvn_html_show_cat = '';
  if ( $product_categories ) {
    foreach ( $product_categories as $category ) {
      $term_link = get_term_link( $category );
      $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
      if ( $thumbnail_id ) {
        $image = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size);
        $image = $image[0];
      } else {
        $image = wc_placeholder_img_src();
      }
      $hdevvn_html_show_cat .= '<li class="hdevvn_cats"><a href="'.$term_link.'">'.$category->name.'</a></li>';
    }
  }
  return '<div class="'.$classes.'" '.get_shortcode_inline_css($css_args).'><'. $tag_name . ' class="section-title section-title-'.$style.'"><b></b><span class="section-title-main" '.get_shortcode_inline_css($css_args_title).'>'.$icon.$text.$small_text.'</span>
  <span class="hdevvn-show-cats">'.$hdevvn_html_show_cat.'</span><b></b>'.$link_output.'</' . $tag_name .'></div><!-- .section-title -->';
}
add_shortcode('title_with_cat', 'title_with_cat_shortcode');

/*
 register_sidebar( array(
  'name'          => __( 'Product Sidebar 2', 'flatsome' ),
  'id'            => 'product-sidebar-2',
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget'  => '</aside>',
  'before_title'  => '<span class="widget-title shop-sidebar">',
  'after_title'   => '</span><div class="is-divider small"></div>',
) );




function my_custom_translations( $strings ) {
$text = array(
'Thêm vào giỏ hàng' => 'Mua hàng',
'quick view' => 'Xem nhanh',
);
$strings = str_ireplace( array_keys( $text ), $text, $strings );
return $strings;
}
add_filter( 'gettext', 'my_custom_translations', 20 );



add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post', '__return_false', 10, 2);

add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

function thongso(){
?>

<div class="cdt-product__config">
  <div class="cdt-product__config__param">
    <?php if(get_field('Chip')){ ?>
      <span data-title="CPU"><i class="icon2-cpu"></i><?php the_field('Chip')?></span>
    <?php } ?>
    <?php if(get_field('man_hinh')){ ?>
      <span data-title="Màn hình"><i class="icon2-mobile"></i><?php the_field('man_hinh')?></span>
    <?php } ?>
    <?php if(get_field('ram')){ ?>
    <span data-title="RAM"><i class="icon2-ram"></i><?php the_field('ram')?></span>
    <?php } ?>
    <?php if(get_field('bo_nho')){ ?>
    <span data-title="Bộ nhớ trong"><i class="icon2-hdd-black"></i><?php the_field('bo_nho')?></span>
    <?php } ?>
  </div>
</div>

<?php
}

add_action('flatsome_product_box_after','thongso');


*/


function thongso1(){
ob_start();
?>
<div class="card-body"><div class="st-pd-table"><?php the_field('thong_so')?><div class="st-pd-table-viewDetail"><a href="#thongso" class="re-link js--open-modal">Xem cấu hình chi tiết <span class="carret"></span></a></div></div></div>


<?php echo do_shortcode('[lightbox id="thongso" width="800px" padding="0px"]<div class="card-normal"><h2 class="card-title">Chi tiết thông số kỹ thuật '.get_the_title().'</span></h2><div class="st-pd-table">'.get_field('thong_so_chi_tiet').'</div></div>[/lightbox]')?>
<?php
$result = ob_get_contents();
ob_end_clean();
return $result;
}
add_shortcode('thongso', 'thongso1');



// Nhóm sản phẩm
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_634e10210fb8f',
	'title' => 'Tên rút gọn',
	'fields' => array(
		array(
			'key' => 'field_634e102126669',
			'label' => 'Tên rút gọn',
			'name' => 'ten_rut_gon',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
function cptui_register_my_taxes_dong_san_pham() {

	/**
	 * Taxonomy: Dòng sản phẩm.
	 */

	$labels = [
		"name" => esc_html__( "Dòng sản phẩm", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Dòng", "custom-post-type-ui" ),
		"menu_name" => esc_html__( "Dòng", "custom-post-type-ui" ),
		"all_items" => esc_html__( "Dòng", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Dòng sản phẩm", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'dong_san_pham', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "dong_san_pham",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "dong_san_pham", [ "product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_dong_san_pham' );

add_shortcode( 'lnh_same_type_products', 'bbloomer_echo_product_ids_belong_to_tag' );
add_action( 'flatsome_custom_single_product_1', 'bbloomer_echo_product_ids_belong_to_tag' );
function bbloomer_echo_product_ids_belong_to_tag($product) {
 global $product;
	$cur_id= $product->get_id();
   // HERE below define your custom taxonomy
   	$taxonomy = 'dong_san_pham';
   	$terms = wp_get_post_terms( $product->get_id(), $taxonomy, ['fields' => 'names']);
   	$all_ids = get_posts( array(
      'post_type' => 'product',
      'numberposts' => -1,
      'post_status' => 'publish',
      'fields' => 'ids',
      'tax_query' => array(
         array(
            'taxonomy' => 'dong_san_pham',
            'field' => 'slug',
            'terms' => implode(', ', $terms),
            'operator' => 'IN'
         )
      ),
   ) );
//phần giá sản phẩm

	 if( ! empty($terms) ) {
		 ?>
		 <style>
			ul.properties.clearfix, .properties.clearfix li {
			margin: 0;
			}
			.properties li {
			display: block;
			line-height: 30px;
			}
			.links {
			display: inline-block;
			padding: 0;
			align-content: center;
			}
			.links .label.checked {
			font-weight: 600;
			border: 1px solid #f89008;
			}
			.links .label {
			position: relative;
			background: #fff;
			color: #333;
			border: 1px solid #ddd;
			-moz-box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .15);
			-webkit-box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);
			box-shadow: 0 2px 3px 0 rgb(0 0 0 / 15%);
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			float: left;
			text-align: center;
			padding: 10px;
			margin-right: 10px;
			margin-bottom: 10px;
			min-width: 46%;
			}
			.product_details a {
			color: #288ad6;
			}
			.links .label span {
			display: block;
			line-height: 16px;
			}
			.links .label span:before {
			width: 12px;
			height: 12px;
			content: " ";
			background: #ffff;
			border: 1px solid #ddd;
			border-radius: 10px;
			text-align: center;
			padding: 0;
			line-height: 12px;
			display: inline-block;
			vertical-align: middle;
			font-size: 10px;
			margin-right: 5px;
			}
			.links .checked span::before {
			content: "✓" !important;
			background: #3fb846 !important;
			border: 1px solid #3fb846 !important;
			color: #fff;
			}
			.links .label strong {
			font-size: 16px;
			display: block;
			margin-top: 5px;
			color: #e10c00;
			height: 20px;
			line-height: 20px;
			}
		 </style>
		 <?php
        // Display the term names 
		/*
		 echo '<ul class="properties clearfix"><li><p class="' . $taxonomy . '">Has <strong class="attr_number">'.count($all_ids).'</strong> models of <strong class="attr_selected">' . implode(', 		', $terms) . '</strong></p>'; */
		echo '<span class="links">';
		$inventory = array();
		foreach ( $all_ids as $id ) {
			$_product = wc_get_product( $id );
			if ($id == $cur_id){
				 echo '<a class="label checked" href="'.$_product->get_permalink().'"><span>'.get_post_meta( $id, 'ten_rut_gon', true ).'</span><strong>'.number_format ( $_product->get_price() , $decimals = 0 , $dec_point = "," , $thousands_sep = "." ).' ₫</strong></a>';
			 }
			 else {
				 echo '<a class="label" href="'.$_product->get_permalink().'"><span>'.get_post_meta( $id, 'ten_rut_gon', true ).'</span><strong>'.number_format ( $_product->get_price() , $decimals = 0 , $dec_point = "," , $thousands_sep = "." ).' ₫</strong></a>';
			 }
		}
		 echo '</span></li></ul>';
		}
}


// Tạo shortcode cho nút xóa bộ lọc
function clear_filter_button_shortcode() {
    // Kiểm tra xem có bộ lọc nào đang được áp dụng hay không
    if (isset($_GET['min_price']) || isset($_GET['max_price']) || isset($_GET['filter_brand']) || isset($_GET['filter_color']) || isset($_GET['filter_size'])) {
        // Tạo URL để xóa bộ lọc
        $shop_page_url = get_permalink(woocommerce_get_page_id('shop'));
        
        // HTML cho nút xóa bộ lọc
        return '<a href="' . esc_url($shop_page_url) . '" class="button clear-filters">Xóa bộ lọc</a>';
    }
}
add_shortcode('clear_filter_button', 'clear_filter_button_shortcode');

