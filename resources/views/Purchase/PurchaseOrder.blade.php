@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control select2" style="width:100%" name="supplier"></select>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>No.Transaksi</label>
                    <a href="#Modal_add" data-toggle="modal"><i class="fas fa-cogs"></i></a>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tgl Transaksi</label>
                    <input type="text"  class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" rows="1"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tgl Jatuh Tempo</label>
                    <input type="text"  class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Syarat Pembayaran</label>
                    <select class="form-control select2" style="width:100%" name="supplier"></select>
                </div>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Diskon</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <button type="button" id="BarisBaru" class="btn btn-default" name="button">
                            <i class="fas fa-solid fa-plus"></i> Tambah Baris
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

@endsection


@section('modal')
<!-- START: POP-UP FOR ADD DATA -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="Modal_add" class="modal">
    <div class="modal-dialog card elevation-0">
        <div class="modal-content">
            <div class="modal-header pb-1 pt-2">
                <h4 class="modal-title"></h4>
               <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <div class="modal-add"></div>
        </div>
        <div class="overlay load-add"><i class="fas fa-2x fa-spinner fa-spin default"></i></div>
    </div>
</div>
<!-- END: POP-UP FOR ADD DATA -->
@endsection