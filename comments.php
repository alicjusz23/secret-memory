<?php 
    if (post_password_required()){
        return;
    }
?>
 
<div id="comments" class="comments">
    <div class="row">
        <!-- <div id="comments_list" class="col-sm-8 col-xs-11"> -->
        <div id="comments_list" class="col-lg-9 col-lg-offset-1 col-xs-12">
        <?php 
            if(have_comments()) : ?>
                <h5 class="comments-title">
                    <?php 
                        $c_title = '<span class="post-title-break">' . get_the_title() . '</span>' ;
                        printf( _n('%1$s comment on "%2$s"', '%1$s comments on "%2$s"', 
                                get_comments_number(),
                                'my-secret-memory'),
                            number_format_i18n(get_comments_number()), $c_title);
                    ?>
                </h5>

                <!-- Here inner comment part starts -->
                <ul class="comment-list">
                    <?php
                        wp_list_comments(array(
                            'walker' => new Mysecretmemory_Walker_Comment(),
                            'short_ping' => true,
                            'avatar_size' => 50,
                            'style' => 'ol',
                            'max-depth' =>  2,
                        ));
                    ?>
                </ul>

                <div class="commentPagination">
                    <?php paginate_comments_links(array(
                        'prev_text'=> __('<< Previous ','my-secret-memory'),
                        'next_text'=> __(' Next >>', 'my-secret-memory'),
                    )); ?> 
                </div>

            <?php else: ?>
                <h5 class="comments-title">0 <?php _e("comments on  \"", 'my-secret-memory');?><span class="post-title-break"><?php echo get_the_title() . "\""; ?></span></h5>
            <?php endif; ?>
            <?php if(!comments_open() && get_comments_number() 
                && post_type_supports(get_post_type(), 'comments')) : ?>
                <p class="no-comments">
                        <?php _e('Commetns are closed.', 'my-secret-memory'); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php if(comments_open()): ?>
        <div class="row">
            <div id="comment_form" class="col-lg-9 col-lg-offset-1 col-xs-12">
                <?php
                    $comment_reply = __("Share your thoughts", 'my-secret-memory');
                    $comment_reply_to = __("Reply", 'my-secret-memory');
                    
                    $comment_author = __("Name", 'my-secret-memory');
                    $comment_email = __("E-Mail", 'my-secret-memory');
                    $comment_body = __("Your comment", 'my-secret-memory');
                    $comment_url = __("Website", 'my-secret-memory');
                    $comment_cookies_1 = __(" By commenting you accept the", 'my-secret-memory');
                    $comment_cookies_2 = __(" Privacy Policy", 'my-secret-memory');
                    
                    $comments_args_array = array(
                        'author' => '<p class="comment-form-author"><input type="text" id="author" name="author" required placeholder="' . $comment_author .'"></input></p>',
                        'email' => '<p class="comment-form-email"><input type="email" id="email" name="email" required placeholder="' . $comment_email .'"></input></p>',
                        'url' => '<p class="comment-form-url"><input type="url" id="url" name="url" placeholder="' . $comment_url .'"></input></p>'
                        
                    );
                    if(get_privacy_policy_url()){
                        $comments_args_array = array_merge(
                            $comments_args_array,
                            array('cookies' => '<p class="comment-form-cookies"><label><input type="checkbox" name="cookies" required><span id="check"></span>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a><label></p>')
                        );
                    }else{
                        $comments_args_array = array_merge(
                            $comments_args_array,
                            array('cookies' => '')
                        );
                    }

                    $comments_args = array(
                        'fields' => $comments_args_array,
                        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . $comment_body . '" required cols="45" rows="8" maxlength="400"></textarea></p>',
                        'label_submit'=>$comment_reply_to,
                        'title_reply'=>$comment_reply,
                        'comment_notes_after' => '',
                        'comment_notes_before' => ''
                    );

                    comment_form($comments_args);
                ?>    
            </div>
        </div>
    <?php endif; ?>
</div>