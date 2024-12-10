@extends('layouts.app')
@push('css')
    <style>
        .form-label {
            font-size: 1.1rem;
        }

        .form-check-input {
            transform: scale(1.5);
            margin-left: 10px;
        }

        .btn {
            width: 60px;
            /* Lebar tombol */
            text-align: center;
        }

        .form-check-input {
            transform: scale(1.5);
            /* Perbesar ukuran checkbox */
        }

        .d-flex.align-items-center.gap-2 {
            gap: 1rem;
            /* Jarak antara elemen */
        }

        .btn-block {
            width: 10%;
            display: block;
            /* Mengubah tampilan menjadi block agar memenuhi lebar penuh */
            text-align: center;
            /* Memastikan teks berada di tengah */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('FORMULIR PEDULI HSE') }}</div>
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    @if ($errors->any())
                        <script>
                            let errorMessages = @json($errors->toArray());
                            let formattedErrors = Object.values(errorMessages).flat().join('\n');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Errors',
                                text: formattedErrors,
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-3">
                            @if ($report->feedback)
                                <!-- Tampilkan badge success jika sudah ada aksi approve/reject -->
                                <div class="d-flex flex-column align-items-start mb-3">
                                    <span class="badge {{ $report->feedback === 'approve' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($report->feedback) }}
                                    </span>
                                    <span class="mt-2">Ket : {{ ucfirst($report->reason) }}</span>
                                </div>
                            @else
                                <!-- Tampilkan tombol aksi jika belum ada aksi -->
                                <div class="btn-group mb-3">
                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal"
                                                onclick="setAction('approve', {{ $report->id }})">
                                                Setujui
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal"
                                                onclick="setAction('reject', {{ $report->id }})">
                                                Tolak
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                        </div>


                        <!-- Modal Feedback -->
                        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="feedbackForm" method="POST" action="">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="report_id" id="reportId" value="">
                                            <input type="hidden" name="action" id="actionType" value="">

                                            <div class="form-group">
                                                <label for="reason">Keterangan</label>
                                                <textarea name="reason" id="reason" class="form-control" placeholder="Masukkan keterangan"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <div id="contentToExport">
                            <table class="table table-bordered border-black">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="3">FORMULIR PEDULI HSE</th>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-3">
                                                <div class="d-flex flex-column align-items-start gap-1">
                                                    <!-- Unsafe Condition -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-sm btn-danger">RED</button>
                                                        <input type="checkbox" class="form-check-input" id="unsafeCondition"
                                                            name="condition_status[]" value="Unsafe Condition"
                                                            {{ in_array('Unsafe Condition', explode(', ', $report->condition_status ?? '')) ? 'checked' : '' }}
                                                            disabled>
                                                        <label for="unsafeCondition" class="mb-0">Unsafe
                                                            Condition</label>
                                                    </div>

                                                    <!-- Unsafe Act -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger invisible"></button>
                                                        <input type="checkbox" class="form-check-input" id="unsafeAct"
                                                            name="condition_status[]" value="Unsafe Act"
                                                            {{ in_array('Unsafe Act', explode(', ', $report->condition_status ?? '')) ? 'checked' : '' }}
                                                            disabled>
                                                        <label for="unsafeAct" class="mb-0">Unsafe Act</label>
                                                    </div>

                                                    <!-- Safe Condition -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-sm btn-success">GREEN</button>
                                                        <input type="checkbox" class="form-check-input" id="safeCondition"
                                                            name="condition_status[]" value="Safe Condition"
                                                            {{ in_array('Safe Condition', explode(', ', $report->condition_status ?? '')) ? 'checked' : '' }}
                                                            disabled>
                                                        <label for="safeCondition" class="mb-0">Safe
                                                            Condition</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 33%">DATE : <strong>{{ $report->date }}</strong></td>
                                        <td style="width: 33%">Reported By :
                                            <strong>{{ $report->reported_by }}</strong>
                                        </td>
                                        <td style="width: 33%">Inst / Dept : <strong>{{ $report->inst_dept }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CATEGORY "A"<br>Alat Pelindung Diri / PPE</th>
                                        <th>CATEGORY "B"<br>Posisi Kerja / Working Position</th>
                                        <th>CATEGORY "C"<br>Kesehatan & Ergonomi / Ergonomic & Health</th>
                                    </tr>

                                    {{-- Baris pertama --}}
                                    <tr>
                                        <!-- Mata & Wajah -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="faceEyes">Mata & Wajah <br>Face &
                                                    Eyes</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="faceEyes"
                                                    name="ppe[face_eyes]"
                                                    {{ isset($report->ppe['face_eyes']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['face_eyes']) && $report->ppe_notes['face_eyes'])
                                                <div class="text-muted">
                                                    <small>Keterangan: {{ $report->ppe_notes['face_eyes'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Berbenturan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="strikingAgainst">Berbenturan
                                                    <br>Striking Against</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="strikingAgainst" name="working_position[striking_against]"
                                                    {{ isset($report->working_position['striking_against']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->working_position_notes['striking_against']) && $report->working_position_notes['striking_against'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->working_position_notes['striking_against'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Sikap Tubuh -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="posture">Sikap Tubuh
                                                    <br>Posture</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="posture"
                                                    name="ergonomic[posture]"
                                                    {{ isset($report->ergonomic['posture']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['posture']) && $report->ergonomic_notes['posture'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['posture'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris kedua --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="ears">Telinga <br>Ears</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="ears"
                                                    name="ppe[ears]" {{ isset($report->ppe['ears']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['ears']) && $report->ppe_notes['ears'])
                                                <div class="text-muted">
                                                    <small>Keterangan: {{ $report->ppe_notes['ears'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="struckBy">Terbentur Oleh
                                                    <br>Struck
                                                    By</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="struckBy"
                                                    name="working_position[struck_by]"
                                                    {{ isset($report->working_position['struck_by']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->working_position_notes['struck_by']) && $report->working_position_notes['struck_by'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->working_position_notes['struck_by'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="motionType">Jenis & Jumlah Gerakan
                                                    <br>Number & Type of Motion</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="motionType"
                                                    name="ergonomic[motion_type]"
                                                    {{ isset($report->ergonomic['motion_type']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['motion_type']) && $report->ergonomic_notes['motion_type'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['motion_type'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>



                                    {{-- Baris kelima --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="feetLegs">Kaki & Telapak
                                                    Kaki<br>Feet & Legs</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="feetLegs"
                                                    name="ppe[feet_legs]"
                                                    {{ isset($report->ppe['feet_legs']) && $report->ppe['feet_legs'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['feet_legs']) && $report->ppe_notes['feet_legs'])
                                                <div class="text-muted">
                                                    <small>Keterangan: {{ $report->ppe_notes['feet_legs'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="extremeTemperature">Temperatur
                                                    yang Berlebihan<br>Extremes Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="extremeTemperature" name="ergonomic[extreme_temperature]"
                                                    {{ isset($report->ergonomic['extreme_temperature']) && $report->ergonomic['extreme_temperature'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['extreme_temperature']) && $report->ergonomic_notes['extreme_temperature'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['extreme_temperature'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsGrip">Peralatan dan Cara
                                                    Penggunaan<br>Tools & Grip</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="toolsGrip"
                                                    name="tools[tools_grip]"
                                                    {{ isset($report->tools['tools_grip']) && $report->tools['tools_grip'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->tools_notes['tools_grip']) && $report->tools_notes['tools_grip'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['tools_grip'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="respiratorySystem">Sistim
                                                    Pernapasan<br>Respiratory System</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="respiratorySystem" name="ppe[respiratory_system]"
                                                    {{ isset($report->ppe['respiratory_system']) && $report->ppe['respiratory_system'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['respiratory_system']) && $report->ppe_notes['respiratory_system'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ppe_notes['respiratory_system'] }}</small>
                                                </div>
                                            @else
                                                <div class="text-muted">
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="electricalCurrent">Arus
                                                    Listrik<br>Electrical Current</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="electricalCurrent" name="ergonomic[electrical_current]"
                                                    {{ isset($report->ergonomic['electrical_current']) && $report->ergonomic['electrical_current'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['electrical_current']) && $report->ergonomic_notes['electrical_current'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['electrical_current'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="airVentilation">Sirkulasi
                                                    Udara<br>Air Ventilation</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="airVentilation" name="environment[air_ventilation]"
                                                    {{ isset($report->environment['air_ventilation']) && $report->environment['air_ventilation'] ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['air_ventilation']) && $report->environment_notes['air_ventilation'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['air_ventilation'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- Baris ketujuh --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="trunk">Dada<br>Trunk</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="trunk"
                                                    name="ppe[trunk]" {{ isset($report->ppe['trunk']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['trunk']) && $report->ppe_notes['trunk'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ppe_notes['trunk'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="inhaling">Terhisap Oleh
                                                    Pernapasan<br>Inhaling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="inhaling"
                                                    name="ergonomic[inhaling]"
                                                    {{ isset($report->ergonomic['inhaling']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['inhaling']) && $report->ergonomic_notes['inhaling'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['inhaling'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="vibration">Getaran<br>Vibration</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="vibration"
                                                    name="ergonomic[vibration]"
                                                    {{ isset($report->ergonomic['vibration']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['vibration']) && $report->ergonomic_notes['vibration'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['vibration'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris kedelapan --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="body">Badan<br>Body</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="body"
                                                    name="ppe[body]" {{ isset($report->ppe['body']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['body']) && $report->ppe_notes['body'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ppe_notes['body'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="absorbing">Terserap Oleh
                                                    Kulit<br>Absorbing</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="absorbing"
                                                    name="ergonomic[absorbing]"
                                                    {{ isset($report->ergonomic['absorbing']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['absorbing']) && $report->ergonomic_notes['absorbing'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['absorbing'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workAreaTemperature">Suhu<br>Work
                                                    Area Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workAreaTemperature" name="ergonomic[work_area_temperature]"
                                                    {{ isset($report->ergonomic['work_area_temperature']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->ergonomic_notes['work_area_temperature']) && $report->ergonomic_notes['work_area_temperature'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ergonomic_notes['work_area_temperature'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris kesembilan --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others"
                                                    name="ppe[others]"
                                                    {{ isset($report->ppe['others']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->ppe_notes['others']) && $report->ppe_notes['others'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->ppe_notes['others'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="fallingObjects">Kejatuhan
                                                    Benda<br>Falling Objects</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="fallingObjects" name="working_position[falling_objects]"
                                                    {{ isset($report->working_position['falling_objects']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->working_position_notes['falling_objects']) && $report->working_position_notes['falling_objects'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->working_position_notes['falling_objects'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="lighting">Penerangan<br>Lighting</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="lighting"
                                                    name="environment[lighting]"
                                                    {{ isset($report->environment['lighting']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['lighting']) && $report->environment_notes['lighting'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['lighting'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- Baris kesepuluh --}}
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersPressure">Lain-lain
                                                    (Tekanan, dll)<br>Others (Pressure, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersPressure" name="environment[others_pressure]"
                                                    {{ isset($report->environment['others_pressure']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['others_pressure']) && $report->environment_notes['others_pressure'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['others_pressure'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="noise">Kebisingan<br>Noise</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="noise"
                                                    name="environment[noise]"
                                                    {{ isset($report->environment['noise']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->environment_notes['noise']) && $report->environment_notes['noise'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['noise'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris sebelas --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="psychosocial">Psikososial<br>Psychosocial</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="psychosocial"
                                                    name="environment[psychosocial]"
                                                    {{ isset($report->environment['psychosocial']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['psychosocial']) && $report->environment_notes['psychosocial'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['psychosocial'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris duabelas --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersChemical">Lain-lain (Kimia,
                                                    Debu, dll)<br>Others (Chemical, Dust, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersChemical" name="environment[others_chemical]"
                                                    {{ isset($report->environment['others_chemical']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['others_chemical']) && $report->environment_notes['others_chemical'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['others_chemical'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                </thead>
                            </table>
                            <table class="table table-bordered border-black">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 33%" class="align-middle">CATEGORY "D"<br>Peralatan &
                                            Perkakas /
                                            Tools &
                                            Equipment</th>
                                        <th style="width: 33%" class="align-middle">CATEGORY "E"<br>Prosedur /
                                            Procedures
                                        </th>
                                        <th style="width: 33%" class="align-middle">CATEGORY "F"<br>Lingkungan &
                                            Kebersihan Kerapihan /
                                            Environment & Housekeeping</th>
                                    </tr>
                                    {{-- Baris pertama category DEF --}}
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="rightTool">Menggunakan Peralatan
                                                    yang Tepat<br>Use the Right Tool</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="rightTool"
                                                    name="tools[right_tool]"
                                                    {{ isset($report->tools['right_tool']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->tools_notes['right_tool']) && $report->tools_notes['right_tool'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['right_tool'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="standardPracticeEstablished">Apakah
                                                    Standar Operasional Sudah
                                                    Ada?<br>Is Standard Practice Established</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardPracticeEstablished" name="procedures[standard_practice]"
                                                    {{ isset($report->procedures['standard_practice']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->procedures_notes['standard_practice']) && $report->procedures_notes['standard_practice'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->procedures_notes['standard_practice'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td colspan="2">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="cleanlinessCheck">Kebersihan<br>Cleanliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="cleanlinessCheck" name="environment[cleanliness]"
                                                        {{ isset($report->environment['cleanliness']) ? 'checked' : '' }}
                                                        disabled>
                                                </div>
                                                @if (isset($report->environment_notes['cleanliness']) && $report->environment_notes['cleanliness'])
                                                    <div class="text-muted">
                                                        <small>Keterangan:
                                                            {{ $report->environment_notes['cleanliness'] }}</small>
                                                    </div>
                                                @else
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                @endif

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="orderlinessCheck">Kerapihan<br>Orderliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="orderlinessCheck" name="environment[orderliness]"
                                                        {{ isset($report->environment['orderliness']) ? 'checked' : '' }}
                                                        disabled>
                                                </div>
                                                @if (isset($report->environment_notes['orderliness']) && $report->environment_notes['orderliness'])
                                                    <div class="text-muted">
                                                        <small>Keterangan:
                                                            {{ $report->environment_notes['orderliness'] }}</small>
                                                    </div>
                                                @else
                                                    <small class="form-text text-muted">Tidak ada catatan.</small>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Baris kedua category DEF --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="usedCorrectly">Dipergunakan dengan
                                                    benar dan sesuai<br>Used Correctly</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="usedCorrectly" name="tools[used_correctly]"
                                                    {{ isset($report->tools['used_correctly']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->tools_notes['used_correctly']) && $report->tools_notes['used_correctly'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['used_correctly'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardAdequate">Apakah Standar
                                                    Operasional Sudah Cukup Untuk Pekerjaan Tersebut ?<br>Is Standard
                                                    Practice Adequate for the Job</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardAdequate" name="procedures[standard_adequate]"
                                                    {{ isset($report->procedures['standard_adequate']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->procedures_notes['standard_adequate']) && $report->procedures_notes['standard_adequate'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->procedures_notes['standard_adequate'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="hazardousMaterialHandling">Penanganan
                                                    Material / Limbah
                                                    B3<br>Handling of Hazardous Material or Waste</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="hazardousMaterialHandling"
                                                    name="environment[hazardous_material_handling]"
                                                    {{ isset($report->environment['hazardous_material_handling']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->procedures_notes['standard_adequate']) && $report->procedures_notes['standard_adequate'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->procedures_notes['standard_adequate'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>


                                    {{-- Baris ketiga category DEF --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsCondition">Kondisi
                                                    Peralatan<br>Tools and Equipment Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsCondition" name="tools[tools_condition]"
                                                    {{ isset($report->tools['tools_condition']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->tools_notes['tools_condition']) && $report->tools_notes['tools_condition'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['tools_condition'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardMaintained">Apakah Standar
                                                    Operasional Diterapkan & Dipertahankan ?<br>Is Standard Practice
                                                    Maintained</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardMaintained" name="procedures[standard_maintained]"
                                                    {{ isset($report->procedures['standard_maintained']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->procedures_notes['standard_maintained']) && $report->procedures_notes['standard_maintained'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->procedures_notes['standard_maintained'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="nonB3WasteHandling">Penanganan
                                                    Limbah Non B3<br>NON B3 Waste Handling</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="nonB3WasteHandling" name="environment[non_b3_waste_handling]"
                                                    {{ isset($report->environment['non_b3_waste_handling']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['non_b3_waste_handling']) && $report->environment_notes['non_b3_waste_handling'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['non_b3_waste_handling'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris keempat category DEF --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsConditionCheck">Kondisi
                                                    Perkakas<br>Tools Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsConditionCheck" name="tools[tools_condition_check]"
                                                    {{ isset($report->tools['tools_condition_check']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->tools_notes['tools_condition_check']) && $report->tools_notes['tools_condition_check'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['tools_condition_check'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="othersEquipment">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersEquipment" name="tools[others]"
                                                    {{ isset($report->tools['others']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->tools_notes['others']) && $report->tools_notes['others'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['others'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="environmentAspectControl">Pengendalian
                                                    Aspek
                                                    Lingkungan<br>Environment Aspect Control</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="environmentAspectControl"
                                                    name="environment[environment_aspect_control]"
                                                    {{ isset($report->environment['environment_aspect_control']) ? 'checked' : '' }}
                                                    disabled>
                                            </div>
                                            @if (isset($report->environment_notes['environment_aspect_control']) &&
                                                    $report->environment_notes['environment_aspect_control']
                                            )
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['environment_aspect_control'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Baris kelima category DEF --}}
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others2">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others2"
                                                    name="tools[others2]"
                                                    {{ isset($report->tools['others2']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->tools_notes['others2']) && $report->tools_notes['others2'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->tools_notes['others2'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others3">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others3"
                                                    name="environment[others3]"
                                                    {{ isset($report->environment['others3']) ? 'checked' : '' }} disabled>
                                            </div>
                                            @if (isset($report->environment_notes['others3']) && $report->environment_notes['others3'])
                                                <div class="text-muted">
                                                    <small>Keterangan:
                                                        {{ $report->environment_notes['others3'] }}</small>
                                                </div>
                                            @else
                                                <small class="form-text text-muted">Tidak ada catatan.</small>
                                            @endif
                                        </td>
                                    </tr>

                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer">

                        <button class="btn btn-primary btn-block" onclick="window.history.back();">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            const element = document.getElementById('contentToExport');
            const opt = {
                margin: 1,
                filename: 'report.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().from(element).set(opt).save();
        });

        function setAction(action, reportId) {
            const feedbackForm = document.getElementById('feedbackForm');
            const actionType = document.getElementById('actionType');
            const reportIdInput = document.getElementById('reportId');

            feedbackForm.action = `/hse_report/${reportId}/${action}`;
            actionType.value = action;
            reportIdInput.value = reportId;
        }
    </script>
@endpush
