<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
        <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="Icon">
    </head>
    <body <?php body_class(); ?>>
        <div class="StripHeader">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 ColLogo">
                            <a title="<?php echo get_bloginfo( 'name' ); ?>" href="<?php echo get_site_url(); ?>">
                                <div class="Branding">
                                    <img class="LogoImg" src="<?php echo get_template_directory_uri() ?>/images/dm-logo.png" alt="המרכז הרפורמי לדת ומדינה" title="המרכז הרפורמי לדת ומדינה" />
                                    <!--<div class="TextSlogan"><?php //echo get_bloginfo( 'name' ); ?></div>-->
                                </div>
                            </a>
                            <div class="MobileMenu">
                                <img src="<?php echo get_template_directory_uri() ?>/images/mobile-menu.png"/>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 header-left">
                            <div class="Search clearfix">
                                <form method="get" action="/">
                                    <input type="text" name="s" value="">
                                </form>
                                <img class="IconSearch" src="<?php echo get_template_directory_uri() ?>/images/icon-search.png" />
                            </div>
                            <nav class="MainNav">
                                <?php wp_nav_menu( array( 'theme_location' => 'main-menu','container_class' => 'main-menu' )); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="StripMain Fixed">
            <div class="container breadcrumbWhite">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('<div id="breadcrumbs" class="ContainerBreadcrumbs">','</div>');
                        }
                        ?>
                    </div>
                </div>
            </div>





