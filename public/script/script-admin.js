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

const dropdowns = document.querySelectorAll(".dropdown-admin");
dropdowns.forEach((dropdown) => {
    const select = dropdown.querySelector(".select-admin");
    const caret = dropdown.querySelector(".caret");
    const menu = dropdown.querySelector(".menu-admin");
    const options = dropdown.querySelectorAll(".menu-admin li");
    const selected = dropdown.querySelector(".selected");

    select.addEventListener("click", () => {
        select.classList.toggle("select-admin-clicked");
        caret.classList.toggle("caret-rotate");
        menu.classList.toggle("menu-admin-open");
    });

    options.forEach((option) => {
        option.addEventListener("click", () => {
            selected.innerText = option.innerText;
            // Menutup dropdown setelah item dipilih
            select.classList.remove("select-admin-clicked");
            caret.classList.remove("caret-rotate");
            menu.classList.remove("menu-admin-open");

            // Mengatur item yang aktif
            options.forEach((option) => {
                option.classList.remove("active");
            });
            option.classList.add("active");
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const noWhatsappInput = document.getElementById("no_whatsapp");

    // Event listener saat pengguna mengetik pada input
    noWhatsappInput.addEventListener("input", function (e) {
        // Hapus angka 0 di depan jika ada
        if (this.value.startsWith("0")) {
            this.value = this.value.substring(1);
        }
    });

    // Event listener saat pengguna submit form
    document.querySelector("form").addEventListener("submit", function (e) {
        // Pastikan input tidak kosong dan memenuhi kriteria
        if (!noWhatsappInput.value.match(/^\d{8,14}$/)) {
            alert(
                "Nomor WhatsApp harus terdiri dari 8 hingga 14 digit dan tidak boleh diawali dengan angka 0."
            );
            e.preventDefault();
        }
    });
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

        // Sembunyikan hint password
        document.getElementById("passwordHint").style.display = "none";
    } else {
        form.style.display = "none";
        button.textContent = "Tambah User Baru";
    }
}

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

// Tutup dropdown ketika klik di luar area dropdown
document.addEventListener("click", function (event) {
    const dropdownContent = document.getElementById("dropdownContent");
    const adminDropdown = document.getElementById("adminDropdown");
    const caretIcon = document.getElementById("caretIcon");

    if (
        !adminDropdown.contains(event.target) &&
        !dropdownContent.contains(event.target)
    ) {
        dropdownContent.style.display = "none";
        caretIcon.classList.remove("rotate-icon"); // Kembalikan ikon ke posisi semula jika dropdown tertutup
    }
});
