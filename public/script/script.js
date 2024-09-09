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
        const caret = toggle.querySelector(".fa-caret-down"); // Caret Icon
        const dropdownLink = toggle.querySelector("a"); // Link

        // Klik pada link atau caret untuk toggle dropdown
        [caret, dropdownLink].forEach((element) => {
            element.addEventListener("click", function (event) {
                event.preventDefault(); // Mencegah navigasi

                const dropdownContent =
                    toggle.querySelector(".dropdown-content"); // Dropdown content

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
                    document
                        .querySelectorAll(".fa-caret-down")
                        .forEach((icon) => {
                            icon.classList.remove("active"); // Hapus animasi dari caret lain
                        });

                    // Buka dropdown yang diklik
                    dropdownContent.style.display = "block";
                    caret.classList.add("active"); // Tambah class 'active' untuk animasi caret
                }
            });
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

    if (selectedRole !== "null") {
        roleTitle.innerText = selectedRole.toUpperCase();
        formContainer.style.display = "block";
        formContainer.scrollIntoView({ behavior: "smooth" });

        formContainer.action = `/admin/add/${selectedRole}`;
        document.getElementById("hidden-role").value = selectedRole;
    } else {
        formContainer.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Hide the form initially
    document.getElementById("form-container").style.display = "none";
});

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
        // Jika form tidak valid, tampilkan peringatan dan hentikan proses
        Swal.fire({
            title: "Error!",
            text: "Pastikan semua field sudah diisi dengan benar.",
            icon: "error",
            confirmButtonText: "OK",
        });
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
                footer: '<a href="#">Pergi ke Email?</a>',
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
