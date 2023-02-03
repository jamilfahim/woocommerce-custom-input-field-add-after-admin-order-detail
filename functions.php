//======================================================
//   Add custom tracking field after admin order details
//======================================================
function my_custom_tracking_field( $order ) {
	echo '<p class="form-field-wide"><div class="order_data_column"><h3>Tracking</h3></div><p>';
  echo '<p class="form-field-wide"><div class="my-custom-field">';
  woocommerce_form_field( '_innaree_tracking_code', array(
    'type' => 'text',
    'label' => __( 'Tracking Code', 'woocommerce' ),
    'required' => false,
  ), get_post_meta( $order->get_id(), '_innaree_tracking_code', true ) );
  echo '<p></div>';
  echo '<div class="my-custom-field">';
  woocommerce_form_field( '_innaree_tracking_info', array(
    'type' => 'textarea',
    'label' => __( 'Tracking Info', 'woocommerce' ),
    'required' => false,
  ), get_post_meta( $order->get_id(), '_innaree_tracking_info', true ) );
  echo '</div>';
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'my_custom_tracking_field' );

//update tracking input value
function my_custom_field_update_order_meta( $order_id ) {
  if ( ! empty( $_POST['_innaree_tracking_code'] ) ) {
    update_post_meta( $order_id, '_innaree_tracking_code', sanitize_text_field( $_POST['_innaree_tracking_code'] ) );
  }
  if ( ! empty( $_POST['_innaree_tracking_info'] ) ) {
	update_post_meta( $order_id, '_innaree_tracking_info', sanitize_text_field( $_POST['_innaree_tracking_info'] ) );
 }
}
add_action( 'woocommerce_process_shop_order_meta', 'my_custom_field_update_order_meta' );
