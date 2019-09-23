@extends('layouts.app')
@section('title')
Tambah Peserta
@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Matakuliah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::model($data, ['route' => ['peserta.update' , $data->kode_pst] ]) }}
              @csrf
              @method('PUT')
                <div class="box-body">
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Kode Peserta</label>
	                        {{ Form::text('kode_pst', null, ['class' => 'form-control', 'readonly' => 'readonly']) }}
	                        @if ($errors->has('kode_pst'))
	                          <div class="alert-danger">
	                              <strong>{{ $errors->first('kode_pst') }}</strong>
	                          </div>
	                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Nama Peserta</label>
	                        {{ Form::text('nama_pst', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('nama_pst'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('nama_pst') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Instansi</label>
	                        {{ Form::text('instansi', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('instansi'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('instansi') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Jenis_Kelamin</label>
	                        {{ Form::text('jenis_kelamin', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('jenis_kelamin'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Masuk</label>
	                        {{ Form::text('masuk', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('masuk'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('masuk') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Keluar</label>
	                        {{ Form::text('keluar', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('keluar'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('keluar') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-xs-3">
	                        <label for="">Status</label>
	                        {{ Form::text('status', null, ['class' => 'form-control']) }}
	                        @if ($errors->has('status'))
	                          <div class="alert-danger">
	                            <strong>{{ $errors->first('status') }}</strong>
	                          </div>
	                        @endif
                    	</div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-md btn-flat bg-navy" name="button"><i class="fa fa-save"></i></button>
                    <a href="{{ route('peserta.index') }}" class="btn btn-md bg-navy btn-flat"> <i class="fa fa-chevron-circle-left"></i> </a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</section>

@endsection
