<?php
$this->load->view('nav/nav');
?>

<?php
$method = $this->uri->segment(2);
switch ($method) {
	case 'add':
		$data = array(
					'title'=>'Tambah',
					'id_listproduk'=>'',
					'kode_item'=>'',
					'nama_produk'=>'');
		break;
	
	case 'edit':
		$data = array(
					'title'=>'Edit',
					'id_listproduk'=>$record['id_listproduk'],
					'kode_item'=>$record['kode_item'],
					'nama_produk'=>$record['nama_produk']);
		break;
}
?>
<div class="row">
	<div class="col-lg-6">
		<h1 class="page-header"><?php echo $data['title'];?> Data Produk</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php
		$hidden = array('id_listproduk'=>$data['id_listproduk']);
		echo form_open('produk/'.$method,'',$hidden);
		?>
		<div class="form-group">
			<label>Kode Item</label>
			<input type="number" name="kode_item" class="form-control" placeholder="Kode Item" value="<?php echo $data['kode_item'];?>">
		</div>
		<div class="form-group">
			<label>Nama Produk</label>
			<input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?php echo $data['nama_produk'];?>">
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</button>
		<?php echo form_close();?>
	</div>
</div>