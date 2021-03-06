@extends('adminlte::page')
@section('title', 'Mapa')

@section('content_header')

@stop

@section('content')
    <style>
        #lista::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #lista::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #lista::-webkit-scrollbar-thumb {
            background-color: #F90;
            background-image: -webkit-linear-gradient(90deg, rgba(255, 255, 255, .2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%, transparent 75%, transparent)
        }

    </style>
    <div class="botones">
        <a class="boton" href="{{ route('mapa_todos_transportes_admin') }}">Transportes</a>
        <a class="boton" href="{{ route('mapa_requerimientos_admin') }}">Requerimientos</a>
        <a class="boton" id="todos" href="{{ route('mapa_todos_admin') }}">Ver Ambos</a><br>

    </div>
    <a class="mostrar-lista" id="mostrar-lista" onclick="mostrar_lista()"><i class="fa-solid fa-caret-down"></i></a>
    <a class="ocultar-lista hidden" id="ocultar-lista" onclick="ocultar_lista()"><i class="fa-solid fa-caret-up"></i></a>
    <div id="lista" style="overflow: auto;direction: rtl; height:80vh" class="encontrados hidden">
        @if ($transportes != null)
            <ul class="lista-encontrados">
                @foreach ($transportes as $transporte)
                    <a class="encontrado" href="">Trans.: {{ $transporte->tipo }} {{ $transporte->marca }}
                        {{ $transporte->modelo }}</a><br>
                @endforeach
            </ul>
        @endif
        @if ($requerimientos != null)
            <ul class="lista-encontrados">
                @foreach ($requerimientos as $requerimiento)
                    <a class="encontrado" href="">Reque.: {{ $requerimiento->tipo }} {{ $requerimiento->marca }}
                        {{ $requerimiento->modelo }}</a><br>
                @endforeach
            </ul>
        @endif
    </div>
    <div id='map'></div>


@stop

@section('css')

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            z-index: 200;
            margin-top: 20px;
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

        .boton:hover {
            color: rgb(240, 192, 35);
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
            color: rgb(240, 192, 35);
        }


        .mostrar-lista {
            cursor: pointer;
            position: absolute;
            margin-top: 25px;
            margin-left: 170px;
            z-index: 200;
            font-size: 3rem;
            color: rgb(53, 53, 53);
        }

        .ocultar-lista {
            cursor: pointer;
            position: absolute;
            margin-top: 35px;
            margin-left: 170px;
            z-index: 200;
            font-size: 3rem;
            color: rgb(53, 53, 53);
        }

        .ocultar-lista:hover {
            color: rgb(240, 192, 35);
        }

        .mostrar-lista:hover {
            color: rgb(240, 192, 35);
        }

        .hidden {
            display: none;
        }

    </style>
@stop

