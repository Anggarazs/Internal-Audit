@extends('layouts.master')

@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah Data Laporan Audit {{$audit->judul_audit}}</h1>
<p class="mb-4">Berikut merupakan detail data Laporan Audit {{$audit->judul_audit}}</p>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Data Laporan Audit</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
        <form method="post" action="/edit_audit_process" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
            <input type="hidden" name="no_audit" value="{{$audit->no_audit}}">
                <div class="col-lg-6">
                <label>Nomor Audit</label>
                    <input  type="text" class="form-control " name="no_laporan_audit" required autocomplete="no_laporan_audit" autofocus placeholder="Nomor Laporan Audit" value="{{$audit->no_laporan_audit}}">
                    @error('no_laporan_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6">
                <label>Judul</label>
                <input type="text" class="form-control"  name="judul_audit"  required autocomplete="judul_audit" placeholder="Judul Audit" value="{{$audit->judul_audit}}">
                @error('judul_audit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                <label>Status</label>
                    <select name="status_audit"  class=" form-control form-control-user @error('status_audit') is-invalid @enderror" id="status_audit" value="{{$audit->status_audit}} required>
                            <option value="" selected  >Pilih Status Audit</option>                 
                            <option value="On Progress">On Progress</option>
                            <option value="Completed">Completed</option>                 
                        </select>
                    @error('status_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="col-lg-6">
                <label>Percentage</label>
                <input  type="text" class="form-control"  name="percentage_audit"  required autocomplete="percentage_audit" placeholder="Jenis Audit" value="{{$audit->percentage_audit}}">
                @error('percentage_audit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                <label>Tipe Audit</label>
                    <select name="tipe_audit"  class=" form-control form-control-user @error('tipe_audit') is-invalid @enderror" id="tipe_audit" value="{{$audit->tipe_audit}} required>
                            <option value="" >Pilih Tipe Audit</option>                 
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>                 
                        </select>
                    @error('tipe_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="col-lg-6">
                <label>Jenis Audit</label>
                <input  type="text" class="form-control"  name="jenis_audit"  required autocomplete="jenis_audit" placeholder="Jenis Audit" value="{{$audit->jenis_audit}}">
                @error('jenis_audit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                <label>Objek</label>
                    <input type="text" class="form-control"  name="objek"  required autocomplete="objek" placeholder="Objek" value="{{$audit->objek}}">
                        @error('objek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-6">
                <label>Auditor</label>
                    <input type="text" class="form-control"  name="auditor"  required autocomplete="auditor" placeholder="Auditor" value="{{$audit->auditor}}">
                    @error('auditor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                <label>Department</label>
                    <select name="department" class="form-control @error('deparment') is-invalid @enderror" value="{{$audit->department}} required>
                            @foreach ($department as $list_depart)
                            <option value="{{ $list_depart->id}}" >{{ $list_depart->nama_department}}</option>
                            @endforeach
                    </select>
                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-6">
                <label>Kriteria</label>
                    <input  type="text" class="form-control"  name="kriteria_audit"  required autocomplete="kriteria_audit" placeholder="Kriteria Audit"  value="{{$audit->kriteria_audit}}">
                    @error('kriteria_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
            <div class="col-lg-4">
                <label>Tahun</label>  
                    <select name="tahun_audit"  class=" form-control form-control-user @error('tahun_audit') is-invalid @enderror" id="tahun_audit" value="{{$audit->tahun_audit}} required>
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
                <div class="col-lg-4"> 
                <label>Start</label>
                    <input  type="date" class="form-control" name="tanggal_mulai_audit"  required autocomplete="tanggal_mulai_audit" placeholder="Tanggal Mulai" value="{{$audit->tanggal_mulai_audit}}">
                    @error('tanggal_mulai_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
                <div class="col-lg-4"> 
                <label>End</label>
                    <input type="date" class="form-control"  name="tanggal_akhir_audit"  required autocomplete="tanggal_akhir_audit" placeholder="Tanggal AKhir"  value="{{$audit->tanggal_akhir_audit}}">
                    @error('tanggal_akhir_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
            <label>Dokumen Audit</label>
                <div class="col-lg-4"> 
                <span>File Lama :</span>
                <a target="_blank" href="{{url('storage/LaporanAudit', $audit -> file)}}">{{ $audit -> file }}</a>
                </div>
                <input id="file" type="file" accept=".pdf,.jpg,.png" class="form-control"  name="file" autocomplete="file" placeholder="Dokumen" href="{{url('storage/LaporanAudit', $audit -> file)}}">
                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="modal-footer">
            <a href="/audit"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
@endsection
