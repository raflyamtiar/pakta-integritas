@extends('layouts.admin')
@section('title', 'Tambah Laporan SPG')
@section('content')
    <header>
        <h1>Silahkan Isi Formulir Laporan SPG</h1>
    </header>
    <hr class="header-line">
    <div class="isi-form" id="isi-form">
        <form action="{{ route('lapor.submit') }}" method="POST" enctype="multipart/form-data" id="form-container"
            class="form-container">
            @csrf
            <input type="hidden" name="is_admin" value="true">
            <h3>FORMULIR LAPORAN SPG</h3>
            <div class="img-form">
                <img src="{{ asset('assets/pembatas.png') }}" alt="">
            </div>
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

            <div class="form-group">
                <label for="reporterName">Nama Pelapor <span>*</span></label>
                <input type="text" id="reporterName" name="reporterName" max-length="100"
                    value="{{ old('reporterName') }}" required>
            </div>

            <div class="form-group">
                <label for="reporterEmail">Email Pelapor <span>*</span></label>
                <input type="email" id="reporterEmail" name="reporterEmail" value="{{ old('reporterEmail') }}"
                    placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="relationship">Hubungan Pelapor dengan BPMSPH <span>*</span></label>
                <select id="relationship" name="relationship" required>
                    <option value="">Pilih Hubungan</option>
                    <option value="Karyawan" {{ old('relationship') == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                    <option value="Masyarakat" {{ old('relationship') == 'Masyarakat' ? 'selected' : '' }}>Masyarakat
                    </option>
                    <option value="Instansi" {{ old('relationship') == 'Instansi' ? 'selected' : '' }}>Instansi</option>
                    <option value="Lainnya" {{ old('relationship') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="form-group hidden-input" id="relationshipOtherContainer">
                <label for="relationshipOther">Hubungan Lainnya</label>
                <input type="text" id="relationshipOther" name="relationship_other"
                    placeholder="Sebutkan hubungan lainnya" value="{{ old('relationship_other') }}">
            </div>

            <div class="form-group">
                <label for="reportedName">Nama Terlapor <span>*</span></label>
                <input type="text" id="reportedName" name="reportedName" value="{{ old('reportedName') }}" required>
            </div>

            <div class="form-group">
                <label for="reportedPosition">Jabatan Instansi Tempat Kerja Terlapor <span>*</span></label>
                <input type="text" id="reportedPosition" name="reportedPosition" value="{{ old('reportedPosition') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="caseType">Kasus Penyuapan/SPG yang Terjadi <span>*</span></label>
                <select id="caseType" name="caseType" required>
                    <option value="">Pilih Kasus</option>
                    <option value="Uang" {{ old('caseType') == 'Uang' ? 'selected' : '' }}>Uang</option>
                    <option value="Barang" {{ old('caseType') == 'Barang' ? 'selected' : '' }}>Barang</option>
                    <option value="Diskon" {{ old('caseType') == 'Diskon' ? 'selected' : '' }}>Diskon</option>
                    <option value="Pinjaman" {{ old('caseType') == 'Pinjaman' ? 'selected' : '' }}>Pinjaman</option>
                    <option value="Lainnya" {{ old('caseType') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="form-group hidden-input" id="caseTypeOtherContainer">
                <label for="caseTypeOther">Kasus Lainnya</label>
                <input type="text" id="caseTypeOther" name="case_type_other" placeholder="Sebutkan kasus lainnya"
                    value="{{ old('case_type_other') }}">
            </div>

            <div class="form-group">
                <label for="incidentLocation">Lokasi Kejadian SPG <span>*</span></label>
                <select id="incidentLocation" name="incidentLocation" required>
                    <option value="">Pilih Lokasi</option>
                    <option value="Kantor" {{ old('incidentLocation') == 'Kantor' ? 'selected' : '' }}>Kantor</option>
                    <option value="Lainnya" {{ old('incidentLocation') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="form-group hidden-input" id="incidentLocationOtherContainer">
                <label for="incidentLocationOther">Lokasi Lainnya</label>
                <input type="text" id="incidentLocationOther" name="incident_location_other"
                    placeholder="Sebutkan lokasi lainnya" value="{{ old('incident_location_other') }}">
            </div>

            <div class="form-group">
                <label for="incidentAddress">Tempat / Alamat Kejadian SPG <span>*</span></label>
                <textarea id="incidentAddress" name="incidentAddress" required>{{ old('incidentAddress') }}</textarea>
            </div>

            <div class="form-group">
                <label for="incidentDate">Tanggal Kejadian SPG <span>*</span></label>
                <input type="date" id="incidentDate" name="incidentDate" value="{{ old('incidentDate') }}" required>
            </div>

            <div class="form-group">
                <label for="incidentTime">Waktu / Jam Kejadian SPG <span>*</span></label>
                <input type="time" id="incidentTime" name="incidentTime" value="{{ old('incidentTime') }}" required>
            </div>

            <div class="form-group">
                <label for="incidentDescription">Deskripsi Singkat Kejadian SPG <span>*</span></label>
                <textarea id="incidentDescription" name="incidentDescription" required>{{ old('incidentDescription') }}</textarea>
            </div>

            <div class="form-group">
                <label for="evidence" class="upload-label">Bukti Fisik Kejadian SPG (bila ada):</label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" id="evidence" name="evidence" accept="image/*,application/pdf" hidden>
                    <span>Seret dan lepas file di sini atau <strong>klik untuk memilih file</strong></span>
                    <div id="filePreview" class="file-preview"></div>
                </div>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center;">
                    <input type="checkbox" id="declaration" name="declaration" value="Setuju" required
                        {{ old('declaration') == 'Setuju' ? 'checked' : '' }}
                        style="width: auto; margin-right: 8px; transform: scale(1.3);">
                    Dengan ini saya sebagai pelapor menyatakan bahwa laporan yang saya sampaikan adalah benar.
                </label>
            </div>

            <div class="btn-send-form">
                <button id="submit-btn" type="submit">
                    Kirim <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
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

        .hidden-input {
            display: none;
        }
    </style>

    <script>
        // Handle file upload preview
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

        // Clear file preview
        function clearFilePreview() {
            filePreview.innerHTML = '';
            fileInput.value = ''; // Reset the file input
            uploadArea.querySelector('span').style.display = 'inline'; // Show the upload message again
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleInputVisibility = (selectElement, containerId) => {
                const container = document.getElementById(containerId);
                if (selectElement.value === 'Lainnya') {
                    container.classList.remove('hidden-input'); // Tampilkan
                } else {
                    container.classList.add('hidden-input'); // Sembunyikan
                    container.querySelector('input').value = ''; // Kosongkan input jika disembunyikan
                }
            };

            // Hubungan Pelapor
            const relationshipSelect = document.getElementById('relationship');
            relationshipSelect.addEventListener('change', () => {
                toggleInputVisibility(relationshipSelect, 'relationshipOtherContainer');
            });

            // Kasus Penyuapan
            const caseTypeSelect = document.getElementById('caseType');
            caseTypeSelect.addEventListener('change', () => {
                toggleInputVisibility(caseTypeSelect, 'caseTypeOtherContainer');
            });

            // Lokasi Kejadian
            const incidentLocationSelect = document.getElementById('incidentLocation');
            incidentLocationSelect.addEventListener('change', () => {
                toggleInputVisibility(incidentLocationSelect, 'incidentLocationOtherContainer');
            });
        });
    </script>

@endsection
