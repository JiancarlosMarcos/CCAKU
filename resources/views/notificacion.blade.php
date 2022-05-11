@if (session('mensaje') && session('tipo'))
    <div class="notification is-{{ session('tipo') }}" id="notificacion" style="display:flex;background:#ffb21b99;
    padding:16px;border-radius:9px;
    color:#353232;font-weight:600">
        {{ session('mensaje') }} <a style="cursor: pointer;background:#transparent;margin-left:auto"
            onclick="borrar_notificacion();">x</a>
    </div>
    <br>
    @if (session('id_cotizacion'))
        <meta http-equiv="refresh"
            content="5;url='../cotizaciones/clientes/descargar/{{ session('id_cotizacion') }}'">
    @endif
    @if (session('id_cotizacion_editar'))
        <meta http-equiv="refresh"
            content="5;url='../../cotizaciones/clientes/descargar/{{ session('id_cotizacion_editar') }}'">
    @endif


@endif

<script>
    function borrar_notificacion() {
        document.getElementById("notificacion").style.display = "none";
    }

    function borrar_notificacion2() {
        document.getElementById("notificacion2").style.display = "none";
    }
</script>
