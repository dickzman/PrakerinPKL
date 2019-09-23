@extends('layouts.app')
@section('title') Home
@endsection
@section('content')

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-android-contacts"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number text-muted">Peserta Prakerin</span>
                    <a href="{{ route('peserta.index') }}" class="info-box-text text-muted">Buka Menu <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-person"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number text-muted">Pembimbing</span>
                    <a href="{{ route('pembimbing.index') }}" class="info-box-text text-muted">Buka Menu <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

@endsection
