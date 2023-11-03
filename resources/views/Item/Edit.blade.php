@extends('Template.App')
@section('title',$title)
@section('content')
<form action="{{ url('item/'.$item->id.'') }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @php $brand_id_old = Request::old('brand_id') ? Request::old('brand_id') : $item->brand_id; @endphp
                <div class="form-group">
                    <label><span class="text-danger">*</span> Merek</label>
                    <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                        @if( $brand_id_old  != NULL)
                            <option value="{{$brand_id_old}}">{{$brands->where('id', intval($brand_id_old))->first()->name_brand}}</option>
                        @endif
                    </select>
                    @error('brand_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                @php $category_id_old = Request::old('category_id') ? Request::old('category_id') : $item->category_id; @endphp
                <div class="form-group">
                    <label><span class="text-danger">*</span> Kategori</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        @if( $category_id_old != NULL)
                            <option value="{{$category_id_old}}">{{$categories->where('id', intval($category_id_old))->first()->category_name}}</option>
                        @endif
                    </select>
                    @error('category_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                @php
                $unit_show = $unit->unit_id ? $unit->unit_id : null;
                $unit_id_old = Request::old('unit_id') ? Request::old('unit_id') : $unit_show; @endphp
                <div class="form-group">
                    <label><span class="text-danger">*</span> Satuan</label>
                    <i class="text-danger">Harap pilih Satuan terkecil.</i>
                    <select name="unit_id" class="form-control @error('unit_id') is-invalid @enderror" style="width:100%">
                        @if( $unit_id_old != NULL)
                            <option value="{{$unit_id_old}}">{{ $units->where('id', intval($unit_id_old))->first()->unit_name}}</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Nama Produk</label>
                    <input type="text" value="{{ old('item_name') ? old('item_name') : $item->item_name }}"  name="item_name" value="{{ old('item_name') }}" class="form-control @error('item_name') is-invalid @enderror">
                    @error('item_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Kode / SKU</label>
                    <input type="text" name="code_sku" value="{{ old('code_sku') ? old('code_sku') : $item->code_sku }}"  class="form-control @error('code_sku') is-invalid @enderror">
                    @error('code_sku')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Barcode</label>
                    <input type="text" name="barcode" value="{{ old('barcode') ? old('barcode') : $item->barcode }}" class="form-control @error('barcode') is-invalid @enderror">
                    @error('barcode')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Image</label>
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('images') is-invalid @enderror" name="images">
                  <label class="custom-file-label">
                  Choose file only JPG | PNG | JPEG | SVG
                  </label>
                </div>
            </div>
            @error('images')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote">{{ old('description') ? old('description') : $item->description }}</textarea>
            @error('description')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <table class="table table-borderless mb-2" id="buy_item">
            <thead class="bg-light">
                <th colspan="3">
                    @php $buy_checked = old('buy_checked') ? old('buy_checked') : $item->buy_checked; @endphp
                    <div class="form-group mb-0">
                        <div class="custom-control custom-switch">
                            <input type="hidden" value="0" name="buy_checked">
                            <input type="checkbox" name="buy_checked" value="1" id="customSwitchBuy" class="custom-control-input" @if( $buy_checked  == 1 ) checked @endif>
                            <label class="custom-control-label text-primary" for="customSwitchBuy">Saya akan membeli produk ini</label>
                        </div>
                    </div>
                </th>
            </thead>
            <tbody style="display:none">
                <tr>
                    <td width="40%">
                        <div class="form-group">
                            <label>Harga Beli Satuan</label>
                            <input type="text" name="buy_price" value="{{ old('buy_price') ? old('buy_price') : $unit->buy_price }}" class="form-control @error('buy_price') is-invalid @enderror">
                            @error('buy_price')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td width="30%">
                        @php $account_buy_old = Request::old('account_buy') ? Request::old('account_buy') : $item->account_buy; @endphp
                        <div class="form-group">
                            <label>Akun Pembelian</label>
                            <select name="account_buy" class="form-control @error('account_buy') is-invalid @enderror" width="100%">
                                @if($account_buy_old != NULL)
                                   @php
                                       $value_list = $account_list->where('id', intval($account_buy_old))->first();
                                   @endphp
                                    <option value="{{$account_buy_old}}">{{ $value_list->lists_code.' - '.$value_list->lists_name }}</option>
                                @endif
                            </select>
                            @error('account_buy')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td width="30%">
                        @php $tax_buy_id_old = Request::old('tax_buy_id') ? Request::old('tax_buy_id') : $item->tax_buy_id; @endphp
                        <div class="form-group">
                            <label>Pajak Beli</label>
                            <select name="tax_buy_id" class="form-control @error('tax_buy_id') is-invalid @enderror">
                                @if( $tax_buy_id_old != NULL)
                                   @php
                                       $value_tax = $taxes->where('id', intval($tax_buy_id_old))->first();
                                   @endphp
                                    <option value="{{$tax_buy_id_old}}">{{ $value_tax->tax_name }}</option>
                                @endif
                            </select>
                            @error('tax_buy_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-borderless  mb-2" id="sell_item">
            <thead class="bg-light">
                <th colspan="3">
                    @php $sell_cheked = old('sell_cheked') ? old('sell_cheked') : $item->sell_cheked; @endphp
                    <div class="form-group mb-0">
                        <div class="custom-control custom-switch">
                            <input type="hidden" value="0" name="sell_cheked">
                            <input type="checkbox" name="sell_cheked" value="1" id="customSwitchSell" class="custom-control-input" @if( $sell_cheked == 1 ) checked @endif>
                            <label class="custom-control-label text-primary" for="customSwitchSell">Saya akan menjual produk ini</label>
                        </div>
                    </div>
                </th>
            </thead>
            <tbody style="display:none">
                <tr>
                    <td width="40%">
                        <div class="form-group">
                            <label>Harga Jual Satuan</label>
                            <input type="text" name="sell_price" value="{{ old('sell_price') ? old('sell_price') : $unit->sell_price }}" class="form-control @error('sell_price') is-invalid @enderror">
                            @error('sell_price')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td width="30%">
                        @php $account_sell_old = Request::old('account_sell') ? Request::old('account_sell') : $item->account_sell; @endphp
                        <div class="form-group">
                            <label>Akun Penjualan</label>
                            <select name="account_sell" class="form-control @error('account_sell') is-invalid @enderror">
                                @if( $account_sell_old != NULL)
                                   @php
                                       $value_list = $account_list->where('id', intval($account_sell_old))->first();
                                   @endphp
                                    <option value="{{$account_sell_old}}">{{ $value_list->lists_code.' - '.$value_list->lists_name }}</option>
                                @endif
                            </select>
                            @error('account_sell')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td width="30%">
                        @php $tax_sell_id_old = Request::old('tax_sell_id') ? Request::old('tax_sell_id') : $item->tax_sell_id; @endphp
                        <div class="form-group">
                            <label>Pajak Jual</label>
                            <select name="tax_sell_id" class="form-control @error('tax_sell_id') is-invalid @enderror">
                                @if( $tax_sell_id_old != NULL)
                                   @php $value_tax = $taxes->where('id', intval($tax_sell_id_old))->first(); @endphp
                                    <option value="{{$tax_sell_id_old}}">{{ $value_tax->tax_name }}</option>
                                @endif
                            </select>
                            @error('tax_sell_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-borderless mb-2" id="inventory_item">
            <thead class="bg-light">
                <th colspan="3">
                    @php $inventory_checked = old('inventory_checked') ? old('inventory_checked') : $item->inventory_checked; @endphp
                    <div class="form-group mb-0">
                        <div class="custom-control custom-switch">
                            <input type="hidden" value="0" name="inventory_checked">
                            <input type="checkbox" name="inventory_checked" value="1" id="customSwitchInventory" class="custom-control-input" @if( $inventory_checked == 1 ) checked @endif>
                            <label class="custom-control-label text-primary" for="customSwitchInventory">Saya akan melacak persediaan produk ini</label>
                        </div>
                    </div>
                </th>
            </thead>
            <tbody style="display:none">
                <tr>
                    <td width="50%">
                        <div class="form-group">
                            <label>Batas Stok Minimum</label>
                            <input type="text" name="minimum_stock" value="{{ old('minimum_stock') ? old('minimum_stock') : $item->minimum_stock }}" class="form-control @error('minimum_stock') is-invalid @enderror">
                            @error('minimum_stock')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td width="50%">
                        @php $account_inventory_old = Request::old('account_inventory') ? Request::old('account_inventory') : $item->account_inventory; @endphp
                        <div class="form-group">
                            <label>Akun Persediaan Barang</label>
                            <select name="account_inventory" class="form-control @error('account_inventory') is-invalid @enderror">
                                @if( $account_inventory_old != NULL)
                                   @php
                                       $value_list = $account_list->where('id', intval($account_inventory_old))->first();
                                   @endphp
                                    <option value="{{$account_inventory_old}}">{{ $value_list->lists_code.' - '.$value_list->lists_name }}</option>
                                @endif
                            </select>
                            @error('account_inventory')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/item') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>
</form>
@endsection

@section('Notify')
@include('Template.Notify')
@endsection

@section('Modal')
@include('Template.Modal')
@endsection

@section('javascript')
<script type="text/javascript">

bsCustomFileInput.init();

$('[name="brand_id"]').select2({
    allowClear: true,
    placeholder: "Cari merek",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_brand') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#modal_add" data-toggle="modal" class="select_add add_brand"><i class="fas fa-plus"></i> Add</a>');
});

$(document).on('click', '.add_brand', function(event) {
    event.preventDefault();
    /* Act on the event */

    $('[name="brand_id"]').select2("close");

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

$(document).on('submit', '#simpanBrand', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.btn_add').prop('disabled', true);

    $.ajax({
        url: '{!! route('item.create_brand') !!}',
        type: 'post',
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend:function(){
            $('.btn_add').html('<i class="spinner-border spinner-border-sm"></i> Menyimpan...');
        }
    })
    .done(function(json) {
        $.notify(json.message,{
            position:"top center",
            className :json.class_name
        });
        $('.btn_add').prop('disabled', false);
        $('#modal_add .close').click();
    })
    .fail(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    })
    .always(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    });

});

$('[name="category_id"]').select2({
    allowClear: true,
    placeholder: "Cari kategori",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_category') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#modal_add" data-toggle="modal" class="select_add add_cat"><i class="fas fa-plus"></i> Add</a>');
});

$(document).on('click', '.add_cat', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('[name="category_id"]').select2("close");

    $.ajax({
        url: '{!! route('item.modal_cat') !!}',
        type: 'post',
        dataType: 'html',
        data: {_token:'{!! csrf_token() !!}'},
    })
    .done(function(data) {
        $('.modal_show').html(data);
    });
});

$(document).on('submit', '#simpanCategory', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.btn_add').prop('disabled', true);

    $.ajax({
        url: '{!! route('item.create_cat') !!}',
        type: 'post',
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend:function(){
            $('.btn_add').html('<i class="spinner-border spinner-border-sm"></i> Menyimpan...');
        }
    })
    .done(function(json) {
        $.notify(json.message,{
            position:"top center",
            className :json.class_name
        });
        $('.btn_add').prop('disabled', false);
        $('#modal_add .close').click();
    })
    .fail(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    })
    .always(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    });

});

