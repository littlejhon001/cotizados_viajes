</div class="h-25">
<div class="container-fluid bg-dark text-white text-center p-3">
    <p id="footer-text"></p>
    <p>GRUPO GREMS SAS
        NIT 901.867.890-9
        Dirección: CRA 9 este 1A 56 📍
        <br>
        <a href="https://wa.me/573115966555">WhatsApp</a>
        <br>
        📱 Tel: 3115966555-3213130355
    </p>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    var year = new Date().getFullYear();
    document.getElementById("footer-text").innerText = "© Transdorado " + year + " Todos los derechos reservados";


    flashdata = <?php echo json_encode($this->session->flashdata()) ?>;
    if (!Array.isArray(flashdata)) {
        if (flashdata.success == true) {
            Swal.fire({
                toast: true,
                position: "top-end",
                timer: 5000,
                timerProgressBar: true,
                title: flashdata.message,
                icon: "success",
                showConfirmButton: false,
            })
        } else {
            Swal.fire({
                toast: true,
                position: "top-end",
                timer: 3000,
                timerProgressBar: true,
                title: flashdata.message,
                icon: "error",
                showConfirmButton: false,
            })
        }
    }
</script>

</html>