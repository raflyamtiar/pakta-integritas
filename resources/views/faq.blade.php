<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Chatbot</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('style/style_index.css') }}">

</head>
<body>
    <nav class="container-navbar">
        <a href="/">
            <div class="logo">
                <img src="assets/logo smi.png" alt="Logo Image" class="logo-img">
                <h3>SMI BPMSPH</h3>
            </div>
        </a>
        <div id="icon-nav" class="icon-nav">
            <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
        </div>
        <ul id="menu-list" class="hidden">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="/lapor" class="{{ request()->is('lapor') ? 'active' : '' }}">Lapor</a></li>
            <li class="dropdown">
                <div class="dropdown-i">
                    <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Pedoman dan Prosedur SMI</a>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/pedoman-smi">Pedoman
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/prosedur-smi">Prosedur
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/formulir-smi">Formulir
                            SMI</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/ikk-smi">IKK</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <div class="dropdown-i">
                    <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Agenda Sosialisasi PK</a>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-internal">Audit
                            Internal</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-eksternal">Audit
                            Eksternal</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <div class="dropdown-i">
                    <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Kebijakan dan Sasaran</a>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/kebijakan">Kebijakan</a>
                    </li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/sasaran">Sasaran</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/pedoman-dan-prosedur-mi">Pedoman
                            Prosedur & Formulir</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/struktur">Struktur</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <div class="dropdown-i">
                    <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Eviden</a>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <ul class="dropdown-content">
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-45001">Eviden 45001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-9001">Eviden 9001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/eviden-37001">Eviden 37001</a></li>
                    <li><a href="https://sites.google.com/view/smapbpmsph/eviden/manual-sni-iso">Manual SNI ISO</a></li>
                </ul>
            </li>
            </li>
            <li> <a href="/web" class="{{ request()->is('web') ? 'active' : '' }}">Web</a>
            </li>
            <li> <a href="/faq" class="{{ request()->is('faq') ? 'active' : '' }}">FAQ</a>
            </li>
        </ul>
    </nav>

    <div id="loader" class="loader-container">
        <div class="spinner"></div>
    </div>

    <div id="imageModal" class="modal">
        <div id="caption"></div>
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
<main>
    <div class="contentFAQ">
        <div class="faqHeader">
            <h2>Frequently Asked Question (FAQ) SMI BPMSPH</h2>
        </div>
        <div class="chatBox" id="chatBox">
            <ul class="chat-list">
                <!-- Pesan akan muncul di sini -->
            </ul>
        </div>
        <!-- Tombol Mulai -->
        <button id="startBtn" style="display: none;" onclick="showOptions()">Mulai</button>
    </div>

</main>

<script src="{{ asset('script/faq.js') }}"></script>
<script>
window.addEventListener("load", function () {
    var loader = document.getElementById("loader");
    loader.style.display = "none"; // Sembunyikan loader setelah halaman dimuat
});
</script>

</body>
</html>
