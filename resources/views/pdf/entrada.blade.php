<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <title>Entrada de Almacen FCP</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap');
        body
        {
            font-family: 'Montserrat', sans-serif;
        }
        .headir {
            background-color: #272626e8;
            color: white;
            padding: 5px;
            text-align: center;
        }
    /* Clase para la tabla */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc; /* Borde de la tabla */
            font-size: 12px;
        }
        /* Estilo para el encabezado de la tabla */
        .custom-table thead {
            background-color: #f2f2f2; /* Color gris claro */
        }
        .custom-table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #ddd; /* Borde inferior de las celdas de encabezado */
            border-right: 1px solid #ddd; /* Borde derecho de las celdas de encabezado */
        }
        /* Estilo para el cuerpo de la tabla */
        .custom-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9; /* Color para filas impares */
        }
        .custom-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd; /* Borde inferior de las celdas del cuerpo */
            border-right: 1px solid #ddd; /* Borde derecho de las celdas del cuerpo */
        }
        /* Eliminar último borde derecho de las celdas del encabezado y el cuerpo */
        .custom-table th:last-child,
        .custom-table td:last-child {
        border-right: none;
        }

        /* Ajustar ancho de la columna Concepto */
        .custom-table th:nth-child(4),
        .custom-table td:nth-child(4) {
        width: 2 times; /* Puedes ajustar este valor según tus necesidades */
        }

    /* Ajustar ancho de las últimas dos columnas */
        .custom-table th:nth-last-child(-n+2),
        .custom-table td:nth-last-child(-n+2) {
        width: 80px; /* Ajusta el ancho según tus necesidades */
        }
        .content {
            flex: 1; /* Toma el espacio restante */
            padding: 20px;
        }

        .footer {
            background-color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: auto; /* Empuja el footer hacia abajo */
        }
    </style>
</head>
<body>
    <section>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('img/logoqroo.png')}}" class="rounded img-thumbnail img-fluid" alt="logoqroo" width="70px">
                    </td>
                    <td class="text-center">
                        <span><strong>COMISION DE AGUA POTABLE Y ALCANTARILLADO</strong></span><br>
                        <span><strong>DEL ESTADO DE QUINTANA ROO</strong></span><br>
                        <span class="text-muted"><small>DEPARTAMENTO DE RECURSOS MATERIALES</small></span><br>
                        <span class="text-muted"><small>ALMACEN ORGANISMO OPERADOR</small></span><br>
                        <span class="text-muted"><small>FELIPE CARRILLO PUERTO</small></span>
                    </td>
                    <td>
                        <img src="{{ asset('img/capa.png')}}" class="rounded img-thumbnail img-fluid" alt="logoqroo" width="190px">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex float-end">
            <div class="p-2 ma-1 bg-secondary headir" style="font-size: 12px;">
                <span class="text-white">ENTRADA DE ALMACEN</span>
            </div>
        </div>
    </section>
    <br><br>
    <section class="header">
        <span class="pb-3 ml-3 mr-3 border border-dark">
            <table class="table" style="font-size: 12px; margin-left:5px;">
                <tbody>
                    <tr>
                        <th scope="row"><strong>PROVEEDOR:</strong></th>
                        <td>{{$header->proveedor}}</td>
                        <td></td>
                        <td><strong>FECHA:</strong></td>
                        <td>{{$header->fecha}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="row">NOMBRE COMERCIAL:</th>
                        <td>{{$header->nomComer}}</td>
                        <td></td>
                        <td><strong>FOLIO:</strong></td>
                        <td>{{$header->fol_entrada}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="row">FACTURA, NOTA O COTIZACIÓN:</th>
                        <td>{{$header->factura}}</td>
                        <td>{{$header->nFactura}}</td>
                        <td><strong>ORDEN DE COMPRA:</strong></td>
                        <td>{{$header->ordenCompra}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="row">DEPARTAMENTO SOLICITANTE:</th>
                        <td>{{$header->workarea->name}}</td>
                        <td></td>
                        <td><strong>TIPO DE COMPRA O CONTRATO:</strong></td>
                        <td>{{$header->tCompraContrato}}</td>
                    </tr>
                </tbody>
            </table>
        </span>
    </section>
    <section class="content">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Codigo</th>
                    <th>Concepto</th>
                    <th>P. U.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $item)
                    <tr>
                        <td>{{$item->catidad}}</td>
                        <td>{{$item->measurementunits->name}}</td>
                        <td>{{$item->numInv}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{'$ '.number_format($item->pUnit, 2)}}</td>
                        <td>{{'$ '.number_format($item->total, 2)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td></td>
                    <td>{{'$ ' . number_format($header->total, 2)}}</td>
                </tr>
            </tfoot>
        </table>
    </section>
    <section>
        <div class="container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <td class="text-center" style="font-size: 8;" >OBSERVACIONES:</td>
                        <td class="text-center" style="font-size: 8;">
                            <div class="text-center">
                                <span>{{$header->observaciones}}</span><br>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

    </section>
    <br>
    <br>
    <br>
    <div class="footer">
        <table>
            <thead>
                <tr>
                    <td class="text-center" style="font-size: 8; width: 250px;">
                        <div class="text-center">
                            <span>{{$almacen->name}}</span><br>
                            <span>RECIBIO</span><br>
                            <span>{{$almacen->job->name . ' ' . $almacen->workarea->name}}</span>
                        </div>
                    </td>
                    <td>
                        <div class="text-center" style="font-size: 8; width: 200px;">
                            <span>{{$subgerente->name}}</span><br>
                            <span>VISTO BUENO</span><br>
                            <span>{{$subgerente->job->name . ' ' . $subgerente->workarea->name}}</span>
                        </div>
                    </td>
                    <td>
                        <div class="text-center" style="font-size: 8; width: 230px;">
                            <span>{{$materiales->name}}</span><br>
                            <span>VISTO BUENO</span><br>
                            <span>{{$materiales->job->name . ' ' . $materiales->workarea->name}}</span>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>

</body>
</html>
