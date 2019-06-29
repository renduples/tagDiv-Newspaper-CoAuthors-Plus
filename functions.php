<?php
/**
 * ==================================
 * Action: pmxi_saved_post
 * ==================================
 *
 * R3N13R
 * Triggered after a post has been saved
 *
 * @param $post_id int - The imported post id passed by WP Allimport hook
 * @param $author_str string - Author_ids comma delimited (saved in a custom field)
 *
 * BEWARE: WP Allimport sometimes fail if we use double quotes in functions
 *
 * Test using PHP CLI: php mywebdir/wp-content/uploads/wpallimport/functions.php
 * Uncomment 3 lines below to test, but comment out before running WP Allimport 
  
  define('ROOT_DIR', realpath(__DIR__.'/../../..'));
  require_once ROOT_DIR .'/wp-load.php';
  import_coauthors(9108, '');
 */

function import_coauthors($post_id) 
{	

	if (empty($post_id)){		
				echo 'No postid value';
	} else {

		$author_str = get_post_meta( $post_id, '_cap_import_author', true);

		if ( function_exists( 'set_post_coauthors' ) ) {

			$result = set_post_coauthors( $post_id, $author_str );
			update_post_meta($post_id, '_cap_import_result', $result);
			echo $result;

		} else {

		    echo 'You forgot to edit /wp-content/plugins/co-authors-plus/template-tags.php';
			update_post_meta($post_id, '_cap_import_result', 'Edit the author plus template');
		}
			
		
	}
}

// Comment this out when testing with PHP CLI
add_action('pmxi_saved_post', 'import_coauthors', 10, 1);

?>
