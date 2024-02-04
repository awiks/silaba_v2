@extends('Template.App') 
@section('title',$title)
@section('content')
<div class="card elevation-0">
  <div class="card-body">
    <p class="my-2"># Pengaturan Sistem</p>
    <ul class="nav flex-column">
      <li class="nav-item"><a href="{{ url('setting/company') }}" class="nav-link">Perusahaan</a></li>
      <li class="nav-item"><a href="{{ url('setting/company') }}" class="nav-link">Penjualan</a></li>
      <li class="nav-item"><a href="{{ url('setting/company') }}" class="nav-link">Pembelian</a></li>
      <li class="nav-item"><a href="{{ url('setting/product') }}" class="nav-link">Produk & Jasa</a></li>
      <li class="nav-item"><a href="{{ url('setting/other_list') }}" class="nav-link">Daftar Lainnya</a></li>
      <li class="nav-item"><a href="{{ url('setting/user') }}" class="nav-link">Pengaturan Pengguna</a></li>
    </ul>
    <p class="my-2"># Master Produk</p>
    <ul class="nav flex-column">
      <li class="nav-item"><a href="{{ url('setting/unit') }}" class="nav-link">Satuan</a></li>
      <li class="nav-item"><a href="{{ url('setting/brand') }}" class="nav-link">Merek</a></li>
      <li class="nav-item"><a href="{{ url('setting/category') }}" class="nav-link">Kategori</a></li>
      <li class="nav-item"><a href="{{ url('setting/tax') }}" class="nav-link">Pajak</a></li>
    </ul>
    <p class="my-2"># Kode Akun Akuntansi / <i>Chart of Account (CoA)</i> </p>
    <ul class="nav flex-column">
      <li class="nav-item"><a href="{{ url('setting/account_header') }}" class="nav-link">Header</a></li>
      <li class="nav-item"><a href="{{ url('setting/account_sub_header') }}" class="nav-link">Sub Header</a></li>
      <li class="nav-item"><a href="{{ url('setting/account_category ') }}" class="nav-link">Kategori Akun</a></li>
      <li class="nav-item"><a href="{{ url('setting/account_list') }}" class="nav-link">Daftar Akun</a></li>
      <li class="nav-item"><a href="{{ url('setting/account_preferences') }}" class="nav-link">Preferensi Akun Default</a></li>
    </ul>
    
    
  </div>
</div>
@endsection