@extends('layouts.user')

@section('title', 'Form Lapor SPG')

@section('content')

    {{-- loading --}}
    <div id="loader" class="loader-container">
        <div class="spinner"></div>
    </div>

    <!-- Background -->
    <figure class="mybg">
        <img src="{{ asset('assets/kantor.jpg') }}" alt="" style="width: 100%; height: auto;">
        <div class="overlay"></div> <!-- Overlay div -->
    </figure>

    <div class="isi-form" id="isi-form">
        <div class="ContainerSpg">
            <form id="reportForm" action="{{ route('lapor.submit.user') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf
                <h3>Formulir Lapor Suap Pungli & Gratifikasi</h3>

                <div class="header-image">
                    <img src="{{ asset('assets/kop.png') }}" alt="Kop Surat"
                        style="width: 100%; height: auto; display: block; margin: 0 auto;" />
                </div>
                <input type="hidden" name="is_admin" value="false">
                <!-- Nama Pelapor -->
                <div class="form-group">
                    <label for="reporterName">Nama Pelapor <span>*</span></label>
                    <input type="text" id="reporterName" name="reporterName" max-length="100" required>
                </div>

                <!-- Email Pelapor -->
                <div class="form-group">
                    <label for="reporterEmail">Email Pelapor <span>*</span>
                        <small style="color:red;">Pastikan email yang dimasukkan benar karena surat akan dikirim ke email
                            ini.</small>
                    </label>
                    <input type="email" id="reporterEmail" name="reporterEmail" placeholder="example@gmail.com" required>
                </div>

                <!-- Hubungan Pelapor -->
                <div class="form-group">
                    <label for="relationship">Hubungan Pelapor dengan BPMSPH <span>*</span></label>
                    <select id="relationship" name="relationship" required>
                        <option value="">Pilih Hubungan</option>
                        <option value="Karyawan">Karyawan</option>
                        <option value="Masyarakat">Masyarakat</option>
                        <option value="Instansi">Instansi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Nama Terlapor -->
                <div class="form-group">
                    <label for="reportedName">Nama Terlapor <span>*</span></label>
                    <input type="text" id="reportedName" name="reportedName" required>
                </div>

                <!-- Jabatan Terlapor -->
                <div class="form-group">
                    <label for="reportedPosition">Jabatan Instansi Tempat Kerja Terlapor <span>*</span></label>
                    <input type="text" id="reportedPosition" name="reportedPosition" required>
                </div>

                <!-- Kasus Penyuapan -->
                <div class="form-group">
                    <label for="caseType">Kasus Penyuapan/SPG yang Terjadi <span>*</span></label>
                    <select id="caseType" name="caseType" required>
                        <option value="">Pilih Kasus</option>
                        <option value="Uang">Uang</option>
                        <option value="Barang">Barang</option>
                        <option value="Diskon">Diskon</option>
                        <option value="Pinjaman">Pinjaman</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Lokasi Kejadian -->
                <div class="form-group">
                    <label for="incidentLocation">Lokasi Kejadian SPG <span>*</span></label>
                    <select id="incidentLocation" name="incidentLocation" required>
                        <option value="">Pilih Lokasi</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Alamat Kejadian -->
                <div class="form-group">
                    <label for="incidentAddress">Tempat / Alamat Kejadian SPG <span>*</span></label>
                    <textarea id="incidentAddress" name="incidentAddress" required></textarea>
                </div>

                <!-- Tanggal Kejadian -->
                <div class="form-group">
                    <label for="incidentDate">Tanggal Kejadian SPG <span>*</span></label>
                    <input type="date" id="incidentDate" name="incidentDate" required>
                </div>

                <!-- Waktu Kejadian -->
                <div class="form-group">
                    <label for="incidentTime">Waktu / Jam Kejadian SPG <span>*</span></label>
                    <input type="time" id="incidentTime" name="incidentTime" required>
                </div>

                <!-- Deskripsi Kejadian -->
                <div class="form-group">
                    <label for="incidentDescription">Deskripsi Singkat Kejadian SPG <span>*</span></label>
                    <textarea id="incidentDescription" name="incidentDescription" required></textarea>
                </div>

                <!-- Bukti Fisik -->
                <div class="form-group">
                    <label for="evidence" class="upload-label">Bukti Fisik Kejadian SPG (bila ada):</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" id="evidence" name="evidence" accept="image/*,application/pdf" hidden>
                        <span>Seret dan lepas file di sini atau <strong>klik untuk memilih file</strong></span>
                        <div id="filePreview" class="file-preview"></div>
                    </div>
                </div>

                <!-- Pernyataan Pelapor -->
                <div class="form-group">
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" id="declaration" name="declaration" value="Setuju" required
                            style="width: auto; margin-right: 8px; transform: scale(1.3);">
                        <p>Dengan ini saya sebagai pelapor menyatakan bahwa laporan yang saya sampaikan adalah benar.
                            <span>*</span></p>

                    </label>
                </div>

                <!-- Submit Button -->
                <div class="btn-send-form">
                    <button id="submit-btn" type="submit"> Kirim <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reportForm');
            const submitBtn = document.querySelector('#submit-btn');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form auto-submit

                // Validate form before submitting
                if (!form.checkValidity()) {
                    form.reportValidity(); // Show validation messages if form is invalid
                    return;
                }

                // Display confirmation with SweetAlert2
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Pastikan data dan email yang Anda masukkan sudah benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, kirim!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable submit button to prevent multiple clicks
                        submitBtn.disabled = true;
                        submitBtn.textContent = "Mengirim..."; // Optional: change button text

                        // Send form data using fetch API
                        let formData = new FormData(form);

                        fetch('{{ route('lapor.submit.user') }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    title: "Terkirim!",
                                    text: data.message,
                                    icon: "success",
                                    footer: '<a href="https://mail.google.com/">Pergi ke Email?</a>',
                                    showConfirmButton: true,
                                    timer: 10000
                                }).then(() => {
                                    // Re-enable button and reset text after confirmation
                                    submitBtn.disabled = false;
                                    submitBtn.textContent = "Kirim";
                                });
                                form.reset(); // Reset form after successful submission
                                clearFilePreview(); // Clear file preview after submission
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengirim laporan.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                                submitBtn.disabled = false; // Re-enable button on error
                                submitBtn.textContent = "Kirim"; // Restore button text
                            });
                    }
                });
            });

            // Fungsi clear file preview setelah submit
            function clearFilePreview() {
                const filePreview = document.getElementById('filePreview');
                filePreview.innerHTML = '';
                const fileInput = document.getElementById('evidence');
                fileInput.value = ''; // Reset input file
                document.getElementById('uploadArea').querySelector('span').style.display =
                    'inline'; // Tampilkan pesan upload lagi
            }
        });


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

        // Clear file preview
        function clearFilePreview() {
            filePreview.innerHTML = '';
            fileInput.value = ''; // Reset the file input
            uploadArea.querySelector('span').style.display = 'inline'; // Show the upload message again
        }
    </script>

@endsection
