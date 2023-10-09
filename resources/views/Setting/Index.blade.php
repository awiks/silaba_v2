@extends('Template.App') 
@section('title',$title)
@section('content')
<div class="card elevation-0">
  <div class="card-body">
    <p># Master Produk</p>
    <ul>
      <li><a href="{{ url('setting/unit') }}">Satuan</a></li>
      <li><a href="{{ url('setting/brand') }}">Merek</a></li>
      <li><a href="{{ url('setting/category') }}">Kategori</a></li>
      <li><a href="{{ url('setting/tax') }}">Pajak</a></li>
    </ul>
    <p># Kode Akun Akuntansi / <i>Chart of Account (CoA)</i> </p>
    <ul>
      <li><a href="{{ url('setting/account_header') }}">Header</a></li>
      <li><a href="{{ url('setting/account_sub_header') }}">Sub Header</a></li>
      <li><a href="{{ url('setting/account_category ') }}">Kategori Akun</a></li>
      <li><a href="{{ url('setting/account_list') }}">Daftar Akun</a></li>
      <li><a href="{{ url('setting/account_preferences') }}">Preferensi Akun Default</a></li>
    </ul>
    
    <p># Pengaturan Sistem</p>
    
  </div>
</div>
@endsection