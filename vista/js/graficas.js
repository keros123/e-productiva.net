

const MostrarDatos = ()=>{
    let data = {"listarSeguimientos":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatoSeguimientos();
}

MostrarDatos();


const MostrarRealizados = ()=>{
    let data = {"listarRealizados":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosRealizados();
}

MostrarRealizados();

const MostrarPendientes = ()=>{
    let data = {"listarPendientes":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosPendientes();
}

MostrarPendientes();

const MostrarAsignados = ()=>{
    let data = {"listarAsignados":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosAsignados();
}

MostrarAsignados();


const MostrarTotal= ()=>{
    let data = {"listarTotal":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosTotal();
}

MostrarTotal();

const MostrarVencidos= ()=>{
    let data = {"listarVencidos":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosVencidos();
}

MostrarVencidos();

const MostrarCertificacion= ()=>{
    let data = {"ListarCertificacion":"ok"};
    let objUsuario = new Seguimiento(data);
    objUsuario.DatosVencidos();
}

MostrarCertificacion();