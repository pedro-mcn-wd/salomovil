<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row border m-0 p-3" style="background-color: lightgrey;">
            PEDIDOS
            <span class="float-right">{{ \Carbon\Carbon::now(new DateTimeZone('Europe/Madrid'))->format('d/m/Y H:i:s') }}</span>
        </div>

        <div class="row border mx-0 mb-0 mt-3 p-3">
            <div class="col-12 m-0 p-0">
                <h6 class="mb-3">Vendedor:</h6>
                <div><strong>SALOMOVIL</strong></div>
                <div>salomovil@gmail.com</div>
                <div>www.salomovil.es</div>
            </div>

        </div>

        @foreach ($sales as $sale)
            <div class="row border mx-0 mb-0 mt-3 p-3">
                <div class="container-fluid m-0 p-0">
                    <div class="row p-3">
                        Pedido No.
                        <strong>{{ $sale->id }}</strong>
                        <span class="float-right">Fecha de pedido:
                            <strong>{{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}</strong></span>
                    </div>

                    <div class="row p-3">
                        <div class="col-12 p-0">
                            <h6 class="mb-3">Datos:</h6>
                        </div>

                        <div class="col-12 p-0">
                            <div>
                                Dirección de envío: {{ $sale->delivery_address }}
                            </div>
                            <div>
                                Dirección de facturación: {{ $sale->billing_address }}
                            </div>
                            <div>
                                Número de la tarjeta del pago:
                                @php
                                    foreach (str_split($sale->credit_card_number) as $ind => $char) {
                                        if ($ind % 4 === 0) {
                                            echo ' ';
                                        }
                                        echo $char;
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-12 p-0">
                            <h6 class="mb-3">Comprador:</h6>
                            <div>
                                <strong>{{ $sale->user->userProfile->name . ' ' . $sale->user->userProfile->surname_first . ' ' . $sale->user->userProfile->surname_second }}</strong>
                            </div>
                            <div>{{ $sale->delivery_address }}</div>
                            <div>{{ $sale->user->email }}</div>
                        </div>
                    </div>

                    <div class="row p-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="right">Cantidad</th>
                                    <th class="center">Precio</th>
                                    <th class="right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts[$sale->id] as $ind => $items)
                                    @if ($ind === 'items')
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="left">{{ $item['name'] }}</td>
                                                <td class="right">{{ $item['qty'] }}</td>
                                                <td class="center">{{ $item['price'] }}{{ __('€') }}
                                                </td>
                                                <td class="right">
                                                    {{ $item['price'] * $item['qty'] }}{{ __('€') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="left" colspan="3">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>{{ $carts[$sale->id]['total'] }}{{ __('€') }}</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row border m-0 p-3" style="background-color: lightgrey;">
            <cite title="Source Title">¡Gracias por confiar en nosotros!</cite>
        </div>
    </div>
</body>

</html>
