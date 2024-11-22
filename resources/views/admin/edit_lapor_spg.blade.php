@extends('layouts.admin')

@section('title', 'Edit Data Lapor SPG')

@section('content')

    <header>
        <h1>Edit Data Lapor SPG</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <div class="form-container-wrapper">
            <form action="{{ route('lapor-spg.update', ['id' => $laporanSpg->id]) }}" method="POST"
                enctype="multipart/form-data" id="form-container" class="form-container">
                @csrf
                @method('PUT')

                <h3>FORMULIR LAPOR SPG</h3>

                <!-- Error Message Handling -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Nama Pelapor -->
                <div class="form-group">
                    <label for="reporter_name">Nama Pelapor <span>*</span></label>
                    <input type="text" id="reporter_name" name="reporterName" max-length="100"
                        value="{{ old('reporterName', $laporanSpg->reporter_name) }}" required>
                </div>

                <!-- Email Pelapor -->
                <div class="form-group">
                    <label for="reporter_email">Email Pelapor <span>*</span></label>
                    <input type="email" id="reporter_email" name="reporterEmail"
                        value="{{ old('reporterEmail', $laporanSpg->reporter_email) }}" required>
                </div>

                <!-- Hubungan Pelapor -->
                <div class="form-group">
                    <label for="relationship">Hubungan Pelapor dengan BPMSPH <span>*</span></label>
                    <select id="relationship" name="relationship" required onchange="toggleOtherInput('relationship')">
                        <option value="">Pilih Hubungan</option>
                        <option value="Karyawan"
                            {{ old('relationship', $laporanSpg->relationship) == 'Karyawan' ? 'selected' : '' }}>Karyawan
                        </option>
                        <option value="Masyarakat"
                            {{ old('relationship', $laporanSpg->relationship) == 'Masyarakat' ? 'selected' : '' }}>
                            Masyarakat</option>
                        <option value="Instansi"
                            {{ old('relationship', $laporanSpg->relationship) == 'Instansi' ? 'selected' : '' }}>Instansi
                        </option>
                        <option value="Lainnya"
                            {{ !in_array($laporanSpg->relationship, ['Karyawan', 'Masyarakat', 'Instansi']) ? 'selected' : '' }}>
                            Lainnya</option>
                    </select>
                    <input type="text" id="relationship_other" name="relationship_other" class="form-control mt-2"
                        value="{{ !in_array($laporanSpg->relationship, ['Karyawan', 'Masyarakat', 'Instansi']) ? $laporanSpg->relationship : '' }}"
                        placeholder="Hubungan lainnya"
                        style="display: {{ !in_array($laporanSpg->relationship, ['Karyawan', 'Masyarakat', 'Instansi']) ? 'block' : 'none' }};">
                </div>

                <!-- Nama Terlapor -->
                <div class="form-group">
                    <label for="reported_name">Nama Terlapor <span>*</span></label>
                    <input type="text" id="reported_name" name="reportedName" max-length="100"
                        value="{{ old('reportedName', $laporanSpg->reported_name) }}" required>
                </div>

                <!-- Jabatan Terlapor -->
                <div class="form-group">
                    <label for="reported_position">Jabatan Terlapor <span>*</span></label>
                    <input type="text" id="reported_position" name="reportedPosition" max-length="50"
                        value="{{ old('reportedPosition', $laporanSpg->reported_position) }}" required>
                </div>

                <!-- Kasus Penyuapan -->
                <div class="form-group">
                    <label for="case_type">Kasus Penyuapan/SPG yang Terjadi <span>*</span></label>
                    <select id="case_type" name="caseType" required onchange="toggleOtherInput('case_type')">
                        <option value="">Pilih Kasus</option>
                        <option value="Uang" {{ old('caseType', $laporanSpg->case_type) == 'Uang' ? 'selected' : '' }}>
                            Uang</option>
                        <option value="Barang" {{ old('caseType', $laporanSpg->case_type) == 'Barang' ? 'selected' : '' }}>
                            Barang</option>
                        <option value="Diskon" {{ old('caseType', $laporanSpg->case_type) == 'Diskon' ? 'selected' : '' }}>
                            Diskon</option>
                        <option value="Pinjaman"
                            {{ old('caseType', $laporanSpg->case_type) == 'Pinjaman' ? 'selected' : '' }}>Pinjaman</option>
                        <option value="Lainnya"
                            {{ !in_array($laporanSpg->case_type, ['Uang', 'Barang', 'Diskon', 'Pinjaman']) ? 'selected' : '' }}>
                            Lainnya</option>
                    </select>
                    <input type="text" id="case_type_other" name="case_type_other" class="form-control mt-2"
                        value="{{ !in_array($laporanSpg->case_type, ['Uang', 'Barang', 'Diskon', 'Pinjaman']) ? $laporanSpg->case_type : '' }}"
                        placeholder="Jenis kasus lainnya"
                        style="display: {{ !in_array($laporanSpg->case_type, ['Uang', 'Barang', 'Diskon', 'Pinjaman']) ? 'block' : 'none' }};">
                </div>

                <!-- Lokasi Kejadian -->
                <div class="form-group">
                    <label for="incident_location">Lokasi Kejadian SPG <span>*</span></label>
                    <select id="incident_location" name="incidentLocation" required
                        onchange="toggleOtherInput('incident_location')">
                        <option value="">Pilih Lokasi</option>
                        <option value="Kantor"
                            {{ old('incidentLocation', $laporanSpg->incident_location) == 'Kantor' ? 'selected' : '' }}>
                            Kantor</option>
                        <option value="Lainnya"
                            {{ !in_array($laporanSpg->incident_location, ['Kantor']) ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <input type="text" id="incident_location_other" name="incident_location_other"
                        class="form-control mt-2"
                        value="{{ !in_array($laporanSpg->incident_location, ['Kantor']) ? $laporanSpg->incident_location : '' }}"
                        placeholder="Lokasi lainnya"
                        style="display: {{ !in_array($laporanSpg->incident_location, ['Kantor']) ? 'block' : 'none' }};">
                </div>

                <!-- Alamat Kejadian -->
                <div class="form-group">
                    <label for="incident_address">Tempat / Alamat Kejadian SPG <span>*</span></label>
                    <textarea id="incident_address" name="incidentAddress" required>{{ old('incidentAddress', $laporanSpg->incident_address) }}</textarea>
                </div>

                <!-- Tanggal Kejadian -->
                <div class="form-group">
                    <label for="incident_date">Tanggal Kejadian <span>*</span></label>
                    <input type="date" id="incident_date" name="incidentDate"
                        value="{{ old('incidentDate', $laporanSpg->incident_date) }}" required>
                </div>

                <!-- Waktu Kejadian -->
                <div class="form-group">
                    <label for="incident_time">Waktu / Jam Kejadian SPG <span>*</span></label>
                    <input type="time" id="incident_time" name="incidentTime"
                        value="{{ old('incidentTime', $laporanSpg->incident_time) }}" required>
                </div>

                <!-- Deskripsi Kejadian -->
                <div class="form-group">
                    <label for="incident_description">Deskripsi Singkat Kejadian SPG <span>*</span></label>
                    <textarea id="incident_description" name="incidentDescription" required>{{ old('incidentDescription', $laporanSpg->incident_description) }}</textarea>
                </div>

                <!-- Bukti Fisik (File Upload) -->
                <div class="form-group">
                    <label for="evidence" class="upload-label">Bukti Fisik Kejadian SPG (bila ada):</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" id="evidence" name="evidence" accept="image/*,application/pdf" hidden>
                        <span>Seret dan lepas file di sini atau <strong>klik untuk memilih file</strong></span>
                        <div id="filePreview" class="file-preview"></div>
                    </div>
                    @if ($laporanSpg->evidence)
                        <p>Bukti yang sudah diunggah sebelumnya:
                            <a href="{{ Storage::url($laporanSpg->evidence) }}" target="_blank">Lihat Bukti</a>
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" id="declaration" name="declaration" value="Setuju" required
                            {{ old('declaration', $laporanSpg->declaration) == 'Setuju' ? 'checked' : '' }}
                            style="width: auto; margin-right: 8px; transform: scale(1.3);">
                        Dengan ini saya sebagai pelapor menyatakan bahwa laporan yang saya sampaikan adalah benar.
                    </label>
                </div>

                <div class="btn-send-form">
                    <button type="submit">
                        Update <i class="fa-solid fa-paper-plane"></i>
                    </button>
                    <a href="{{ url()->previous() }}" class="btn-cancel">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .upload-area {
            border: 2px dashed #28a745;
            padding: 20px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .file-preview img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>

    <script src="{{ asset('script/script-admin.js') }}"></script>
    <script>
        // File upload drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('evidence');
        const filePreview = document.getElementById('filePreview');

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', handleFiles);

        uploadArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadArea.style.backgroundColor = '#e0e0e0';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.backgroundColor = '';
        });

        uploadArea.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadArea.style.backgroundColor = '';
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFiles();
            }
        });

        // Handle file preview
        function handleFiles() {
            const files = fileInput.files;
            filePreview.innerHTML = '';

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const fileType = file.type.split('/')[0];
                    if (fileType === 'image') {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        filePreview.appendChild(img);
                    } else {
                        const para = document.createElement('p');
                        para.textContent = `File: ${file.name} (PDF)`;
                        filePreview.appendChild(para);
                    }
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleInputVisibility = (selectElement, containerId) => {
                const container = document.getElementById(containerId);
                if (selectElement.value === 'Lainnya') {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                    container.querySelector('input').value = ''; // Kosongkan input jika disembunyikan
                }
            };

            // Hubungan Pelapor
            const relationshipSelect = document.getElementById('relationship');
            relationshipSelect.addEventListener('change', () => {
                toggleInputVisibility(relationshipSelect, 'relationshipOtherContainer');
            });

            // Kasus Penyuapan
            const caseTypeSelect = document.getElementById('case_type');
            caseTypeSelect.addEventListener('change', () => {
                toggleInputVisibility(caseTypeSelect, 'caseTypeOtherContainer');
            });

            // Lokasi Kejadian
            const incidentLocationSelect = document.getElementById('incident_location');
            incidentLocationSelect.addEventListener('change', () => {
                toggleInputVisibility(incidentLocationSelect, 'incidentLocationOtherContainer');
            });
        });

        function toggleOtherInput(field) {
            const select = document.getElementById(field);
            const otherInput = document.getElementById(`${field}_other`);
            if (select.value === "Lainnya") {
                otherInput.style.display = "block";
            } else {
                otherInput.style.display = "none";
                otherInput.value = ""; // Reset value jika "Lainnya" tidak dipilih
            }
        }
    </script>

@endsection
