<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="informacion-concierto">
        <strong>@lang('strings.nombre')</strong>><span>{{ $concierto->nombre }}</span>
        <strong>@lang('strings.promotor')</strong>><span>{{ $concierto->promotor->nombre }}</span>
        <strong>@lang('strings.recinto')</strong>><span>{{ $concierto->recinto->nombre }}</span>
        <strong>@lang('strings.numero_espectadores')</strong>><span>{{ $concierto->nombre }}</span>
        <strong>@lang('strings.fecha')</strong>><span>{{ $concierto->nombre }}</span>
    </div>

    <table>
        <thead>
        <th>@lang('strings.precio_entrada')</th>
        <th>@lang('strings.total_entradas_plano')</th>
        <th>@lang('strings.alquiler_recinto')</th>
        <th>@lang('strings.porcentaje_fijo')</th>
        <th>@lang('strings.cache_grupos')</th>
        <th>@lang('strings.porcentaje_entradas')</th>
        <th>@lang('strings.total_entrante')</th>
        <th>@lang('strings.total_saliente')</th>
        </thead>
        <tbody>
            <td>{{ $desglose->getPrecioEntrada() }}</td>
            <td>{{ $desglose->getTotalEntradasPlano() }}</td>
            <td>{{ $desglose->getAlquilerRecinto() }}</td>
            <td>{{ $desglose->getPorcentajeFijo() }}</td>
            <td>{{ $desglose->getCacheGrupos() }}</td>
            <td>{{ $desglose->getPorcentajeEntradas() }}</td>
            <td>{{ $desglose->getTotalEntrante() }}</td>
            <td>{{ $desglose->getTotalSaliente() }}</td>
        </tbody>
    </table>
</div>
</body>
</html>
