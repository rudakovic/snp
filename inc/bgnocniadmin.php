<?php
echo '<style>
body {background-color:#393e45;}
</style>
';
$shortdes = get_bloginfo('name');
$des = explode('-', $shortdes);
$des = $des[1];
$current_user = wp_get_current_user();

echo '<div class="logo logo-admin" style="background-image: url( ' . get_field( "logo", 10 ) . ')"></div>';
echo '<div class="logo"><p>'.$des.'</p></div>';
echo '<div class="logo">';
if (!empty($current_user->user_firstname)) {
	echo '<h2> ' . $current_user->user_firstname . ', dobrodošli na sajt!</h2>';
	echo '<p>Za promenu podataka izabrati nešto iz levog menija.</p>';
}
else{
	echo '<h2> ' . $current_user->user_login . ', dobrodošli na sajt!</h2>';
	echo '<p>Za promenu podataka izabrati nešto iz levog menija.</p>';
}

echo '</div>';