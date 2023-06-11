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
        <div class="card">
            <div class="card-header">
                Factura No.
                <strong>{{ $cart['id'] }}</strong>
                <span class="float-right"> Fecha de facturación: <strong>{{ $cart['created_at'] }}</strong></span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="mb-3">Vendedor:</h6>
                        <div>
                            <strong>SALOMOVIL</strong>
                        </div>
                        <div>salomovil@gmail.com</div>
                        <div>www.salomovil.es</div>
                    </div>

                    <div class="col-12 mt-4">
                        <h6 class="mb-3">Comprador:</h6>
                        <div>
                            <strong>{{ $cart['username'] }}</strong>
                        </div>
                        <div>{{ $cart['delivery_address'] }}</div>
                        <div>{{ $cart['email'] }}</div>
                    </div>
                </div>

                <div class="table-responsive-sm">
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
                            @foreach ($cart['items'] as $item)
                                <tr>
                                    <td class="left">{{ $item['name'] }}</td>
                                    <td class="right">{{ $item['qty'] }}</td>
                                    <td class="center">{{ $item['price'] }}{{ __('€') }}</td>
                                    <td class="right">{{ $item['price'] * $item['qty'] }}{{ __('€') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="left" colspan="3">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>{{ $cart['total'] }}{{ __('€') }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <cite title="Source Title">¡Gracias por confiar en nosotros!</cite>
            </div>
        </div>
    </div>
</body>

</html>
