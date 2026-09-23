<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Aprendiz Sena! 🎉</h5>
                                <p class="mb-4">
                                    Estimado(a) aprendiz,
                                    <br>
                                    Le informamos que su proceso de certificación inició el día
                                    <?php echo $_SESSION["objCertificacion"]["fecha_certificacion"]; ?> El
                                    certificado estará disponible en la plataforma Sofia Plus dentro de un plazo de 15 a
                                    20 días hábiles.
                                    <br>
                                    Le invitamos a ingresar regularmente a Sofia Plus para revisar el estado de su
                                    certificación. En caso de requerir asistencia, puede contactarnos a través de los
                                    canales oficiales.
                                </p>

                                <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="assets/img/interface/clase-virtual.png" height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="row p-2">
                        <div class="col-md-5  text-center p-2" style="border-right: 2px solid #394859 ">
                            <img src="<?php echo $_SESSION["foto"]; ?>" alt="user-avatar"
                                class="d-block rounded mx-auto" height="200" width="200">
                            <div class="row mt-2">
                                <h4>
                                    <?php echo $_SESSION["nombreUsuario"]; ?>
                                </h4>;
                            </div>
                        </div>
                        <div class="col-md-7 aling-items-center p-2">
                            <div class="row mt-2 px-1" style="justify-content:center;">
                                <div class="col-md-12 p-3">
                                    <h5 class="mb-2" style="font-weight:bold">Información personal</h5>
                                    <ul class="mb-1">
                                        <li>
                                            <h6 style="word-wrap: break-word;">Documento : <?php echo $_SESSION["documento"]; ?></h6>
                                        </li>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Email : <?php echo $_SESSION["objCertificacion"]["email"]; ?></h6>
                                        </li>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Telefono : <?php echo $_SESSION["objCertificacion"]["telefono"]; ?></h6>
                                        </li>
                                    </ul>
                                    <h5 class="mt-2 mb-2" style="font-weight:bold">Información certificación</h5>
                                    <ul>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Ficha : <?php echo $_SESSION["objCertificacion"]["numero_ficha"]."-".$_SESSION["objCertificacion"]["caracterizacion"]; ?></h6>
                                        </li>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Modalidad : <?php echo $_SESSION["objCertificacion"]["modalidad"]; ?></h6>
                                        </li>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Fin practica : <?php echo $_SESSION["objCertificacion"]["fin_practica"] ?></h6>
                                        </li>
                                        <li>
                                            <h6 style="word-wrap: break-word;">Fecha certificación : <?php echo $_SESSION["objCertificacion"]["fecha_certificacion"]; ?></h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>