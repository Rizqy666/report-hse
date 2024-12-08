<html>
<head>
    <title>Formulir Peduli HSE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }


        .submit-btn button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 10px;
        }

        .submit-btn button:hover {
            background-color: #0056b3;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
        }
        .sub-header {
            text-align: center;
            margin-top: 10px;
        }
        .sub-header span {
            display: inline-block;
            margin: 0 10px;
        }
        .sub-header .red {
            background-color: red;
            color: white;
            padding: 2px 5px;
        }
        .sub-header .green {
            background-color: green;
            color: white;
            padding: 2px 5px;
        }
        .form-section {
            margin-top: 20px;
        }
        .form-section table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Memastikan kolom memiliki lebar yang sama */
        }
        .form-section th, .form-section td {
            border: 1px solid black;
            padding: 1px;
            text-align: centert;
            overflow: hidden; /* Mencegah teks overflow */
            text-overflow: ellipsis; /* Menambahkan ellipsis untuk teks yang overflow */
        }
        .form-section th {
            background-color: #f2f2f2;
        }
        .form-section .category {
            font-weight: bold;
        }
        .form-section .sub-category {
            font-style: italic;
        }
        .form-section .checkbox {
            display: flex;
            justify-content: flex-end; /* Mengatur checkbox di tengah kanan */
            align-items: center; /* Vertikal tengah */
        }
    </style>
</head>
<body>
    <div class="header">FORMULIR PEDULI HSE</div>
    <div class="sub-header">
        <span class="red">RED</span> Unsafe Condition
        <span class="green">GREEN</span> Unsafe Act
    </div>
    <div class="form-section">
        <table>
            <tr>
                <td>Date: ........................................</td>
                <td>Reported By: ........................................</td>
                <td>Inst / Dept: ........................................</td>
            </tr>
        </table>
    </div>
    <div class="form-section">
        <table>
            <tr>
                <th>CATEGORY "A"<br>Alat Pelindung Diri / PPE</th>
                <th>CATEGORY "B"<br>Posisi Kerja / Working Position</th>
                <th>CATEGORY "C"<br>Kesehatan & Ergonomi / Ergonomic & Health</th>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Mata & Wajah<br><span class="sub-category">Face & Eyes</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Berbenturan<br><span class="sub-category">Striking Against</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Sikap Tubuh<br><span class="sub-category">Posture</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Telinga<br><span class="sub-category">Ears</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Terbentur Oleh<br><span class="sub-category">Struck By</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Jenis & Jumlah Gerakan<br><span class="sub-category">Number & Type of Motion</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kepala<br><span class="sub-category">Head</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Terjepit Diantara<br><span class="sub-category">Caught Between</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Beban yang Ditangani<br><span class="sub-category">Load Handled</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Tangan & Lengan<br><span class="sub-category">Arms & Hands</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Jatuh<br><span class="sub-category">Falling</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Design Lokasi Kerja<br><span class="sub-category">Working Area Design</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kaki & Telapak Kaki<br><span class="sub-category">Feet & Legs</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Temperatur yang Berlebihan<br><span class="sub-category">Extremes Temperature</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Peralatan dan Cara Penggunaan<br><span class="sub-category">Tools & Grip</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Sistim Pernapasan<br><span class="sub-category">Respiratory System</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Arus Listrik<br><span class="sub-category">Electrical Current</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Sirkulasi Udara<br><span class="sub-category">Air Ventilation</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Dada<br><span class="sub-category">Trunk</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Terhisap Oleh Pernapasan<br><span class="sub-category">Inhaling</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Getaran<br><span class="sub-category">Vibration</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Badan<br><span class="sub-category">Body</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Terserap Oleh Kulit<br><span class="sub-category">Absorbing</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Suhu<br><span class="sub-category">Work Area Temperature</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Lain-lain<br><span class="sub-category">Others</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kejatuhan Benda<br><span class="sub-category">Falling Objects</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Penerangan<br><span class="sub-category">Lighting</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Lain-lain (Tekanan, dll)<br><span class="sub-category">Others (Pressure, etc)</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kebisingan<br><span class="sub-category">Noise</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Psikososial<br><span class="sub-category">Psychosocial</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Lain-lain (Kimia, Debu, dll)<br><span class="sub-category">Others (Chemical, Dust, etc)</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="form-section">
        <table>
            <tr>
                <th>CATEGORY "D"<br>Peralatan & Perkakas / Tools & Equipment</th>
                <th>CATEGORY "E"<br>Prosedur / Procedures</th>
                <th>CATEGORY "F"<br>Lingkungan & Kebersihan Kerapihan / Environment & Housekeeping</th>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Menggunakan Peralatan yang Tepat<br><span class="sub-category">Use the Right Tool</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Apakah Standar Operasional Sudah Ada ?<br><span class="sub-category">Is Standard Practice Established</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kebersihan<br><span class="sub-category">Cleanliness</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Dipergunakan dengan benar dan sesuai<br><span class="sub-category">Used Correctly</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Apakah Standar Operasional Sudah Cukup Untuk Pekerjaan Tersebut ?<br><span class="sub-category">Is Standard Practice Adequate for the Job</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kerapihan<br><span class="sub-category">Orderliness</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kondisi Peralatan<br><span class="sub-category">Tools and Equipment Condition</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Apakah Standar Operasional Diterapkan & Dipertahankan ?<br><span class="sub-category">Is Standard Practice Maintained</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Penanganan Material / Limbah B3<br><span class="sub-category">Handling of Hazardous Material or Waste</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Kondisi Perkakas<br><span class="sub-category">Tools Condition</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Lain-lain<br><span class="sub-category">Others</span>
                </td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Penanganan Limbah Non B3<br><span class="sub-category">NON B3 Waste Handling</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="checkbox"><input type="checkbox"></div> Pengendalian Aspek Lingkungan<br><span class="sub-category">Environment Aspect Control</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="submit-btn">
        <button type="submit">Submit</button>
    </div>
</body>
</html>


<?php /**PATH C:\Users\Bian\Documents\Work\Clone\report-hse\resources\views/hse_form.blade.php ENDPATH**/ ?>