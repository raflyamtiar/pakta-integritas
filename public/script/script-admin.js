// password
function togglePasswordVisibility() {
    // Ambil elemen checkbox dan input password
    const showPasswordCheckbox = document.getElementById("show-password");
    const passwordInput = document.getElementById("password");

    // Tambahkan event listener pada checkbox
    showPasswordCheckbox.addEventListener("change", function () {
        if (this.checked) {
            // Jika checkbox di centang, ubah tipe input menjadi text
            passwordInput.type = "text";
        } else {
            // Jika checkbox tidak di centang, ubah tipe input kembali menjadi password
            passwordInput.type = "password";
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua elemen sidebar dengan tautan
    const sidebarLinks = document.querySelectorAll(".sidebar-admin a");

    // Loop semua elemen sidebar
    sidebarLinks.forEach((link) => {
        if (link.href.includes(window.location.pathname)) {
            // Tambahkan kelas 'active' ke elemen
            link.classList.add("active");

            // Jika elemen berada di dalam dropdown, buka dropdown-nya
            const parentDropdown = link.closest(".dropdown-admin");
            if (parentDropdown) {
                const menu = parentDropdown.querySelector(".menu-admin");
                const select = parentDropdown.querySelector(".select-admin");

                // Tambahkan kelas untuk membuka dropdown
                menu.classList.add("menu-admin-open");
                select.classList.add("active");

                // Pastikan elemen lain bergeser ke bawah
                parentDropdown.classList.add("dropdown-open");
            }
        }
    });
});

const dropdowns = document.querySelectorAll(".dropdown-admin");
dropdowns.forEach((dropdown) => {
    const select = dropdown.querySelector(".select-admin");
    const caret = dropdown.querySelector(".fa-caret-down");
    const menu = dropdown.querySelector(".menu-admin");
    const options = dropdown.querySelectorAll(".menu-admin li");
    const selected = dropdown.querySelector(".selected"); // Elemen untuk teks yang terpilih
    const accountSettings = document.querySelector(".box-admin-akun"); // Pengaturan Akun

    // Fungsi untuk memuat pilihan dari LocalStorage saat halaman di-load
    const loadSelectedOption = () => {
        const savedOption = localStorage.getItem("selectedOption");
        if (savedOption) {
            selected.innerText = savedOption; // Mengubah teks dropdown dengan yang disimpan
            options.forEach((option) => {
                // Pastikan opsi yang disimpan ditandai sebagai aktif
                if (option.innerText === savedOption) {
                    option.classList.add("active");
                } else {
                    option.classList.remove("active");
                }
            });
        }
    };

    // Panggil fungsi ini saat halaman dimuat
    loadSelectedOption();

    // Saat dropdown diklik
    select.addEventListener("click", () => {
        select.classList.toggle("select-admin-clicked");
        caret.classList.toggle("fa-caret-down-rotate");
        menu.classList.toggle("menu-admin-open");

        // Tambahkan atau hapus class untuk mengatur margin bawah
        dropdown.classList.toggle("dropdown-open");
    });

    // Saat opsi dipilih
    options.forEach((option) => {
        option.addEventListener("click", () => {
            selected.innerText = option.innerText; // Ubah teks menjadi opsi terpilih

            // Simpan pilihan ke LocalStorage
            localStorage.setItem("selectedOption", option.innerText);

            // Menutup dropdown setelah item dipilih
            select.classList.remove("select-admin-clicked");
            caret.classList.remove("fa-caret-down-rotate");
            menu.classList.remove("menu-admin-open");

            // Reset margin setelah item dipilih
            accountSettings.style.marginTop = "0";

            // Mengatur item yang aktif
            options.forEach((option) => {
                option.classList.remove("active");
            });
            option.classList.add("active");
        });
    });
});

// Daftarkan semua menu yang harus mereset dropdown ke pilihan default
const menusToReset = [
    document.querySelector(".box-admin"), // Beranda
    document.querySelector(".box-admin-akun"), // Pengaturan Akun, bisa tambah menu lainnya
];

// Tambahkan event listener ke menu yang harus mereset dropdown
menusToReset.forEach((menu) => {
    menu.addEventListener("click", () => {
        localStorage.setItem("selectedOption", "Pakta Integritas"); // Reset ke default
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const noWhatsappInput = document.getElementById("no_whatsapp");
    if (noWhatsappInput) {
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
    }
});

//delete
function confirmDelete(itemId) {
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Data ini tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus ini!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + itemId).submit();
            Swal.fire({
                title: "Terhapus!",
                text: "Data kamu berhasil terhapus.",
                icon: "success",
            });
        }
    });
}

