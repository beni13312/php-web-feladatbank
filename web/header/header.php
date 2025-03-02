<div id="header">
    <script src="public/script/nav.js"></script>
    <nav id="navbar">
        <div id="nav-left">
            <h2 id="nav-title">Informatikai Feladat gyűjtemény</h2>
        </div>
        <div id="nav-right">
            <div class="nav-d" id="nav-info">Információ</div>

        </div>
    </nav>
</div>
<script>
    function updateTitle() {
        const titleElement = document.getElementById("nav-title");
        if (window.innerWidth < 512) {
            titleElement.textContent = "INFOGY";
        } else {
            titleElement.textContent = "Informatikai Feladat gyűjtemény";
        }
    }

    document.addEventListener("DOMContentLoaded", updateTitle);

    window.addEventListener("resize", updateTitle);

</script>