
    <footer>
        <p><span id="derechos">Copyright &#169; Todos los derechos reservados |</span> The Article Creativity</p>
    </footer>
</body>
<script>
    
    const movimientoi = document.querySelector(".movimientoi");
    const movimientoT = document.querySelector(".movimientoT");
    const selectorCambioColor = document.querySelector(".cambioTamanio");

    const letrasi = document.querySelectorAll(".letrai");
    const letrasT = document.querySelectorAll(".letraT");
    const titulo = document.querySelector(".titulo");

    movimientoi.addEventListener("mouseover", () => {
        letrasi.forEach(letra => letra.classList.add("accion"));
    });

    movimientoi.addEventListener("mouseout", () => {
        letrasi.forEach(letra => letra.classList.remove("accion"));
    });

    movimientoT.addEventListener("mouseover", () => {
        letrasT.forEach(letra => letra.classList.add("accion"));
    });

    movimientoT.addEventListener("mouseout", () => {
        letrasT.forEach(letra => letra.classList.remove("accion"));
    });

    selectorCambioColor.addEventListener("mouseover", () => {
        titulo.classList.add("cambiarTamanio");
    });

    selectorCambioColor.addEventListener("mouseout", () => {
        titulo.classList.remove("cambiarTamanio");
    });


</script>
</html>