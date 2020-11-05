<?php 
    if (post_password_required()){
        return;
    }
?>
 
<div id="comments" class="comments">
    <div id="comments_list">
    <?php 
        if(have_comments()) : ?>
            <h5 class="comments-title">
            <?php 
                printf( _nx('One comment on "%2$s"', '%1$s comments on "%2$s"', 
                        get_comments_number(),
                        'comments title'),
                    number_format_i18n(get_comments_number()), get_the_title());
            ?>
            </h5>
            <ul class="comment-list">
                <?php
                    wp_list_comments(array(
                        'walker' => new Startwordpress_Walker_Comment(),
                        'short_ping' => true,
                        'avatar_size' => 50,
                        'style' => 'ol',
                        'max-depth' =>  3,
                    ));
                ?>
            </ul>
        <?php else: ?>
            <h5 class="comments-title">0 comments on <?php echo get_the_title(); ?></h5>
        <? endif; ?>
        <?php if(!comments_open() && get_comments_number() 
            && post_type_supports(get_post_type(), 'comments')) : ?>
            <p class="no-comments">
                    <?php _e('Commetns are closed.'); ?>
            </p>
        <?php endif; ?>
    </div>
    <div id="comment_form">
        <?php
        $comment_reply = 'Share your thoughts';
        $comment_reply_to = 'Reply';
         
        $comment_author = 'Name';
        $comment_email = 'E-Mail';
        $comment_body = 'Comment';
        $comment_url = 'Website';
        $comment_cookies_1 = ' By commenting you accept the';
        $comment_cookies_2 = ' Privacy Policy';
         
        $comments_args = array(
            'fields' => array(
                'author' => '<p class="comment-form-author"><input type="text" id="author" name="author" required placeholder="' . $comment_author .'"></input></p>',
                'email' => '<p class="comment-form-email"><input type="email" id="email" name="email" required placeholder="' . $comment_email .'"></input></p>',
                'url' => '<p class="comment-form-url"><input type="text" id="url" name="url" placeholder="' . $comment_url .'"></input></p>',
                'cookies' => '<p class="comment-form-cookies"><label><input type="checkbox" name="cookies" required><span id="check"></span>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a><label></p>',
            ),
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Your comment" required cols="45" rows="8" maxlength="400"></textarea></p>',
            'label_submit'=>$comment_reply_to,
            'title_reply'=>$comment_reply,
            'comment_notes_after' => '',
            'comment_notes_before' => ''
);

comment_form($comments_args);?>    
    </div>
</div>