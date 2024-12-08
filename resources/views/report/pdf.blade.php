<!DOCTYPE html>
<html>

<head>
    <title>Report PDF</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
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
                                        {{ in_array('Unsafe Condition', json_decode($report->condition_status ?? '[]')) ? 'checked' : '' }}
                                        disabled>
                                    <label for="unsafeCondition" class="mb-0">Unsafe
                                        Condition</label>
                                </div>

                                <!-- Unsafe Act -->
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-sm btn-danger invisible"></button>
                                    <input type="checkbox" class="form-check-input" id="unsafeAct"
                                        name="condition_status[]" value="Unsafe Act"
                                        {{ in_array('Unsafe Act', json_decode($report->condition_status ?? '[]')) ? 'checked' : '' }}
                                        disabled>
                                    <label for="unsafeAct" class="mb-0">Unsafe Act</label>
                                </div>

                                <!-- Safe Condition -->
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-sm btn-success">GREEN</button>
                                    <input type="checkbox" class="form-check-input" id="safeCondition"
                                        name="condition_status[]" value="Safe Condition"
                                        {{ in_array('Safe Condition', json_decode($report->condition_status ?? '[]')) ? 'checked' : '' }}
                                        disabled>
                                    <label for="safeCondition" class="mb-0">Safe Condition</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 33%">DATE : <strong>{{ $report->date }}</strong></td>
                    <td style="width: 33%">Reported By : <strong>{{ $report->reported_by }}</strong>
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
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="faceEyes">Mata & Wajah <br>Face &
                                Eyes</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="faceEyes" name="ppe[face_eyes]"
                                {{ isset($report->ppe['face_eyes']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="strikingAgainst">Berbenturan
                                <br>Striking
                                Against</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="strikingAgainst"
                                name="working_position[striking_against]"
                                {{ isset($report->working_position['striking_against']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="posture">Sikap Tubuh
                                <br>Posture</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="posture"
                                name="ergonomic_health[posture]"
                                {{ isset($report->ergonomic_health['posture']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kedua --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="ears">Telinga <br>Ears</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="ears" name="ppe[ears]"
                                {{ isset($report->ppe['ears']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="struckBy">Terbentur Oleh <br>Struck
                                By</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="struckBy"
                                name="working_position[struck_by]"
                                {{ isset($report->working_position['struck_by']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="motionType">Jenis & Jumlah Gerakan
                                <br>Number & Type
                                of
                                Motion</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="motionType"
                                name="ergonomic_health[motion_type]"
                                {{ isset($report->ergonomic_health['motion_type']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris ketiga --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="head">Kepala <br>Head</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="head" name="ppe[head]"
                                {{ isset($report->ppe['head']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="caughtBetween">Terjepit
                                Diantara<br>Caught
                                Between</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="caughtBetween"
                                name="working_position[caught_between]"
                                {{ isset($report->working_position['caught_between']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="loadHandled">Beban yang
                                Ditangani<br>Load
                                Handled</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="loadHandled"
                                name="ergonomic_health[load_handled]"
                                {{ isset($report->ergonomic_health['load_handled']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris keempat --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="armsHands">Tangan & Lengan<br>Arms
                                &
                                Hands</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="armsHands"
                                name="ppe[arms_hands]" {{ isset($report->ppe['arms_hands']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="falling">Jatuh<br>Falling</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="falling"
                                name="working_position[falling]"
                                {{ isset($report->working_position['falling']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="workingAreaDesign">Design Lokasi
                                Kerja<br>Working Area
                                Design</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="workingAreaDesign"
                                name="ergonomic_health[working_area_design]"
                                {{ isset($report->ergonomic_health['working_area_design']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kelima --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="feetLegs">Kaki & Telapak
                                Kaki<br>Feet
                                & Legs</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="feetLegs"
                                name="ppe[feet_legs]" {{ isset($report->ppe['feet_legs']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="extremeTemperature">Temperatur
                                yang
                                Berlebihan<br>Extremes Temperature </label>
                            <input type="checkbox" class="form-check-input ms-auto" id="extremeTemperature"
                                name="ergonomic_health[extreme_temperature]"
                                {{ isset($report->ergonomic_health['extreme_temperature']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="toolsGrip">Peralatan dan Cara
                                Penggunaan<br>Tools &
                                Grip</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="toolsGrip"
                                name="tools_equipment[tools_grip]"
                                {{ isset($report->tools_equipment['tools_grip']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris keenam --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="respiratorySystem">Sistim
                                Pernapasan<br>Respiratory
                                System</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="respiratorySystem"
                                name="ppe[respiratory_system]"
                                {{ isset($report->ppe['respiratory_system']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="electricalCurrent">Arus
                                Listrik<br>Electrical
                                Current</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="electricalCurrent"
                                name="ergonomic_health[electrical_current]"
                                {{ isset($report->ergonomic_health['electrical_current']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="airVentilation">Sirkulasi
                                Udara<br>Air
                                Ventilation</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="airVentilation"
                                name="environment_housekeeping[air_ventilation]"
                                {{ isset($report->environment_housekeeping['air_ventilation']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris ketujuh --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="trunk">Dada<br>Trunk</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="trunk" name="ppe[trunk]"
                                {{ isset($report->ppe['trunk']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="inhaling">Terhisap Oleh
                                Pernapasan<br>Inhaling</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="inhaling"
                                name="ergonomic_health[inhaling]"
                                {{ isset($report->ergonomic_health['inhaling']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="vibration">Getaran<br>Vibration</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="vibration"
                                name="ergonomic_health[vibration]"
                                {{ isset($report->ergonomic_health['vibration']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kedelapan --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="body">Badan <br>Body</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="body" name="ppe[body]"
                                {{ isset($report->ppe['body']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="absorbing">Terserap Oleh
                                Kulit<br>Absorbing</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="absorbing"
                                name="ergonomic_health[absorbing]"
                                {{ isset($report->ergonomic_health['absorbing']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="workAreaTemperature">Suhu<br>Work
                                Area
                                Temperature</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="workAreaTemperature"
                                name="ergonomic_health[work_area_temperature]"
                                {{ isset($report->ergonomic_health['work_area_temperature']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kesembilan --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="others">Lain-lain<br>Others</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="others"
                                name="ppe[others]" {{ isset($report->ppe['others']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="fallingObjects">Kejatuhan
                                Benda<br>Falling
                                Objects</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="fallingObjects"
                                name="working_position[falling_objects]"
                                {{ isset($report->working_position['falling_objects']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="lighting">Penerangan<br>Lighting</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="lighting"
                                name="environment_housekeeping[lighting]"
                                {{ isset($report->environment_housekeeping['lighting']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kesepuluh --}}
                <tr>
                    <td></td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="othersPressure">Lain-lain
                                (Tekanan,
                                dll)<br>Others
                                (Pressure, etc)</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="othersPressure"
                                name="environment_housekeeping[others_pressure]"
                                {{ isset($report->environment_housekeeping['others_pressure']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="noise">Kebisingan<br>Noise</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="noise"
                                name="environment_housekeeping[noise]"
                                {{ isset($report->environment_housekeeping['noise']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris sebelas --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="psychosocial">Psikososial<br>Psychosocial</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="psychosocial"
                                name="environment_housekeeping[psychosocial]"
                                {{ isset($report->environment_housekeeping['psychosocial']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris duabelas --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="othersChemical">Lain-lain (Kimia,
                                Debu, dll)<br>Others
                                (Chemical, Dust, etc)</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="othersChemical"
                                name="environment_housekeeping[others_chemical]"
                                {{ isset($report->environment_housekeeping['others_chemical']) ? 'checked' : '' }}
                                disabled>
                        </div>
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
                                yang
                                Tepat<br>Use the
                                Right Tool</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="rightTool"
                                name="tools_equipment[right_tool]"
                                {{ isset($report->tools_equipment['right_tool']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mb-0" for="standardPracticeEstablished">Apakah
                                Standar
                                Operasional Sudah Ada?<br>Is Standard Practice Established</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="standardPracticeEstablished"
                                name="procedures[standard_practice]"
                                {{ isset($report->procedures['standard_practice']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-0"
                                    for="cleanlinessCheck">Kebersihan<br>Cleanliness</label>
                                <input type="checkbox" class="form-check-input ms-auto" id="cleanlinessCheck"
                                    name="environment_housekeeping[cleanliness]"
                                    {{ isset($report->environment_housekeeping['cleanliness']) ? 'checked' : '' }}
                                    disabled>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-0" for="orderlinessCheck">Kerapihan<br>Orderliness</label>
                                <input type="checkbox" class="form-check-input ms-auto" id="orderlinessCheck"
                                    name="environment_housekeeping[orderliness]"
                                    {{ isset($report->environment_housekeeping['orderliness']) ? 'checked' : '' }}
                                    disabled>
                            </div>
                        </div>
                    </td>
                </tr>

                {{-- Baris kedua category DEF --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="usedCorrectly">Dipergunakan dengan
                                benar dan sesuai
                                <br>Used Correctly</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="usedCorrectly"
                                name="tools_equipment[used_correctly]"
                                {{ isset($report->tools_equipment['used_correctly']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="standardAdequate">Apakah Standar
                                Operasional Sudah
                                Cukup Untuk Pekerjaan Tersebut ? <br>Is Standard Practice Adequate
                                for
                                the Job</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="standardAdequate"
                                name="procedures[standard_adequate]"
                                {{ isset($report->procedures['standard_adequate']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="hazardousMaterialHandling">Penanganan
                                Material /
                                Limbah B3<br>Handling of Hazardous Material or Waste</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="hazardousMaterialHandling"
                                name="environment_housekeeping[hazardous_material_handling]"
                                {{ isset($report->environment_housekeeping['hazardous_material_handling']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris ketiga category DEF --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="toolsCondition">Kondisi
                                Peralatan<br>Tools and
                                Equipment Condition</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="toolsCondition"
                                name="tools_equipment[tools_condition]"
                                {{ isset($report->tools_equipment['tools_condition']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="standardMaintained">Apakah Standar
                                Operasional
                                Diterapkan & Dipertahankan ?<br>Is Standard Practice
                                Maintained</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="standardMaintained"
                                name="procedures[standard_maintained]"
                                {{ isset($report->procedures['standard_maintained']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="nonB3WasteHandling">Penanganan
                                Limbah
                                Non B3<br>NON B3
                                Waste Handling</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="nonB3WasteHandling"
                                name="environment_housekeeping[non_b3_waste_handling]"
                                {{ isset($report->environment_housekeeping['non_b3_waste_handling']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris keempat category DEF --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="toolsConditionCheck">Kondisi
                                Perkakas<br>Tools
                                Condition</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="toolsConditionCheck"
                                name="tools_equipment[tools_condition_check]"
                                {{ isset($report->tools_equipment['tools_condition_check']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="othersEquipment">Lain-lain<br>Others</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="othersEquipment"
                                name="tools_equipment[others]"
                                {{ isset($report->tools_equipment['others']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="environmentAspectControl">Pengendalian
                                Aspek
                                Lingkungan<br>Environment Aspect Control</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="environmentAspectControl"
                                name="environment_housekeeping[environment_aspect_control]"
                                {{ isset($report->environment_housekeeping['environment_aspect_control']) ? 'checked' : '' }}
                                disabled>
                        </div>
                    </td>
                </tr>

                {{-- Baris kelima category DEF --}}
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="others2">Lain-lain<br>Others</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="others2"
                                name="tools_equipment[others2]"
                                {{ isset($report->tools_equipment['others2']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-label mb-0" for="others3">Lain-lain<br>Others</label>
                            <input type="checkbox" class="form-check-input ms-auto" id="others3"
                                name="environment_housekeeping[others3]"
                                {{ isset($report->environment_housekeeping['others3']) ? 'checked' : '' }} disabled>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>
