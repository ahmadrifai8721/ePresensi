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
                        <a href="{{ Route('Users.create') }}" class="btn btn-sm btn-light">Tambah Users <i
                                class="mdi mdi-plus ms-1"></i></a>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive" id="table">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    <td colspan="4">
                                        <h5 class="font-14 my-1 fw-normal"></h5>
                                    </td>
                                    @forelse ($Users as $item)
                                        <tr>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Nama</h5>
                                                <span class="text-muted font-13">{{ $item->name }}</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Email</h5>
                                                <span class="text-muted font-13">{{ $item->email }}</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Role</h5>
                                                <span class="text-muted font-13">{{ $item->UserRole->role->role }}</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Action</h5>
                                                <a href="{{ route('Users.edit', parameters: $item->id) }}"
                                                    class="btn btn-outline-primary btn-sm me-1"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <form action="{{ route('Users.destroy', $item->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                            class="mdi mdi-trash-can"></i></button>
                                                </form>
                                                <button type="button" class="btn btn-outline-secondary btn-sm ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showTokenModal{{ $item->id }}">
                                                    <i class="mdi mdi-key"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="showTokenModal{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="showTokenModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="showTokenModalLabel{{ $item->id }}">User Token
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            {{-- @dump($item->mobileAccess) --}}
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Current Token</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                            id="tokenInput{{ $item->id }}"
                                                                            value="{{ $item->mobileAccess->pin ?? 'No token yet' }}"
                                                                            readonly>
                                                                        <button class="btn btn-outline-secondary"
                                                                            type="button"
                                                                            onclick="copyToken{{ $item->id }}()">
                                                                            Copy
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    function copyToken{{ $item->id }}() {
                                                                        const token = document.getElementById('tokenInput{{ $item->id }}').value;
                                                                        navigator.clipboard.writeText(token).then(function() {
                                                                            Swal.fire({
                                                                                icon: 'success',
                                                                                title: 'Copied!',
                                                                                text: 'Token copied to clipboard.',
                                                                                timer: 1500,
                                                                                showConfirmButton: false
                                                                            });
                                                                        });
                                                                    }
                                                                </script>
                                                                <form id="generateTokenForm{{ $item->id }}"
                                                                    method="get"
                                                                    action="{{ route('Users.show', $item->id) }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-primary w-100">Generate New
                                                                        Token</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Nama Users Belum Ada</h5>
                                                <span class="text-muted font-13">Wali Users Belum Di Isi</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">***</h5>
                                                <span class="text-muted font-13">Jumlah Users Di Users</span>
                                            </td>
                                            <td>
                                                <h5 class="font-14 my-1 fw-normal">Action</h5>
                                                <button class="btn btn-primary font-13 disabled">Edit</button>
                                                <button class="btn btn-danger font-13 disabled">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
    <!-- container -->
@endsection
@include('admin/pagination')
