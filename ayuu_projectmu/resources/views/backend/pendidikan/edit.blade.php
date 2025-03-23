@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Edit Pendidikan</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ url('dashboard') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i>Riwayat Hidup</li>
                    <li class="fa fa-files-o">Pendidikan</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Data Pendidikan
                    </header>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pendidikan.update', $pendidikan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ $pendidikan->nama }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tingkatan</label>
                                <select name="tingkatan" class="form-control" required>
                                <option value="1" {{ $pendidikan->tingkatan == 1 ? 'selected' : '' }}>TK</option>
                                    <option value="2" {{ $pendidikan->tingkatan == 2 ? 'selected' : '' }}>SD</option>
                                    <option value="3" {{ $pendidikan->tingkatan == 3 ? 'selected' : '' }}>SMP</option>
                                    <option value="4" {{ $pendidikan->tingkatan == 4 ? 'selected' : '' }}>SMA</option>
                                    <option value="5" {{ $pendidikan->tingkatan == 5 ? 'selected' : '' }}>SMK</option>
                                    <option value="6" {{ $pendidikan->tingkatan == 6 ? 'selected' : '' }}>D3</option>
                                    <option value="7" {{ $pendidikan->tingkatan == 7 ? 'selected' : '' }}>S1</option>
                                    <option value="8" {{ $pendidikan->tingkatan == 8 ? 'selected' : '' }}>S2</option>
                                    <option value="9" {{ $pendidikan->tingkatan == 9 ? 'selected' : '' }}>S3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" class="form-control" value="{{ $pendidikan->tahun_masuk }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tahun Keluar</label>
                                <input type="number" name="tahun_keluar" class="form-control" value="{{ $pendidikan->tahun_keluar }}" required>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('pendidikan.index') }}" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection
