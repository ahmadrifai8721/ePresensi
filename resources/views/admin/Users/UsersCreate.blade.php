@extends('admin/layout')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $pageTitle }}</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">{{ $pageTitle }}</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal"
                        data-bs-target="#TambahUser">
                        Tambah Users <i class="mdi mdi-plus ms-1"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="TambahUserLabel">Tambah User Manual</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('Users.store') }}" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="name" />
                                            <label for="floatingInput">Nama Users</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control disabled" id="floatingemail"
                                                name="email" />
                                            <label for="floatingemail">E-Mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control disabled" id="floatinpassword"
                                                name="password" />
                                            <label for="floatinpassword">Password</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingWaliRole" name="Role">
                                                @forelse ($Role as $item)
                                                <option value="{{ $item->id }}">{{ $item->role }}
                                                </option>
                                                @empty
                                                <option selected disabled>Role Belum Di Buat</option>
                                                @endforelse
                                            </select>
                                            <label for="floatingWaliRole">Role</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-soft-primary rounded-pill">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body pt-0">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('Users.store') }}" method="post">
                        @csrf
                        @livewire('create-users')
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection
@include('admin/pagination')