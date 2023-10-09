@extends('Template.App')
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/expenses') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-5 col-md-5">
                <div class="form-group">
                    <label>Dibayarkan dari</label>
                    <select class="form-control select2" style="width:100%" name="supplier"></select>
                  </div>
            </div>
            <div class="col-7 col-md-7">
                <div class="custom-control custom-switch ml-2 my-2 py-4">
                    <input type="hidden" value="0" name="buy_checked">
                    <input type="checkbox" name="buy_checked" value="1" id="customSwitchBuy" class="custom-control-input">
                    <label class="custom-control-label text-primary" for="customSwitchBuy">Bayar Nanti</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Penerima</label>
                    <select class="form-control select2" style="width:100%" name="supplier"></select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="text" placeholder="dd-mm-yyyy" class="form-control datepicker" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nomor</label>
                    <input type="text"  class="form-control" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tag</label>
                    <input type="text" name="tag" class="form-control" >
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Akun Biaya</th>
                    <th>Deskripsi</th>
                    <th>Pajak</th>
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
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <button type="button" id="BarisBaru" class="btn btn-default" name="button">
                            <i class="fas fa-solid fa-plus"></i> Tambah Baris
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Reference</label>
                    <textarea name=""  class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-6 ms-auto">

                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td><strong>Subtotal</strong></td>
                            <td>Rp. 5000.000</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>Rp. 5000.000</strong></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/expenses') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-primary float-right">
            <i class="far fa-save"></i> Simpan
         </button>
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

@section('javascript')
<script type="text/javascript">
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight:true,
});

</script>
@endsection