@section('js')
    <script>
        function mostrar_lista() {
            // var x = document.getElementById("lista");
            $('#lista').removeClass('hidden');
            $('#mostrar-lista').addClass('hidden');
            $('#ocultar-lista').removeClass('hidden');
            // if (x.className.indexOf("hidden") == -1) {
            //     x.className += " hidden";
            // } else {
            //     x.className = x.className.replace(" hidden", "");
            // }
        }

        function ocultar_lista() {
            $('#lista').addClass('hidden');
            $('#ocultar-lista').addClass('hidden');
            $('#mostrar-lista').removeClass('hidden');
        }
    </script>
    <script>
        var bounds = [

            [-91.37224615128879, -18.1556508709991],
            [-57.40833424744614, 0.20814680528115084]
            // Northeast coordinates

        ];
        console.log(<?php echo $transportes; ?>)

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
            '{{ url('/image/camabaja.png') }}',
            function(error, image1) {
                if (error) throw error;
                map.addImage('custom-marker Camabaja', image1);

            });

        map.loadImage(
            '{{ url('/image/tracto.png') }}',
            function(error, image2) {
                if (error) throw error;
                map.addImage('custom-marker Tracto', image2);

            });

        map.loadImage(
            '{{ url('/image/camacuna.png') }}',
            function(error, image3) {
                if (error) throw error;
                map.addImage('custom-marker Camacuna', image3);

            });

        map.loadImage(
            '{{ url('/image/plataforma.png') }}',
            function(error, image4) {
                if (error) throw error;
                map.addImage('custom-marker Camion Plataforma', image4);

            });

        map.loadImage(
            '{{ url('/image/carga.png') }}',
            function(error, image5) {
                if (error) throw error;
                map.addImage('custom-marker Carga', image5);

            });
        map.loadImage(
            '{{ url('/image/camion normal.png') }}',
            function(error, image6) {
                if (error) throw error;
                map.addImage('custom-marker Camion Normal', image6);

            });
        map.loadImage(
            '{{ url('/image/rebatible-grua.png') }}',
            function(error, image7) {
                if (error) throw error;
                map.addImage('custom-marker Camion Rebatible', image7);

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
                        @if ($transportes != null)
                            @foreach ($transportes as $transporte)
                                {
                                    'type': 'Feature',
                                    'properties': {
                                        'message': 'Foo',
                                        'nombre': '{{ $transporte->tipo . ' ' . $transporte->marca . ' ' . $transporte->modelo }}',
                                        'empresa': '{{ $transporte->empresa }}',
                                        'id': '{{ $transporte->id }}',
                                        'id_empresa': '{{ $transporte->id_transportista }}',
                                        'anio': '{{ $transporte->anio }}',
                                        'estado': '{{ $transporte->estado }}',
                                        'ejes': '{{ $transporte->cantidad_ejes }}',
                                        'capacidad': '{{ $transporte->capacidad }}',
                                        'origen': '',
                                        'destino': '',
                                        'fecha': '',
                                        'transporte': '',
                                        'peso': '',
                                        'iconMarker': '{{ $transporte->tipo }}',
                                    },
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': ['{{ $transporte->longitud }}',
                                            '{{ $transporte->latitud }}'
                                        ],
                                    }
                                },
                            @endforeach
                        @endif
                        @if ($requerimientos != null)
                            @foreach ($requerimientos as $requerimiento)
                                {
                                    'type': 'Feature',
                                    'properties': {
                                        'message': 'Foo',
                                        'nombre': '{{ $requerimiento->tipo . ' ' . $requerimiento->marca . ' ' . $requerimiento->modelo }}',
                                        'empresa': '{{ $requerimiento->empresa }}',
                                        'id': '{{ $requerimiento->id }}',
                                        'id_empresa': '',
                                        'origen': '{{ $requerimiento->departamento_origen }}',
                                        'destino': '{{ $requerimiento->departamento_destino }}',
                                        'fecha': '{{ $requerimiento->fecha_transporte }}',
                                        'transporte': '{{ $requerimiento->transporte_requerido }}',
                                        'peso': '{{ $requerimiento->peso }}',
                                        'anio': '',
                                        'estado': '',
                                        'ejes': '',
                                        'capacidad': '',
                                        'iconMarker': 'Carga',
                                    },
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': ['{{ $requerimiento->longitud }}',
                                            '{{ $requerimiento->latitud }}'
                                        ],
                                    }
                                },
                            @endforeach
                        @endif
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
                var anio = e.features[0].properties.anio;
                var estado = e.features[0].properties.estado;
                var peso = e.features[0].properties.peso;
                var ejes = e.features[0].properties.ejes;
                var capacidad = e.features[0].properties.capacidad;
                var origen = e.features[0].properties.origen;
                var destino = e.features[0].properties.destino;
                var fecha = e.features[0].properties.fecha;
                var transporte = e.features[0].properties.transporte;
                var id_empresa = e.features[0].properties.id_empresa;
                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                //Creamos el POPUP para los marcadores
                if (origen == "" && destino == "") {
                    new mapboxgl.Popup({
                            offset: 15,
                            closeOnClick: true
                        })
                        .setLngLat(coordinates)
                        .setHTML(
                            ' <b>' + nombre +
                            '</b><br>A??o: ' + anio +
                            '<br>Empresa: ' + empresa +
                            '<br>Estado: ' + estado +
                            '<br>Cantidad de ejes: ' + ejes +
                            '<br>Capacidad: ' + capacidad +
                            "<br><a href='transportistas/editar/" + id_empresa +
                            "'>Ver Mas</a>"
                        )
                        .addTo(map);
                } else {
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
                            '<br>Transporte Requerido: ' + transporte +
                            "<br><a href='user/requerimientos/agregar/" + id + "'>Realizar Cotizacion</a>"
                        )
                        .addTo(map);
                }
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
