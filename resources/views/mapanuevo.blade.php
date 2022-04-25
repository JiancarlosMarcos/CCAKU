<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MDN-PT | Mapa</title>

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

        /*
        .camabaja {
            background-image: url('{{ url('/image/camabaja.webp') }}');
        }

        .tracto {
            background-image: url('{{ url('/image/tracto.jpg') }}');
        }

        .marker {
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .marker-car {
            background-image: url('https://cdn-icons-png.flaticon.com/512/62/62065.png?w=360');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }

        .mapboxgl-popup {
            max-width: 200px;

        }

        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        } */

    </style>
</head>

<body>
    <div id='map'></div>

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
            '{{ url('/iconos/11.png') }}',
            function(error, image1) {
                if (error) throw error;
                map.addImage('custom-markerCamabaja', image1);

            });

        map.loadImage(
            '{{ url('/iconos/22.png') }}',
            function(error, image2) {
                if (error) throw error;
                map.addImage('custom-markerTracto', image2);

            });

        map.loadImage(
            '{{ url('/iconos/33.png') }}',
            function(error, image3) {
                if (error) throw error;
                map.addImage('custom-markerCamacuna', image3);

            });

        map.loadImage(
            '{{ url('/iconos/44.png') }}',
            function(error, image4) {
                if (error) throw error;
                map.addImage('custom-markerCamion Plataforma', image4);

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
                        @foreach ($transportes as $transporte)
                            {
                            'type': 'Feature',
                            'properties': {
                            'message': 'Foo',
                            'nombre': '{{ $transporte->tipo . ' ' . $transporte->marca . ' ' . $transporte->modelo }}',
                            'empresa': '{{ $transporte->empresa }}',
                            'iconMarker': '{{ $transporte->tipo }}',
                            },
                            'geometry': {
                            'type': 'Point',
                            'coordinates': ['{{ $transporte->longitud }}', '{{ $transporte->latitud }}'],
                            }
                            },
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
                        '#599E9C',
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

                    'icon-image': 'custom-marker' + '{iconMarker}',
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
                        ' - <b>' + nombre +

                        '</b><br>Empresa: ' + empresa + "'>Solicitar Equipo</a>"
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

        })


        // const geojson = {
        //     "type": "FeatureCollection",
        //     "features_t": [
        @if ($transportes != null)
            // @foreach ($transportes as $transporte)
                // {
                // "type": "Feature",
                // "geometry": {
                // "type": "Point",
                // "coordinates": [
                // {{ $transporte->longitud }},
                // {{ $transporte->latitud }}
                // ]
                // },
                // "properties": {
                // "title": "{{ $transporte->tipo }}",
                // "description": "{{ $transporte->empresa }}",
                // 'iconMarker': '{{ $transporte->tipo }}',
                // }
                // },
                //
            @endforeach
            // @endif
        //     ],
        //     "features_c": [
        @if ($cargas != null)
            // @foreach ($cargas as $carga)
                // {
                // "type": "Feature",
                // "geometry": {
                // "type": "Point",
                // "coordinates": [
                // {{ $carga->longitud }},
                // {{ $carga->latitud }}
                // ]
                // },
                // "properties": {
                // "title": "{{ $carga->tipo }}",
                // "description": "{{ $carga->empresa }}",
        
                // }
                // },
                //
            @endforeach
            // @endif
        //     ]

        // };

        // // add markers to map
        @if ($transportes != null)
            // for (const feature_t of geojson.features_t) {
            // // create a HTML element for each feature
            // const veh = document.createElement('div');
        
            // veh.className = `marker tracto`;
        
            // // make a marker for each feature and add it to the map
            // new mapboxgl.Marker(veh)
            // .setLngLat(feature_t.geometry.coordinates)
            // .setPopup(
            // new mapboxgl.Popup({
            // offset: 25
            // }) // add popups
            // .setHTML(
            // `<h3>${feature_t.properties.title}</h3>
            // <p>${feature_t.properties.description}</p>`
            // )
            // )
            // .addTo(map);
            // }
            //
        @endif
        @if ($cargas != null)
            // // add markers to map
            // for (const feature_c of geojson.features_c) {
            // // create a HTML element for each feature
            // const car = document.createElement('div');
        
            // car.className = 'marker-car';
            // // make a marker for each feature and add it to the map
            // new mapboxgl.Marker(car)
            // .setLngLat(feature_c.geometry.coordinates)
            // .setPopup(
            // new mapboxgl.Popup({
            // offset: 25
            // }) // add popups
            // .setHTML(
            // `<h3>${feature_c.properties.title}</h3>
            // <p>${feature_c.properties.description}</p>`)
            // ).addTo(map);
            // }
            //
        @endif
    </script>
</body>

</html>