$('[name="unit_id"]').select2({
    allowClear: true,
    placeholder: "Cari satuan",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_unit') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#modal_add" data-toggle="modal" class="select_add add_unit"><i class="fas fa-plus"></i> Add</a>');
});

$(document).on('click', '.add_unit', function(event) {
    event.preventDefault();
    /* Act on the event */

    $('[name="unit_id"]').select2("close");

    $.ajax({
        url: '{!! route('item.modal_unit') !!}',
        type: 'post',
        dataType: 'html',
        data: {_token:'{!! csrf_token() !!}'},
    })
    .done(function(data) {
        $('.modal_show').html(data);
    });
});

$(document).on('submit', '#simpanUnit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $('.btn_add').prop('disabled', true);

    $.ajax({
        url: '{!! route('item.create_unit') !!}',
        type: 'post',
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend:function(){
            $('.btn_add').html('<i class="spinner-border spinner-border-sm"></i> Menyimpan...');
        }
    })
    .done(function(json) {
        $.notify(json.message,{
            position:"top center",
            className :json.class_name
        });
        $('.btn_add').prop('disabled', false);
        $('#modal_add .close').click();
    })
    .fail(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    })
    .always(function() {
        $('.btn_add').prop('disabled', false);
        $('.btn_add').html('<i class="fa fa-check"></i> Simpan');
    });

});

