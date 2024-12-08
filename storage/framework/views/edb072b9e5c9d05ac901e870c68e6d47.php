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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?php echo e(__('FORMULIR PEDULI HSE')); ?></div>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
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
                                                class="form-control"></td>
                                        <td style="width: 33%">Reported By :<input type="text" name="reported_by"
                                                id="reported_by" class="form-control"></td>
                                        <td style="width: 33%">Inst / Dept :<input type="text" name="inst_dept"
                                                id="inst_dept" class="form-control"></td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>CATEGORY "A"<br>Alat Pelindung Diri / PPE</th>
                                        <th>CATEGORY "B"<br>Posisi Kerja / Working Position</th>
                                        <th>CATEGORY "C"<br>Kesehatan & Ergonomi / Ergonomic & Health</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="faceEyes">Mata & Wajah <br>Face &
                                                        Eyes</label>
                                                    <input type="checkbox" class="form-check-input ms-auto" id="faceEyes"
                                                        name="ppe[face_eyes]" onchange="toggleNote('faceEyes')">
                                                </div>
                                                <div id="note-faceEyes" class="note-input" style="display: none;">
                                                    <label for="note-faceEyes" class="form-label">Note:</label>
                                                    <input type="text" class="form-control" name="ppe_notes[face_eyes]"
                                                        placeholder="Enter keterangan untuk Mata & Wajah">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="strikingAgainst">Berbenturan
                                                        <br>Striking Against</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="strikingAgainst" name="working_position[striking_against]"
                                                        onchange="toggleNote('strikingAgainst')">
                                                </div>
                                                <div id="note-strikingAgainst" class="note-input" style="display: none;">
                                                    <label for="note-strikingAgainst" class="form-label">Note:</label>
                                                    <input type="text" class="form-control"
                                                        name="working_position_notes[striking_against]"
                                                        placeholder="Enter keterangan untuk Berbenturan">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="posture">Sikap Tubuh
                                                        <br>Posture</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="posture" name="ergonomic[posture]"
                                                        onchange="toggleNote('posture')">
                                                </div>
                                                <div id="note-posture" class="note-input" style="display: none;">
                                                    <label for="note-posture" class="form-label">Note:</label>
                                                    <input type="text" class="form-control"
                                                        name="ergonomic_notes[posture]"
                                                        placeholder="Enter keterangan untuk Sikap Tubuh">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="ears">Telinga <br>Ears</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="ears" name="ppe[ears]" onchange="toggleNote('ears')">
                                                </div>
                                                <div id="note-ears" class="note-input" style="display: none;">
                                                    <label for="note-ears" class="form-label">Keterangan:</label>
                                                    <input type="text" class="form-control" name="ppe_notes[ears]"
                                                        placeholder="Enter keterangan untuk Telinga">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="struckBy">Terbentur Oleh
                                                        <br>Struck By</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="struckBy" name="working_position[struck_by]"
                                                        onchange="toggleNote('struckBy')">
                                                </div>
                                                <div id="note-struckBy" class="note-input" style="display: none;">
                                                    <label for="note-struckBy" class="form-label">Keterangan:</label>
                                                    <input type="text" class="form-control"
                                                        name="working_position_notes[struck_by]"
                                                        placeholder="Enter keterangan untuk Terbentur Oleh">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <label class="form-label mb-0" for="motionType">Jenis & Jumlah Gerakan
                                                        <br>Number & Type of Motion</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="motionType" name="ergonomic[motion_type]"
                                                        onchange="toggleNote('motionType')">
                                                </div>
                                                <div id="note-motionType" class="note-input" style="display: none;">
                                                    <label for="note-motionType" class="form-label">Keterangan:</label>
                                                    <input type="text" class="form-control"
                                                        name="ergonomic_notes[motion_type]"
                                                        placeholder="Enter keterangan untuk Jenis & Jumlah Gerakan">
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
                                                    name="ppe[head]" onchange="toggleNote('head')">
                                            </div>
                                            <div id="note-head" class="note-input" style="display: none;">
                                                <label for="note-head" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[head]"
                                                    placeholder="Enter keterangan untuk Kepala">
                                            </div>
                                        </td>

                                        <!-- Terjepit Diantara -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="caughtBetween">Terjepit
                                                    Diantara<br>Caught Between</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="caughtBetween" name="working_position[caught_between]"
                                                    onchange="toggleNote('caughtBetween')">
                                            </div>
                                            <div id="note-caughtBetween" class="note-input" style="display: none;">
                                                <label for="note-caughtBetween" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[caught_between]"
                                                    placeholder="Enter keterangan untuk Terjepit Diantara">
                                            </div>
                                        </td>

                                        <!-- Beban yang Ditangani -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="loadHandled">Beban yang
                                                    Ditangani<br>Load Handled</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="loadHandled"
                                                    name="ergonomic[load_handled]" onchange="toggleNote('loadHandled')">
                                            </div>
                                            <div id="note-loadHandled" class="note-input" style="display: none;">
                                                <label for="note-loadHandled" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[load_handled]"
                                                    placeholder="Enter keterangan untuk Beban yang Ditangani">
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Tangan & Lengan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="armsHands">Tangan & Lengan<br>Arms &
                                                    Hands</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="armsHands"
                                                    name="ppe[arms_hands]" onchange="toggleNote('armsHands')">
                                            </div>
                                            <div id="note-armsHands" class="note-input" style="display: none;">
                                                <label for="note-armsHands" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[arms_hands]"
                                                    placeholder="Enter keterangan untuk Tangan & Lengan">
                                            </div>
                                        </td>

                                        <!-- Jatuh -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="falling">Jatuh<br>Falling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="falling"
                                                    name="working_position[falling]" onchange="toggleNote('falling')">
                                            </div>
                                            <div id="note-falling" class="note-input" style="display: none;">
                                                <label for="note-falling" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[falling]"
                                                    placeholder="Enter keterangan untuk Jatuh">
                                            </div>
                                        </td>

                                        <!-- Design Lokasi Kerja -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workingAreaDesign">Design Lokasi
                                                    Kerja<br>Working Area Design</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workingAreaDesign" name="ergonomic[working_area_design]"
                                                    onchange="toggleNote('workingAreaDesign')">
                                            </div>
                                            <div id="note-workingAreaDesign" class="note-input" style="display: none;">
                                                <label for="note-workingAreaDesign" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[working_area_design]"
                                                    placeholder="Enter keterangan untuk Design Lokasi Kerja">
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
                                                    name="ppe[feet_legs]" onchange="toggleNote('feetLegs')">
                                            </div>
                                            <div id="note-feetLegs" class="note-input" style="display: none;">
                                                <label for="note-feetLegs" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[feet_legs]"
                                                    placeholder="Enter keterangan untuk Kaki & Telapak Kaki">
                                            </div>
                                        </td>

                                        <!-- Temperatur yang Berlebihan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="extremeTemperature">Temperatur yang
                                                    Berlebihan<br>Extremes Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="extremeTemperature" name="ergonomic[extreme_temperature]"
                                                    onchange="toggleNote('extremeTemperature')">
                                            </div>
                                            <div id="note-extremeTemperature" class="note-input" style="display: none;">
                                                <label for="note-extremeTemperature"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[extreme_temperature]"
                                                    placeholder="Enter keterangan untuk Temperatur yang Berlebihan">
                                            </div>
                                        </td>

                                        <!-- Peralatan dan Cara Penggunaan -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsGrip">Peralatan dan Cara
                                                    Penggunaan<br>Tools & Grip</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="toolsGrip"
                                                    name="tools[tools_grip]" onchange="toggleNote('toolsGrip')">
                                            </div>
                                            <div id="note-toolsGrip" class="note-input" style="display: none;">
                                                <label for="note-toolsGrip" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="tools_notes[tools_grip]"
                                                    placeholder="Enter keterangan untuk Peralatan dan Cara Penggunaan">
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
                                                    onchange="toggleNote('respiratorySystem')">
                                            </div>
                                            <div id="note-respiratorySystem" class="note-input" style="display: none;">
                                                <label for="note-respiratorySystem" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ppe_notes[respiratory_system]"
                                                    placeholder="Enter keterangan untuk Sistem Pernapasan">
                                            </div>
                                        </td>

                                        <!-- Arus Listrik -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="electricalCurrent">Arus
                                                    Listrik<br>Electrical Current</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="electricalCurrent" name="ergonomic[electrical_current]"
                                                    onchange="toggleNote('electricalCurrent')">
                                            </div>
                                            <div id="note-electricalCurrent" class="note-input" style="display: none;">
                                                <label for="note-electricalCurrent" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[electrical_current]"
                                                    placeholder="Enter keterangan untuk Arus Listrik">
                                            </div>
                                        </td>

                                        <!-- Sirkulasi Udara -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="airVentilation">Sirkulasi Udara<br>Air
                                                    Ventilation</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="airVentilation" name="environment[air_ventilation]"
                                                    onchange="toggleNote('airVentilation')">
                                            </div>
                                            <div id="note-airVentilation" class="note-input" style="display: none;">
                                                <label for="note-airVentilation" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[air_ventilation]"
                                                    placeholder="Enter keterangan untuk Sirkulasi Udara">
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Dada (Trunk) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="trunk">Dada<br>Trunk</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="trunk"
                                                    name="ppe[trunk]" onchange="toggleNote('trunk')">
                                            </div>
                                            <div id="note-trunk" class="note-input" style="display: none;">
                                                <label for="note-trunk" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[trunk]"
                                                    placeholder="Enter keterangan untuk Dada">
                                            </div>
                                        </td>

                                        <!-- Terhisap Oleh Pernapasan (Inhaling) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="inhaling">Terhisap Oleh
                                                    Pernapasan<br>Inhaling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="inhaling"
                                                    name="ergonomic[inhaling]" onchange="toggleNote('inhaling')">
                                            </div>
                                            <div id="note-inhaling" class="note-input" style="display: none;">
                                                <label for="note-inhaling" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[inhaling]"
                                                    placeholder="Enter keterangan untuk Inhaling">
                                            </div>
                                        </td>

                                        <!-- Getaran (Vibration) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="vibration">Getaran<br>Vibration</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="vibration"
                                                    name="ergonomic[vibration]" onchange="toggleNote('vibration')">
                                            </div>
                                            <div id="note-vibration" class="note-input" style="display: none;">
                                                <label for="note-vibration" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[vibration]"
                                                    placeholder="Enter keterangan untuk Vibration">
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <!-- Badan (Body) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="body">Badan<br>Body</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="body"
                                                    name="ppe[body]" onchange="toggleNote('body')">
                                            </div>
                                            <div id="note-body" class="note-input" style="display: none;">
                                                <label for="note-body" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[body]"
                                                    placeholder="Enter keterangan untuk Badan">
                                            </div>
                                        </td>

                                        <!-- Terserap Oleh Kulit (Absorbing) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="absorbing">Terserap Oleh
                                                    Kulit<br>Absorbing</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="absorbing"
                                                    name="ergonomic[absorbing]" onchange="toggleNote('absorbing')">
                                            </div>
                                            <div id="note-absorbing" class="note-input" style="display: none;">
                                                <label for="note-absorbing" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[absorbing]"
                                                    placeholder="Enter keterangan untuk Absorbing">
                                            </div>
                                        </td>

                                        <!-- Suhu (Work Area Temperature) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workAreaTemperature">Suhu<br>Work Area
                                                    Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workAreaTemperature" name="ergonomic[work_area_temperature]"
                                                    onchange="toggleNote('workAreaTemperature')">
                                            </div>
                                            <div id="note-workAreaTemperature" class="note-input" style="display: none;">
                                                <label for="note-workAreaTemperature"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="ergonomic_notes[work_area_temperature]"
                                                    placeholder="Enter keterangan untuk Work Area Temperature">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others"
                                                    name="ppe[others]" onchange="toggleNote('others')">
                                            </div>
                                            <div id="note-others" class="note-input" style="display: none;">
                                                <label for="note-others" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="ppe_notes[others]"
                                                    placeholder="Enter keterangan untuk Others">
                                            </div>
                                        </td>

                                        <!-- Kejatuhan Benda (Falling Objects) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="fallingObjects">Kejatuhan
                                                    Benda<br>Falling Objects</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="fallingObjects" name="working_position[falling_objects]"
                                                    onchange="toggleNote('fallingObjects')">
                                            </div>
                                            <div id="note-fallingObjects" class="note-input" style="display: none;">
                                                <label for="note-fallingObjects" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="working_position_notes[falling_objects]"
                                                    placeholder="Enter keterangan untuk Falling Objects">
                                            </div>
                                        </td>

                                        <!-- Penerangan (Lighting) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="lighting">Penerangan<br>Lighting</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="lighting"
                                                    name="environment[lighting]" onchange="toggleNote('lighting')">
                                            </div>
                                            <div id="note-lighting" class="note-input" style="display: none;">
                                                <label for="note-lighting" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[lighting]"
                                                    placeholder="Enter keterangan untuk Lighting">
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
                                                    onchange="toggleNote('othersPressure')">
                                            </div>
                                            <div id="note-othersPressure" class="note-input" style="display: none;">
                                                <label for="note-othersPressure" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others_pressure]"
                                                    placeholder="Enter keterangan untuk Others (Pressure, etc)">
                                            </div>
                                        </td>

                                        <!-- Kebisingan (Noise) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="noise">Kebisingan<br>Noise</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="noise"
                                                    name="environment[noise]" onchange="toggleNote('noise')">
                                            </div>
                                            <div id="note-noise" class="note-input" style="display: none;">
                                                <label for="note-noise" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[noise]"
                                                    placeholder="Enter keterangan untuk Noise">
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
                                                    onchange="toggleNote('psychosocial')">
                                            </div>
                                            <div id="note-psychosocial" class="note-input" style="display: none;">
                                                <label for="note-psychosocial" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[psychosocial]"
                                                    placeholder="Enter keterangan untuk Psychosocial">
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
                                                    onchange="toggleNote('othersChemical')">
                                            </div>
                                            <div id="note-othersChemical" class="note-input" style="display: none;">
                                                <label for="note-othersChemical" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others_chemical]"
                                                    placeholder="Enter keterangan untuk Others (Chemical, Dust, etc)">
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
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="rightTool">Menggunakan Peralatan yang
                                                    Tepat<br>Use the Right Tool</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="rightTool"
                                                    name="tools[right_tool]" onchange="toggleNote('rightTool')">
                                            </div>
                                            <div id="note-rightTool" class="note-input" style="display: none;">
                                                <label for="note-rightTool" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="tools_notes[right_tool]"
                                                    placeholder="Enter keterangan untuk Right Tool">
                                            </div>
                                        </td>

                                        <!-- Apakah Standar Operasional Sudah Ada? (Is Standard Practice Established) -->
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="standardPracticeEstablished">Apakah
                                                    Standar Operasional Sudah Ada?<br>Is Standard Practice
                                                    Established</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardPracticeEstablished" name="procedures[standard_practice]"
                                                    onchange="toggleNote('standardPracticeEstablished')">
                                            </div>
                                            <div id="note-standardPracticeEstablished" class="note-input"
                                                style="display: none;">
                                                <label for="note-standardPracticeEstablished"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_practice]"
                                                    placeholder="Enter keterangan untuk Standard Practice Established">
                                            </div>
                                        </td>

                                        <!-- Kebersihan dan Kerapihan (Cleanliness and Orderliness) -->
                                        <td colspan="2">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="cleanlinessCheck">Kebersihan<br>Cleanliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="cleanlinessCheck" name="environment[cleanliness]"
                                                        onchange="toggleNote('cleanlinessCheck')">
                                                </div>
                                                <div id="note-cleanlinessCheck" class="note-input"
                                                    style="display: none;">
                                                    <label for="note-cleanlinessCheck"
                                                        class="form-label">Keterangan:</label>
                                                    <input type="text" class="form-control"
                                                        name="environment_notes[cleanliness]"
                                                        placeholder="Enter keterangan untuk Cleanliness">
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="orderlinessCheck">Kerapihan<br>Orderliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="orderlinessCheck" name="environment[orderliness]"
                                                        onchange="toggleNote('orderlinessCheck')">
                                                </div>
                                                <div id="note-orderlinessCheck" class="note-input"
                                                    style="display: none;">
                                                    <label for="note-orderlinessCheck"
                                                        class="form-label">Keterangan:</label>
                                                    <input type="text" class="form-control"
                                                        name="environment_notes[orderliness]"
                                                        placeholder="Enter keterangan untuk Orderliness">
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
                                                    onchange="toggleNote('usedCorrectly')">
                                            </div>
                                            <div id="note-usedCorrectly" class="note-input" style="display: none;">
                                                <label for="note-usedCorrectly" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[used_correctly]"
                                                    placeholder="Enter keterangan untuk Used Correctly">
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
                                                    onchange="toggleNote('standardAdequate')">
                                            </div>
                                            <div id="note-standardAdequate" class="note-input" style="display: none;">
                                                <label for="note-standardAdequate" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_adequate]"
                                                    placeholder="Enter keterangan untuk Standard Adequate">
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
                                                    onchange="toggleNote('hazardousMaterialHandling')">
                                            </div>
                                            <div id="note-hazardousMaterialHandling" class="note-input"
                                                style="display: none;">
                                                <label for="note-hazardousMaterialHandling"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[hazardous_material_handling]"
                                                    placeholder="Enter keterangan untuk Hazardous Material Handling">
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
                                                    onchange="toggleNote('toolsCondition')">
                                            </div>
                                            <div id="note-toolsCondition" class="note-input" style="display: none;">
                                                <label for="note-toolsCondition" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[tools_condition]"
                                                    placeholder="Enter keterangan untuk Tools Condition">
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
                                                    onchange="toggleNote('standardMaintained')">
                                            </div>
                                            <div id="note-standardMaintained" class="note-input" style="display: none;">
                                                <label for="note-standardMaintained"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="procedures_notes[standard_maintained]"
                                                    placeholder="Enter keterangan untuk Standard Practice Maintained">
                                            </div>
                                        </td>

                                        <!-- Penanganan Limbah Non B3 (NON B3 Waste Handling) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="nonB3WasteHandling">Penanganan Limbah
                                                    Non B3<br>NON B3 Waste Handling</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="nonB3WasteHandling" name="environment[non_b3_waste_handling]"
                                                    onchange="toggleNote('nonB3WasteHandling')">
                                            </div>
                                            <div id="note-nonB3WasteHandling" class="note-input" style="display: none;">
                                                <label for="note-nonB3WasteHandling"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[non_b3_waste_handling]"
                                                    placeholder="Enter keterangan untuk NON B3 Waste Handling">
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
                                                    onchange="toggleNote('toolsConditionCheck')">
                                            </div>
                                            <div id="note-toolsConditionCheck" class="note-input" style="display: none;">
                                                <label for="note-toolsConditionCheck"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="tools_notes[tools_condition_check]"
                                                    placeholder="Enter keterangan untuk Tools Condition Check">
                                            </div>
                                        </td>

                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="othersEquipment">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersEquipment" name="tools[others]"
                                                    onchange="toggleNote('othersEquipment')">
                                            </div>
                                            <div id="note-othersEquipment" class="note-input" style="display: none;">
                                                <label for="note-othersEquipment" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="tools_notes[others]"
                                                    placeholder="Enter keterangan untuk Others">
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
                                                    onchange="toggleNote('environmentAspectControl')">
                                            </div>
                                            <div id="note-environmentAspectControl" class="note-input"
                                                style="display: none;">
                                                <label for="note-environmentAspectControl"
                                                    class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[environment_aspect_control]"
                                                    placeholder="Enter keterangan untuk Environment Aspect Control">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others2">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others2"
                                                    name="tools[others2]" onchange="toggleNote('others2')">
                                            </div>
                                            <div id="note-others2" class="note-input" style="display: none;">
                                                <label for="note-others2" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control" name="tools_notes[others2]"
                                                    placeholder="Enter keterangan untuk Others">
                                            </div>
                                        </td>

                                        <!-- Kosongkan Kolom -->
                                        <td></td>

                                        <!-- Lain-lain (Others) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others3">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others3"
                                                    name="environment[others3]" onchange="toggleNote('others3')">
                                            </div>
                                            <div id="note-others3" class="note-input" style="display: none;">
                                                <label for="note-others3" class="form-label">Keterangan:</label>
                                                <input type="text" class="form-control"
                                                    name="environment_notes[others3]"
                                                    placeholder="Enter keterangan untuk Others">
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