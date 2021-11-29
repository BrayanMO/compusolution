<div>
    <style>
        h1 {
            text-align: center;
            font: bold;
            font-family: Arial, Helvetica, sans-serif;
            background: #85C1E9;
            color: #17202A;
        }

        div {
            text-align: center;
        }

        label {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            width: 300px;
            height: 100px;
            border: 2px solid #17202A;
            border-radius: 15px;
            margin-top: 12px;
            background: #AED6F1;
            box-shadow: 0px 0px 60px #17202A;

        }

        td {
            text-align: center;
        }

        tr {

            color: #17202A;

        }

        th {
            color: #17202A(255, 255, 255);
        }

    </style>
    <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
        <!--Title-->
        <h1>
            Reporte de Ventas
        </h1>
        @if (empty($fecha_inicio) && empty($fecha_fin))
            <div>
                <x-jet-label value="Total de Ingresos:"/>
                <strong>S/ {{$sumtotal}}</strong>
            </div>
        @else
            <div>
                <label for="">Fecha Inicio:</label>
                <input type="date"> <b>{{ $fecha_inicio }}</b>
                <label for=""> -  Fecha Fin:</label>
                <input type="date"> <b>{{ $fecha_fin }}</b><br><br>
                <x-jet-label value="Total de Ingresos:"/>
                <strong>S/ {{$sumtotal}}</strong>
            </div>
        @endif
        <!--Card-->
        <div id='recipients' class="p-8 mb-6 mt-4 lg:mt-0 rounded shadow bg-white">


                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Id</th>
                            <th data-priority="1">Cliente</th>
                            <th data-priority="2">Fecha</th>
                            <th data-priority="3">Tipo de envío</th>
                            <th data-priority="1">SubTotal</th>
                            <th data-priority="2">Costo de Envío</th>
                            <th data-priority="3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }} </td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</td>
                                <td>@if ($order->envio_type == 1)
                                        Recojo en tienda
                                    @else
                                        Envío a domicilio
                                    @endif
                                </td>
                                <td>S/ {{$order->total - $order->shipping_cost}}</td>
                                <td>S/ {{$order->shipping_cost}}</td>
                                <td>S/ {{$order->total}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

        <!--/Card-->

    </div>

</div>
