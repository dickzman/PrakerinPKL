@extends('layouts.app')
@section('title')
Tambah Peserta
@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Peserta</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(['route' => 'peserta.store', 'enctype' => 'multipart/form-data', 'onchange' => 'preview_image(event)']) }}
                  @csrf
                    <div class="box-body">
                        <div class="form-group row">
                        	<div class="col-xs-6">
    	                        <label for="">Kode Peserta</label>
    	                        {{ Form::text('kode_pst', null, ['class' => 'form-control']) }}
    	                        @if ($errors->has('kode_pst'))
    	                          <div class="alert-danger">
    	                              <strong>{{ $errors->first('kode_pst') }}</strong>
    	                          </div>
    	                        @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        	<div class="col-xs-6">
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
                        	<div class="col-xs-4">
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
                        	<div class="col-xs-6">
    	                        <label for="">Jenis Kelamin</label>
    	                        {{ Form::text('jenis_kelamin', null, ['class' => 'form-control']) }}
    	                        @if ($errors->has('jenis_kelamin'))
    	                          <div class="alert-danger">
    	                            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
    	                          </div>
    	                        @endif
                        	</div>
                        </div>
                        <div class="form-group row">
                        	<div class="col-xs-6">
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
                        	<div class="col-xs-6">
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
                        	<div class="col-xs-6">
    	                        <label for="">Status</label>
    	                        {{ Form::text('status', null, ['class' => 'form-control']) }}
    	                        @if ($errors->has('status'))
    	                          <div class="alert-danger">
    	                            <strong>{{ $errors->first('status') }}</strong>
    	                          </div>
    	                        @endif
                        	</div>
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            {{ Form::textarea('ket_mk', null, ['class' => 'form-control']) }}
                        </div>-->
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-md btn-flat bg-navy" name="button"><i class="fa fa-save"></i></button>
                        <a href="{{ route('peserta.index') }}" class="btn btn-md bg-navy btn-flat"> <i class="fa fa-chevron-circle-left"></i> </a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@endsection
