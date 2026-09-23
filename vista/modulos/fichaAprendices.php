<?php
    require ('vendor/autoload.php');
    use Encryption\Encryption;
    $url = explode("?m~",$_SERVER["REQUEST_URI"]);
    $idFicha = "";
    $ficha = "";
    $caracterizacion = "";
    try {
        $objEncriptacion = Encryption::getEncryptionObject();
        $idFicha = $objEncriptacion->decrypt($url[1], $_SESSION["key"], $_SESSION["iv"]);
        $ficha = $objEncriptacion->decrypt($url[2], $_SESSION["key"], $_SESSION["iv"]);
        $caracterizacion = $objEncriptacion->decrypt($url[3], $_SESSION["key"], $_SESSION["iv"]);
    } catch (Exception $e) {
        echo '<script>window.location = "404";</script>';
    }
?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo / <a href="fichas">Fichas</a> /</span> <?php echo $ficha." - ".$caracterizacion;?>
    </h4>

    <div class="row fichaAprendices">
        <div class="col-md-12">
            
            <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
                <?php
                    if ($_SESSION["tipoUsuario"] != 6) {
                ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link active" href="javascript:void(0);" id="agregarAprendiz"><i class="bx bx-user-plus me-1"></i> Agregar Aprendiz</a>
                    </li>
                    <li id="contenedorBtnSubirArchivo" class="nav-item mb-2">
                        <div class="button-wrapper mc-pading">
                            <label for="btn_excel" class="btn btn-secondary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block"><i class='bx bxs-file-doc'></i> Subir Archivo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="btn_excel" ficha="<?php echo $ficha;?>" fichaId="<?php echo $idFicha;?>" class="account-file-input" hidden accept=".xlsx, .xls, .csv" />
                            </label>
                        </div>
                    </li>
                <?php
                    }else{
                ?>
                    <li id="contenedorBtnSubirArchivo" class="nav-item" style="display:none;">
                        <div class="button-wrapper mc-pading">
                            <label for="btn_excel" class="btn btn-secondary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block"><i class='bx bxs-file-doc'></i> Subir Archivo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="btn_excel" ficha="<?php echo $ficha;?>" fichaId="<?php echo $idFicha;?>" class="account-file-input" hidden accept=".xlsx, .xls, .csv" />
                            </label>
                        </div>
                    </li>
                <?php 
                    }
                ?>
                
                
            </ul>

            <!-- FORMULARIO -->
            <?php 
                include_once "formularioAgregarAprendiz.php";
                include_once "formularioEditarAprendiz.php";
            ?>

            <div class="card" id="card-tablaAprendices">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaAprendizFichaSeleccionada" class="table table-hover align-middle table table-sm border-top"
                            style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center">Documento</th>
                                    <th class="text-nowrap text-center">Nombres</th>
                                    <th class="text-nowrap text-center">Apellidos</th>
                                    <th class="text-nowrap text-center">Celular</th>
                                    <th class="text-nowrap text-center">Email</th>
                                    <th class="text-nowrap text-center">Estado</th>
                                    <th class="text-nowrap text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-grid gap-2 d-md-block">
                        <button type="button" class="btn btn-dark" onclick="window.location.href = 'fichas';">Regresar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "detallesAprendiz.php" ?>
</div>

<div id="contenedorLoader" style="display: none;">
    <?php include_once "loader.html";?>
</div>

