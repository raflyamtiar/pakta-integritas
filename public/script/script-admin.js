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
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        let isValid = true;
        const fields = form.querySelectorAll(
            "input[required], textarea[required]"
        );

        fields.forEach(function (field) {
            if (!field.value.trim()) {
                isValid = false;
                field.setCustomValidity("Field ini wajib diisi.");
                field.reportValidity();
            } else {
                field.setCustomValidity("");
            }
        });

        if (!isValid) {
            e.preventDefault(); // Mencegah form dikirim jika ada kesalahan
        }
    });

    form.querySelectorAll("input[required], textarea[required]").forEach(
        function (input) {
            input.addEventListener("input", function () {
                this.setCustomValidity(""); // Menghapus pesan custom saat input mulai diisi
            });
        }
    );
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
