<?php include_once "tablaLineaRedTecnologica.php"; ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Fichas
    </h4>

    <div class="row">
        <div class="col-md-12">
            <?php
                if ($_SESSION["tipoUsuario"] != 6) {
            ?>
                <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active btn_agregarFicha" href="javascript:void(0);"><i class="bx bx-box me-1"></i> Agregar Ficha</a>
                    </li>
                </ul>
            <?php
                }
            ?>
            <div class="card card_agregarFicha" style="display: none;">
                <div class="card-body">
                    <form id="formAgregarFicha" class="needs-validated" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-2">
                                <label class="form-label" for="txt-Ficha">FICHA</label>
                                <input type="text" id="txt-Ficha" class="form-control phone-mask" placeholder="Numero de Ficha" aria-label="Numero de Ficha" aria-describedby="txt-Ficha" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el número de la ficha.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="txt-Caracterizacion" class="form-label">CARACTERIZACIÓN</label>
                                <input type="text" id="txt-Caracterizacion" class="form-control phone-mask" placeholder="Caracterizacón" aria-label="Caracterizacón" aria-describedby="txt-Caracterizacion" required>
                                <div class="invalid-feedback">Por favor ingrese la caracterización.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>

                             <div class="mb-3 col-md-4">
                                <label class="form-label" for="txt-tipoPrograma">Tipo de Programa</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="txt-tipoPrograma" duracion="" idPrograma="" data-bs-toggle="modal" data-bs-target="#modalSelectTipoPrograma" class="form-control phone-mask " placeholder="Click para seleccionar un tipo de programa" aria-label="Click para seleccionar un tipo de programa" aria-describedby="txt-tipoPrograma" disabled="" required="">

                                    <span class="input-group-text cursor-pointer" id="txt-tipoPrograma_agregar_0" data-bs-toggle="modal" data-bs-target="#modalSelectTipoPrograma"><i class='bx bx-list-plus'></i></span>    
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione un tipo de programa.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="txt_linea_red_tecnologica">Línea y Red Tecnológica</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="txt_linea_red_tecnologica" idRedTecnologica="" data-bs-toggle="modal" data-bs-target="#modalSelectLineaRedTecnologica" class="form-control phone-mask " placeholder="Click para seleccionar línea y red tecnológica" aria-label="Click para seleccionar línea y red tecnológica" disabled="" required="">
                                    <span class="input-group-text cursor-pointer" id="txt_linea_red_tecnologica_0" data-bs-toggle="modal" data-bs-target="#modalSelectLineaRedTecnologica"><i class='bx bx-list-plus'></i></span>    
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione línea y red tecnológica.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaInicioFicha" class="form-label">FECHA INICIO</label>
                                <input type="date" id="txt-fechaInicioFicha" class="form-control phone-mask" aria-describedby="txt-fechaInicioFicha" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaFinLectiva" class="form-label">FECHA TERMINACIÓN LECTIVA</label>
                                <input type="date" id="txt-fechaFinLectiva" class="form-control phone-mask" aria-describedby="txt-fechaFinLectiva" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaFinPractica" class="form-label">FECHA TERMINACIÓN PRÁCTICA</label>
                                <input type="date" id="txt-fechaFinPractica" class="form-control phone-mask" aria-describedby="txt-fechaFinPractica" disabled="" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <?php include "selectEstadoFicha.php"; ?>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione el estado de la Ficha.</div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-dark btn_atras_agregarFicha">Regresar</button>
                            
                            <button type="submit" class="btn btn-primary" id="btn-agregarFicha"><i class="bx bx-box me-1"></i> Agregar</button>
                        </div>  
                    </form>
                </div>
            </div>

            <div class="card card_editarFicha" style="display: none;">
                <div class="card-body">
                    <form id="formEditarFicha" class="needs-validated" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-2">
                                <label class="form-label" for="txt-FichaEdit">FICHA</label>
                                <input type="text" id="txt-FichaEdit" class="form-control phone-mask" placeholder="Numero de Ficha" aria-label="Numero de Ficha" aria-describedby="txt-Ficha" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor el número de la ficha.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="txt-CaracterizacionEdit" class="form-label">CARACTERIZACIÓN</label>
                                <input type="text" id="txt-CaracterizacionEdit" class="form-control phone-mask" placeholder="Caracterizacón" aria-label="Caracterizacón" aria-describedby="txt-Caracterizacion" required>
                                <div class="invalid-feedback">Por favor ingrese la caracterización.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="txt-tipoProgramaEdit">Tipo de Programa</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="txt-tipoProgramaEdit" duracion="" idprograma="" data-bs-toggle="modal" data-bs-target="#modalSelectTipoPrograma" class="form-control phone-mask " placeholder="Click para seleccionar un tipo de programa" aria-label="Click para seleccionar un tipo de programa" aria-describedby="txt-tipoPrograma" disabled="" required="">

                                    <span class="input-group-text cursor-pointer" id="txt-tipoPrograma_editar_0" data-bs-toggle="modal" data-bs-target="#modalSelectTipoPrograma"><i class='bx bx-list-plus'></i></span>    
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione un tipo de programa.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="txt_linea_red_tecnologica_edit">Línea y Red Tecnológica</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="txt_linea_red_tecnologica_edit" idredTecnologica="" data-bs-toggle="modal" data-bs-target="#modalSelectLineaRedTecnologica" class="form-control phone-mask " placeholder="Click para seleccionar línea y red tecnológica" aria-label="Click para seleccionar línea y red tecnológica" disabled="" required="">
                                    <span class="input-group-text cursor-pointer" id="txt_linea_red_tecnologica_edit_0" data-bs-toggle="modal" data-bs-target="#modalSelectLineaRedTecnologica"><i class='bx bx-list-plus'></i></span>    
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione línea y red tecnológica.</div>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaInicioFichaEdit" class="form-label">FECHA INICIO</label>
                                <input type="date" id="txt-fechaInicioFichaEdit" class="form-control phone-mask" aria-describedby="txt-fechaInicioFichaEdit" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaFinLectivaEdit" class="form-label">FECHA TERMINACIÓN LECTIVA</label>
                                <input type="date" id="txt-fechaFinLectivaEdit" class="form-control phone-mask" aria-describedby="txt-fechaFinLectivaEdit" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="txt-" class="form-label">FECHA TERMINACIÓN PRÁCTICA</label>
                                <input type="date" id="txt-fechaFinPracticaEdit" class="form-control phone-mask" aria-describedby="txt-fechaFinPracticaEdit" disabled="" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="selectEstadoFichaEdit" class="form-label">Estado</label>
                                <select id="selectEstadoFichaEdit" class="form-select" aria-label="selectEstadoFicha" required>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor seleccione el estado de la Ficha.</div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-dark btn_atras_editarFicha">Regresar</button>

                            <button type="submit" class="btn btn-primary" id="btn-EditarFicha" ficha=""><i class="bx bx-box me-1"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card card_tablaFichas">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaFichas" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Ficha</th>
                                    <th class="text-nowrap text-center text-dark">Caracterización</th>
                                    <th class="text-nowrap text-center text-dark">Línea Tecnológica</th>
                                    <th class="text-nowrap text-center text-dark">Red Tecnológica</th>
                                    <th class="text-nowrap text-center text-dark">Inicio</th>
                                    <th class="text-nowrap text-center text-dark">Fin Lectiva</th>
                                    <th class="text-nowrap text-center text-dark">Fin Práctica</th>
                                    <th class="text-nowrap text-center text-dark">Estado</th>
                                    <th class="text-nowrap text-center text-dark">...</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalSelectTipoPrograma" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="">Seleccionar Tipo Programa</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablaSelectTipoPrograma"
                                    class="table table-hover border-top"
                                    style="width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <h5></h5>
                                            <th class="text-nowrap text-center text-dark">Tipo</th>
                                            <th class="text-nowrap text-center text-dark">Duración</th>
                                            <th class="text-nowrap text-center text-dark">Descripción</th>
                                            <th class="text-nowrap text-center text-dark">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>