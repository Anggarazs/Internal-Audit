@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail dari Laporan Audit berjudul {{ $audit->judul_audit }}</h1>
    <!-- Collapsable Card Example -->
    @if(Session::has('gagal'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <strong>Gagal,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Detail {{ $audit->judul_audit }}</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Nomor Audit</label>
                        <input id="no_laporan_audit" type="text" class="form-control form-control-user"
                            name="no_laporan_audit" value="{{ $audit->no_laporan_audit }}" readonly>
                        @error('no_laporan_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>Auditor</label>
                        <input id="auditor" type="text" class="form-control form-control-user " name="auditor"
                            autocomplete="auditor" value="{{ $audit->auditor }}" readonly>
                        @error('auditor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Judul</label>
                        <input id="judul_audit" type="text" class="form-control form-control-user " name="judul_audit"
                            autocomplete="judul_audit" value="{{ $audit->judul_audit }}" readonly>
                        @error('judul_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Status</label>
                        <input id="status_audit" type="text" class="form-control form-control-user " name="status_audit"
                            autocomplete="status_audit" value="{{ $audit->status_audit }}" readonly>
                        @error('status_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Tipe Audit</label>
                        <input id="tipe_audit" type="text" class="form-control form-control-user " name="tipe_audit"
                            autocomplete="tipe_audit" value="{{ $audit->tipe_audit }}" readonly>
                        @error('tipe_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>Jenis Audit</label>
                        <input id="jenis_audit" type="text" class="form-control form-control-user " name="jenis_audit"
                            autocomplete="jenis_audit" value="{{ $audit->jenis_audit }}" readonly>
                        @error('jenis_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Objek</label>
                        <input id="objek" type="text" class="form-control form-control-user" name="objek"
                            autocomplete="objek" value="{{ $audit->objek }}" readonly>
                        @error('objek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>Department</label>
                        <input id="department" type="text" class="form-control form-control-user" name="department"
                            value="{{ $audit->Depart->nama_department }}" readonly>
                        @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Kriteria</label>
                        <input id="kriteria_audit" type="text" class="form-control form-control-user"
                            name="kriteria_audit" value="{{ $audit->kriteria_audit }}" readonly>
                        @error('kriteria_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>Tahun</label>
                        <input id="tahun_audit" type="text" class="form-control form-control-user" name="tahun_audit"
                            value="{{ $audit->tahun_audit }}" readonly>
                        @error('tahun_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Start</label>
                        <input id="tanggal_mulai_audit" type="text" class="form-control form-control-user"
                            name="tanggal_mulai_audit" value="{{ $audit->tanggal_mulai_audit }}" readonly>
                        @error('tanggal_mulai_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>End</label>
                        <input id="tanggal_akhir_audit" type="text" class="form-control form-control-user"
                            name="tanggal_akhir_audit" value="{{ $audit->tanggal_akhir_audit }}" readonly>
                        @error('tanggal_akhir_audit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label>Dokumen Audit</label>
                        <a target="_blank" href="{{url('storage/LaporanAudit', $audit -> file)}}"><input type="text"
                                style="cursor:pointer" class="form-control form-control-user"
                                value="{{ $audit -> file }}" readonly></a>
                    </div>
                    <div class="modal-footer">
                        <a href="/audit"><button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Detail Finding dari {{ $audit->judul_audit }}</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Laporan Audit</th>
                                <th>Judul Laporan</th>
                                <th>Finding</th>
                                <th>Root Cause</th>
                                <th>Corrective Action</th>
                                <th>Risk Level</th>
                                <th>Auditee</th>
                                <th>Due Date</th>
                                <th bgcolor="#F0F3FD">FU Corrective Action</th>
                                <th bgcolor="#F0F3FD">Evident</th>
                                <th>Comment</th>
                                <th>Risk After</th>
                                <th>Percentage</th>
                                <th>Close Date</th>
                                <th>Status</th>
                            </tr>
                        <tbody>
                            @foreach($finding as $item)
                            <tr class="text-center">
                                <td>{{ $item -> no_laporan_audit }}</td>
                                <td>{{ $item -> judul_audit}}</td>
                                <td>{{ $item -> item_finding}}</td>
                                <td>{{ $item -> root_cause}} </td>
                                <td>{{ $item -> corrective }}</td>
                                <td>
                                    @if ($item -> risk_level == 'Low' )
                                    <p class="text-success">{{ $item -> risk_level }}</p>
                                    @endif
                                    @if ($item -> risk_level == 'Medium' )
                                    <p class="text-warning"> {{ $item -> risk_level }}</p>
                                    @endif
                                    @if ($item -> risk_level == 'High' )
                                    <p class="text-danger"> {{ $item -> risk_level }}</p>
                                    @endif

                                </td>
                                <td>{{ $item -> department }}</td>
                                <td>{{ $item -> due_date }}</td>
                                <td bgcolor="#F0F3FD">{{ $item -> fu_corrective }}</td>
                                <td bgcolor="#F0F3FD">
                                    <a target="_blank" href="{{url('storage/LaporanFollowUp', $item -> file_fu)}}">{{
                                        $item
                                        -> file_fu }}</a>
                                </td>
                                <td>{{ $item -> comment }}</td>
                                <td>
                                    @if ($item -> risk_after == 'Low' )
                                    <p class="text-success">{{ $item -> risk_after }}</p>
                                    @endif
                                    @if ($item -> risk_after == 'Medium' )
                                    <p class="text-warning"> {{ $item -> risk_after }}</p>
                                    @endif
                                    @if ($item -> risk_after == 'High' )
                                    <p class="text-danger"> {{ $item -> risk_after }}</p>
                                    @endif

                                </td>
                                <td>{{ $item -> progress }}%</td>
                                <td>{{ $item -> close_date }}</td>
                                <td>
                                    @if ($item -> status == 'Open' )
                                    <p class="text-warning"> {{ $item -> status }}</p>
                                    @else
                                    <p class="text-success"> {{ $item -> status }}</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
