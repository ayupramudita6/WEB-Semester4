@extends('backend/layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Riwayat Hidup</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ url('dashboard') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i>Riwayat Hidup</li>
                    <li><i class="fa fa-files-o"></i> Pendidikan</li>
                </ol>
            </div>
        </div>

        <!-- Form validations -->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Pendidikan
                    </header>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body">
                        <form class="form-validate form-horizontal" id="pendidikan_form" method="POST" 
                            action="{{ route('pendidikan.store') }}">

                            @csrf
                            <div class="form-group">
                                <label class="control-label col-lg-2">Nama Sekolah <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="nama" name="nama" minlength="5" type="text" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Tingkatan <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="tingkatan" id="tingkatan" required>
                                        <option value="TK">TK</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Tahun Masuk <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input id="tahun_masuk" type="text" name="tahun_masuk" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Tahun Keluar <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input id="tahun_keluar" type="text" name="tahun_keluar" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ route('pendidikan.index') }}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection

@push('content-css')
    <link href="{{ asset('backend/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endpush

@push('content-js')
    <script src="{{ asset('backend/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $('#tahun_masuk').datepicker({
            format: "yyyy",
            minViewMode: 2,
            viewMode: 2,
            autoclose: true
        });

        $('#tahun_keluar').datepicker({
            format: "yyyy",
            minViewMode: 2,
            viewMode: 2,
            autoclose: true
        });
    </script>
@endpush
