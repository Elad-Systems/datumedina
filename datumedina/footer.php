</div>
<div class="StripFooter">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-sidebar') ) :endif; ?>
                </div>
                <div class="col-md-3">
                    <div class="FooterLogo">
                        <a title="התנועה ליהדות מתקדמת בישראל" class="LogoImg" href="http://www.reform.org.il"><img src="<?php echo get_template_directory_uri() ?>/images/logo-footer.png"  title="התנועה ליהדות מתקדמת בישראל" alt="התנועה ליהדות מתקדמת בישראל"/></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="SubFooter">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-utility-menu','container_class' => 'utility-menu' )); ?>
                </div>
                <div class="col-md-3 CreditContainer">
                    <a class="CreditProfile" href="http://www.profilesoft.com" target="_blank" title="הקמת אתרי וורדפרס, עיצוב ממשקי משתמש"><img src="<?php echo get_template_directory_uri() ?>/images/Credit-profile.png" alt="הקמת אתרי וורדפרס, עיצוב ממשקי משתמש" title="הקמת אתרי וורדפרס, עיצוב ממשקי משתמש" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>