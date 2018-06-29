<?php
include_once('bar.php');

include_once('conexion.php');
date_default_timezone_set('America/La_Paz');
$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$result = mysql_query("SELECT * FROM empresa where  id=".$_SESSION['id_emp']." ;");
$row3 = mysql_fetch_array($result);
$_SESSION['nivel_empresa']=$row3['nivel'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Categoria de Articulo</title>

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
        .borde {
            border: 2px solid #a1a1a1;
            padding: 10px 40px;
            border-radius: 3px;
            width: 80%;

        }
        .tree > li:last-child:before { display: none; }

        .tree_custom {
            display: block;
            background: #eee;
            padding: 1em;
            border-radius: 0.3em;

        }
        .alertify-logs.right {
            right: 0;
            width: 20%;
        }
        .alertify-logs.right > .default,
        .alertify-logs.right > .success,
        .alertify-logs.right > .error {
            transform: translateX(-5%);
            transform: translateY(20%);
            text-align: left;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">

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
        $(document).ready(function(){



        });
    </script>
    <link rel="stylesheet" href="css/style.min.css">
    <script type="text/javascript" src="js/jstree.min.js"></script>
</head>
<body>
<div class="container" style="padding-left:150px;">
    <div><h3>Plan de Cuentas</h3></div>



    <?php if(isset($_SESSION['id_emp']))
    { ?>


        <div id="tree-container" ></div>
         <?php } else{ ?>


    <?php }?>

</div>
<!-- /.container -->



</body>
<script type="text/javascript">
    $(document).ready(function(){



        $("#nivel").change(function () {
            $("#nivel option:selected").each(function () {
               var id = $(this).val();
                $.post("ajax_padre.php", { id: id }, function(data){
                    $("#id_tipocuenta").html(data).selectpicker('refresh');


                });
            });
        });
        $('#guardar').click(function(){



            $.ajax({
                type: 'post',
                url: 'cuentaabm.php',
                data: $('form').serialize(),
                success: function (data) {
                    if(data=='1'){
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success('Guardado');
                        $('#tree-container'). jstree("refresh");
                    }else {

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data);
                        }
                    }

            });

        });


        $('#tree-container').jstree({
            'core' : {
                'data' : {
                    'url' : 'categoriaabm.php?operation=get_node',
                    'data' : function (node) {
                        return { 'id' : node.id };

                        },

                    "dataType" : "json"
                }
                ,'check_callback' : true,
                'themes' : {
                    'responsive' : false,
                    "icons": false
                }
            },

            'plugins' : ['state','contextmenu'],
            "contextmenu": {
                items : function (o, cb) {
                    return {
                        "create" : {
                            "separator_before"	: false,
                            "separator_after"	: true,
                            "_disabled"			: false, //(this.check("create_node", data.reference, {}, "last")),
                            "label"				: "Crear",
                            "action"			: function (data) {
                                var inst = $.jstree.reference(data.reference),
                                    obj = inst.get_node(data.reference);
                                inst.create_node(obj, {}, "last", function (new_node) {
                                    try {
                                        inst.edit(new_node);
                                    } catch (ex) {
                                        setTimeout(function () { inst.edit(new_node); },0);
                                    }
                                });
                            }
                        },
                        "rename" : {
                            "separator_before"	: false,
                            "separator_after"	: false,
                            "_disabled"			: false, //(this.check("rename_node", data.reference, this.get_parent(data.reference), "")),
                            "label"				: "Editar",
                            /*!
                             "shortcut"			: 113,
                             "shortcut_label"	: 'F2',
                             "icon"				: "glyphicon glyphicon-leaf",
                             */
                            "action"			: function (data) {
                                var inst = $.jstree.reference(data.reference),
                                    obj = inst.get_node(data.reference);
                                inst.edit(obj);

                            }
                        },
                        "remove" : {
                            "separator_before"	: false,
                            "icon"				: false,
                            "separator_after"	: false,
                            "_disabled"			: false, //(this.check("delete_node", data.reference, this.get_parent(data.reference), "")),
                            "label"				: "Eliminar",
                            "action"			: function (data) {
                                var inst = $.jstree.reference(data.reference),
                                    obj = inst.get_node(data.reference);
                                if(inst.is_selected(obj)) {
                                    inst.delete_node(inst.get_selected());

                                }
                                else {
                                    inst.delete_node(obj);
                                }
                            }
                        }

                    }


                }
//                    "items": {
//                    "create" : false,
//                    "ccp" : false,
//                    "rename" : false,
//                    "remove" : {
//                        "label" : "&nbsp;Delete",
//                        "icon" : "/images/icon/cross.png"
//                    }
//                }
            }
        }).on('create_node.jstree', function (e, data) {

            $.get('categoriaabm.php?operation=create_node', { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text })
                .done(function (d) {
                    data.instance.set_id(data.node, d.id);
                })
                .fail(function () {
                    data.instance.refresh();
                })
        }).on('rename_node.jstree', function (e, data) {
            $.get('categoriaabm.php?operation=rename_node', { 'id' : data.node.id, 'text' : data.text })
                .fail(function () {
                    data.instance.refresh();
                });
            $('#tree-container').jstree("refresh");
        }).on('delete_node.jstree', function (e, data) {
            $.get('categoriaabm.php?operation=delete_node', { 'id' : data.node.id })
                .fail(function () {
                    data.instance.refresh();
                });
        });

    });
</script>
<script type="text/javascript" src="js/alertify.min.js"></script>
</html>
