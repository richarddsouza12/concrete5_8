<?php defined('C5_EXECUTE') or die("Access Denied.");

$site = Config::get('concrete.site');
$themePath = $this->getThemePath();

?>

<?php $this->inc('elements/header_top.php'); ?>

<header>
    <div class="container">
        <div class="col-sm-12">
            <div class="logo">
                <a href="<?php echo View::url('/'); ?>">
                    <img src="<?php echo $themePath; ?>/images/logo.png" alt="<?php echo $site; ?>"/>
                </a>
            </div>
            <nav>
                <div class="mobile-menu">
                    <span class="nav-icon"></span>
                </div>
            </nav>
        </div>
    </div>
</header>