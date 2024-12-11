<?php $__env->startPush('css'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo e(__('FORMULIR PEDULI HSE')); ?></div>
                    <?php if(session('success')): ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '<?php echo e(session('success')); ?>',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <script>
                            let errorMessages = <?php echo json_encode($errors->toArray(), 15, 512) ?>;
                            let formattedErrors = Object.values(errorMessages).flat().join('\n');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Errors',
                                text: formattedErrors,
                                confirmButtonText: 'OK'
                            });
                        </script>
                    <?php endif; ?>


                    <form method="POST" action="<?php echo e(route('hse_report.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
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
                                                        <input type="radio" class="form-check-input" id="unsafeCondition"
                                                            name="condition_status" value="Unsafe Condition"
                                                            onclick="onlyOne(this)"
                                                            <?php echo e(in_array('Unsafe Condition', json_decode($report->condition_status ?? '[]')) ? 'checked' : ''); ?>>
                                                        <label for="unsafeCondition" class="mb-0">Unsafe Condition</label>
                                                    </div>

                                                    <!-- Unsafe Act -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger invisible"></button>
                                                        <input type="radio" class="form-check-input" id="unsafeAct"
                                                            name="condition_status" value="Unsafe Act"
                                                            onclick="onlyOne(this)"
                                                            <?php echo e(in_array('Unsafe Act', json_decode($report->condition_status ?? '[]')) ? 'checked' : ''); ?>>
                                                        <label for="unsafeAct" class="mb-0">Unsafe Act</label>
                                                    </div>

                                                    <!-- Safe Condition -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-sm btn-success">GREEN</button>
                                                        <input type="radio" class="form-check-input" id="safeCondition"
                                                            name="condition_status" value="Safe Condition"
                                                            onclick="onlyOne(this)"
                                                            <?php echo e(in_array('Safe Condition', json_decode($report->condition_status ?? '[]')) ? 'checked' : ''); ?>>
                                                        <label for="safeCondition" class="mb-0">Safe Condition</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 33%">DATE :<input type="date" name="date" id="date"
                                                class="form-control" value="<?php echo e(old('date')); ?>"></td>
                                        <td style="width: 33%">Reported By :<input type="text" name="reported_by"
                                                id="reported_by" class="form-control" value="<?php echo e(auth()->user()->name); ?>"
                                                ></td>
                                        <td style="width: 33%">Inst / Dept :<input type="text" name="inst_dept"
                                                id="inst_dept" class="form-control"value="<?php echo e(old('inst_dept')); ?>"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CATEGORY "A"<br>Alat Pelindung Diri / PPE</th>
                                        <th>CATEGORY "B"<br>Posisi Kerja / Working Position</th>
                                        <th>CATEGORY "C"<br>Kesehatan & Ergonomi / Ergonomic & Health</th>
                                    </tr>
                                    
                                    <tr>
                                        <!-- Kolom 1 -->
                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="faceEyes">
                                                        Mata & Wajah <br>Face & Eyes
                                                    </label>
                                                    <input type="checkbox" class="form-check-input ms-auto" id="faceEyes"
                                                        name="ppe[face_eyes]"
                                                        onchange="document.getElementById('note-faceEyes').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control" name="ppe_notes[face_eyes]"
                                                        id="note-faceEyes" placeholder="Enter keterangan untuk Mata & Wajah"
                                                        disabled>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Kolom 2 -->
                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="strikingAgainst">
                                                        Berbenturan <br>Striking Against
                                                    </label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="strikingAgainst" name="working_position[striking_against]"
                                                        onchange="document.getElementById('note-strikingAgainst').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="working_position_notes[striking_against]"
                                                        id="note-strikingAgainst"
                                                        placeholder="Enter keterangan untuk Berbenturan" disabled>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Kolom 3 -->
                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="posture">
                                                        Sikap Tubuh <br>Posture
                                                    </label>
                                                    <input type="checkbox" class="form-check-input ms-auto" id="posture"
                                                        name="ergonomic[posture]"
                                                        onchange="document.getElementById('note-posture').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="ergonomic_notes[posture]" id="note-posture"
                                                        placeholder="Enter keterangan untuk Sikap Tubuh" disabled>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="ears">Telinga <br>Ears</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="ears" name="ppe[ears]"
                                                        onchange="document.getElementById('note-ears').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control" name="ppe_notes[ears]"
                                                        id="note-ears" placeholder="Enter keterangan untuk Telinga"
                                                        disabled>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="struckBy">Terbentur Oleh
                                                        <br>Struck By</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="struckBy" name="working_position[struck_by]"
                                                        onchange="document.getElementById('note-struckBy').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="working_position_notes[struck_by]" id="note-struckBy"
                                                        placeholder="Enter keterangan untuk Terbentur Oleh" disabled>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-grid gap-3">
                                                <!-- Input utama -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0" for="motionType">Jenis & Jumlah Gerakan
                                                        <br>Number & Type of Motion</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="motionType" name="ergonomic[motion_type]"
                                                        onchange="document.getElementById('note-motionType').disabled = !this.checked;">
                                                </div>
                                                <!-- Note -->
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="ergonomic_notes[motion_type]" id="note-motionType"
                                                        placeholder="Enter keterangan untuk Jenis & Jumlah Gerakan"
                                                        disabled>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>



                                    
                                    <tr>
                                        <!-- Kepala -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="head">Kepala <br>Head</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="head"
                                                    name="ppe[head]"
                                                    onchange="document.getElementById('note-head').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[head]"
                                                    id="note-head" placeholder="Enter keterangan untuk Kepala" disabled>
                                            </div>
                                        </td>

                                        <!-- Terjepit Diantara -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="caughtBetween">Terjepit Diantara
                                                    <br>Caught Between</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="caughtBetween" name="working_position[caught_between]"
                                                    onchange="document.getElementById('note-caughtBetween').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[caught_between]" id="note-caughtBetween"
                                                    placeholder="Enter keterangan untuk Terjepit Diantara" disabled>
                                            </div>
                                        </td>

                                        <!-- Beban yang Ditangani -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="loadHandled">Beban yang Ditangani
                                                    <br>Load Handled</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="loadHandled"
                                                    name="ergonomic[load_handled]"
                                                    onchange="document.getElementById('note-loadHandled').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[load_handled]" id="note-loadHandled"
                                                    placeholder="Enter keterangan untuk Beban yang Ditangani" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Baris keempat -->
                                    <tr>
                                        <!-- Tangan & Lengan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="armsHands">Tangan & Lengan <br>Arms &
                                                    Hands</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="armsHands"
                                                    name="ppe[arms_hands]"
                                                    onchange="document.getElementById('note-armsHands').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[arms_hands]"
                                                    id="note-armsHands"
                                                    placeholder="Enter keterangan untuk Tangan & Lengan" disabled>
                                            </div>
                                        </td>

                                        <!-- Jatuh -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="falling">Jatuh <br>Falling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="falling"
                                                    name="working_position[falling]"
                                                    onchange="document.getElementById('note-falling').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[falling]" id="note-falling"
                                                    placeholder="Enter keterangan untuk Jatuh" disabled>
                                            </div>
                                        </td>

                                        <!-- Design Lokasi Kerja -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workingAreaDesign">Design Lokasi Kerja
                                                    <br>Working Area Design</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workingAreaDesign" name="ergonomic[working_area_design]"
                                                    onchange="document.getElementById('note-workingAreaDesign').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[working_area_design]"
                                                    id="note-workingAreaDesign"
                                                    placeholder="Enter keterangan untuk Design Lokasi Kerja" disabled>
                                            </div>
                                        </td>
                                    </tr>


                                    
                                    <tr>
                                        <!-- Kaki & Telapak Kaki -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="feetLegs">Kaki & Telapak Kaki<br>Feet
                                                    & Legs</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="feetLegs"
                                                    name="ppe[feet_legs]"
                                                    onchange="document.getElementById('note-feetLegs').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[feet_legs]"
                                                    id="note-feetLegs"
                                                    placeholder="Enter keterangan untuk Kaki & Telapak Kaki" disabled>
                                            </div>
                                        </td>

                                        <!-- Temperatur yang Berlebihan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="extremeTemperature">Temperatur yang
                                                    Berlebihan<br>Extremes Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="extremeTemperature" name="ergonomic[extreme_temperature]"
                                                    onchange="document.getElementById('note-extremeTemperature').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[extreme_temperature]"
                                                    id="note-extremeTemperature"
                                                    placeholder="Enter keterangan untuk Temperatur yang Berlebihan"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Peralatan dan Cara Penggunaan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsGrip">Peralatan dan Cara
                                                    Penggunaan<br>Tools & Grip</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="toolsGrip"
                                                    name="tools[tools_grip]"
                                                    onchange="document.getElementById('note-toolsGrip').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="tools_notes[tools_grip]"
                                                    id="note-toolsGrip"
                                                    placeholder="Enter keterangan untuk Peralatan dan Cara Penggunaan"
                                                    disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Sistem Pernapasan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="respiratorySystem">Sistem
                                                    Pernapasan<br>Respiratory System</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="respiratorySystem" name="ppe[respiratory_system]"
                                                    onchange="document.getElementById('note-respiratorySystem').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ppe_notes[respiratory_system]" id="note-respiratorySystem"
                                                    placeholder="Enter keterangan untuk Sistem Pernapasan" disabled>
                                            </div>
                                        </td>

                                        <!-- Arus Listrik -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="electricalCurrent">Arus
                                                    Listrik<br>Electrical Current</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="electricalCurrent" name="ergonomic[electrical_current]"
                                                    onchange="document.getElementById('note-electricalCurrent').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[electrical_current]" id="note-electricalCurrent"
                                                    placeholder="Enter keterangan untuk Arus Listrik" disabled>
                                            </div>
                                        </td>

                                        <!-- Sirkulasi Udara -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="airVentilation">Sirkulasi Udara<br>Air
                                                    Ventilation</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="airVentilation" name="environment[air_ventilation]"
                                                    onchange="document.getElementById('note-airVentilation').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[air_ventilation]" id="note-airVentilation"
                                                    placeholder="Enter keterangan untuk Sirkulasi Udara" disabled>
                                            </div>
                                        </td>
                                    </tr>


                                    
                                    <tr>
                                        <!-- Dada (Trunk) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="trunk">Dada<br>Trunk</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="trunk"
                                                    name="ppe[trunk]"
                                                    onchange="document.getElementById('note-trunk').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[trunk]"
                                                    id="note-trunk" placeholder="Enter keterangan untuk Dada" disabled>
                                            </div>
                                        </td>

                                        <!-- Terhisap Oleh Pernapasan (Inhaling) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="inhaling">Terhisap Oleh
                                                    Pernapasan<br>Inhaling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="inhaling"
                                                    name="ergonomic[inhaling]"
                                                    onchange="document.getElementById('note-inhaling').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[inhaling]" id="note-inhaling"
                                                    placeholder="Enter keterangan untuk Inhaling" disabled>
                                            </div>
                                        </td>

                                        <!-- Getaran (Vibration) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="vibration">Getaran<br>Vibration</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="vibration"
                                                    name="ergonomic[vibration]"
                                                    onchange="document.getElementById('note-vibration').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[vibration]" id="note-vibration"
                                                    placeholder="Enter keterangan untuk Vibration" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Badan (Body) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="body">Badan<br>Body</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="body"
                                                    name="ppe[body]"
                                                    onchange="document.getElementById('note-body').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[body]"
                                                    id="note-body" placeholder="Enter keterangan untuk Badan" disabled>
                                            </div>
                                        </td>

                                        <!-- Terserap Oleh Kulit (Absorbing) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="absorbing">Terserap Oleh
                                                    Kulit<br>Absorbing</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="absorbing"
                                                    name="ergonomic[absorbing]"
                                                    onchange="document.getElementById('note-absorbing').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[absorbing]" id="note-absorbing"
                                                    placeholder="Enter keterangan untuk Absorbing" disabled>
                                            </div>
                                        </td>

                                        <!-- Suhu (Work Area Temperature) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workAreaTemperature">Suhu<br>Work Area
                                                    Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workAreaTemperature" name="ergonomic[work_area_temperature]"
                                                    onchange="document.getElementById('note-workAreaTemperature').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[work_area_temperature]"
                                                    id="note-workAreaTemperature"
                                                    placeholder="Enter keterangan untuk Work Area Temperature" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others"
                                                    name="ppe[others]"
                                                    onchange="document.getElementById('note-others').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="ppe_notes[others]"
                                                    id="note-others" placeholder="Enter keterangan untuk Others" disabled>
                                            </div>
                                        </td>

                                        <!-- Kejatuhan Benda (Falling Objects) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="fallingObjects">Kejatuhan
                                                    Benda<br>Falling Objects</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="fallingObjects" name="working_position[falling_objects]"
                                                    onchange="document.getElementById('note-fallingObjects').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[falling_objects]"
                                                    id="note-fallingObjects"
                                                    placeholder="Enter keterangan untuk Falling Objects" disabled>
                                            </div>
                                        </td>

                                        <!-- Penerangan (Lighting) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="lighting">Penerangan<br>Lighting</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="lighting"
                                                    name="environment[lighting]"
                                                    onchange="document.getElementById('note-lighting').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[lighting]" id="note-lighting"
                                                    placeholder="Enter keterangan untuk Lighting" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Lain-lain (Tekanan, dll) (Others - Pressure, etc) -->
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersPressure">Lain-lain (Tekanan,
                                                    dll)<br>Others (Pressure, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersPressure" name="environment[others_pressure]"
                                                    onchange="document.getElementById('note-othersPressure').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others_pressure]" id="note-othersPressure"
                                                    placeholder="Enter keterangan untuk Others (Pressure, etc)" disabled>
                                            </div>
                                        </td>

                                        <!-- Kebisingan (Noise) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="noise">Kebisingan<br>Noise</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="noise"
                                                    name="environment[noise]"
                                                    onchange="document.getElementById('note-noise').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[noise]" id="note-noise"
                                                    placeholder="Enter keterangan untuk Noise" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Psikososial (Psychosocial) -->
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="psychosocial">Psikososial<br>Psychosocial</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="psychosocial"
                                                    name="environment[psychosocial]"
                                                    onchange="document.getElementById('note-psychosocial').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[psychosocial]" id="note-psychosocial"
                                                    placeholder="Enter keterangan untuk Psychosocial" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Lain-lain (Kimia, Debu, dll) (Others - Chemical, Dust, etc) -->
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersChemical">Lain-lain (Kimia,
                                                    Debu, dll)<br>Others (Chemical, Dust, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersChemical" name="environment[others_chemical]"
                                                    onchange="document.getElementById('note-othersChemical').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others_chemical]" id="note-othersChemical"
                                                    placeholder="Enter keterangan untuk Others (Chemical, Dust, etc)"
                                                    disabled>
                                            </div>
                                        </td>
                                    </tr>

                                </thead>
                            </table>
                            <div style="height: 20px;"></div>
                            <table class="table table-bordered border-black">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 33%" class="align-middle">CATEGORY "D"<br>Peralatan & Perkakas /
                                            Tools & Equipment</th>
                                        <th style="width: 33%" class="align-middle">CATEGORY "E"<br>Prosedur / Procedures
                                        </th>
                                        <th style="width: 33%" class="align-middle">CATEGORY "F"<br>Lingkungan &
                                            Kebersihan Kerapihan / Environment & Housekeeping</th>
                                    </tr>
                                    
                                    <tr>
                                        <!-- Menggunakan Peralatan yang Tepat (Use the Right Tool) -->
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="rightTool">Menggunakan Peralatan yang
                                                    Tepat<br>Use the Right Tool</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="rightTool"
                                                    name="tools[right_tool]"
                                                    onchange="document.getElementById('note-rightTool').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="tools_notes[right_tool]"
                                                    id="note-rightTool" placeholder="Enter keterangan untuk Right Tool"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Apakah Standar Operasional Sudah Ada? (Is Standard Practice Established) -->
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardPracticeEstablished">Apakah
                                                    Standar Operasional Sudah Ada?<br>Is Standard Practice
                                                    Established</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardPracticeEstablished" name="procedures[standard_practice]"
                                                    onchange="document.getElementById('note-standardPracticeEstablished').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_practice]"
                                                    id="note-standardPracticeEstablished"
                                                    placeholder="Enter keterangan untuk Standard Practice Established"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Kebersihan dan Kerapihan (Cleanliness and Orderliness) -->
                                        <td colspan="2">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0"
                                                        for="cleanlinessCheck">Kebersihan<br>Cleanliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="cleanlinessCheck" name="environment[cleanliness]"
                                                        onchange="document.getElementById('note-cleanlinessCheck').disabled = !this.checked;">
                                                </div>
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="environment_notes[cleanliness]" id="note-cleanlinessCheck"
                                                        placeholder="Enter keterangan untuk Cleanliness" disabled>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0"
                                                        for="orderlinessCheck">Kerapihan<br>Orderliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="orderlinessCheck" name="environment[orderliness]"
                                                        onchange="document.getElementById('note-orderlinessCheck').disabled = !this.checked;">
                                                </div>
                                                <div>
                                                    <input type="text" class="form-control"
                                                        name="environment_notes[orderliness]" id="note-orderlinessCheck"
                                                        placeholder="Enter keterangan untuk Orderliness" disabled>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Dipergunakan dengan benar dan sesuai (Used Correctly) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="usedCorrectly">Dipergunakan dengan
                                                    benar dan sesuai <br>Used Correctly</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="usedCorrectly" name="tools[used_correctly]"
                                                    onchange="document.getElementById('note-usedCorrectly').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[used_correctly]" id="note-usedCorrectly"
                                                    placeholder="Enter keterangan untuk Used Correctly" disabled>
                                            </div>
                                        </td>

                                        <!-- Apakah Standar Operasional Sudah Cukup? (Is Standard Practice Adequate for the Job) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardAdequate">Apakah Standar
                                                    Operasional Sudah Cukup Untuk Pekerjaan Tersebut ? <br>Is Standard
                                                    Practice Adequate for the Job</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardAdequate" name="procedures[standard_adequate]"
                                                    onchange="document.getElementById('note-standardAdequate').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_adequate]" id="note-standardAdequate"
                                                    placeholder="Enter keterangan untuk Standard Adequate" disabled>
                                            </div>
                                        </td>

                                        <!-- Penanganan Material / Limbah B3 (Handling of Hazardous Material or Waste) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="hazardousMaterialHandling">Penanganan
                                                    Material / Limbah B3<br>Handling of Hazardous Material or Waste</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="hazardousMaterialHandling"
                                                    name="environment[hazardous_material_handling]"
                                                    onchange="document.getElementById('note-hazardousMaterialHandling').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[hazardous_material_handling]"
                                                    id="note-hazardousMaterialHandling"
                                                    placeholder="Enter keterangan untuk Hazardous Material Handling"
                                                    disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Kondisi Peralatan (Tools and Equipment Condition) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsCondition">Kondisi
                                                    Peralatan<br>Tools and Equipment Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsCondition" name="tools[tools_condition]"
                                                    onchange="document.getElementById('note-toolsCondition').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[tools_condition]" id="note-toolsCondition"
                                                    placeholder="Enter keterangan untuk Tools Condition" disabled>
                                            </div>
                                        </td>

                                        <!-- Apakah Standar Operasional Diterapkan & Dipertahankan? (Is Standard Practice Maintained) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardMaintained">Apakah Standar
                                                    Operasional Diterapkan & Dipertahankan ?<br>Is Standard Practice
                                                    Maintained</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardMaintained" name="procedures[standard_maintained]"
                                                    onchange="document.getElementById('note-standardMaintained').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_maintained]"
                                                    id="note-standardMaintained"
                                                    placeholder="Enter keterangan untuk Standard Practice Maintained"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Penanganan Limbah Non B3 (NON B3 Waste Handling) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="nonB3WasteHandling">Penanganan Limbah
                                                    Non B3<br>NON B3 Waste Handling</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="nonB3WasteHandling" name="environment[non_b3_waste_handling]"
                                                    onchange="document.getElementById('note-nonB3WasteHandling').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[non_b3_waste_handling]"
                                                    id="note-nonB3WasteHandling"
                                                    placeholder="Enter keterangan untuk NON B3 Waste Handling" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Kondisi Perkakas (Tools Condition) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsConditionCheck">Kondisi
                                                    Perkakas<br>Tools Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsConditionCheck" name="tools[tools_condition_check]"
                                                    onchange="document.getElementById('note-toolsConditionCheck').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[tools_condition_check]"
                                                    id="note-toolsConditionCheck"
                                                    placeholder="Enter keterangan untuk Tools Condition Check" disabled>
                                            </div>
                                        </td>

                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="othersEquipment">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersEquipment" name="tools[others]"
                                                    onchange="document.getElementById('note-othersEquipment').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="tools_notes[others]"
                                                    id="note-othersEquipment" placeholder="Enter keterangan untuk Others"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Pengendalian Aspek Lingkungan (Environment Aspect Control) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="environmentAspectControl">Pengendalian
                                                    Aspek Lingkungan<br>Environment Aspect Control</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="environmentAspectControl"
                                                    name="environment[environment_aspect_control]"
                                                    onchange="document.getElementById('note-environmentAspectControl').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[environment_aspect_control]"
                                                    id="note-environmentAspectControl"
                                                    placeholder="Enter keterangan untuk Environment Aspect Control"
                                                    disabled>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others2">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others2"
                                                    name="tools[others2]"
                                                    onchange="document.getElementById('note-others2').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" name="tools_notes[others2]"
                                                    id="note-others2" placeholder="Enter keterangan untuk Others"
                                                    disabled>
                                            </div>
                                        </td>

                                        <!-- Kosongkan Kolom -->
                                        <td></td>

                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others3">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others3"
                                                    name="environment[others3]"
                                                    onchange="document.getElementById('note-others3').disabled = !this.checked;">
                                            </div>
                                            <div>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others3]" id="note-others3"
                                                    placeholder="Enter keterangan untuk Others" disabled>
                                            </div>
                                        </td>
                                    </tr>

                                </thead>
                            </table>
                            <button class="btn btn-primary btn-block"><i class="fa-solid fa-floppy-disk"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('condition_status[]');
            checkboxes.forEach((item) => {
                if (item !== checkbox) {
                    item.checked = false; // Uncheck other checkboxes
                }
            });
        }

        function toggleNote(checkboxId) {
            var noteDiv = document.getElementById('note-' + checkboxId);
            var checkbox = document.getElementById(checkboxId);
            if (checkbox.checked) {
                noteDiv.style.display = 'block'; // Show the note input
            } else {
                noteDiv.style.display = 'none'; // Hide the note input
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\report-hse-feature-baru\resources\views/report/index.blade.php ENDPATH**/ ?>