const iconNav = document.getElementById("icon-nav");
const menuList = document.getElementById("menu-list");

iconNav.addEventListener("click", () => {
    menuList.classList.toggle("hidden");
});

function togglePopup(popupId) {
    document.getElementById(popupId).classList.toggle("active");
}

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
