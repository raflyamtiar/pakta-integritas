@extends('layouts.user')

@section('title', 'FAQ')

@section('content')

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
<script src="{{ asset('script/script.js') }}"></script>
<script>
window.addEventListener("load", function () {
    var loader = document.getElementById("loader");
    loader.style.display = "none"; // Sembunyikan loader setelah halaman dimuat
});
</script>

@endsection
