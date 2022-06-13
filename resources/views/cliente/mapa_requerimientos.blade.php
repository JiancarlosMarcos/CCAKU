@extends('adminlte::page')
@section('title', 'Mapa Requerimientos')

@section('content_header')

@stop

@section('content')
    <div id='map'></div>


    <script>
        var bounds = [

            [-91.37224615128879, -18.1556508709991],
            [-57.40833424744614, 0.20814680528115084]
            // Northeast coordinates

        ];
        mapboxgl.accessToken =
            'pk.eyJ1IjoiamFpcm8xMzk3IiwiYSI6ImNsMjZuZGp6NzA0N3AzY3FxeWJiZTl6NGEifQ.KSS4YhkkI_nygWVkGb-f_A';
        const map = new mapboxgl.Map({

            container: 'map', // container ID
            style: 'mapbox://styles/jairo1397/cl2akyvyx006g15nza0ms0o4x', // style URL
            center: [-74.5, -10], // starting position [lng, lat]
            zoom: 4.8, // starting zoom
            maxBounds: bounds

        });



        map.loadImage(
            '{{ url('/image/carga.png') }}',
            function(error, image5) {
                if (error) throw error;
                map.addImage('custom-marker Carga', image5);

            });

        //mapa normal
        map.dragRotate.disable();
        map.touchZoomRotate.disableRotation();

        map.on('load', function() {
            map.addSource('earthquakes', {
                type: 'geojson',

                data: {
                    'type': 'FeatureCollection',
                    'features': [

                        @foreach ($requerimientos as $requerimiento)
                            @if ($requerimiento->id_users == auth()->user()->id)
                                {
                                    'type': 'Feature',
                                    'properties': {
                                        'message': 'Foo',
                                        'nombre': '{{ $requerimiento->tipo . ' ' . $requerimiento->marca . ' ' . $requerimiento->modelo }}',
                                        'empresa': '{{ $requerimiento->empresa }}',
                                        'origen': '{{ $requerimiento->departamento_origen }}',
                                        'destino': '{{ $requerimiento->departamento_destino }}',
                                        'fecha': '{{ $requerimiento->fecha_transporte }}',
                                        'cargas': '{{ $requerimiento->cargas }}',
                                        'transportes': '{{ $requerimiento->transportes }}',
                                        'id': '{{ $requerimiento->id_requerimiento }}',
                                        'peso': '{{ $requerimiento->peso }}',
                                        'iconMarker': 'Carga',
                                    },
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': ['{{ $requerimiento->longitud }}',
                                            '{{ $requerimiento->latitud }}'
                                        ],
                                    }
                                },
                            @endif
                        @endforeach

                    ]
                },
                cluster: true,
                clusterMaxZoom: 14, // Max zoom to cluster points on
                clusterRadius: 25 // Radius of each cluster when clustering points (defaults to 50)
            });
            map.addLayer({
                //CSS de Agrupacion de Marcadores
                id: 'clusters',
                type: 'circle',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                paint: {
                    // Use step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#FCAF3B',
                        100,
                        '#fff',
                        750,
                        '#62CB85'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        20,
                        100,
                        30,
                        750,
                        40
                    ]
                }
            });

            map.addLayer({
                id: 'cluster-count',
                type: 'symbol',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': '{point_count_abbreviated}',
                    'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                    'text-size': 15,
                },
                paint: {
                    "text-color": "#ffffff"
                }
            });
            map.addLayer({

                id: 'unclustered-point',
                type: 'symbol',
                layout: {

                    'icon-image': 'custom-marker' + ' ' + '{iconMarker}',
                    //'icon-image': 'custom-markercamabaja',
                    'icon-size': 1,
                    // get the title name from the source's "title" property


                    'text-font': [
                        'Open Sans Semibold',
                        'Arial Unicode MS Bold',
                    ],
                    'text-size': 10,
                    'text-offset': [0, 4.25],
                    'text-anchor': 'top',
                },

                source: 'earthquakes',
                filter: ['!', ['has', 'point_count']],
            });

            map.on('click', 'unclustered-point', function(e) {
                //declaramos variables y le asignamos valores del JSON extraido.
                var coordinates = e.features[0].geometry.coordinates.slice();
                var empresa = e.features[0].properties.empresa;
                var nombre = e.features[0].properties.nombre;
                var id = e.features[0].properties.id;
                var origen = e.features[0].properties.origen;
                var destino = e.features[0].properties.destino;
                var fecha = e.features[0].properties.fecha;
                var transporte = e.features[0].properties.transportes;
                var carga = e.features[0].properties.cargas;
                var url = "/user/requerimientos/editar/" + id;
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                //Creamos el POPUP para los marcadores

                new mapboxgl.Popup({
                        offset: 15,
                        closeOnClick: true
                    })
                    .setLngLat(coordinates)
                    .setHTML(
                        ' <b>' + nombre +
                        '</b><br>Empresa: ' + empresa +
                        '<br>Origen: ' + origen +
                        '<br>Destino: ' + destino +
                        '<br>Fecha de Transporte: ' + fecha +
                        '<br>Cant. Transporte Requerido: ' + transporte +
                        '<br>Cant. Cargas: ' + carga +
                        "<br><a href='" + url + "'>Modificar Requerimiento</a>"
                    )
                    .addTo(map);
            });
            map.on('click', 'clusters', function(e) {
                var features = map.queryRenderedFeatures(e.point, {
                    layers: ['clusters']
                });
                var clusterId = features[0].properties.cluster_id;
                map.getSource('earthquakes').getClusterExpansionZoom(
                    clusterId,
                    function(err, zoom) {
                        if (err) return;

                        map.easeTo({
                            center: features[0].geometry.coordinates,
                            zoom: zoom
                        });
                    }
                );
            });
            map.on('mouseenter', 'unclustered-point', function() {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'unclustered-point', function() {
                map.getCanvas().style.cursor = '';
            });

            map.on('mouseenter', 'clusters', function() {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'clusters', function() {
                map.getCanvas().style.cursor = '';
            });

        })
    </script>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            height: 100vh;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .botones {
            position: absolute;
            margin-top: 20px;
            z-index: 200;
            margin-top: 30px;
            margin-left: 20px;
        }

        .boton {
            text-decoration: none;
            padding: 10px;
            width: 100px;
            background-color: rgb(55, 55, 55);
            border-radius: 20px;
            color: rgb(252, 252, 252);
        }

        .encontrados {
            position: absolute;
            margin-top: 100px;
            z-index: 200;
            margin-bottom: 30px;
            margin-left: 20px;
        }

        .lista-encontrados {
            list-style-type: none;
            margin: 0;
            padding: 0;
            color: white
        }

        .encontrado {
            background-color: rgb(53, 53, 53);
            margin: 5px;
            padding: 0 5px;
            border-radius: 5px;
            color: rgb(240, 192, 35)
        }

    </style>

    <!-- SELECT 2 JS CSS-->
    <script src="{{ asset('js2/jquery/jquery.min.js') }}"></script>
    <!-- NUEVO JQUERY-->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css2/main.css') }}">

    <link rel="stylesheet" href="{{ asset('css2/product.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  extension responsive  -->

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Montserrat);

        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid #123;
            border-radius: 50%;
            animation: lds-ring 1.5s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #123 transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.30s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.15s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .hidden {
            overflow: hidden;
            visibility: hidden;
        }

        .centrado {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .bg-principal {
            background: #222d32;
            color: #fff;
        }

    </style>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .usuario {
            position: absolute;
            z-index: 200;
            margin-top: 20px;
            margin-left: 95%;
        }

    </style>
@stop

@section('js')

@stop
