@extends('layouts.master')

@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah Data User {{$account->username}}</h1>
<p class="mb-4">Berikut merupakan detail data user {{$account->username}}</p>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Data User</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
        <form class="user" method="post" action="/edit_account_process">
            @csrf
            <div class="form-group">
            <input type="hidden" name="id" value="{{$account->id}}">
                <input id="name" type="text" class="form-control " name="username" required autocomplete="username" autofocus placeholder="Username"  value="{{$account->username}}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <select name="id_department"  class="form-control @error('id_department') is-invalid @enderror" id="id_department"  required>
                        @foreach ($department as $list_depart)
                        <option value="{{ $list_depart->id}}" >{{ $list_depart->nama_department}}</option>
                        @endforeach
                </select>
                    @error('id_department')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control"  name="password"  required autocomplete="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="modal-footer">
            <a href="/account"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
@endsection