function confirmDelete(adminId) {
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Akun ini tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus ini!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, kirim form untuk penghapusan data
            document.getElementById("delete-form-" + adminId).submit();
            Swal.fire({
                title: "Terhapus!",
                text: "Akun kamu berhasil terhapus.",
                icon: "success",
            });
        }
    });
}

//logout
document.getElementById("logout-btn").addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah form logout langsung terkirim

    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Anda akan keluar dari akun!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, logout!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim form logout jika user mengkonfirmasi logout
            document.getElementById("logout-form").submit();

            // Optional: Menampilkan notifikasi logout berhasil
            Swal.fire({
                title: "Logout berhasil!",
                text: "Anda telah keluar dari akun.",
                icon: "success",
            });
        }
    });
});

function toggleForm() {
    var form = document.getElementById("userForm");
    var button = document.getElementById("toggleFormBtn");

    if (form.style.display === "none") {
        form.style.display = "block";
        button.textContent = "Minimize Form";

        // Reset form ke kondisi default (untuk tambah user baru)
        document.getElementById("addUserForm").action = "/admin/store";
        document.getElementById("methodField").value = "POST"; // Default POST method
        document.getElementById("userId").value = ""; // Reset user ID
        document.getElementById("name").value = ""; // Reset name field
        document.getElementById("email").value = ""; // Reset email field
        document.getElementById("password").value = ""; // Reset password field
        document.querySelector(
            'form#addUserForm button[type="submit"]'
        ).textContent = "Simpan";

        // Ubah judul form menjadi "Tambah Admin Baru"
        document.getElementById("formTitle").textContent = "Tambah Admin Baru";

        // Sembunyikan hint password
        document.getElementById("passwordHint").style.display = "none";
    } else {
        form.style.display = "none";
        button.textContent = "Tambah User Baru";
    }
}

// JavaScript untuk toggle visibility password
document.addEventListener("DOMContentLoaded", function () {
    // Pastikan semua elemen sudah ter-load sebelum menjalankan script
    const togglePasswordButton = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    if (togglePasswordButton && passwordInput) {
        togglePasswordButton.addEventListener("click", function () {
            const icon = this; // Mengambil ikon mata (fa-eye/fa-eye-slash)

            // Toggle tipe input antara password dan text
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Tampilkan password
                icon.classList.remove("fa-eye-slash"); // Ubah ikon ke mata terbuka
                icon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password"; // Sembunyikan password
                icon.classList.remove("fa-eye"); // Ubah ikon ke mata tertutup
                icon.classList.add("fa-eye-slash");
            }
        });
    }
});

function editAdmin(id, name, email) {
    // Tampilkan form
    toggleForm();

    // Ubah nilai form untuk edit
    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("userId").value = id;

    // Ganti method menjadi PUT untuk update
    document.getElementById("methodField").value = "PUT";

    // Ubah URL action menjadi URL update
    document.getElementById("addUserForm").action = "/admin/update/" + id;

    // Ubah button text
    document.querySelector(
        'form#addUserForm button[type="submit"]'
    ).textContent = "Perbarui";

    // Ubah judul form menjadi "Edit Akun Admin"
    document.getElementById("formTitle").textContent = "Edit Akun Admin";

    // Tampilkan hint password
    document.getElementById("passwordHint").style.display = "block";
}

