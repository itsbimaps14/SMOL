<?php
$session_nama = $this->session->userdata('nama');
$session_id = $this->session->userdata('id_user');
$session_level = $this->session->userdata('level');
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/icon.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $session_nama ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $session_level ?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="tree-view active">
          <a href="<?php echo base_url().'spek/'.$session_level.'_index';?>">
            <i class="fa fa-database"></i> <span>Database Spek</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: white;" >
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: white;">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content" style="background-color: white;">