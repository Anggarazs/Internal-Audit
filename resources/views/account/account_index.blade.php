@extends('layouts.master')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ">Account Management</h1>
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
    <h6 class="m-0 font-weight-bold text-primary">Data Akun</h6>
</div>
<div class="card-body">
        <a href="#" class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#insertModal">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Akun</span>
    </a>
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    @csrf
        <thead>
            <tr class="text-center">
                <th >No</th>
                <th >Username</th>
                <th >Department</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($account as $list_account)
        <tr>
            <td class="text-center">{{ $i++ }}</td>
            <td class="text-center">{{ $list_account->username }}</td>
            <td class="text-center">{{ $list_account->nama_department }}</td>
            <td class="text-center">
            <a class="btn btn-info btn-icon-split btn-sm" href="edit_account/{{$list_account->id}}">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Edit</span>
            </a>  
            </td>
            <td class="text-center">
                <a href="delete_account/{{$list_account->id}}" onclick="return confirm('Apakah anda yakin ingin menghapus akun?')" class="btn btn-danger btn-icon-split btn-sm" type="submit">
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
</div>
<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="insertModal">Input Akun Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="user" method="POST" action="/insert_account">
                @csrf
                <div class="form-group">
                   <input id="username" type="text" class="form-control " name="username" value="{{ old('username') }}" required autocomplete="name" autofocus placeholder="Username">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                <select name="id_department"  class="form-control  @error('id_department') is-invalid @enderror" id="id_department" required>
                        <option value=""selected >Choose Department</option>
                        @foreach ($department as $list_depart)
                        <option value="{{$list_depart->id}}">{{ $list_depart->nama_department}}</option>
                        @endforeach
                </select>
                    @error('id_department')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="Password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah Akun</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection