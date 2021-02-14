<?php

	class Mysecretmemory_Walker_Comment extends Walker_Comment {
			var $tree_type = 'comment';
			var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
	 
			
			function __construct() { ?>
				<section class="comments-list">
			<?php }
	
			
			function start_lvl( &$output, $depth = 0, $args = array() ) {
				$GLOBALS['comment_depth'] = $depth + 2; ?>
				
				<section class="child-comments comments-list">
	
			<?php }
		
			
			function end_lvl( &$output, $depth = 0, $args = array() ) {
				$GLOBALS['comment_depth'] = $depth + 2; ?>
	
				</section>
	
			<?php }
	

			function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
				$depth++;
				$GLOBALS['comment_depth'] = $depth;
				$GLOBALS['comment'] = $comment;
				$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
		
				global $post;
				$author = $comment->comment_author_email === get_userdata($post->post_author)->user_email ? true : false;
				
				$tag = 'article';
				$add_below = 'comment';
				?>
			
				<article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent'); ?> id="comment-<?php comment_ID(); ?>">
					<?php if($comment->comment_type!="pingback" && $comment->comment_type!="trackback"): ?>
					<div class="single-comment">
						<div class="comment-meta post-meta">
							<div class="container comments-container">
								<div class="row">
									<div class="col-xs-2 col-sm-1 comment-avatar">	
										<?php echo get_avatar( $comment, 30); ?>
									</div>
									<div class="col-xs-10 col-sm-11">
										<h4 class="comment-author">
											<a class="comment-author-link" href="
												<?php 
													if($comment->user_id > 0){
														// url to post author
														echo esc_url(get_home_url() . "/author/"  .  get_user_by('id', $comment->user_id)->nickname);
													}else{
														// url provided by comment author
														comment_author_url(); 
													}
												?>"
											> 
											<?php 
												comment_author(); if($author){ _e(" (author)", "my-secret-memory"); }?></a>
											
											<p><?php if($depth>1) { ?>
												<span class="activ-com">
													<?php _e("Replied on ", 'my-secret-memory'); ?>
												</span>
											<?php } else { ?>
												<span class="activ-com">
													<?php _e("Commented on ", 'my-secret-memory'); ?>
												</span>
											<?php } ?>
											<time class="comment-meta-item" ><?php echo get_comment_date(get_option('date_format')); ?>, <?php comment_time() ?></time>
											<?php edit_comment_link('<i class="comment-meta-item fa fa-pencil icomment" title="Edit"></i>','',''); ?>
											<?php
												if($depth<10)
													 comment_reply_link(array_merge( $args, array('reply_text' => __('<i class="fa fa-reply icomment" title="Reply"></i>', 'my-secret-memory'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
											</p>
										</h4>
										<?php if ($comment->comment_approved == '0') : ?>
											<p class="comment-meta-item comment-not-approved">
												<?php __("Your comment is awaiting moderation.", "my-secret-memory"); ?>
											</p>
										<?php endif; 
										?>
										<div class="comment-content">
											<div class="comment-text">
												<?php comment_text() ?>
											</div>
											
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php else:?>
						<div class="single-comment">
							<div class="comment-meta post-meta">
								<div class="container comments-container">
									<div class="row">
										<div class="col-xs-12">	
										<h4 class="comment-author">
											<a class="comment-author-link" href="
												<?php 
													if($comment->user_id > 0){
														// url to post author
														echo esc_url(get_home_url() . "/author/"  .  get_user_by('id', $comment->user_id)->nickname);
													}else{
														// url provided by comment author
														comment_author_url(); 
													}
												?>"
											> 
											<?php 
												comment_author(); if($author){ _e(" (author)", "my-secret-memory"); }?></a>
											
										</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
	
			<?php }
	

			function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
	
				</article>
	
			<?php }
	

			function __destruct() { ?>
	
				</section>
			
			<?php }
	
		}
	?>