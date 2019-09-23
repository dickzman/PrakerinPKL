@extends('layouts.app')
@section('title')
Data Peserta
@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                @if (Session::has('pesertaCreate'))
                <div class="alert-success text-center" role="alert" id="alert">
                    <strong> {{ Session::get('pesertaCreate') }} </strong>
                </div>
                @endif
                @if (Session::has('pesertaUpdate'))
                <div class="alert-success text-center" role="alert" id="alert">
                    <strong> {{ Session::get('pesertaUpdate') }} </strong>
                </div>
                @endif
                @if (Session::has('pesertaDelete'))
                <div class="alert-success text-center" role="alert" id="alert">
                    <strong> {{ Session::get('pesertaDelete') }} </strong>
                </div>
                @endif
                @if (Session::has('pesertaRestore'))
                <div class="alert-success text-center" role="alert" id="alert">
                    <strong> {{ Session::get('pesertaRestore') }} </strong>
                </div>
                @endif

                <div class="box-header">
                    <h3 class="box-title"> <i class="fa fa-database"></i> Data Peserta</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data-pst" width="100%" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Pst</th>
                                    <th>Nama Pst</th>
                                    <th>Instansi</th>
                                    <th>Jenis_Kelamin</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('peserta.create') }}" id="klik" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn bg-navy btn-flat btn-md"><i class="fa fa-plus-square"></i></a>
                    <a href="{{ route('peserta.trash') }}" class="btn bg-navy btn-flat btn-md"> <i class="fa fa-trash-o"></i></a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')

@if ($errors->any())
<script type="text/javascript">
    document.getElementById('klik').click();
</script>
@endif

<script>
    $(function() {
        $('#data-pst').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ],
            language: {
                "processing": "",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Data tidak ditemukan...",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari Data:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            },
            ajax: '{{ route('peserta.json') }}',
            columns: [{
                    data: 'kode_pst',
                    name: 'kode_pst'
                },
                {
                    data: 'nama_pst',
                    name: 'nama_pst'
                },
                {
                    data: 'instansi',
                    name: 'instansi'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'masuk',
                    name: 'masuk'
                },
                {
                    data: 'keluar',
                    name: 'keluar'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    $("#alert").fadeTo(2000, 500).slideUp(500, function() {
        $("#success-alert").slideUp(500);
    });
</script>

@endpush
