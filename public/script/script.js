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

// Tunggu hingga DOM selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
    const roleDropdown = document.getElementById("form-role");
    const tanggalAkhirWrapper = document.getElementById(
        "tanggal-akhir-wrapper"
    );
    const infoPegawai = document.getElementById("info-pegawai");

    // Fungsi untuk menampilkan atau menyembunyikan elemen berdasarkan role
    function updateForm() {
        const role = roleDropdown.value;

        if (role === "pegawai") {
            tanggalAkhirWrapper.style.display = "none"; // Sembunyikan tanggal akhir
            infoPegawai.style.display = "block"; // Tampilkan info khusus pegawai
        } else if (
            ["penyedia-jasa", "pengguna-jasa", "auditor"].includes(role)
        ) {
            tanggalAkhirWrapper.style.display = "block"; // Tampilkan tanggal akhir
            infoPegawai.style.display = "none"; // Sembunyikan info pegawai
        } else {
            tanggalAkhirWrapper.style.display = "none"; // Default sembunyikan tanggal akhir
            infoPegawai.style.display = "none"; // Default sembunyikan info pegawai
        }
    }

    // Tambahkan event listener ke dropdown
    roleDropdown.addEventListener("change", updateForm);
});

function showForm() {
    const selectedRole = document.getElementById("form-role").value;
    const formContainer = document.getElementById("form-container");
    const roleTitle = document.getElementById("role-title");

    if (selectedRole !== "null") {
        roleTitle.innerText = selectedRole.toUpperCase();
        formContainer.style.display = "block";
        formContainer.scrollIntoView({ behavior: "smooth" });

        // Periksa apakah pengguna berada di halaman admin atau user
        const isAdmin = window.location.pathname.includes("/admin");

        if (isAdmin) {
            formContainer.action = `/admin/add/${selectedRole}`;
        } else {
            formContainer.action = "user/integritas/store";
        }

        document.getElementById("hidden-role").value = selectedRole;
    } else {
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
