<?php
include_once('bar.php');

include_once('conexion.php');
date_default_timezone_set('America/La_Paz');


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Plan de Cuentas</title>

    <style>

        button, input, optgroup, select, textarea {

            color: #000000;
        }
    </style>
    <style media="screen">
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        body {
  margin: 30px;
  font-family: sans-serif;
  }

#fontSizeWrapper { font-size: 16px; }

#fontSize {
  width: 100px;
  font-size: 1em;
  }

/* ————————————————————–
  Tree core styles
*/
.tree { margin: 1em; }

.tree input {
  position: absolute;
  clip: rect(0, 0, 0, 0);
  }

.tree input ~ ul { display: none; }

.tree input:checked ~ ul { display: block; }

/* ————————————————————–
  Tree rows
*/
.tree li {
  line-height: 1.2;
  position: relative;
  padding: 0 0 1em 1em;
  }

.tree ul li { padding: 1em 0 0 1em; }

.tree > li:last-child { padding-bottom: 0; }

/* ————————————————————–
  Tree labels
*/
.tree_label {
  position: relative;
  display: inline-block;
  background: #fff;
  }

label.tree_label { cursor: pointer; }

label.tree_label:hover { color: #666; }

/* ————————————————————–
  Tree expanded icon
*/
label.tree_label:before {
  background: #000;
  color: #fff;
  position: relative;
  z-index: 1;
  float: left;
  margin: 0 1em 0 -2em;
  width: 1em;
  height: 1em;
  border-radius: 1em;
  content: '+';
  text-align: center;
  line-height: .9em;
  }

:checked ~ label.tree_label:before { content: '–'; }

/* ————————————————————–
  Tree branches
*/
.tree li:before {
  position: absolute;
  top: 0;
  bottom: 0;
  left: -.5em;
  display: block;
  width: 0;
  border-left: 1px solid #777;
  content: "";
  }

.tree_label:after {
  position: absolute;
  top: 0;
  left: -1.5em;
  display: block;
  height: 0.5em;
  width: 1em;
  border-bottom: 1px solid #777;
  border-left: 1px solid #777;
  border-radius: 0 0 0 .3em;
  content: '';
  }

label.tree_label:after { border-bottom: 0; }

:checked ~ label.tree_label:after {
  border-radius: 0 .3em 0 0;
  border-top: 1px solid #777;
  border-right: 1px solid #777;
  border-bottom: 0;
  border-left: 0;
  bottom: 0;
  top: 0.5em;
  height: auto;
  }

.tree li:last-child:before {
  height: 1em;
  bottom: auto;
  }

.tree > li:last-child:before { display: none; }

.tree_custom {
  display: block;
  background: #eee;
  padding: 1em;
  border-radius: 0.3em;
}
    </style>
    <script type="text/javascript">
    function isNumber(n) {
return !isNaN(parseFloat(n)) && isFinite(n);
}

function setFontSize(el) {
  var fontSize = el.val();

  if ( isNumber(fontSize) && fontSize >= 0.5 ) {
    $('body').css({ fontSize: fontSize + 'em' });
  } else if ( fontSize ) {
    el.val('1');
    $('body').css({ fontSize: '1em' });
  }
}

$(function() {

$('#fontSize')
  .bind('change', function(){ setFontSize($(this)); })
  .bind('keyup', function(e){
    if (e.keyCode == 27) {
      $(this).val('1');
      $('body').css({ fontSize: '1em' });
    } else {
      setFontSize($(this));
    }
  });

$(window)
  .bind('keyup', function(e){
    if (e.keyCode == 27) {
      $('#fontSize').val('1');
      $('body').css({ fontSize: '1em' });
    }
  });

});


    </script>
      <script>
          $(function () {

              $('form').on('submit', function (e) {

                  e.preventDefault();

                  $.ajax({
                      type: 'post',
                      url: 'cuentaabm.php',
                      data: $('form').serialize(),
                      success: function () {

                      }
                  });

              });

          });
      </script>
      <link rel="stylesheet" href="css/style.min.css">
      <script type="text/javascript" src="js/jstree.min.js"></script>
  </head>
 <body>
   <div class="container" style="padding-left:200px;">
       <div><h3>Plan de Cuentas</h3></div>
      <?php if(isset($_SESSION['id_emp']))
       { ?>


       <div id="tree-container" ></div>
 <?php } else{ ?>


<?php }?>




   <script>
       $(function () {

           var data = [
               { "id" : "0", "parent" : "#", "text" : "Cuentas Contables" },
           ];
           ;
           var listah;
           var route = 'lista.php'
           $.ajax({
               url :  route,
               type: 'GET',
               success : function(data){
                   data = JSON.parse(data);
                   if ((data.errors)) {
                       alert('Oops!  ocurre un error en la respuesta con el sistema');
                   }
                   else {
                       listah = data;

                       agregar();
                   }

               },
               error: function(e) {
                   alert('Error'+e.responseText);
               }
           });
           function agregar(){
               $.each(listah,function(index,element){

                   data.push({"id" : ""+element.id, "parent" : ""+element.id_tipocuenta, "text" : ""+element.id+" - "+element.text });

               });
               $("#tree-container").jstree({
                   "core" : {
                       // so that create works
                       "check_callback" : true,

                       "data": data
                   }

               }).on('create_node.jstree', function(e, data) {
                   console.log('saved');
               });



           }





       });
       function traerlistas() {


           var route = 'lista.php';
           var type = 'GET';
           $.ajax({
               url :  route,
               type: type,
               success : function(data){
                   data = JSON.parse(data);
                   if ((data.errors)) {
                       alert('Oops!  ocurre un error en la respuesta con el sistema');
                   }
                   else {
                       listaCuentas = data;
                       if(listaCuentas.length == 0)
                       {
                           obtenerPadre();
                       }else {
                           CrearCuenta();
                       }
                   }

               },
               error: function(e) {
                   alert('Error'+e.responseText);
               }
           });
       }
       function obtenerPadre() {

           var route = 'lista.php';
           var type = 'GET';
           $.ajax({
               url :  route,
               type: type,
               success : function(data){
                   data = JSON.parse(data);
                   if ((data.errors)) {
                       alert('Oops!  ocurre un error en la respuesta con el sistema');
                   }
                   else {
                       datoPadre = data;
                       $.each(datoPadre,function (index, elemento) {
                           elemento.nivel =elemento.nivel+1;
                           elemento.id_tipocuenta=elemento.id;
                       });
                       listaCuentas = datoPadre;
                       CrearCuenta();


                   }

               },
               error: function(e) {
                   alert('Error'+e.responseText);
               }
           });

       }
       function CrearCuenta() {
           $.each(listaCuentas,function (index, elemento) {
               ultimo =elemento;
           });
           var nivelEmpresa = $('#NivelEmpresa').val();
           var nivel ;
           if(ultimo == null){
               nuevaCuenta();
               nivel = 1;
           }
           else {
               nivel = ultimo.nivel;


               if (nivel <= nivelEmpresa) {


                   var id = "" + ultimo.codigo;
                   if (ultimo.nivel == 1) {
                       id = id.substring(0, 1);
                       var complement = (ultimo.codigo.toString()).substring(1)
                       id = parseInt(id);
                       id = id + 1;
                       id = id + "" + complement

                   }
                   if (ultimo.nivel == 2) {
                       id = id.toString().substring(2, 4);
                       var complement = (ultimo.codigo.toString()).substring(0, 2)
                       var complement2 = (ultimo.codigo.toString()).substring(4)
                       id = parseInt(id);
                       //1.00.00.00.00.00.00.00.00

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   if (ultimo.nivel == 3) {
                       id = id.toString().substring(5, 7);
                       var complement = (ultimo.codigo.toString()).substring(0, 5)
                       var complement2 = (ultimo.codigo.toString()).substring(7)
                       id = parseInt(id);

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   if (ultimo.nivel == 4) {
                       id = id.toString().substring(8, 10);
                       var complement = (ultimo.codigo.toString()).substring(0, 8)
                       var complement2 = (ultimo.codigo.toString()).substring(10)
                       id = parseInt(id);

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   if (ultimo.nivel == 5) {
                       id = id.toString().substring(11, 13);
                       var complement = (ultimo.codigo.toString()).substring(0, 11)
                       var complement2 = (ultimo.codigo.toString()).substring(13)
                       id = parseInt(id);

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   if (ultimo.nivel == 6) {
                       id = id.toString().substring(14, 16);
                       var complement = (ultimo.codigo.toString()).substring(0, 14)
                       var complement2 = (ultimo.codigo.toString()).substring(16)
                       id = parseInt(id);

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   if (ultimo.nivel == 7) {
                       id = id.toString().substring(17, 19);
                       var complement = (ultimo.codigo.toString()).substring(0, 17)
                       var complement2 = (ultimo.codigo.toString()).substring(19)
                       id = parseInt(id);

                       id = id + 1;
                       if (id <= 9) {
                           id = "0" + id;
                       }
                       id = complement + "" + id + "" + complement2
                   }
                   $('#CodCuenta').val('' + id);

                   $('#codNivel').val(ultimo.nivel);


                   $('#ModalCuenta').modal('show');
               }
               else {
                   setTimeout(function () {

                       toastr.error('No puede crear mas niveles, esta en su limite', 'Error Alert', {timeOut: 5000});
                   }, 500);

               }
           }
       }
   </script>
 </body>

</html>
