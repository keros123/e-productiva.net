(()=>{

    const cargarConsolidadoVencidos = ()=>{
        let objData = {"cargarConsolidadoVencidos":"ok"}
        let objConsolidado = new Informes(objData);
        objConsolidado.ConsolidadoSeguimientosVencidos();
    }

    cargarConsolidadoVencidos();


    const cargarConsolidadoCompleto = ()=>{
        let objData = {"cargarConsolidadoCompleto": "ok"};
        let objConsolidadoCompleto = new Informes(objData);
        objConsolidadoCompleto.ConsolidadoSeguimeintosCompletos();
    }

    cargarConsolidadoCompleto();

    
    // Escuchar cuando se expande una fila
    $("#tabla_informeSeguimientosVencidos").on("responsive-display.dt", function () {
        setTimeout(() => {
            $("#tabla_informeSeguimientosVencidos tbody tr td.child").css("font-size", "12.5px");
        }, 10); // Agregamos un pequeño retraso para asegurar que DataTables termine de renderizar
    });


    // Escuchar cuando se expande una fila
    $("#tabla_informeSeguimientosCompletos").on("responsive-display.dt", function () {
        setTimeout(() => {
            $("#tabla_informeSeguimientosCompletos tbody tr td.child").css("font-size", "12.5px");
        }, 10); // Agregamos un pequeño retraso para asegurar que DataTables termine de renderizar
    });

})()