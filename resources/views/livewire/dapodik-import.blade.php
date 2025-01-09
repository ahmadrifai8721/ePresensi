<div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">

            <div class="row">
                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-google-classroom widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of  Kelas">
                                Kelas</h5>
                            <h3 class="mt-3 mb-3" wire:model='kelas'>{{ $kelas == null ? 0 : $kelas }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-primary-lighten text-primary"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Siswa">Siswa</h5>
                            <h3 class="mt-3 mb-3" wire:model="pesertaDidik">
                                {{ $pesertaDidik == null ? 0 : $pesertaDidik }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-warning-lighten text-warning"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Average PTK / GTK">PTK / GTK</h5>
                            <h3 class="mt-3 mb-3" wire:model="GTK">{{ $GTK == null ? 0 : $GTK }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-google-classroom widget-icon bg-secondary-lighten text-secondary"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Pembelajaran">Pembelajaran</h5>
                            <h3 class="mt-3 mb-3" wire:model="Pembelajaran">
                                {{ $Pembelajaran == null ? 0 : $Pembelajaran }}</h3>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
        @switch($Notice)
            @case("danger")
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">
                        {{ $noticeText }}
                    </h4>
                </div>
                @break
            @case("success")
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">
                        {{ $noticeText }}
                    </h4>
                </div>
            @break
            @case("warning")
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">
                        {{ $noticeText }}
                    </h4>
                </div>

            @break
            @default
        @endswitch

    <div class="row">
        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">sinkronisasi data</h4>
                    <a wire:click="syncDapodik" class="btn btn-sm btn-light">Connect Ke Server Dapodik <i
                            class="mdi mdi-sync ms-1"></i></a>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-blod">Siswa</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $pesertaDidik_progres }}%;"
                                                aria-valuenow="{{ $pesertaDidik_progres }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $pesertaDidik_progres }}%</div>
                                        </div>
                                        <h5 class="font-14 my-1 fw-blod">GTK / PTK</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $GTK_progres }}%;" aria-valuenow="{{ $GTK_progres }}"
                                                aria-valuemin="0" aria-valuemax="100">{{ $GTK_progres }}%</div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="btn btn-primary {{ $userUploadFinis ? '' : 'disabled' }}"
                                            wire:click="UploadUser">sinkron data</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-blod">Kelas</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $kelas_progres }}%;"
                                                aria-valuenow="{{ $kelas_progres }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $kelas_progres }}%</div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="btn btn-primary {{ $kelasUploadFinis ? '' : 'disabled' }}"
                                            wire:click="UploadKelas">sinkron
                                            data</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-blod">Pembelajaran</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $Pembelajaran_progres }}%;"
                                                aria-valuenow="{{ $Pembelajaran_progres }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $Pembelajaran_progres }}</div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="btn btn-primary {{ $pembelajaranUploadFinis ? '' : 'disabled' }}"
                                            wire:click="UploadPembelajaran">sinkron
                                            data</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6 col-lg-6 order-lg-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Log Singkron</h4>

                </div>

                <div class="card-body py-0 mb-3" data-simplebar
                    style="max-height: 283px;height: 283px;overflow: overlay;">
                    <div class="timeline-alt py-0">
                        @forelse ($log->sortByDesc("time")->all() as $result)
                            {{-- @dump($result) --}}
                            <div class="timeline-item">
                                <i class="mdi {{ $result['icon'] }} text-dark fs-3 text-center timeline-icon"></i>
                                <div class="timeline-item-{{ $result['icon_color'] }}">
                                    <a href="javascript:void(0);"
                                        class="text-{{ $result['icon_color'] }} fw-bold mb-1 d-block">&nbsp;
                                        {{ $result['title'] }}</a>
                                    <p class="mb-0 pb-2 ps-3">
                                        <small class="text-muted">{{ $result['time'] }}</small>
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="timeline-item">
                                <i class="mdi mdi-close-thick text-dark fs-3 text-center timeline-icon"></i>
                                <div class="timeline-item-danger">
                                    <a href="javascript:void(0);" class="text-danger fw-bold mb-1 d-block">&nbsp;
                                        Belum
                                        Pernah
                                        Sinkron</a>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">{{ date('d-m-Y') }}</small>
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!-- end timeline -->
                </div> <!-- end slimscroll -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

</div>
