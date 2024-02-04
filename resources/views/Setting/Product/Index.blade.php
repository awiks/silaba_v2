@extends('Template.App')
@section('title',$title)
@section('content')
<div class="card elevation-0 mb-2">
    <div class="card-body">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th width="20%">Tampilkan Stok Produk</th>
                    <td width="2%">:</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="hidden" value="0" name="show_logo">
                            <input type="checkbox" name="show_logo" value="1" id="customSwitchView" class="custom-control-input">
                            <label class="custom-control-label text-primary" for="customSwitchView"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th width="20%">Kategori Produk</th>
                    <td width="2%">:</td>
                    <td>
                        <a href="#modal_add" data-toggle="modal" class="show_cat">Pengaturan Kategori</a>
                    </td>
                </tr>
                <tr>
                    <th width="20%">Merek Produk</th>
                    <td width="2%">:</td>
                    <td>
                        <a href="#modal_add" data-toggle="modal" class="show_brand">Pengaturan Merek</a>
                    </td>
                </tr>
                <tr>
                    <th width="20%">Satuan Produk</th>
                    <td width="2%">:</td>
                    <td>
                        <a href="#modal_add" data-toggle="modal" class="show_unit">Pengaturan Satuan</a>
                    </td>
                </tr>
            </tbody>
        </table>
        

    </div>
</div>

<div class="card elevation-0">
    <div class="card-body">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('setting') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="button" class="btn btn-success" onclick="location.href='{{ url('setting/company/edit') }}'">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>

@endsection


@section('Notify')
@include('Template.Notify')
@endsection

@section('Modal')
@include('Template.Modal')
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function () {

    $(document).on('click', '.show_cat', function(event) {
        event.preventDefault();
        /* Act on the event */

        $.ajax({
            url: '{!! route('product.show_cat') !!}',
            type: 'post',
            dataType: 'html',
            data: {_token:'{!! csrf_token() !!}'},
        })
        .done(function(data) {
            $('.modal_show').html(data);
        });

    });

    $(document).on('click', '.show_brand', function(event) {
        event.preventDefault();
        /* Act on the event */

    });

    $(document).on('click', '.show_unit', function(event) {
        event.preventDefault();
        /* Act on the event */

    });

    $(document).on('click', '.add_brand', function(event) {
        event.preventDefault();
        /* Act on the event */

        $.ajax({
            url: '{!! route('item.modal_brand') !!}',
            type: 'post',
            dataType: 'html',
            data: {_token:'{!! csrf_token() !!}'},
        })
        .done(function(data) {
            $('.modal_show').html(data);
        });
    });

});
</script>
@endsection
