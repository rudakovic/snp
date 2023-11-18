<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/img/favicon2.png" rel="shortcut icon">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/404.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

</head>
<body>
<main>
    <div class="logoDiv" style="background-image: url(<?php echo get_field( 'logo', 10 ); ?>)"></div>
    <div class="textDiv">
        <div class="textDivArea">
            <h1><span>404</span> Stranica nije pronađena!</h1>
            <p>Vrati se na <a href="<?php echo home_url() ?>">početnu</a></p>
        </div>
    </div>
</main>
<footer>
</footer>
</body>
</html>