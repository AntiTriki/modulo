<?php
 include_once('preloader.html');
 include_once('bar.php');
include_once('conexion.php');
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producto de la empresa</title>
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap-select.min.css">


    <style media="screen">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
  <div class="canvas">
        <div class="container">

  <section id="prove-product-cat-config">
         <div class="container">
             <div class="page-footer">
               <h1>Panel de productos </h1>
             </div>
             <!-- Nav tabs -->
             <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
               <li role="presentation"><a href="#Catalogo" role="tab" data-toggle="tab">Catalogo</a></li>

             </ul>
             <div class="tab-content">
                 <!--==============================Panel productos===============================-->
                 <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                 <div class="row">


            <div class="text">
                <h2>  Agregar producto</h2>

            </div>
            <br>

            <div class="col-sm-12">
            <form class="form-horizontal" role="form" method="post" action="productoregister.php" enctype="multipart/form-data">
              <div class="container">
                <div class="row row-centered">
                  <div class="col-sm-5">
           				</div>
                    <div class="col-sm-3 col-lg-3 col-centered">
                        <!-- <div class="form-group">
                <label for="input6" class="col-md-4 control-label">123456789012:</label>
                <div class="col-md-8">
                <input type="text" class="form-control" id="input6" placeholder="input 6">
              </div>
            </div> -->
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                            <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                <input type="file" name="imagen" id="imagen">
                              </span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>

                        </div>
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="descripcion" class="col-md-4 control-label">Descripción:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="stock" class="col-md-4 control-label">Stock:</label>
                            <div class="col-md-8">
                                <input type="number" min="0" step="1" class="form-control" id="stock" name="stock" placeholder="Stock">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="precio" class="col-md-4 control-label">Precio:</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="precio" name="precio" min="0" step=".01" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Categoria:</label>
                            <div class="col-md-8">
                                <select title="Seleccione..." class="form-control selectpicker show-menu-arrow show-tick" data-size="5" data-dropup-auto="false" id="categoria" name="categoria" >

                                  <?php
                                  $cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
                                  $cxn->set_charset("utf8");
    $result = $cxn->query("SELECT
      id, nombre
      FROM categoria_producto
      WHERE  sub_categoria IS NULL ORDER BY nombre ASC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
        }
    }
    $cxn->close();
    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="subcategoria" class="col-md-4 control-label">Subcategoria:</label>
                            <div id="cat" class="col-md-8">
                                  <select title="Fije subcategoria" class="form-control selectpicker show-menu-arrow show-tick" data-size="5" data-dropup-auto="false" id="subcategoria" name="subcategoria" >
                                  </select>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row this actually does not appear to be needed with the form-horizontal -->
                <div class="pull-right">
                <button type="submit" class="btn btn-success"> Ingresar</button>
                <br>
                <br>
                <br>
              </div>
            </form>

</div>
        </div>

                           </div>
<div role="tabpanel" class="tab-pane fade" id="Catalogo">
  <div class="container">
    <div class="text">
        <h2>  Catalogo</h2>

    </div>
    <br>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
<thead>
  <tr>
  <th>#</th>
  
  <th>Nombre</th>
  <th>Descripcion</th>
  <th>Stock</th>
  <th>Precio</th>
  <th>Publicado en:</th>
<th>Acciones</th>
</tr>
</thead>
<?php
$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$query_user = sprintf('SELECT * FROM producto where valido = 1');
// mysqli_query("SET NAMES 'UTF8'");
$cxn->set_charset("utf8");
$result_user = mysqli_query($cxn,$query_user) or die("Error usuario:".mysqli_error($cxn));
$i=0;
              while($productos = mysqli_fetch_array($result_user)){
                $i++;
                echo'<tr id="'.$i.'">
                <td>'.$i.'</td>

                <td>'.$productos['nombre'].'</td>
                <td>'.$productos['descripcion'].'</td>
                <td>'.$productos['stock'].'</td>
                <td>'.$productos['precio'].'</td>
                <td>'.$productos['fecha_publicacion'].'</td>
                <td>
                <a href="productomodificar.php?id='.$productos['id'].'" ><button value="'.$i.'" class="btn btn-warning edit" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span></button></a>
                &nbsp;
                <button  id="'.$productos['id'].'" class="btn btn-danger delete "><span id="'.$productos['id'].'" class="glyphicon glyphicon-remove "></span></button>
                </td>



                </tr>';



};
                ?>
</table>
</div>

  </div>
</div>

                         </div>
                         </div>









<script language="javascript">
    $(document).ready(function(){
       $("#categoria").change(function () {
               $("#categoria option:selected").each(function () {
                id = $(this).val();
                $.post("ajax_categoriaproducto.php", { id: id }, function(data){
                    $("#subcategoria").html(data).selectpicker('refresh');


                });
            });
       })
    });
    $(document).ready(function(){

      // Delete
      $('.delete').click(function(){
          var el = this;
          var id = this.id;


          // Delete id
          var deleteid = id;

          // AJAX Request
          $.ajax({
              url: 'eliminarproductolista.php',
              type: 'POST',
              data: { id:id } ,
              success: function(response){

                  // Removing row from HTML Table
                  $(el).closest('tr').css('background','tomato');
                  $(el).closest('tr').fadeOut(800, function(){
                      $(this).remove();
                  });
              }
          });
      });
    });




    </script>
    <!-- <script src="js/bootstrap.min.js" charset="utf-8"></script> -->
    <script src="js/bootstrap-select.min.js" charset="utf-8"></script>
  <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
</body>
</html>
