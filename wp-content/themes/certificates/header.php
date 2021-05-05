<?php
/**
 * header template (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 * @author DHL
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); // language attr ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); // encoding ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php /* RSS and other */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php /* All scripts and styles are now included in functions.php */ ?>

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<header class="header">
        <div class="container">
            <a href="/" class="logo">
                <img src="/public/img/logo.svg" alt="Сертификаты">
            </a>
            <div class="d-flex flex-col only-md">
                <a href="tel:+375 29 767-50-73" class="phone">+375 29 767-50-73</a>
                <a href="tel:+375 44 787-50-73" class="phone">+375 44 787-50-73</a>
            </div>
            <nav class="nav">
                <div class="search__content only-xs">
                    <input type="text" class="search__input" name="s" placeholder="Введите слово или словосочетание">
                    <span class="search__clear"></span>
                    <input type="submit" class="search__submit" value="Поиск" disabled>
                </div>
                <a href="/service" class="nav__service">Услуги</a>
                <a href="">О компании</a>
                <a href="">Документация</a>
                <a href="">Вопросы</a>
                <a href="">Контакты</a>
                <div class="d-flex flex-col only-xs">
                    <a href="tel:+375 29 767-50-73" class="phone">+375 29 767-50-73</a>
                    <a href="tel:+375 44 787-50-73" class="phone">+375 44 787-50-73</a>
                </div>
                <div class="btn btn--stroke only-xs">Консультация</div>
            </nav>
            <div class="search only-md">
                <div class="search__btn" data-control='modal--search'>Поиск</div>
            </div>
            <div class="btn btn--stroke only-md">Консультация</div>
            <div class="menu-btn" data-active data-control="nav">
                <div class="menu-btn__item"></div>
                <div class="menu-btn__item"></div>
            </div>
        </div>
    </header>

    <div class="modal modal--search">
        <div class="container">
            <form action="/" class="search__content animate__animated animate__slideInDown animate__faster">
                <input type="text" class="search__input" name="s" placeholder="Введите слово или словосочетание">
                <span class="search__clear"></span>
                <input type="submit" class="search__submit" value="Поиск" disabled>
			</form>
        </div>
    </div>