<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mtminimag
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// Comments form
global $aria_req;
$comments_args = array(
    // remove "Text or HTML to be displayed after the set of comment fields"
    'title_reply' => '<h5 class="blog-item-title-style2"><b>' . esc_html__('Leave a Comment', 'mtminimag') . '</b></h5>',
    'id_submit'         => 'submit',
    'class_submit'      => 'btn btn-black',
	'name_submit'       => 'submit',
	'class_form'      => 'row justify-content-center ',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'fields' => $fields =  array(
        'author' =>
            '<div class="col-md-4">
				<div class="form-group">
                    <input class="form-control" name="author" id="author" type="text"  placeholder="' . esc_html__('Full Name', 'mtminimag') . '" value="' . esc_attr($commenter['comment_author']) . '" size="19"' . $aria_req . ' required />
                </div>
            </div>',
        'email' =>
            '<div class="col-md-4">
                <div class="form-group">
					<input id="emailaddress" name="email" class="form-control" placeholder="' . esc_html__('Email Address', 'mtminimag') . '" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="19"' . $aria_req . ' required />
                </div>
            </div>',
        'url' =>
            '<div class="col-md-4">
                <div class="form-group">
					<input id="website" name="url" type="text" class="form-control" placeholder="' . esc_html__('Website', 'mtminimag') . '" value="' . esc_attr($commenter['comment_author_url']) . '" size="19" />
                </div>
            </div>',
    ),
    'comment_field' => 
        '<div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" id="comment" name="comment" placeholder="' . esc_html__('Comment', 'mtminimag') . '" cols="45" rows="8" aria-required="true"></textarea>
            </div>
        </div>',
    'label_submit' => esc_html__('Post Comment', 'mtminimag'),
);
?>

<?php 
// Comment list
if (have_comments()) :
    $comments_count = wp_count_comments($post->ID)->approved;
?>
    <div id="comments" class="comments-area mt-sept">
        <h3 class="comments-heading"><?php echo esc_html($comments_count); ?> <?php esc_html_e('Comments', 'mtminimag'); ?></h3>
        
        <ul class="comments-list">
            <?php wp_list_comments( 'type=comment&callback=mtminimag_comment' ); ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : 
            ?>
            <nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" class="commentnavi pagination">
                <h2 class="screen-reader-text">
                    <?php esc_html_e('Comments navigation', 'mtminimag'); ?>
                </h2>
                <div class="nav-links">
                    <?php paginate_comments_links(); ?>
                </div>
            </nav>
        <?php endif; ?>

    </div><!-- Post comment end -->

<?php else : ?>

    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->
    <?php else : 
    ?>
        <!-- If comments are closed. -->
        <?php esc_html_e('Comments are disabled.', 'mtminimag'); ?>
    <?php endif; ?>

<?php endif; ?>

<div class="comments-form border-box mt-sept">
    <?php comment_form($comments_args); ?>
</div>
