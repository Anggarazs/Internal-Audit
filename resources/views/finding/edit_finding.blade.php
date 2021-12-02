@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Data Finding </h1>
    <p class="mb-4">Berikut merupakan detail data Finding  </p>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Data Item Audit</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <form method="post" action="/edit_finding_process" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="id_corrective" value="{{ $jumlah_temuan -> id_corrective  }}" hidden>
                        {{-- <div class="col-lg-6">
                            <label>Finding</label>
                            <input type="text" class="form-control" name="finding" required autocomplete="Finding"
                                placeholder="Finding" value="{{ $jumlah_temuan -> item_finding }}">
                            @error('finding')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        {{-- <div class="col-lg-6">
                            <label>Root Cause</label>
                            <input type="text" class="form-control" name="root_cause" required autocomplete="root_cause"
                                placeholder="Root Cause" value="{{ $jumlah_temuan -> root_cause }}">
                            @error('roto_cause')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                    </div>
                    {{-- <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Corrective Action</label>
                            <input type="text" class="form-control" name="corrective" required autocomplete="corrective"
                                placeholder="Corrective Action" value="">
                            @error('corrective')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Risk Level</label>
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
                    </div> --}}
                    {{-- <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Auditee</label>
                            <select name="auditee" class="form-control  @error('auditee') is-invalid @enderror"
                                id="auditee" required>
                                <option value="" selected disabled>Auditee</option>
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
                        <div class="col-lg-6">
                            <label>Due Date</label>
                            <input id="due_date" type="text" class="form-control form-control-user"
                                onfocus="(this.type='date')" onblur="(this.type='text')" name="due_date" required
                                autocomplete="due_date" placeholder="Due Date">
                            @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Percentage</label>
                            <input type="text" class="form-control" name="progress" required autocomplete="progress"
                                placeholder="Percentage" value="{{ $jumlah_temuan -> progress }}">
                            @error('progress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/finding"><button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button></a>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection