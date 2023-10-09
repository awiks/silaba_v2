@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button class="btn btn-primary" onclick="location.href='{{ url('expenses/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah Biaya
        </button>

        <div class="card-tools">
            <div class="form-inline">
                <label>Filter Periode : </label>
                <div class="input-group ml-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control range_date">
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Total Biaya Bulan ini</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                    <div class="card-body p-3">
                        <h4>Rp.5.000.000</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Biaya 30 hari terakhir</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                    <div class="card-body p-3">
                        <h4>Rp.5.000.000</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Biaya Belum Dibayar</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                    <div class="card-body p-3">
                        <h4>Rp.5.000.000</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nomor</th>
                        <th>Penerima</th>
                        <th>Status</th>
                        <th>Sisa Tagihan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(function(){
        var currentYear = moment().year();
  var currentYearStart = moment({
      years: currentYear,
      months: '0',
      date: '1'
    }); // 1st Jan this year
  var currentYearEnd = moment({
      years: currentYear,
      months: '11',
      date: '31'
    }); // 31st Dec this year
  var dateRange = {};
      dateRange["Hari ini"] = [moment(), moment()];
      dateRange["Kemarin"] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
      dateRange["7 Hari Terakhir"] = [moment().subtract(6, 'days'),moment()];
      dateRange["30 hari terakhir"] = [moment().subtract(29, 'days'),moment()];
      dateRange["Bulan ini"] = [moment().startOf('month'), moment().endOf('month')];
      dateRange["Bulan lalu"] = [moment().subtract(1, 'month').startOf('month'),moment().subtract(1, 'month').endOf('month')];
      dateRange["Tahun " + (currentYear)] = [moment(currentYearStart.subtract(0, "year")), moment(currentYearEnd.subtract(0, "year"))]; // Year 2017
      dateRange["Tahun " + (currentYear - 1)] = [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))]; // Year 2017
      dateRange["Tahun " + (currentYear - 2)] = [moment(currentYearStart.subtract(1, "year")), moment(currentYearEnd.subtract(1, "year"))]; // Year 2016
 
      //Date range as a button
    $('.range_date').daterangepicker(
    {
        locale: {
            format: 'DD/MM/YYYY',
            separator:' - '
        },
        ranges: dateRange,
        startDate: moment().subtract(30, 'days'),
        endDate  : moment()
    },

    function (start, end) {
        $('.range_date').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    });
    
    });
</script>
@endsection