$('[name="account_buy"]').select2({
    allowClear: true,
    placeholder: "Cari akun pembelian",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_account') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_list/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('[name="account_sell"]').select2({
    allowClear: true,
    placeholder: "Cari akun penjualan",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_account') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_list/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('[name="tax_buy_id"]').select2({
    allowClear: true,
    placeholder: "Cari pajak beli",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_tax') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/tax/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('[name="tax_sell_id"]').select2({
    allowClear: true,
    placeholder: "Cari pajak jual",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_tax') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/tax/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('[name="account_inventory"]').select2({
    allowClear: true,
    placeholder: "Cari Akun Persediaan Barang",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_account') }}',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_list/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('#summernote').summernote({
    height: $(document).height() - ($("#Maintable").height() + $("#TblTop").height() + 60),
    placeholder: 'Deskripsi produk...',
    tabsize: 2,
    toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline','italic', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height','lineHeights']],
            ['table', ['table']],
            ['insert', ['picture', ]],
            ['view', ['fullscreen', 'codeview']],
        ]
});

$('body').on('click', '#customSwitchBuy', function() {
    if($(this).is(':checked')){
        $('#buy_item tbody').css('display','contents');
    } else {
        $('#buy_item tbody').css('display','none');
        $('[name="buy_price"]').val('');
        $('[name="account_buy"]').empty().trigger('change');
        $('[name="tax_buy_id"]').empty().trigger('change');
    }
});

if($('#customSwitchBuy').is(':checked')){
   $('#buy_item tbody').css('display','contents');
} else {
    $('#buy_item tbody').css('display','none');
}

$('body').on('click', '#customSwitchSell', function() {
    if($(this).is(':checked')){
        $('#sell_item tbody').css('display','contents');
    } else {
        $('#sell_item tbody').css('display','none');
        $('[name="sell_price"]').val('');
        $('[name="account_sell"]').empty().trigger('change');
        $('[name="tax_sell_id"]').empty().trigger('change');
    }
});

if($('#customSwitchSell').is(':checked')){
   $('#sell_item tbody').css('display','contents');
} else {
    $('#sell_item tbody').css('display','none');
}

$('body').on('click', '#customSwitchInventory', function() {
    if($(this).is(':checked')){
        $('#inventory_item tbody').css('display','contents');
    } else {
        $('#inventory_item tbody').css('display','none');
        $('[name="minimum_stock"]').val('');
        $('[name="account_inventory"]').empty().trigger('change');
    }
});

if($('#customSwitchInventory').is(':checked')){
   $('#inventory_item tbody').css('display','contents');
} else {
    $('#inventory_item tbody').css('display','none');
}
</script>
@endsection
