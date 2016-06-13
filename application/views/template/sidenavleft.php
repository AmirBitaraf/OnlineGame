<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 16/04/17
 * Time: 11:19 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#"><span>Admin Page</span></a>

                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav pull-right">
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo $user?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
                                <li><a href="<?php echo base_url();?>index.php/landing/logout"><i class="halflings-icon off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->

            </div>
        </div>
    </div>
    <div class="container-fluid-full" style="overflow-y: hidden">
        <div class="row-fluid" style="min-height: 640px;">

            <!-- start: Main Menu -->
            <div id="sidebar-left" class="span2" style="overflow-y:scroll">
                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="#"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li><a href="#"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
                        <li><a href="#"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
                        <li><a href="#"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- end: Main Menu -->
            <div id="content" class="span10">
        <!--    This div must be close in continuous of the this content -->
