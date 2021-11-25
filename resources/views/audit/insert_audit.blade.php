@extends('layouts.master')

@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tambah Event Audit</h1>
<!-- Collapsable Card Example -->
    @if(Session::has('gagal'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Gagal,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif
        <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Event Audit</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input id="no_laporan_audit" type="text" class="form-control form-control-user"  name="no_laporan_audit" value="{{ old('no_laporan_audit') }}" required autocomplete="no_laporan_audit" placeholder="Nomor Laporan Audit">
                        @error('no_laporan_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input id="auditor" type="text" class="form-control form-control-user " name="auditor" value="{{ old('auditor') }}" required autocomplete="auditor" placeholder="Auditor">
                         @error('auditor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input id="judul_audit" type="text" class="form-control form-control-user " name="judul_audit" value="{{ old('judul_audit') }}" required autocomplete="judul_audit" placeholder="Judul">
                        @error('judul_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select name="status_audit"  class=" form-control form-control-user @error('status_audit') is-invalid @enderror" id="status_audit" required>
                            <option value=""selected disabled >Pilih Status Audit</option>                 
                            <option value="On Progress">On Progress</option>
                            <option value="Completed">Completed</option>                 
                        </select>
                        @error('status_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select name="tipe_audit"  class=" form-control form-control-user @error('tipe_audit') is-invalid @enderror" id="tipe_audit" required>
                            <option value=""selected disabled >Pilih Tipe Audit</option>                 
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>                 
                        </select>
                        @error('tipe_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                    <input id="jenis_audit" type="text" class="form-control form-control-user " name="jenis_audit" value="{{ old('jenis_audit') }}" required autocomplete="jenis_audit" placeholder="Jenis Audit">
                         @error('jenis_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input id="objek" type="text" class="form-control form-control-user"  name="objek" value="{{ old('objek') }}" required autocomplete="objek" placeholder="Objek">
                        @error('objek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                    <select name="department"  class="form-control  @error('department') is-invalid @enderror" id="department" required>
                        <option value=""selected disabled>Department</option>
                            @foreach ($department as $list_depart)
                            <option value="{{$list_depart->id}}">{{ $list_depart->nama_department}}</option>
                            @endforeach
                    </select>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>      
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input id="kriteria_audit" type="text" class="form-control form-control-user"  name="kriteria_audit" value="{{ old('kriteria_audit') }}" required autocomplete="kriteria_audit" placeholder="Kriteria Audit">
                        @error('kriteria_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <select name="tahun_audit"  class=" form-control form-control-user @error('tahun_audit') is-invalid @enderror" id="tahun_audit" value="{{ old('tahun_audit') }}" required>
                            <option value=""selected >Pilih Tahun Audit</option>                 
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>      
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>              
                        </select>
                        @error('tahun_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                     <input id="tanggal_mulai_audit" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tanggal_mulai_audit" required autocomplete="tanggal_mulai_audit" placeholder="Tanggal Mulai">
                      @error('tanggal_mulai_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                     <input id="tanggal_akhir_audit" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tanggal_akhir_audit" required autocomplete="tanggal_akhir_audit" placeholder="Tanggal Akhir">
                      @error('tanggal_akhir_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <input class="form-control form-control-user" type="file" name="file" accept=".pdf,.jpg,.jpeg,.png"/>
                </div>
                <div class="modal-footer">
                <a href="/audit"><button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button></a>
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection