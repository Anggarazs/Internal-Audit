@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Item Audit</h1>
    </div>

    @if(Session::has('berhasil'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif

    <div class="text-danger">
        @error('due_date')
        {{ $message }}
        @enderror
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data item Audit</h6>
        </div>
        <div class="card-body">
            @if(Auth::user()->role == 'auditor')
            <a href="#" class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal"
                data-target="#insertModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Item Audit</span>
            </a>
            <a href="#" class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal"
                data-target="#insertRoot">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Root Cause</span>
            </a>
            <a href="#" class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#insertCA">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Corrective Action</span>
            </a>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
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
                            @if(Auth::user()->role == 'auditor')
                            <th>Approval</th>
                            @endif
                            <th>Follow Up</th>
                            @if(Auth::user()->role == 'auditor')
                            <th>Action</th>
                            @endif
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
                                <a target="_blank" href="{{url('storage/LaporanFollowUp', $item -> file_fu)}}">{{ $item
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
                            <td>{{ $item -> progress }}</td>
                            <td>{{ $item -> close_date }}</td>
                            <td>
                                @if ($item -> status == 'Open' )
                                <p class="text-warning"> {{ $item -> status }}</p>
                                @else
                                <p class="text-success"> {{ $item -> status }}</p>
                                @endif
                            </td>
                            @if(Auth::user()->role == 'auditor')
                            <td class="text-center">
                                <a data-link="/approve_ca/{{ $item->id_corrective }}"
                                    class="btn btn-approve btn-success btn-icon-split btn-sm" data-toggle="modal"
                                    data-target="#Approve">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                    <span class="text">Approve</span>
                                </a>
                                <a data-link="/reject_ca_process/{{ $item->id_corrective }}" onClick='if(this.disabled){ return false; } else { this.disabled = true; }'
                                    class="btn btn-reject btn-danger btn-icon-split btn-sm mt-3" data-toggle="modal"
                                    data-target="#Reject">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-ban"></i>
                                    </span>
                                    <span class="text">Reject</span>
                                </a>
                            </td>
                            @endif
                            <td class="text-center">
                                <a data-link="/follow_up_ca/{{ $item->id_corrective }}" 
                                    class="btn btn-followup btn-warning btn-icon-split btn-sm " data-toggle="modal"
                                    data-target="#follow_up" id="button_fu">
                                    <span class="icon vertical-align: middle text-white-50">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    <span class="text">Follow Up</span>
                                </a>
                            </td>
                            @if(Auth::user()->role == 'auditor')
                            <td class="text-center">
                                <a href="edit_finding/{{$item->id_finding}}" class="btn btn-info btn-icon-split btn-sm"
                                    type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas  fa-edit"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <a href="delete_finding/{{$item->id_finding}}" id="tombol-hapus"
                                    class="btn btn-danger btn-icon-split btn-sm mt-3" type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus</span>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal"
        aria-hidden="true">
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
                                <select name="no_laporan_audit"
                                    class="form-control  @error('no_laporan_audit') is-invalid @enderror"
                                    id="no_laporan_audit" onchange="laporan_audit()" required>
                                    <option value="" selected disabled>Nomor Laporan Audit</option>
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
                                <input id="auditor" type="text" class="form-control form-control-user " name="auditor"
                                    value="{{ old('auditor') }}" required autocomplete="auditor" placeholder="Auditor"
                                    readonly>
                                @error('auditor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input id="judul_audit" type="text" class="form-control form-control-user "
                                    name="judul_audit" value="{{ old('judul_audit') }}" required
                                    autocomplete="judul_audit" placeholder="Judul Laporan Audit" readonly>
                                @error('judul_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input id="tipe_audit" type="text" class="form-control form-control-user "
                                    name="tipe_audit" value="{{ old('tipe_audit') }}" required autocomplete="tipe_audit"
                                    placeholder="Tipe Audit" readonly>
                                @error('tipe_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input id="kriteria_audit" type="text" class="form-control form-control-user "
                                    name="kriteria_audit" value="{{ old('kriteria_audit') }}" required
                                    autocomplete="kriteria_audit" placeholder="Kriteria Audit" readonly>
                                @error('kriteria_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input id="jenis_audit" type="text" class="form-control form-control-user "
                                    name="jenis_audit" value="{{ old('jenis_audit') }}" required
                                    autocomplete="jenis_audit" placeholder="Jenis Audit" readonly>
                                @error('jenis_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input id="tahun_audit" type="text" class="form-control form-control-user"
                                    name="tahun_audit" value="{{ old('tahun_audit') }}" required
                                    autocomplete="tahun_audit" placeholder="Tahun Audit" readonly>
                                @error('tahun_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <input id="tanggal_mulai_audit" type="text" class="form-control form-control-user"
                                    name="tanggal_mulai_audit" required autocomplete="tanggal_mulai_audit"
                                    placeholder="Tanggal Mulai" readonly>
                                @error('tanggal_mulai_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <input id="tanggal_akhir_audit" type="text" class="form-control form-control-user"
                                    name="tanggal_akhir_audit" required autocomplete="tanggal_akhir_audit"
                                    placeholder="Tanggal Akhir" readonly>
                                @error('tanggal_akhir_audit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <textarea id="finding" type="text" class="form-control form-control-user" name="finding"
                                    required autocomplete="finding" rows="5" placeholder="Finding"></textarea>
                                @error('finding')
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
    <!-- Modal -->
    <div class="modal fade" id="insertRoot" tabindex="-1" role="dialog" aria-labelledby="insertRoot" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertRoot">Input Root Cause</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/insert_root" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="nomor_laporan"
                                    class="form-control  @error('nomor_laporan') is-invalid @enderror"
                                    id="nomor_laporan" onchange="pilih_laporan()" required>
                                    <option value="" selected disabled>Nomor Laporan Audit</option>
                                    @foreach ($Audit as $item)
                                    <option value="{{$item->no_audit}}">{{ $item->no_laporan_audit}}</option>
                                    @endforeach
                                </select>
                                @error('nomor_laporan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="pilih_finding"
                                    class="form-control  @error('finding') is-invalid @enderror" id="pilih_finding"
                                    required>
                                    <option value="" selected disabled>Finding</option>
                                </select>
                                @error('finding')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input id="root_cause" type="text" class="form-control form-control-user "
                                    name="root_cause" value="{{ old('root_cause') }}" required autocomplete="root_cause"
                                    placeholder="Root Cause" required>
                                @error('root_cause')
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
    <!-- Modal -->
    <div class="modal fade" id="insertCA" tabindex="-1" role="dialog" aria-labelledby="insertCA" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertCA">Input Corrective Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/insert_CA" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="nomor_laporan_ca"
                                    class="form-control  @error('nomor_laporan_ca') is-invalid @enderror"
                                    id="nomor_laporan_caa" onchange="pilih_laporan_ca()" required>
                                    <option value="" selected disabled>Nomor Laporan Audit</option>
                                    @foreach ($Audit as $item)
                                    <option value="{{$item->no_audit}}">{{ $item->no_laporan_audit}}</option>
                                    @endforeach
                                </select>
                                @error('nomor_laporan_ca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="pilih_finding_caa"
                                    class="form-control  @error('pilih_finding_caa') is-invalid @enderror"
                                    id="pilih_finding_caa" onchange="pilih_finding_ca()" required>
                                    <option value="" selected disabled>Finding</option>
                                </select>
                                @error('pilih_finding_caa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="pilih_root"
                                    class="form-control  @error('pilih_root') is-invalid @enderror" id="pilih_root"
                                    required>
                                    <option value="" selected disabled>Root Cause</option>
                                </select>
                                @error('pilih_root')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <select name="department"
                                    class="form-control  @error('department') is-invalid @enderror" id="department"
                                    required>
                                    <option value="" selected disabled>Department</option>
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
                                <select name="risk_level"
                                    class=" form-control form-control-user @error('risk_level') is-invalid @enderror"
                                    id="risk_level" required>
                                    <option value="" selected disabled>Pilih Risk Level</option>
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
                                <input id="due_date" type="text" class="form-control form-control-user"
                                    onfocus="(this.type='date')" onblur="(this.type='text')" name="due_date" required
                                    autocomplete="due_date" placeholder="Due Date">
                                @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input id="ca" type="text" class="form-control form-control-user " name="ca"
                                    value="{{ old('ca') }}" required autocomplete="root_cause"
                                    placeholder="Corrective Action" required>
                                @error('ca')
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
    <!-- Modal -->
    <div class="modal fade" id="Reject" tabindex="-1" role="dialog" aria-labelledby="Reject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Reject">Input Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="comment-modal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label>Comment</label>
                                <input id="comment" type="text" class="form-control form-control-user " name="comment"
                                    required>
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Tambah Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="Approve" tabindex="-1" role="dialog" aria-labelledby="Approve" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Approve">Input Risk After</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="riskafter-modal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label>Risk After</label>
                                <select name="risk_after"
                                    class=" form-control form-control-user @error('risk_after') is-invalid @enderror"
                                    id="risk_after" required>
                                    <option value="" selected disabled>Pilih Risk After</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                @error('risk_after')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Ubah Risk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="follow_up" tabindex="-1" role="dialog" aria-labelledby="follow_up" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="follow_up">Input Risk After</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="followup-modal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Follow Up Corrective</label>
                                <input id="fu_corrective" type="text" class="form-control form-control-user "
                                    name="fu_corrective" required>
                                @error('fu_corrective')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Evident</label>
                                <input class="form-control form-control-user" type="file" name="file_fu"
                                    accept=".pdf,.jpg,.jpeg,.png" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Tambah Corrective</button>
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

    function pilih_laporan() {
     let nomor = $('#nomor_laporan').val();
     $.ajax ({
        url : '/tampil_finding',
        type : 'get',
        data : {
            no_audit : nomor
        },
        success : function (response) {
            // console.log(response.data);
        response.data.forEach(function(item, index) {
                var textdata = item['item_finding'] ;
                $('#pilih_finding').append($('<option>', {

                    value: item['id_jumlah_temuan'],
                    text: textdata
                }));
                
            });
        }
     });
    }

    function pilih_laporan_ca() {
     let nomor = $('#nomor_laporan_caa').val();
     $.ajax ({
        url : '/tampil_finding_ca',
        type : 'get',
        data : {
            no_audit : nomor
        },
        success : function (response) {
            // console.log(response.data);
        response.data.forEach(function(item, index) {
                var textdata = item['item_finding'] ;
                $('#pilih_finding_caa').append($('<option>', {

                    value: item['id_jumlah_temuan'],
                    text: textdata
                }));
                
            });
        }
     });
    }

    function pilih_finding_ca() {
     let nomor = $('#pilih_finding_caa').val();
     $.ajax ({
        url : '/tampil_root_ca',
        type : 'get',
        data : {
            no_audit : nomor
        },
        success : function (response) {
            // console.log(response.data);
        response.data.forEach(function(item, index) {
                var textdata = item['root_cause'] ;
                $('#pilih_root').append($('<option>', {

                    value: item['id_root'],
                    text: textdata
                }));
                
            });
        }
     });
    }
    </script>
    @endsection
