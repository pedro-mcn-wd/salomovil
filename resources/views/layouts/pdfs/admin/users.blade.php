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
            {{ __('SALOMOVIL - USUARIOS') }}
            <span class="float-right">{{ \Carbon\Carbon::now(new DateTimeZone('Europe/Madrid'))->format('d/m/Y H:i:s') }}</span>
        </div>

        <div class="row border mx-0 mb-0 mt-3 p-3">
            <div class="container-fluid m-0 p-0">
                <div class="row p-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Rol</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->userProfile->name }} {{ $user->userProfile->surname_first }} {{ $user->userProfile->surname_second }}</td>
                                    <td>{{ $user->userProfile->dni }}</td>
                                    <td>{{ $user->getRoleNames()->first() }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="left">
                                    <strong>Cantidad de usuarios: {{ count($users) }}</strong>
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
