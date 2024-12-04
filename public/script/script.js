const iconNav = document.getElementById("icon-nav");
const menuList = document.getElementById("menu-list");

iconNav.addEventListener("click", () => {
    menuList.classList.toggle("hidden");
});

function togglePopup(popupId) {
    document.getElementById(popupId).classList.toggle("active");
}

document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggles = document.querySelectorAll(".dropdown");

    dropdownToggles.forEach((toggle) => {
        const dropdownToggleArea = toggle.querySelector(".dropdown-i"); // Targetkan seluruh div dropdown-i
        const caret = toggle.querySelector(".fa-caret-down"); // Caret Icon
        const dropdownContent = toggle.querySelector(".dropdown-content"); // Dropdown content

        // Klik pada div dropdown-i (yang berisi link dan caret) untuk toggle dropdown
        dropdownToggleArea.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah navigasi jika ada link

            // Jika sudah terbuka, tutup
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
                caret.classList.remove("active"); // Hapus class 'active' dari caret untuk animasi
            } else {
                // Tutup semua dropdown sebelum membuka yang diklik
                document
                    .querySelectorAll(".dropdown-content")
                    .forEach((content) => {
                        content.style.display = "none";
                    });
                document.querySelectorAll(".fa-caret-down").forEach((icon) => {
                    icon.classList.remove("active"); // Hapus animasi dari caret lain
                });

                // Buka dropdown yang diklik
                dropdownContent.style.display = "block";
                caret.classList.add("active"); // Tambah class 'active' untuk animasi caret
            }
        });
    });

    // Tutup dropdown saat mengklik di luar elemen dropdown
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".dropdown")) {
            document
                .querySelectorAll(".dropdown-content")
                .forEach((content) => {
                    content.style.display = "none";
                });
            document.querySelectorAll(".fa-caret-down").forEach((icon) => {
                icon.classList.remove("active"); // Hapus class 'active' dari semua caret
            });
        }
    });
});

function showForm() {
    const selectedRole = document.getElementById("form-role").value;
    const formContainer = document.getElementById("form-container");
    const roleTitle = document.getElementById("role-title");
    const jabatanField = document.getElementById("form-jabatan");
    const instansiField = document.getElementById("form-instansi");

    if (selectedRole !== "null") {
        // Ubah teks judul role
        roleTitle.innerText = selectedRole.toUpperCase();
        formContainer.style.display = "block";
        formContainer.scrollIntoView({ behavior: "smooth" });
        const isAdmin = window.location.pathname.includes("/admin");

        const roleInputHidden = document.getElementById("role-input-hidden");
        roleInputHidden.value = selectedRole;

        // ----------------------------
        if (selectedRole === "pegawai") {
            jabatanField.innerHTML = `
                <label for="jabatan">Jabatan <span>*</span></label>
                <select id="jabatan" name="jabatan" required>
                            <option value="">--- Pilih Jabatan ---</option>
                            <option value="Kepala Balai">Kepala Balai</option>
                            <option value="Kepala Subbagian Tata Usaha">Kepala Subbagian Tata Usaha</option>
                            <option value="Bendahara Pengeluaran">Bendahara Pengeluaran</option>
                            <option value="Bendahara Penerimaan">Bendahara Penerimaan</option>
                            <option value="PPK (Pejabat Pembuat Komitmen)">PPK (Pejabat Pembuat Komitmen)</option>
                            <option value="Pejabat Pengadaan Barang dan Jasa">Pejabat Pengadaan Barang dan Jasa</option>
                            <option value="Penyusun Rencana Kegiatan dan Anggaran">Penyusun Rencana Kegiatan dan Anggaran
                            </option>
                            <option value="Petugas Pemelihara Kendaraan Dinas">Petugas Pemelihara Kendaraan Dinas</option>
                            <option value="Pengadministrasi Keuangan">Pengadministrasi Keuangan</option>
                            <option value="Arsiparis Terampil">Arsiparis Terampil</option>
                            <option value="Pengadministrasi dan Penyaji Data">Pengadministrasi dan Penyaji Data</option>
                            <option value="Pengadministrasi Umum">Pengadministrasi Umum</option>
                            <option value="Pekarya Taman">Pekarya Taman</option>
                            <option value="Medik Muda Selaku Subkoordinator Substansi Penyiapan Sampel">Medik Muda Selaku
                                Subkoordinator Substansi Penyiapan Sampel</option>
                            <option value="Medik Veteriner Madya">Medik Veteriner Madya</option>
                            <option value="Paramedik Veteriner Terampil">Paramedik Veteriner Terampil</option>
                            <option value="Medik Veteriner Muda">Medik Veteriner Muda</option>
                            <option value="Medik Veteriner Pertama">Medik Veteriner Pertama</option>
                            <option value="PMHP Muda">PMHP Muda</option>
                            <option value="PMHP Madya">PMHP Madya</option>
                            <option value="PMHP Penyelia">PMHP Penyelia</option>
                            <option value="PMHP Terampil">PMHP Terampil</option>
                            <option value="Teknisi Gedung">Teknisi Gedung</option>
                            <option value="Medik Muda Selaku Subkoordinator Substansi Pelayanan Teknik">Medik Muda Selaku
                                Subkoordinator Substansi Pelayanan Teknik</option>
                            <option value="Paramedik Pelaksana Lanjutan">Paramedik Pelaksana Lanjutan</option>
                            <option value="Medik Veteriner Ahli Pertama">Medik Veteriner Ahli Pertama</option>
                            <option value="Pengadministrasi dan Penyaji Data">Pengadministrasi dan Penyaji Data</option>
                            <option value="Calon Pengolah Data">Calon Pengolah Data</option>
                            <option value="Calon Paramedik Veteriner">Calon Paramedik Veteriner</option>
                            <option value="Paramedik Veteriner Mahir">Paramedik Veteriner Mahir</option>
                        </select>
            `;
            instansiField.innerHTML = `<label for="instansi">Instansi <span>*</span></label>
                                        <input type="text" id="instansi" name="instansi" value="Balai Pengujian Mutu dan Sertifikasi Produk Hewan" readonly required>`;
        } else {
            jabatanField.innerHTML = `
                                <label for="jabatan">Jabatan <span>*</span></label>
                                <input type="text" id="jabatan" name="jabatan" required>
                                    `;
            instansiField.innerHTML = `
                                <label for="instansi">Instansi <span>*</span></label>
                                <input type="text" id="instansi" name="instansi" required>
                                    `;
        }

        // ----------------------------

        if (isAdmin) {
            formContainer.action = `/admin/add/${selectedRole}`;
        } else {
            formContainer.action = "/user/integritas/store";
        }
    } else {
        // Sembunyikan form jika tidak ada role yang dipilih
        formContainer.style.display = "none";
    }
}

