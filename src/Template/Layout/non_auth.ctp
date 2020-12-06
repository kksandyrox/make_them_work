<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <meta name="keywords" content="Potholes, Goa, MLAs, 40, constituency">
    <meta name="description" content="Potholes in Goa. Make MLAs work">
    <meta name="author" content="Make Them Work">

    <meta property="og:title" content="<?php echo $title;?>">
    <?php $imageMetaUrl = !empty($imageMetaUrl) ? $imageMetaUrl : "" ;?>
    <meta property="og:image" content="<?php echo $imageMetaUrl;?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">

    <title>
        <?= $title ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('mdb.min.css') ?>
    <?= $this->Html->css('dropify.min.css') ?>
    <?= $this->Html->css('lightbox.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5NVMRGV');</script>
    <!-- End Google Tag Manager -->

</head>


    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
<body class="blue-grey lighten-5">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NVMRGV"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark elegant-color">

    <!-- Navbar brand -->
    <?php 
        $homePage = "/potholes/dashboard";
        if(empty($Auth->user())) {
            $homePage = "/potholes/publicDashboard";
        }
    ;?>
    <a class="navbar-brand" href="<?php echo $homePage;?>">MAKE THEM WORK</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/potholes/statistics">Statistics
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/feedbacks/feedback">Submit Feedback
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><span>(Launching Soon)</span><sup><i class="fa fa-android" aria-hidden="true"></i><span>&nbsp;+&nbsp;</span><i class="fa fa-apple" aria-hidden="true"></i></sup>
                    <span class="sr-only">(current)</span>
                </a>
            </li>           
        </ul>

        <ul class="navbar-nav ml-auto">
            <?php if(empty($Auth->user())): ?>
                <li class="nav-item">
                    <?php echo $this->Html->link('Login', array('action' => 'login', 'controller' => 'users'), array('class' => 'nav-link')); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Register', array('action' => 'register', 'controller' => 'users'), array('class' => 'nav-link'));?>
                </li>
            <?php else:?>
                <li class="nav-item">
                    <?php echo $this->Html->link('Logout', array('action' => 'logout', 'controller' => 'users'), array('class' => 'nav-link')); ?>
                </li>
            <?php endif;?>
        </ul>
    </div>

</nav>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <div class="footer-copyright text-center py-3">© <?php echo date('Y') ;?>&nbsp;Copyright - Make Them Work</div>    
    </footer>
</body>
    <?php
        echo $this->Html->script('jquery.js');
        echo $this->Html->script('popper.min.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('mdb.min.js');
        echo $this->Html->script('chart.js');
        echo $this->Html->script('dropify.min.js');
        echo $this->Html->script('lightbox.js');
        echo $this->Html->script('jquery.gotop.min.js');
        echo $this->Html->script('custom.js');    
    ?>
</html>