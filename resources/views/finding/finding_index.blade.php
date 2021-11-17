@extends('layouts.master')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Corrective Action Monitoring</h1>
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
            <th>Jenis Audit</th>
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
            <td>{{ $item -> tipe_audit }}</td>
            <td>{{ $item -> jenis_audit }}</td>
            <td>{{ $item -> risk_level }}</td>
            <td>{{ $item -> kriteria_audit}}</td>
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
                <form method="POST" action="/insert_finding" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                    <select name="no_laporan_audit" class="form-control  @error('no_laporan_audit') is-invalid @enderror" id="no_laporan_audit" onchange="laporan_audit()" required>
                        <option value=""selected disabled >Nomor Laporan Audit</option>
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
                        <input id="auditor" type="text" class="form-control form-control-user " name="auditor" value="{{ old('auditor') }}" required autocomplete="auditor" placeholder="Auditor" readonly>
                      @error('auditor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-12">
                        <input id="judul_audit" type="text" class="form-control form-control-user " name="judul_audit" value="{{ old('judul_audit') }}" required autocomplete="judul_audit" placeholder="Judul Laporan Audit" readonly>
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
                        <select name="risk_level"  class=" form-control form-control-user @error('risk_level') is-invalid @enderror" id="risk_level" required>
                            <option value=""selected disabled >Pilih Risk Level</option>                 
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>  
                            <option value="High">High</option>               
                        </select>
                        @error('risk_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <input id="tipe_audit" type="text" class="form-control form-control-user " name="tipe_audit" value="{{ old('tipe_audit') }}" required autocomplete="tipe_audit" placeholder="Tipe Audit" readonly>
                         @error('tipe_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                    <div class="col-sm-6">
                        <input id="kriteria_audit" type="text" class="form-control form-control-user " name="kriteria_audit" value="{{ old('kriteria_audit') }}" required autocomplete="kriteria_audit" placeholder="Kriteria Audit" readonly>
                         @error('kriteria_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input id="jenis_audit" type="text" class="form-control form-control-user " name="jenis_audit" value="{{ old('jenis_audit') }}" required autocomplete="jenis_audit" placeholder="Jenis Audit" readonly>
                         @error('jenis_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>    
                <div class="form-group row">
                <div class="col-sm-4">
                    <input id="tahun_audit" type="text" class="form-control form-control-user"  name="tahun_audit" value="{{ old('tahun_audit') }}" required autocomplete="tahun_audit" placeholder="Tahun Audit" readonly>
                        @error('tahun_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                     <input id="tanggal_mulai_audit" type="text" class="form-control form-control-user" name="tanggal_mulai_audit" required autocomplete="tanggal_mulai_audit" placeholder="Tanggal Mulai" readonly>
                      @error('tanggal_mulai_audit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                     <input id="tanggal_akhir_audit" type="text" class="form-control form-control-user" name="tanggal_akhir_audit" required autocomplete="tanggal_akhir_audit" placeholder="Tanggal Akhir" readonly>
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
                        <select name="department"  class="form-control  @error('department') is-invalid @enderror" id="department" required>
                            <option value=""selected disabled>Department</option>
                                @foreach ($Depart as $list_depart)
                                    <option value="{{$list_depart->id}}">{{ $list_depart->nama_department}}</option>
                                @endforeach
                        </select>
                      @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                     <input id="auditee" type="text" class="form-control form-control-user" name="auditee" required autocomplete="auditee" placeholder="Auditee">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<script>
    function laporan_audit() {
     let nomor = $('#no_laporan_audit').val();
     $.ajax ({
        url : '/data_tampil',
        type : 'get',
        data : {
            no_audit : nomor
        },
        success : function (response) {
            // console.log(response.data.auditor);
            let isian = response.data; 
            $('#auditor').val(isian.auditor);
            $('#judul_audit').val(isian.judul_audit);
            $('#tipe_audit').val(isian.tipe_audit);
            $('#kriteria_audit').val(isian.kriteria_audit);
            $('#jenis_audit').val(isian.jenis_audit);
            $('#tahun_audit').val(isian.tahun_audit);
            $('#tanggal_mulai_audit').val(isian.tanggal_mulai_audit);
            $('#tanggal_akhir_audit').val(isian.tanggal_akhir_audit);
        }
     });
    }
</script>
@endsection
