<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<link href="<?php echo get_field( 'favicon', 10 ); ?>" rel="shortcut icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- wrapper -->
<div class="wrapper">

	<!-- header -->
    <?php if(getimagesize(get_field( 'video', 10 )) === false) : ?>
            <header id="header" class="header clear">
            <video src="<?php echo get_field( 'video', 10 ); ?>" autoplay loop muted playsinline></video>
        <?php else: ?>
            <header 
                id="header"
                class="header clear header-bg"
                style="background-image:url(<?php echo get_field( 'video', 10 ); ?>)"
            >
        <?php endif; ?>

        <div class="logo-container">
            <div class="logo-img" style="background-image: url(<?php echo get_field( 'logo', 10 ); ?>"></div>
        </div>
        <?php $prijava = get_field( "prijava", 10 ); ?>
        <?php $prodavnica = get_field( "prodavnica", 10 ); ?>
        <?php $volontiraj = get_field( "volontiraj", 10 ); ?>
        <?php if($prijava || $volontiraj) :?>
        <div class="button-container">
            <div>
            <?php if($prijava) : ?>
            <a href="<?php echo $prijava['url'] ?>" target="<?php echo $prijava['target'];  ?>"><?php echo $prijava['title']; ?></a>
            <?php endif; ?>
            <?php if($prodavnica) : ?>
                <a href="<?php echo $prodavnica['url'] ?>" target="<?php echo $prodavnica['target'];  ?>"><?php echo $prodavnica['title']; ?></a>
            <?php endif; ?>
            </div>
	        <?php if($volontiraj) : ?>
            <a class="volontiranje" role="button" tabindex="0" onclick="showVolontiranje()" target="<?php echo $volontiraj['target']; ?>"><?php echo $volontiraj['title']; ?></a>
	        <?php endif; ?>
        </div>
        <?php endif; ?>
		<?php if($volontiraj) : ?>
        <div class="prijava-volontiranje">
            <span class="dashicons dashicons-no-alt" onclick="showVolontiranje()"></span>
            <div class="logo-container-prijava">
                <div class="logo-img" style="background-image: url(<?php echo get_field( 'logo', 10 ); ?>"></div>
            </div>
            <div class="prijava-form">
                <h4><?php echo get_field( 'naslov_forme_za_volontere', 10 ); ?>!</h4>
                <p><?php echo get_field( 'text_volontera', 10 ); ?></p>
                <form id="sendThisEntry" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <div>
                        <label for="name">Ime</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="lastname">Prezime</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                    <div>
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="number">Br. telefona</label>
                        <input type="tel" id="number" name="number" required>
                    </div>
                    <button type="submit">Prijavi se!</button>
                    <p class="ajax-msg"></p>
                </form>
            </div>
        </div>
		<?php endif; ?>

    </header>
	<!-- /header -->