<?php get_header();?>

    <main role="main">
        <div class="nav-bar">
            <nav>
                <div class="menu" onclick="menuEffect(this)">
                    <div class="bar preload"></div>
                    <div class="bar preload"></div>
                    <div class="bar preload"></div>
                </div>
                <a class="mobile-menu-hamburger"></a>
                <div class="linkovi">
	                <?php
                    $blah = CFS()->get( 'menu_items', 10 );
	                foreach($blah as $bla) {
		                foreach ($bla['menu_item_name'] as $what) {
			                echo '<a href="#' . strtolower($what) . '"><span>';
			                echo ($bla['menu_name']) ? $bla['menu_name'] : $what;
			                echo '</span></a>';
		                }
	                }
	                ?>
                </div>
            </nav>
        </div>

        <!-- section -->
        <section class="counter">
            <div class="counter-container-mw">
            <div class="counter-container">

                    <p><span id="days"></span><span id="daysT" class="word"></span></p>
                    <p><span id="hours"></span><span id="hoursT" class="word"></span></p>
                    <p><span id="minutes"></span><span id="minutesT" class="word"></span></p>
                    <p><span id="seconds"></span><span id="secondsT" class="word"></span></p>
                </div>
            </div>
            <div class="counter-text-container">
                <div class="counter-text">
                    <div class="counter-text-left">
                        <h1><?php echo get_field( 'slogan', 10 ); ?></h1>
                    </div>
                    <div class="counter-text-right">
                        <p><?php echo get_field( 'kratak_opis', 10 ); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section id="info" class="info">
            <h2>Info</h2>
            <div class="info-container">
                <div class="info-left">
                    <?php $trke = CFS()->get( 'trke', 28 );
                    foreach ( $trke as $trka ) : ?>
                        <h3><?php echo $trka['naziv_trke']; ?></h3>
	                    <p><?php echo $trka['opis_trke']; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="info-right">
                    <iframe src="<?php echo get_field( 'link_mape', 28 ); ?>" width="100%" height="100%" style="border:none;"></iframe>
                </div>
            </div>
            <?php $fajl = CFS()->get( 'file', 28 ); ?>
            <?php if($fajl) : ?>
            <div class="downloadInfo">
                <p class="preuzmi"><?php echo CFS()->get( 'text_informacija', 28 ) ?></p>
                <a href="<?php echo $fajl ?>" target="_blank">PREUZMI</a>
            </div>
            <?php endif; ?>
            <?php $fajl_eng = CFS()->get( 'file_eng', 28 ); ?>
            <?php if($fajl_eng) : ?>
                <div class="downloadInfo">
                    <p class="preuzmi"><?php echo CFS()->get( 'text_informacija_eng', 28 ) ?></p>
                    <a href="<?php echo $fajl_eng ?>" target="_blank">Download</a>
                </div>
            <?php endif; ?>
	        <?php $results = CFS()->get( 'rezultati', 28 ); ?>
	        <?php if($results) : ?>
            <div class="results">
                <h3>Rezultati</h3>
		        <?php foreach ( $results as $result ) : ?>
                <div>
                    <span><?php echo $result['godina_trke'] ?></span>
                    <span>
                        <?php foreach ($result['rezultati_trke'] as $raceResult) : ?>
                        <a href="<?php echo $raceResult['rezultat_discipline'] ?>" target="_blank"><?php echo $raceResult['disciplina'] ?></a>
                        <?php endforeach; ?>
                    </span>
                </div>
		        <?php endforeach; ?>
            </div>
		    <?php endif; ?>
        </section>
        <section id="agenda" class="agenda">
            <h2>Agenda</h2>
            <?php $dani = CFS()->get( 'dani', 35 ); ?>
            <?php if(CFS()->get('bez_prebacivanja_dana', 35) === 0) { ?>
            <div class="buttons-container">
                <input type="hidden" id="bez_prebacivanja_dana" value="<?php echo CFS()->get('bez_prebacivanja_dana', 35); ?>" />
                <?php foreach ($dani as $dan) : ?>
                <button id="<?php echo $dan["datum"] ?>" onclick="showDate(this)"><?php echo date( 'd.m.Y.', strtotime( $dan["datum"] ) ); ?></button>
                <?php endforeach; ?>
            </div>
            <?php } ?>
            <div class="agenda-container" <?php echo CFS()->get('bez_prebacivanja_dana', 35) === 1 ? 'style="margin-top: 4em;"' : '' ?>>
                <?php foreach ($dani as $dan) : ?>
                <div id="<?php echo $dan["datum"] ?>" class="agenda-point-container">
                    <?php $points = $dan["dan"]; $i = 0; ?>
                    <?php foreach ($points as $point) : ?>
                    <div class="agenda-point">
                        <?php if($i%2 === 0) { ?>
                            <p class="left"><?php echo $point["opis_pointa"] ?><span></span></p>
                            <p class="timeR"><?php echo CFS()->get('bez_prebacivanja_dana', 35) === 1 ? date( 'd.m.Y.', strtotime( $dan["datum"] ) ) . ' ' : '' ; ?><?php echo $point["vreme_pointa"]; echo $point["koristiti_do_vreme"] == 1 ? ' - ' . $point["vreme_pointa_do"] : null ?></p>
                        <?php } else { ?>
                            <p class="timeL"><?php echo CFS()->get('bez_prebacivanja_dana', 35) === 1 ? date( 'd.m.Y.', strtotime( $dan["datum"] ) ) . ' ' : '' ; ?><?php echo $point["vreme_pointa"]; echo $point["koristiti_do_vreme"] == 1 ? ' - ' . $point["vreme_pointa_do"] : null ?><span></span></p>
                            <p class="right"><?php echo $point["opis_pointa"] ?></p>
                        <?php } ?>
                    </div>
                    <?php ++$i; endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section id="provided" class="provided">
            <h2>Obezbeđeno je</h2>
            <div class="provided-inside">
                <div class="providedList">
                    <ul>
                        <?php $stavke = CFS()->get( 'obezbedene_stavke', 85 ); ?>
                        <?php foreach ($stavke as $stavka) : ?>
                        <li><?php echo $stavka["naziv_stavke"] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="providedImg" style="background-image: url(<?php echo CFS()->get( 'slika_uz_stavke', 85 ); ?>)">
                </div>
            </div>
        </section>
        <?php $pomoci = CFS()->get( 'pomoci', 158 ); $pomoci = array_reverse($pomoci) ?>
	    <?php if($pomoci) : ?>
        <section id="pomoci" class="sponsors" style="width: 100%;">
            <h2>Pomogli smo</h2>
                <div class="sponsors-container" style="margin-bottom: 15px">
	                <?php if( count($pomoci) <= 3) { echo '<section class="center slider notEnoughPics" >'; } else echo '<section class="center slider" >';?>
					    <?php foreach ($pomoci as $pomoc) : ?>
                            <a href="<?php echo $pomoc["link_organizacije"]["url"] ?>" target="<?php echo $pomoc["link_organizacije"]["target"] ?>">
                                <div class="whatapp" style="background-image: url(<?php echo $pomoc["logo_organizacije"] ?>)"></div>
                                <p><?php echo $pomoc["ime_organizacije"] ?></p>
                                <?php foreach ($pomoc["godina_pomoci"] as $godina) { echo '<p>' . $godina . '</p>'; } ?>
                            </a>
					    <?php endforeach; ?>
                    </section>
                </div>
        </section>
	    <?php endif; ?>
        <section id="sponzori" class="sponsors" style="width: 100%;">
            <h2>Sponzori</h2>
	        <?php $sponzori = CFS()->get( 'sponzori', 39 ); ?>
            <?php if($sponzori) : ?>
            <div class="sponsors-container">
                <?php if( count($sponzori) <= 3) { echo '<section class="center slider notEnoughPics" >'; } else echo '<section class="center slider" >';?>
                    <?php foreach ($sponzori as $sponzor) : ?>
                    <a href="<?php echo $sponzor["link_sponzora"]["url"] ?>" target="<?php echo $sponzor["link_sponzora"]["target"] ?>">
                        <div class="whatapp" style="background-image: url(<?php echo $sponzor["logo_sponzora"] ?>)"></div>
                    </a>
                    <?php endforeach; ?>
                </section>
            </div>
            <?php endif; ?>
            <div class="sponsorUs">
                <a onclick="writeUs()" target="_blank">BUDI I TI SPONZOR!</a>
            </div>
        </section>
	    <?php $prijatelji = CFS()->get( 'prijatelji', 145 ); ?>
	    <?php if($prijatelji) : ?>
        <section id="prijatelji" class="sponsors" style="width: 100%;">
            <h2>Prijatelji</h2>
                <div class="sponsors-container" style="margin-bottom: 15px">
	                <?php if( count($prijatelji) <= 3) { echo '<section class="center slider notEnoughPics" >'; } else echo '<section class="center slider" >';?>
					    <?php foreach ($prijatelji as $prijatelj) : ?>
                            <a href="<?php echo $prijatelj["link_prijatelja"]["url"] ?>" target="<?php echo $prijatelj["link_prijatelja"]["target"] ?>">
                                <div class="whatapp" style="background-image: url(<?php echo $prijatelj["logo_prijatelja"] ?>)"></div>
                            </a>
					    <?php endforeach; ?>
                    </section>
                </div>
        </section>
	    <?php endif; ?>
        <?php $proizvodi = CFS()->get( 'proizvodi', 405 ); ?>
        <?php if($proizvodi) : ?>
            <section id="proizvodi" class="sponsors" style="width: 100%;">
                <h2>Shop</h2>
                <div class="sponsors-container" style="margin-bottom: 15px">
                    <?php if( count($proizvodi) <= 3) { echo '<section class="center slider notEnoughPics" >'; } else echo '<section class="center slider" >';?>
                    <?php foreach ($proizvodi as $proizvod) : ?>
                        <a href="<?php echo $proizvod["link"]["url"] ?>" target="<?php echo $proizvod["link"]["target"] ?>">
                            <div class="whatapp" style="background-image: url(<?php echo $proizvod["slika"] ?>)"></div>
                        </a>
                    <?php endforeach; ?>
            </section>
            </div>
            </section>
        <?php endif; ?>
        <?php $faqs = CFS()->get( 'faqs', 409 ); ?>
        <?php if($faqs) : ?>
            <section id="faq" class="sponsors" style="width: 100%;">
                <h2>Faq</h2>
                <div class="faq-articles">
                    <?php foreach ($faqs as $key => $faq) : ?>
                        <article class="faq-accordion">
                            <input type="checkbox" class="tgg-title" id="tgg-title-<?php echo $key; ?>">
                            <div class="faq-accordion-title">
                                <label for="tgg-title-<?php echo $key; ?>">
                                    <h3><?php echo $faq['question'] ?></h3>
                                    <span class="arrow-icon"><span class="dashicons dashicons-arrow-up-alt2"></span></span>
                                </label>
                            </div>
                            <div class="faq-accordion-content">
                                <p><?php echo $faq['answer'] ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        <!-- /section -->
    </main>

<?php /*get_sidebar(); */?>

<?php get_footer(); ?>