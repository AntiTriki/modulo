<?php
include_once('conexion.php');
?>
<div class="container" style="padding-left:150px;">
    <div><h3>Plan de Cuentas</h3></div>

    <div class="btn-group-horizontal" style="position: relative;">
        <!--         <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>-->
        <!--         <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>-->
        <!--         <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>-->
        <button type="button" class="btn btn-" data-toggle="modal" data-target="#crea_com"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
        <button type="button" class="btn btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
    </div>
    <div style="position: relative;" class="borde">
        <form id="static" class="" role="form" method="post" action="productoregister.php" enctype="multipart/form-data">
            <div class="container">
                <div class="row row-centered">
                    <div class="col-sm-3 col-lg-3 col-centered">
                        <!-- <div class="form-group">
                <label for="input6" class="col-md-4 control-label">123456789012:</label>
                <div class="col-md-8">
                <input type="text" class="form-control" id="input6" placeholder="input 6">
              </div>
            </div> -->

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-lg-2">
                    <div class="form-group">
                        <label for="nivel">Nivel:</label>
                        <select  class="form-control selectpicker show-menu-arrow show-tick" data-size="5" data-dropup-auto="false" id="nivel" name="nivel" placeholder="Nivel" >

                            <?php

                            $cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
                            $cxn->set_charset("utf8");
                            $result = $cxn->query("SELECT
                                                                                               nivel
                                                                                              FROM empresa
                                                                                              WHERE id=". $_SESSION["id_emp"]." ");
                            $row = $result->fetch_assoc();
                            $i=1;
                            for ($i;$i<=$row['nivel'];$i++) {

                                echo '<option value="'.$i.'">'.$i.'</option>';

                            }
                            $cxn->close();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-lg-6">
                    <div class="form-group">
                        <label for="text">Cuenta:</label>
                        <input disabled type="text" class="form-control" id="text">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-2 col-lg-12">
                    <div class="form-group">
                        <label for="id_tipocuenta">Cuenta Padre:</label>
                        <select title="Fije Cuenta Padre" class="form-control selectpicker show-menu-arrow show-tick" data-size="5" data-dropup-auto="false" id="id_tipocuenta" name="id_tipocuenta" >
                        </select>

                    </div>
                </div>

            </div>


            <!-- /.row this actually does not appear to be needed with the form-horizontal -->

        </form>
    </div>




</div>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" charset="utf-8"></script>
<script src="js/bootstrap-select.min.js" charset="utf-8"></script>