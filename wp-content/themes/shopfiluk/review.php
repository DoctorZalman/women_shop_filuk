<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="toch-reviews">
	<div class="toch-table">
		<table class="table table-striped table-bordered">
			<tbody>
		<?php
		if ( $comments = get_comments( [
			'post_id' => get_the_ID(),
			'order'   => 'ASC',
			'status'  => 'approve'
		] ) ) :
			foreach ( $comments as $comment ) :
				$rat = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>

					 <tr>
						 <td><strong><?php comment_author(); ?></strong></td>
						 <td class="text-right"><strong><?php comment_date(); ?></strong></td>
					 </tr>
					 <tr>
						 <td colspan="2">
							 <?php comment_text(); ?>
							 <?php wp_star_rating( [ 'rating' => $rat ] ); ?>
						 </td>
					 </tr>

			<?php endforeach; endif; ?>

			</tbody>
		</table>
	</div>
	<?php global $product;
	if ( ! comments_open() ) {
		return;
	} ?>
	<div class="review-message">
	  <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div class="col-xs-12">
		 <?php
//		 if ( wc_review_ratings_enabled() ) {
//
//		 };

	  comment_form([
		  'comment_field' => '<p><sup>*</sup>Коментар <br>
				<textarea id="comment" name="comment" class="form-control"></textarea>
			</p>' . '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) .'</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>',

		  'fields' => [
			  'author' => '<p><sup>*</sup>Ім\'я <br>
											<input id="author" name="author" type="text" class="form-control"/>
										</p>',
			  'email' => '<p><sup>*</sup>Email <br>
											<input id="email" name="email" type="email" class="form-control"/>
										</p>'
		  ],

		  'class_submit'  => 'btn btn-primary pull-right',
		  'label_submit'  => __('Post Comment'),
		  'title_reply'   => 'Залишіть коментар',
	  ]);
		 ?>

	</div>

	<div id="reviews" class="woocommerce-Reviews">

			 <div id="review_form_wrapper">
				 <div id="review_form">

				 </div>
			 </div>
	  <?php else : ?>
			 <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	  <?php endif; ?>

		<div class="clear"></div>
	</div>
</div>


