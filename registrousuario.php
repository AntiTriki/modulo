<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>

</head>
<body>
  <div class="container-fluid">
      <div class="text-center">
          <h1>PRODUCTO</h1>

      </div>
      <form class="form-horizontal" role="form" method="post" action="productoregister.php" enctype="multipart/form-data">
        <div class="container">
          <div class="row row-centered">
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
          <div class="row">
              <div class="col-sm-6 col-lg-4">
                  <div class="form-group">
                      <label for="nombre" class="col-md-4 control-label">Nombre:</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                  <div class="form-group">
                      <label for="descripcion" class="col-md-4 control-label">Descripción:</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                  <div class="form-group">
                      <label for="stock" class="col-md-4 control-label">Stock:</label>
                      <div class="col-md-8">
                          <input type="number" min="0" step="1" class="form-control" id="stock" name="stock" placeholder="Stock">
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                  <div class="form-group">
                      <label for="precio" class="col-md-4 control-label">Precio:</label>
                      <div class="col-md-8">
                          <input type="number" class="form-control" id="precio" name="precio" min="0" step=".01" placeholder="0.00">
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-lg-4">
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
              <div class="col-sm-6 col-lg-4">
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
          <button type="submit" class="btn btn-success"> Ingresar</button>
      </form>
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
      </script>
</body>
</html>
