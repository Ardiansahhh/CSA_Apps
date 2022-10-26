<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->

		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="active treeview">
				<a href="#">
					<i class="fa fa-user"></i> <span>Data Master</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('Main'); ?>"><i class="fa fa-users"></i>Data Pelanggan</a></li>
					<li class="active"><a href="<?php echo base_url('Armada'); ?>"><i class="fa fa-truck"></i>Armada</a></li>
					<li class="active"><a href="<?php echo base_url('Salesman'); ?>"><i class="fa fa-user"></i>Data Salesman</a></li>
					<li class="active"><a href="<?php echo base_url('Area'); ?>"><i class="fa  fa-book"></i>Ruang Lingkup</a></li>
					<li class="active"><a href="<?php echo base_url('Filter'); ?>"><i class="fa fa-search"></i>Filter Data</a></li>
					<li class="active"><a href="<?php echo base_url('UnDelivery'); ?>"><i class="fa fa-truck"></i>Belum Terkirim</a></li>
					<li class="active"><a href="<?php echo base_url('Group'); ?>"><i class="fa fa-sitemap"></i>Group Kubikasi</a></li>
					<li class="active"><a href="<?php echo base_url('Kabupaten'); ?>"><i class="fa fa-map-marker"></i>Kabupaten</a></li>
					<li class="active"><a href="<?php echo base_url('Barang'); ?>"><i class="fa fa-cubes"></i>Barang</a></li>
					<li class="active"><a href="<?php echo base_url('Sales'); ?>"><i class="fa fa-pencil-square-o"></i>Form Pinjam Barang</a></li>
					<li class="active"><a href="<?php echo base_url('Form_urgent'); ?>"><i class="fa fa-clone"></i>Form Urgent</a></li>
				</ul>
			</li>
			<li class="active treeview">
				<a href="#">
					<i class="fa fa-user"></i> <span>Main Controller</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="active"><a href="<?php echo base_url('Levelup'); ?>"><i class="fa fa-user"></i>Setting</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $menu; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $menu; ?></li>
		</ol>
	</section>
	<?php include('content.php'); ?>
</div>
