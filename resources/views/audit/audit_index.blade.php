@extends('layouts.master')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Event Audit</h1>
</div>
@if(Session::has('berhasil'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Event Audit</h6>
</div>
<div class="card-body">
        <a href="view_insert_audit" class="btn mb-3 btn-success btn-icon-split btn-sm" >
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data Event Audit</span>
    </a>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center">
                    <th style="display:none">No Audit</th>
                    <th>No Audit</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Percentage</th>
                    <th>Tipe Audit</th>
                    <th>Jenis Audit</th>
                    <th>Objek</th>
                    <th>Department</th>
                    <th>Auditor</th>
                    <th>Kriteria</th>
                    <th>Tahun</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Finding</th>
                    <th>Root Cause</th>
                    <th>Corrective Action</th>
                    <th>Dokumen Audit</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach($audit as $list_audit)
                <tr class="text-center">
                    <td style="display:none">{{ $list_audit -> no_audit }}</td>
                    <td>{{ $list_audit -> no_laporan_audit }}</td>
                    <td>
                        <a target="_blank"  href="view_detail_audit/{{$list_audit->no_audit}}" >{{ $list_audit -> judul_audit }}</a>
                    </td>
                    <td>{{ $list_audit -> status_audit }}</td>
                    <td>{{ $list_audit -> percentage_audit }}</td>
                    <td>{{ $list_audit -> tipe_audit }}</td>
                    <td>{{ $list_audit -> jenis_audit }} </td>
                    <td>{{ $list_audit -> objek}}</td>
                    <td>{{ $list_audit -> nama_department}}  </td>
                    <td>{{ $list_audit -> auditor }}</td>
                    <td>{{ $list_audit -> kriteria_audit }}</td>
                    <td>{{ $list_audit -> tahun_audit }}</td>
                    <td>{{ $list_audit -> tanggal_mulai_audit }}</td>
                    <td>{{ $list_audit -> tanggal_akhir_audit  }}</td>
                    <td>{{ $finding_total }}</td>
                    <td>{{ $root_total }}</td>
                    <td></td>
                    <td>
                    <a target="_blank" href="{{url('storage/LaporanAudit', $list_audit -> file)}}">{{ $list_audit -> file }}</a>
                    </td>
                    <td class="text-center">
                    <a href="edit_audit/{{$list_audit->no_audit}}" class="btn btn-info btn-icon-split btn-sm" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas  fa-edit"></i>
                        </span>
                        <span class="text">Edit</span>
                    </a>  
                    </td>
                    <td class="text-center">
                        <a href="delete_audit/{{$list_audit->no_audit}}" id="tombol-hapus" class="btn btn-danger btn-icon-split btn-sm" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                        </a>    
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="insertModal">Input Laporan Audit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/insert_audit" enctype="multipart/form-data">
                @csrf
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection

