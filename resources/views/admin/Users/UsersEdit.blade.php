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

                </div>

                <div class="card-body pt-0">
                    <form action="{{ route('Users.update', $Users->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" value="{{ $Users->name }}"
                                name="name" />
                            <label for="floatingInput">Nama Users</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control disabled" id="floatingemail"
                                value="{{$Users->email }}" />
                            <label for="floatingemail">E-Mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" readonly class="form-control disabled" id="floatinpassword"
                                value=" {{ $Users->UserRole->Role->role != 'Peserta Didik' ? " Password Dapodik"
                                : "NISN Siswa" }}" />
                            <label for="floatinpassword">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingWaliRole" name="Role">
                                @forelse ($Role as $item)
                                <option value="{{ $item->id }}" {{ $Users->UserRole->role_id == $item->id? "selected":""
                                    }}>{{ $item->role }}
                                </option>
                                @empty
                                <option selected disabled>Role Belum Di Buat</option>
                                @endforelse
                            </select>
                            <label for="floatingWaliRole">Jenis Kelamin</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-soft-primary rounded-pill">Update Data Users</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection