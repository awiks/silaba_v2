<form id="simpanBrand">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $modal_title }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body form-body">
            <div class="form-group">
                <label>Nama Merek</label>
                <input type="text" name="name_brand" class="form-control">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary btn_add">
                <i class="far fa-save"></i> Simpan
             </button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#simpanBrand').validate({
        rules:{
            name_brand:{
                required:true,
                maxlength:100,
            },
        },
        messages:{
            name_brand:{
                required:'Nama Merek harap diisi',
            },
        },
        errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>