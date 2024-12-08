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
                                                        <input type="checkbox" class="form-check-input" id="unsafeCondition"
                                                            name="condition_status[]" value="Unsafe Condition"
                                                            onclick="onlyOne(this)"
                                                            <?php echo e(in_array('Unsafe Condition', json_decode($report->condition_status ?? '[]')) ? 'checked' : ''); ?>>
                                                        <label for="unsafeCondition" class="mb-0">Unsafe Condition</label>
                                                    </div>

                                                    <!-- Unsafe Act -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger invisible"></button>
                                                        <input type="checkbox" class="form-check-input" id="unsafeAct"
                                                            name="condition_status[]" value="Unsafe Act"
                                                            onclick="onlyOne(this)"
                                                            <?php echo e(in_array('Unsafe Act', json_decode($report->condition_status ?? '[]')) ? 'checked' : ''); ?>>
                                                        <label for="unsafeAct" class="mb-0">Unsafe Act</label>
                                                    </div>

                                                    <!-- Safe Condition -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-sm btn-success">GREEN</button>
                                                        <input type="checkbox" class="form-check-input" id="safeCondition"
                                                            name="condition_status[]" value="Safe Condition"
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
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="faceEyes">Mata & Wajah <br>Face &
                                                    Eyes</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="faceEyes"
                                                    name="ppe[face_eyes]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="strikingAgainst">Berbenturan
                                                    <br>Striking Against</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="strikingAgainst"
                                                    name="working_position[striking_against]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="posture">Sikap Tubuh
                                                    <br>Posture</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="posture"
                                                    name="ergonomic_health[posture]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="ears">Telinga <br>Ears</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="ears"
                                                    name="ppe[ears]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="struckBy">Terbentur Oleh <br>Struck
                                                    By</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="struckBy"
                                                    name="working_position[struck_by]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="motionType">Jenis & Jumlah Gerakan
                                                    <br>Number & Type of Motion</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="motionType"
                                                    name="ergonomic_health[motion_type]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="head">Kepala <br>Head</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="head"
                                                    name="ppe[head]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="caughtBetween">Terjepit
                                                    Diantara<br>Caught Between</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="caughtBetween" name="working_position[caught_between]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="loadHandled">Beban yang
                                                    Ditangani<br>Load Handled</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="loadHandled"
                                                    name="ergonomic_health[load_handled]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="armsHands">Tangan & Lengan<br>Arms &
                                                    Hands</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="armsHands"
                                                    name="ppe[arms_hands]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="falling">Jatuh<br>Falling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="falling"
                                                    name="working_position[falling]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workingAreaDesign">Design Lokasi
                                                    Kerja<br>Working Area Design</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workingAreaDesign" name="ergonomic_health[working_area_design]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="feetLegs">Kaki & Telapak Kaki<br>Feet
                                                    & Legs</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="feetLegs"
                                                    name="ppe[feet_legs]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="extremeTemperature">Temperatur yang
                                                    Berlebihan<br>Extremes Temperature </label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="extremeTemperature" name="ergonomic_health[extreme_temperature]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsGrip">Peralatan dan Cara
                                                    Penggunaan<br>Tools & Grip</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="toolsGrip"
                                                    name="tools_equipment[tools_grip]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="respiratorySystem">Sistim
                                                    Pernapasan<br>Respiratory System</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="respiratorySystem" name="ppe[respiratory_system]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="electricalCurrent">Arus
                                                    Listrik<br>Electrical Current</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="electricalCurrent" name="ergonomic_health[electrical_current]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="airVentilation">Sirkulasi Udara<br>Air
                                                    Ventilation</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="airVentilation" name="environment_housekeeping[air_ventilation]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="trunk">Dada<br>Trunk</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="trunk"
                                                    name="ppe[trunk]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="inhaling">Terhisap Oleh
                                                    Pernapasan<br>Inhaling</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="inhaling"
                                                    name="ergonomic_health[inhaling]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="vibration">Getaran<br>Vibration</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="vibration"
                                                    name="ergonomic_health[vibration]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="body">Badan <br>Body</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="body"
                                                    name="ppe[body]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="absorbing">Terserap Oleh
                                                    Kulit<br>Absorbing</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="absorbing"
                                                    name="ergonomic_health[absorbing]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="workAreaTemperature">Suhu<br>Work Area
                                                    Temperature</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="workAreaTemperature"
                                                    name="ergonomic_health[work_area_temperature]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others"
                                                    name="ppe[others]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="fallingObjects">Kejatuhan
                                                    Benda<br>Falling Objects</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="fallingObjects" name="working_position[falling_objects]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="lighting">Penerangan<br>Lighting</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="lighting"
                                                    name="environment_housekeeping[lighting]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersPressure">Lain-lain (Tekanan,
                                                    dll)<br>Others (Pressure, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersPressure" name="environment_housekeeping[others_pressure]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="noise">Kebisingan<br>Noise</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="noise"
                                                    name="environment_housekeeping[noise]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="psychosocial">Psikososial<br>Psychosocial</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="psychosocial"
                                                    name="environment_housekeeping[psychosocial]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="othersChemical">Lain-lain (Kimia,
                                                    Debu, dll)<br>Others (Chemical, Dust, etc)</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersChemical" name="environment_housekeeping[others_chemical]">
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
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="rightTool">Menggunakan Peralatan yang
                                                    Tepat<br>Use the Right Tool</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="rightTool"
                                                    name="tools_equipment[right_tool]">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="standardPracticeEstablished">Apakah
                                                    Standar Operasional Sudah Ada?<br>Is Standard Practice
                                                    Established</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardPracticeEstablished" name="procedures[standard_practice]">
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="cleanlinessCheck">Kebersihan<br>Cleanliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="cleanlinessCheck"
                                                        name="environment_housekeeping[cleanliness]">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0"
                                                        for="orderlinessCheck">Kerapihan<br>Orderliness</label>
                                                    <input type="checkbox" class="form-check-input ms-auto"
                                                        id="orderlinessCheck"
                                                        name="environment_housekeeping[orderliness]">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="usedCorrectly">Dipergunakan dengan
                                                    benar dan sesuai <br>Used Correctly</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="usedCorrectly" name="tools_equipment[used_correctly]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardAdequate">Apakah Standar
                                                    Operasional Sudah Cukup Untuk Pekerjaan Tersebut ? <br>Is Standard
                                                    Practice Adequate for the Job</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardAdequate" name="procedures[standard_adequate]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="hazardousMaterialHandling">Penanganan
                                                    Material / Limbah B3<br>Handling of Hazardous Material or Waste</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="hazardousMaterialHandling"
                                                    name="environment_housekeeping[hazardous_material_handling]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsCondition">Kondisi
                                                    Peralatan<br>Tools and Equipment Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsCondition" name="tools_equipment[tools_condition]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="standardMaintained">Apakah Standar
                                                    Operasional Diterapkan & Dipertahankan ?<br>Is Standard Practice
                                                    Maintained</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="standardMaintained" name="procedures[standard_maintained]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="nonB3WasteHandling">Penanganan Limbah
                                                    Non B3<br>NON B3 Waste Handling</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="nonB3WasteHandling"
                                                    name="environment_housekeeping[non_b3_waste_handling]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="toolsConditionCheck">Kondisi
                                                    Perkakas<br>Tools Condition</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="toolsConditionCheck"
                                                    name="tools_equipment[tools_condition_check]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0"
                                                    for="othersEquipment">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="othersEquipment" name="tools_equipment[others]">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="environmentAspectControl">Pengendalian
                                                    Aspek Lingkungan<br>Environment Aspect Control</label>
                                                <input type="checkbox" class="form-check-input ms-auto"
                                                    id="environmentAspectControl"
                                                    name="environment_housekeeping[environment_aspect_control]">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others2">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others2"
                                                    name="tools_equipment[others2]">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <label class="form-label mb-0" for="others3">Lain-lain<br>Others</label>
                                                <input type="checkbox" class="form-check-input ms-auto" id="others3"
                                                    name="environment_housekeeping[others3]">
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Bian\Documents\Work\Clone\report-hse\resources\views/report/index.blade.php ENDPATH**/ ?>