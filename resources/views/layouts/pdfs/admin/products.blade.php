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
            {{ __('SALOMOVIL - PRODUCTOS') }}
            <span class="float-right">{{ \Carbon\Carbon::now(new DateTimeZone('Europe/Madrid'))->format('d/m/Y H:i:s') }}</span>
        </div>

        <div class="row border mx-0 mb-0 mt-3 p-3">
            <div class="container-fluid m-0 p-0">
                <div class="row p-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th style="width:30%">Descripción</th>
                                <th>Categoría</th>
                                <th>Subcategoría</th>
                                <th>{{ __('Stock (Uds)') }}</th>
                                <th>{{ __('Precio (€)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-wrap">{{ $product->description }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="left">
                                    <strong>Cantidad de productos: {{ count($products) }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="row border m-0 p-3" style="background-color: lightgrey;">
            {{ __('www.salomovil.es') }}
        </div>
    </div>
</body>

</html>
