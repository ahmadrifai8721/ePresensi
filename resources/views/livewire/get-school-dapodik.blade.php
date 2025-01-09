<div>

        <div class="row">
        <div class="col-xl-12col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title text-capitalize">Admiistrator User Setting</h4>
                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i
                            class="mdi mdi-download ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">
                    <form class="row g-3" action="{{ route('setting.userAdmin') }}" method="POST">

                        @csrf
                        @method("PUT")

                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{old('name',$userAdmin->name) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="{{old('email',$userAdmin->email) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                placeholder="{{old('name','******') }}">
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary rounded-5" type="submit">Update User Admin</button>
                        </div>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>

    <form class="row" action="{{ route('setting.update',$dataSekolah->id) }}" method="POST">
        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title text-capitalize">School Identity Setting</h4>
                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i
                            class="mdi mdi-download ms-1"></i></a> --}}
                </div>

                <div class="card-body pt-0">



                        @csrf
                        @method("PUT")
                    <div class="row g-3">

                        <div class="col-md-12">
                            <label for="name" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="name" name="schoolName"
                            value="{{old('schoolName',$dataSekolah->schoolName) }}">

                            <label for="NPSN" class="form-label mt-3">NPSN</label>
                            <input type="text" class="form-control" id="NPSN" name="schoolNPSN"
                            value="{{old('schoolNPSN',$dataSekolah->schoolNPSN) }}">

                        </div>
                        <div class="col-md-12">
                            <label for="Address" class="form-label">School Address</label>
                            <textarea type="Address" class="form-control" id="Address" name="schoolAddress" rows="10" cols="20"
                            placeholder="{{old('schoolAddress',$dataSekolah->schoolAddress ) }}">{{old('schoolAddress',$dataSekolah->schoolAddress ) }}</textarea>
                        </div>

                        <div class="col-12 text-end mt-3">
                            <button class="btn btn-primary rounded-5" type="submit">Update User Admin</button>
                        </div>



                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title text-capitalize my-3">Presensi Setting</h4>
                </div>

                <div class="card-body pt-0">

                        <div class="col-md-12">
                            <input type="checkbox" {{ $presensi ? "checked":"" }} wire:model='presensi' wire:click='setPresensi' class="btn-check" id="presensiStatus" name="presensiStatus" autocomplete="off">
                            @if ($presensi)
                            <label class="btn btn-success" for="presensiStatus">Active</label><br>
                            @else
                            <label class="btn btn-danger" for="presensiStatus">Disabled</label><br>
                            @endif

                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </form>


</div>