// Scroll to top
let scrollToTopBtn = document.getElementById("scrollToTopBtn");

window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

scrollToTopBtn.onclick = function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};

document.addEventListener("DOMContentLoaded", function () {
    const noWhatsappInput = document.getElementById("no_whatsapp");

    noWhatsappInput.addEventListener("input", function (e) {
        if (this.value.startsWith("0")) {
            this.value = this.value.substring(1);
        }
    });

    document.querySelector("form").addEventListener("submit", function (e) {
        if (!noWhatsappInput.value.match(/^\d{8,14}$/)) {
            alert(
                "Nomor WhatsApp harus terdiri dari 8 hingga 14 digit dan tidak boleh diawali dengan angka 0."
            );
            e.preventDefault();
        }
    });
});

// alert form
function confirmationData(event) {
    // Dapatkan elemen form
    const form = document.getElementById("form-container");

    // Validasi form secara manual sebelum menampilkan SweetAlert
    if (!form.checkValidity()) {
        // Jika form tidak valid, arahkan ke elemen yang tidak valid
        form.reportValidity(); // Ini akan otomatis fokus ke field yang tidak valid
        return; // Hentikan eksekusi jika form tidak valid
    }

    // Jika form valid, lanjutkan ke SweetAlert konfirmasi
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Pastikan data dan email yang anda masukkan sudah benar!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, kirim!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, submit form secara manual
            Swal.fire({
                title: "Terkirim!",
                text: "Formulir Anda telah dikirim.",
                icon: "success",
                footer: '<a href="https://mail.google.com/">Pergi ke Email?</a>',
                showConfirmButton: true,
                timer: 10000,
            });
            // Submit form setelah konfirmasi
            form.submit();
        }
    });
}

window.addEventListener("load", function () {
    var loader = document.getElementById("loader");
    loader.style.display = "none"; // Sembunyikan loader setelah halaman dimuat
});

document.addEventListener("DOMContentLoaded", function () {
    const title = document.querySelector(".home-title h1");
    const text = title.textContent;
    title.innerHTML = "";

    // Pecah teks menjadi huruf-huruf
    text.split("").forEach((letter, index) => {
        const span = document.createElement("span");
        if (letter === " ") {
            span.innerHTML = "&nbsp;"; // Jika huruf adalah spasi, tambahkan non-breaking space
        } else {
            span.textContent = letter;
        }
        span.style.animationDelay = `${index * 0.07}s`; // Tambah delay untuk tiap huruf
        title.appendChild(span);
    });
});
