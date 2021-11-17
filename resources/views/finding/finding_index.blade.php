@extends('layouts.master')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Corrective Action Monitoring</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Corrective Action</h6>
</div>
<div class="card-body">
        <a href="#" class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#insertModal">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Data Corrective Action</span>
    </a>
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr class="text-center">
            <th>No.</th>
            <th>No Laporan Audit</th>
            <th>Judul Laporan</th>
            <th>Status</th>
            <th>Progress</th>
            <th>Tipe Audit</th>
            <th>Risk Level</th>
            <th>Kriteria Audit</th>
            <th>Tahun Audit</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Akhir</th>
            <th>Auditor</th>
            <th>Finding</th>
            <th>Root Cause</th>
            <th>Department</th>
            <th>Auditee</th>
            <th>Corrective Action</th>
            <th>Due Date</th>
            <th>Evidence</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($finding as $item)
        <tr class="text-center">
            <td>{{$i++}}</td>
            <td>{{ $item -> no_laporan_audit }}</td>
            <td>{{ $item -> judul_audit}}</td>
            <td>{{ $item -> status }}</td>
            <td>{{ $item -> progress }}</td>
            <td>{{ $item -> tipe_audit }}t</td>
            <td>{{ $item -> risk_level }}</td>
            <td>{{ $item -> kriteria_audit }}t</td>
            <td>{{ $item -> tahun_audit }}</td>
            <td>{{ $item -> tanggal_mulai_audit }}</td>
            <td>{{ $item -> tanggal_akhir_audit }}</td>
            <td>{{ $item -> auditor }}</td>
            <td>{{ $item -> finding }}</td>
            <td>{{ $item -> root }}</td>
            <td>{{ $item -> department }}</td>
            <td>{{ $item -> auditee }}</td>
            <td>{{ $item -> corrective }}</td>
            <td>{{ $item -> due_date }}</td>
            <td>
                <input type="file" id="files" style="display:none;" accept=".pdf,.jpg,.jpeg,.png"/>
                
            </td>
            <td class="text-center">
                <a href="edit_finding/{{$item->id_finding}}" class="btn btn-info btn-icon-split btn-sm" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas  fa-edit"></i>
                    </span>
                    <span class="text">Edit</span>
                </a>  
            </td>
            <td class="text-center">
                <a href="delete_finding/{{$item->id_finding}}" id="tombol-hapus" class="btn btn-danger btn-icon-split btn-sm" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                </a>    
            </td>
        </tr>
        @endforeach
        </tbody>
        </thead>
    </table>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="insertModal">Input Finding</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/insert_audit" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                    <select name="no_laporan_audit"  class="form-control  @error('no_laporan_audit') is-invalid @enderror" id="no_laporan_audit" required>
                        <option value=""selected >Nomor Laporan Audit</option>
                            @foreach ($Audit as $item)
                            <option value="{{$item->no_audit}}">{{ $item->no_laporan_audit}}</option>
                            @endforeach
                    </select>
                        @error('no_laporan_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                     <input id="auditor" type="text" class="form-control form-control-user" name="auditor" required autocomplete="auditor" placeholder="Auditor">
                      @error('auditor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-12">
                        <input id="judul_audit" type="text" class="form-control form-control-user " name="judul_audit" value="{{ old('judul_audit') }}" required autocomplete="judul_audit" placeholder="Judul Laporan Audit">
                         @error('judul_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input id="status" type="text" class="form-control form-control-user " name="status" value="{{ old('status') }}" required autocomplete="status" placeholder="Status">
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                    <input id="risk_level" type="text" class="form-control form-control-user " name="risk_level" value="{{ old('risk_level') }}" required autocomplete="risk_level" placeholder="Risk Level">
                        @error('risk_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <input id="tipe_audit" type="text" class="form-control form-control-user " name="tipe_audit" value="{{ old('tipe_audit') }}" required autocomplete="tipe_audit" placeholder="Tipe Audit">
                         @error('tipe_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    <div class="col-sm-6">
                        <input id="krtieria_audit" type="text" class="form-control form-control-user"  name="krtieria_audit" value="{{ old('krtieria_audit') }}" required autocomplete="krtieria_audit" placeholder="Kriteria Audit">
                        @error('krtieria_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>    
                <div class="form-group row">
                <div class="col-sm-4">
                        <select name="tahun_audit"  class=" form-control form-control-user @error('tahun_audit') is-invalid @enderror" id="tahun_audit" value="{{ old('tahun_audit') }}" required>
                            <option value=""selected >Tahun Audit</option>                 
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
                    <div class="col-sm-4">
                     <input id="tanggal_mulai_audit" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tanggal_mulai_audit" required autocomplete="tanggal_mulai_audit" placeholder="Tanggal Mulai">
                      @error('tanggal_mulai_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                     <input id="tanggal_akhir_audit" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tanggal_akhir_audit" required autocomplete="tanggal_akhir_audit" placeholder="Tanggal Akhir">
                      @error('tanggal_akhir_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-lg-12">
                     <textarea id="finding" type="text" class="form-control form-control-user" name="finding" required autocomplete="finding" rows="5" placeholder="Finding"></textarea>
                      @error('finding')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                     <input id="department" type="text" class="form-control form-control-user" name="department" required autocomplete="department" placeholder="Department">
                      @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                     <input id="auditee" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="auditee" required autocomplete="auditee" placeholder="Auditee">
                      @error('auditee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6">
                    <input id="root" type="text" class="form-control form-control-user" name="root" required autocomplete="root" placeholder="Root Cause">
                      @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                    <input id="due_date" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="due_date" required autocomplete="due_date" placeholder="Due Date">
                      @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-lg-12">
                     <textarea id="corrective" type="text" class="form-control form-control-user" name="corrective" required autocomplete="corrective" rows="5" placeholder="Corrective Action"></textarea>
                      @error('corrective')
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