<?php

/*
@package ur_theme_bgnocnipolumaraton

	=====================
    THEME SUPPORT OPTIONS
	=====================
*/


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


function add_taxonomies_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_taxonomies_to_pages' );

function post_remove ()      //creating functions post_remove for removing menu item
{
	if (!current_user_can('manage_options')) {
		add_action( 'admin_init', 'give_seo_yoastToast');
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php?post_type=cfs' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php?post_type=page' );
		remove_menu_page( 'index.php' );                  //Dashboard

		add_menu_page( 'Header', 'Header', 'edit_posts', 'post.php?post=10&action=edit', '', 'dashicons-welcome-widgets-menus', 5 );
		add_menu_page( 'Info', 'Info', 'edit_posts', 'post.php?post=28&action=edit', '', 'dashicons-info', 6 );
		add_menu_page( 'Agenda', 'Agenda', 'edit_posts', 'post.php?post=35&action=edit', '', 'dashicons-editor-ul', 7 );
		add_menu_page( 'Obezbeđeno', 'Obezbeđeno', 'edit_posts', 'post.php?post=85&action=edit', '', 'dashicons-awards', 8 );
		add_menu_page( 'Pomoći', 'Pomoći', 'edit_posts', 'post.php?post=158&action=edit', '', 'dashicons-heart', 9 );
		add_menu_page( 'Sponzori', 'Sponzori', 'edit_posts', 'post.php?post=39&action=edit', '', 'dashicons-carrot', 10 );
		add_menu_page( 'Prijatelji', 'Prijatelji', 'edit_posts', 'post.php?post=145&action=edit', '', 'dashicons-groups', 11 );
        add_menu_page( 'Shop', 'Shop', 'edit_posts', 'post.php?post=405&action=edit', '', 'dashicons-products', 12 );
        add_menu_page( 'Faq', 'Faq', 'edit_posts', 'post.php?post=409&action=edit', '', 'dashicons-info-outline', 13 );
        add_menu_page( 'Footer', 'Footer', 'edit_posts', 'post.php?post=47&action=edit', '', 'dashicons-welcome-widgets-menus', 14 );

		// disable for posts
		add_filter('use_block_editor_for_post', '__return_false', 10);

		// disable for post types
		add_filter('use_block_editor_for_post_type', '__return_false', 10);
	}
}

add_action('admin_menu', 'post_remove');   //adding action for triggering function call

add_filter('get_sample_permalink_html', '', 10, 5);



add_action( 'wp_ajax_nopriv_nocni_send_entry_back', 'nocni_send_entry' );
add_action( 'wp_ajax_nocni_send_entry_back', 'nocni_send_entry' );


add_action( 'wp_ajax_nopriv_nocni_send_email_back', 'nocni_send_email' );
add_action( 'wp_ajax_nocni_send_email_back', 'nocni_send_email' );

function ur_login_logo() { ?>
	<style type="text/css">
        body {
            background-color: #393e45!important;
        }
        .login #backtoblog a, .login #nav a {
            color: #fff!important;
        }
        .login #backtoblog a:hover, .login #nav a:hover {
            color: #0092ca!important;
        }
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_field( "logo", 10 ); ?>);
			width:100%;
			background-size: auto 100%;
			background-repeat: no-repeat;
			padding-bottom: 5px;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'ur_login_logo' );

function ur_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'ur_login_logo_url' );

function ur_login_logo_url_title() {
	return 'Zimski noćni polumaraton';
}
add_filter( 'login_headertitle', 'ur_login_logo_url_title' );

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if (isset($user->roles) && is_array($user->roles)) {
		//check for subscribers
		if (in_array('editor', $user->roles) || in_array('administrator', $user->roles)) {
			// redirect them to another URL, in this case, the homepage
			$redirect_to =  'wp-admin/admin.php?page=home_page';
		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


function nocni_send_email () {
    $blog = get_bloginfo('name');
	$name = wp_strip_all_tags($_POST['name']);
	$email = wp_strip_all_tags($_POST['email']);
	$number = wp_strip_all_tags($_POST['number']);
	$message = wp_strip_all_tags($_POST['message']);

	$to = 'zimskinocnipolumaraton@gmail.com';
	$subject = 'Kontakt forma - Zimski noćni polumaraton';

	$allmessage = "
						<html>
							<head>
								<style>
								    p {
								        border: 0px;
								        padding:0;
								        margin:0 0 15px 0;
								        border-collapse: collapse;
								        color: black;
								    }
								    
								    h4 {
								    	text-decoration: underline;								    
								    }
								    p span {
								    	font-weight: bold;	
								    }
								</style>
								<title>HTML email</title>
							</head>
							<body>
								<h4>Kontakt forma</h4>
								<p><span>Ime:</span> $name</p>
								<p><span>E-mail:</span>	$email</p>
								<p><span>Broj:</span> $number</p>
								<p><span>Poruka:</span> $message</p>
							</body>		
						</html>
						";

	$headers[] = 'From: '.$blog.' <'. $to .'>';
	$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
	$headers[] = 'Content-Type: text/html; charset=utf-8';

	wp_mail($to, $subject, $allmessage, $headers);
}

function nocni_send_entry () {
	$blog = get_bloginfo('name');
	$name = wp_strip_all_tags($_POST['name']);
	$lastname = wp_strip_all_tags($_POST['lastname']);
	$email = wp_strip_all_tags($_POST['email']);
	$number = wp_strip_all_tags($_POST['number']);

	$to = 'zimskinocnipolumaraton@gmail.com';
	$subject = 'Prijava volontera - Zimski noćni polumaraton';

	$allmessage = "
						<html>
							<head>
								<style>
								    p {
								        border: 0px;
								        padding:0;
								        margin:0 0 15px 0;
								        border-collapse: collapse;
								        color: black;
								    }
								    
								    h4 {
								    	text-decoration: underline;								    
								    }
								    p span {
								    	font-weight: bold;	
								    }
								</style>
								<title>HTML email</title>
							</head>
							<body>
								<h4>Prijava Volontera:</h4>
								<p><span>Ime:</span> $name</p>
                                <p><span>Prezime:</span> $lastname</p>
								<p><span>E-mail:</span>	$email</p>
								<p><span>Broj:</span> $number</p>
							</body>		
						</html>
						";

	$headers[] = 'From: '.$blog.' <'. $to .'>';
	$headers[] = 'Reply-To: '.$name.' <'.$email.'>';
	$headers[] = 'Content-Type: text/html; charset=utf-8';

	wp_mail($to, $subject, $allmessage, $headers);
}

add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    print_r($wp_error);
}