// dropdown logout
function toggleDropdown() {
    const dropdownContent = document.getElementById("dropdownContent");
    const caretIcon = document.getElementById("caretIcon");

    // Tampilkan atau sembunyikan dropdown dan ubah ikon
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        caretIcon.classList.remove("rotate-icon"); // Kembalikan ikon ke posisi semula
    } else {
        dropdownContent.style.display = "block";
        caretIcon.classList.add("rotate-icon"); // Putar ikon saat dropdown dibuka
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const yearSelect = document.getElementById("yearSelect");
    const charts = {}; // Untuk menyimpan referensi chart agar bisa di-update

    // Fungsi untuk membuat grafik
    function createChart(ctx, label, data, backgroundColor) {
        // Jika chart sudah ada, hancurkan sebelum membuat yang baru
        if (charts[label]) {
            charts[label].destroy();
        }

        return new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [
                    {
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: backgroundColor,
                        borderWidth: 1,
                        fill: false,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    function updateCharts(year) {
        fetch(`/admin/get-data-surat?year=${year}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Failed to fetch data");
                }
                return response.json();
            })
            .then((data) => {
                console.log("Data received:", JSON.stringify(data, null, 2)); // Log data yang diterima secara mendetail
                const datasets = [
                    {
                        id: "chartSemua",
                        data: data.monthlyData.semua,
                        label: "Keseluruhan Surat",
                        color: "rgba(54, 162, 235, 1)",
                    },
                    {
                        id: "chartPegawai",
                        data: data.monthlyData.pegawai,
                        label: "Surat Masuk Pegawai",
                        color: "rgba(75, 192, 192, 1)",
                    },
                    {
                        id: "chartPenyedia",
                        data: data.monthlyData.penyedia,
                        label: "Surat Masuk Penyedia Jasa",
                        color: "rgba(255, 206, 86, 1)",
                    },
                    {
                        id: "chartPengguna",
                        data: data.monthlyData.pengguna,
                        label: "Surat Masuk Pengguna Jasa",
                        color: "rgba(153, 102, 255, 1)",
                    },
                    {
                        id: "chartAuditor",
                        data: data.monthlyData.auditor,
                        label: "Surat Masuk Auditor",
                        color: "rgba(255, 99, 132, 1)",
                    },
                    {
                        id: "chartSpg",
                        data: data.monthlyData.laporspg,
                        label: "Laporan SPG",
                        color: "rgba(201, 203, 207, 1)",
                    },
                ];

                datasets.forEach((dataset) => {
                    console.log(
                        `Updating chart: ${dataset.id} with data:`,
                        dataset.data
                    ); // Log data yang digunakan untuk update
                    if (charts[dataset.id]) {
                        charts[dataset.id].data.datasets[0].data = dataset.data;
                        charts[dataset.id].update();
                    } else {
                        charts[dataset.id] = createChart(
                            document
                                .getElementById(dataset.id)
                                .getContext("2d"),
                            dataset.label,
                            dataset.data,
                            dataset.color
                        );
                    }
                });
            })
            .catch((error) => {
                console.error("Error updating charts:", error);
            });
    }
    // Event listener untuk dropdown tahun
    yearSelect.addEventListener("change", (e) => {
        const selectedYear = e.target.value;
        console.log(`Year selected: ${selectedYear}`); // Debugging
        updateCharts(selectedYear);
    });

    // Inisialisasi grafik
    charts["chartSemua"] = createChart(
        document.getElementById("chartSemua").getContext("2d"),
        "Keseluruhan Surat",
        monthlyData,
        "rgba(54, 162, 235, 1)"
    );
    charts["chartPegawai"] = createChart(
        document.getElementById("chartPegawai").getContext("2d"),
        "Surat Masuk Pegawai",
        monthlyDataPegawai,
        "rgba(75, 192, 192, 1)"
    );
    charts["chartPenyedia"] = createChart(
        document.getElementById("chartPenyedia").getContext("2d"),
        "Surat Masuk Penyedia Jasa",
        monthlyDataPenyedia,
        "rgba(255, 206, 86, 1)"
    );
    charts["chartPengguna"] = createChart(
        document.getElementById("chartPengguna").getContext("2d"),
        "Surat Masuk Pengguna Jasa",
        monthlyDataPengguna,
        "rgba(153, 102, 255, 1)"
    );
    charts["chartAuditor"] = createChart(
        document.getElementById("chartAuditor").getContext("2d"),
        "Surat Masuk Auditor",
        monthlyDataAuditor,
        "rgba(255, 99, 132, 1)"
    );
    charts["chartSpg"] = createChart(
        document.getElementById("chartSpg").getContext("2d"),
        "Laporan SPG",
        monthlyDataLaporSpg,
        "rgba(201, 203, 207, 1)"
    );

    // Load data awal (tahun default)
    updateCharts(yearSelect.value);
});
