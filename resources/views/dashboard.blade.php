@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" ></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="container">
        @php
        @endphp

        <div class="grid grid-cols-3 gap-4 pt-4 mb-3">
            <div class="">
                <div class="bg-white w-full rounded-xl shadow-sm flex items-center justify-around p-2">
                    <img src="https://img.icons8.com/ios/50/000000/interstate-plow-truck.png"/>
                    <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-800"> {{$total_vehiculos}} </h1>
                    <span class="text-gray-500">Transportes</span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="bg-white w-full rounded-xl shadow-sm flex items-center justify-around p-2">
                    <img src="https://img.icons8.com/material/48/000000/driving.png"/>
                    <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-800"> {{$total_transportistas}} </h1>
                    <span class="text-gray-500">Transportistas</span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="bg-white w-full rounded-xl shadow-sm flex items-center justify-around p-2">
                    <img src="https://img.icons8.com/material-outlined/48/000000/new-company.png"/>
                    <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-800"> {{$total_clientes}} </h1>
                    <span class="text-gray-500">Clientes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="">
                <canvas id="myChart" class="shadow-sm bg-white rounded-2xl p-4"></canvas>
            </div>
            <div class="">
                <canvas id="myChart2" class="shadow-sm bg-white rounded-2xl p-4"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-3">
            <div class="">
                <canvas id="myChart6" class="shadow-sm bg-white rounded-2xl p-4"></canvas>
            </div>
            <div class="">
                <canvas id="myChart61" class="shadow-sm bg-white rounded-2xl p-4"></canvas>
            </div>
            <div class="">
                <canvas id="myChart62" class="shadow-sm bg-white rounded-2xl p-4"></canvas>
            </div>
        </div>
    </div>
<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['{{$camacunas}} Camacuna',
                     '{{$cam_plataforma}} Camion Plataforma',
                     '{{$cam_rebatibles}} Camion Rebatible',
                     '{{$cam_normal}} Camion Normal',
                     '{{$camabajas}} Camabaja',
                     '{{$tractos}} Tracto',
                     '{{$cam_modular}} Modulares'
                    ],
            datasets: [{
                label: "datos actualizados",
                data: [{{$camacunas}},
                       {{$cam_plataforma}},
                       {{$cam_rebatibles}},
                       {{$cam_normal}},
                       {{$camabajas}},
                       {{$tractos}},
                       {{$cam_modular}}
                    ],
                backgroundColor: [
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)',
                    'rgba(54, 162, 235, .9)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Tipos de Transportes Registrados'
                }
            }
        }
    });
    const ctx2 = document.getElementById('myChart2');
    const myChart2 = new Chart(ctx2, {
        type: 'line',
        // const labels = Utils.months({count: 7});
        data: {
            datasets: [{
                label: 'Requerimientos',
                data: [{x:'abril', y:12}, {x:'mayo', y:10}, {x:'junio', y:15}, {x:'julio', y:12}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1,
                tension: 0.5
            },
            {
                label: 'cotizaciones aceptadas',
                data: [{x:'abril', y:5}, {x:'mayo', y:7}, {x:'junio', y:8}, {x:'julio', y:5}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.9)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1,
                tension: 0.5
            },
            {
                label: 'cotizaciones canceladas',
                data: [{x:'abril', y:7}, {x:'mayo', y:8}, {x:'junio', y:6}, {x:'julio', y:7}],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1,
                tension: 0.5
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Conversiones de requerimientos'
                }
            }
        }
    });

    // const ctx3 = document.getElementById('myChart3');
    // const myChart3 = new Chart(ctx3, {
    //     type: 'radar',
    //     data: {
    //         labels: ['Transportistas', 'transporte', 'clientes'],
    //         datasets: [{
    //             label: 'Datos generales',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // const ctx4 = document.getElementById('myChart4');
    // const myChart4 = new Chart(ctx4, {
    //     type: 'polarArea',
    //     data: {
    //         labels: ['Transportistas', 'transporte', 'clientes'],
    //         datasets: [{
    //             label: 'Datos generales',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // const ctx5 = document.getElementById('myChart5');
    // const myChart5 = new Chart(ctx5, {
    //     type: 'pie',
    //     data: {
    //         labels: ['name'
    //         ],
    //         datasets: [{
    //             label: 'Datos generales',
    //             data: [12, 19, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    const ctx6 = document.getElementById('myChart6');
    const myChart6 = new Chart(ctx6, {
        type: 'doughnut',
        data: {
            labels: ['Jairo Espinoza Quispe','Jose Armacanqui','Sarah','Christopher','Gean Carlos Armacanqui Mitma'],
            datasets: [{
                label: 'Datos generales',
                data: [{{$jairo}}, {{$jose_armacanqui}}, {{$brandon}}, {{$sarah}}, {{$chistofer}}, {{$gean}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Registro de Transportistas por Usuario'
                }
            }
        }
    });
    const ctx61 = document.getElementById('myChart61');
    const myChart61 = new Chart(ctx61, {
        type: 'pie',
        data: {
            labels: ['Jairo Espinoza Quispe','Jose Armacanqui','Sarah','Christopher','Gean Carlos Armacanqui Mitma'],
            datasets: [{
                label: 'Datos generales',
                data: [{{$jairo_v}}, {{$jose_armacanqui_v}}, {{$brandon_v}}, {{$sarah_v}}, {{$chistofer_v}}, {{$gean_v}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Registro de Transportes por Usuario'
                }
            }
        }
    });
    const ctx62 = document.getElementById('myChart62');
    const myChart62 = new Chart(ctx62, {
        type: 'doughnut',
        data: {
            labels: ['Jairo Espinoza Quispe','Jose Armacanqui','Sarah','Christopher','Gean Carlos Armacanqui Mitma'],
            datasets: [{
                label: 'Datos generales',
                data: [{{$jairo}}, {{$jose_armacanqui}}, {{$brandon}}, {{$sarah}}, {{$chistofer}}, {{$gean}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.9)',
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(255, 206, 86, 0.9)',
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 159, 64, 0.9)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // const ctx7 = document.getElementById('myChart7');
    // const myChart7 = new Chart(ctx7, {
    //     type: 'bubble',
    //     data: {
    //         datasets: [
    //     {
    //         label: 'First Dataset',
    //         data: [
    //             {
    //                 x: 20,
    //                 y: 30,
    //                 r: 15
    //             },
    //             {
    //                 x: 40,
    //                 y: 10,
    //                 r: 10
    //             }
    //         ],
    //         backgroundColor:"#FF6384",
    //         hoverBackgroundColor: "#FF6384",
    //     }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

</script>

@stop

@section('css')
    @include('admin.datatable')
@stop

@section('js')

@stop
