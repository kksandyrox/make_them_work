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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('mdb.min.css') ?>
    <!-- <?php echo $this->Html->css('dropzone.css');?> -->
    <?= $this->Html->css('dropify.min.css') ?>
    <?= $this->Html->css('lightbox.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>


    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/css/bootstrap-slider.min.css">
    <!-- Bootstrap core CSS -->
<body class="mdb-color lighten-5">
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark unique-color">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="/potholes/dashboard">Make Them Work</a>

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
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            <?php 
                $sessionText = 'Login';
                $sessionAction = 'login';
                if(!empty($Auth->user())) {
                    $sessionText = 'Logout';
                    $sessionAction = 'logout';
                }
            ?>
                 <?php echo $this->Html->link($sessionText, array('action' => $sessionAction, 'controller' => 'users'), array('class' => 'nav-link'));?>
            </li>
        </ul>
    </div>

</nav>
    <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
<footer class="page-footer font-small blue mt-5 fixed-bottom unique-color">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/bootstrap-tutorial/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

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
        echo $this->Html->script('custom.js');
    ?>
</html>
