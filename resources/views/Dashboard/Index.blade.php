@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-none">
        <span class="info-box-icon bg-info"><i class="fa-solid fa-address-card"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Kontak</span>
          <span class="info-box-number">1,410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-none">
        <span class="info-box-icon bg-success"><i class="fas fa-cart-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Penjualan</span>
          <span class="info-box-number">410</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-none">
        <span class="info-box-icon bg-warning"><i class="fas fa-shopping-bag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pembelian</span>
          <span class="info-box-number">13,648</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box shadow-none">
        <span class="info-box-icon bg-danger"><i class="fa-solid fa-box"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Produk</span>
          <span class="info-box-number">93,139</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>



@endsection