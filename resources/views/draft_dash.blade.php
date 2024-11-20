@extends('index')

@section('content')
    <style>
        #transactionChart {
            width: 100%;
            /* Pastikan lebar penuh */
            height: auto;
            /* Tinggi menyesuaikan */
        }
    </style>
    <!-- Bread crumb -->
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                    {{ $greeting }}, {{ $user->name }}!
                </h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $totalQuantity }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Quantity</h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="package"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    <sup class="set-doller">Rp.</sup>{{ number_format($totalAmountOverall, 0, ',', '.') }}
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Nominal Keseluruhan
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    <sup
                                        class="set-doller">Rp.</sup>{{ number_format($totalAmountSuccessful, 0, ',', '.') }}
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Nominal Berhasil
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">
                                    {{ $ticketSold }}
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Tiket Terjual</h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="28"
                                        height="28" fill="#a1a1a1" viewBox="0 0 256 256">
                                        <path
                                            d="M232,104a8,8,0,0,0,8-8V64a16,16,0,0,0-16-16H32A16,16,0,0,0,16,64V96a8,8,0,0,0,8,8,24,24,0,0,1,0,48,8,8,0,0,0-8,8v32a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V160a8,8,0,0,0-8-8,24,24,0,0,1,0-48ZM32,167.2a40,40,0,0,0,0-78.4V64H88V192H32Zm192,0V192H104V64H224V88.8a40,40,0,0,0,0,78.4Z">
                                        </path>
                                    </svg></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-12">
                <div class="card h-100">
                    <div class="card-body" style="margin-bottom: -40px;">
                        <div class="flex justify-between items-center">
                            <!-- Title and Percentage Section -->
                            <div>
                                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2"
                                    id="sales-this-week">
                                    $12,423
                                </h5>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Transaksi Per Tanggal</p>
                            </div>
                            <!-- Percentage and Icon Section -->
                            <div
                                class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500">
                                <span id="sales-percentage">23%</span>
                                <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Reduced margin-top and padding on the chart section -->
                    <div id="labels-chart" class="px-2.5 mt-0 p-4 md:p-6 pt-0 md:pt-0"></div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('http://192.168.43.45/api/trxDailyCount') // Ganti URL ke yang benar
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            // Ekstrak data untuk chart
                            // const categories = data.data.map(item => item.trx_date);  // Tanggal transaksi
                            // Ekstrak data untuk chart
                            const categories = data.data.map(item => {
                                const date = new Date(item.trx_date);
                                // Mengubah format tanggal ke "25 Nov 2024"
                                return date.toLocaleDateString('id-ID', {
                                    day: 'numeric',
                                    month: 'short', // Menggunakan bulan singkat (3 huruf)
                                    year: 'numeric'
                                });
                            }); // Tanggal transaksi dengan format yang diinginkan
                            const seriesData = data.data.map(item => item
                                .unique_transactions); // Jumlah transaksi unik

                            // Render chart
                            renderChart(categories, seriesData);
                        } else {
                            console.error("Failed to fetch data:", data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            function renderChart(categories, seriesData) {
                const options = {
                    chart: {
                        type: 'area',
                        height: "100%",
                        width: "100%",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    xaxis: {
                        categories: categories, // Tanggal pada sumbu X
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    // yaxis: {
                    //     labels: {
                    //         show: true,
                    //         style: {
                    //             fontFamily: "Inter, sans-serif",
                    //             cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    //         },
                    //     },
                    // },
                    yaxis: {
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            },
                            formatter: function(value) {
                                return Math.round(value); // Membulatkan angka yang ditampilkan di axis
                            }
                        },
                    },
                    series: [{
                        name: 'Jumlah Transaksi',
                        data: seriesData, // Jumlah transaksi unik pada sumbu Y
                        color: "#1A56DB",
                    }, ],
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false,
                        },
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#1C64F2",
                            gradientToColors: ["#1C64F2"],
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    legend: {
                        show: false,
                    },
                    grid: {
                        show: false,
                    },
                };

                const chart = new ApexCharts(document.getElementById("labels-chart"), options);
                chart.render();
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('http://192.168.43.45/api/trxSalesData') // Ganti URL dengan API endpoint yang sesuai
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            const salesThisWeek = data.data.sales_this_week;
                            const percentageChange = data.data.percentage_change;
                            const transactionsCount = data.data.transactions_count;

                            // Menampilkan data penjualan minggu ini
                            document.getElementById('sales-this-week').innerText = `$${salesThisWeek}`;
                            document.getElementById('sales-percentage').innerText = `${percentageChange}%`;

                            // Menampilkan jumlah transaksi minggu ini
                            document.getElementById('transactions-count').innerText = transactionsCount;

                            // Jika perlu, tambahkan logika untuk rentang waktu lainnya seperti "Last 7 days"
                        } else {
                            console.error("Failed to fetch data:", data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        </script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        {{-- <div class="col-sm-6 col-lg-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">
                                    </sup>{{ number_format($totalMerchants, 0, ',', '.') }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Merchant
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}

        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6 col-lg-7">
                <div class="card h-100">
                    <div class="card-body">
                        <!-- Judul dan Dropdown Menu -->
                        <div class="d-flex align-items-start">
                            <h4 class="card-title mb-0">Earning Statistics</h4>
                            {{-- <div class="ms-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Tempat Grafik Chart.js -->
                        <div class="pl-4 mb-5">
                            <canvas id="transactionChart" class="stats ct-charts position-relative"></canvas>
                        </div>

                        <!-- Keterangan Grafik -->
                        <ul class="list-inline text-center mt-4 mb-0">
                            <li class="list-inline-item text-muted fst-italic">Earnings for this date</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Script Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const transactions = @json($transactions); // Data transaksi dari controller

                // Ambil tanggal transaksi dan total_amount
                const labels = transactions.map(transaction => {
                    const date = new Date(transaction.trx_date);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short', // Menggunakan bulan singkat (3 huruf)
                        year: 'numeric'
                    });
                });
                // const labels = transactions.map(transaction => {
                //     const date = new Date(transaction.trx_date);
                //     return date.toLocaleDateString(); // Mengambil tanggal
                // });

                const data = transactions.map(transaction => transaction.total_amount);

                // Tentukan nilai terendah dan tertinggi dari data total_amount
                const minValue = Math.min(...data);
                const maxValue = Math.max(...data);
                const adjustedMinValue = minValue - 20;
                const adjustedMaxValue = maxValue + 20;

                const ctx = document.getElementById('transactionChart').getContext('2d');
                let transactionChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Amount',
                            data: data,
                            borderColor: '#4e73df',
                            backgroundColor: 'rgba(78, 115, 223, 0.2)',
                            fill: true,
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true, // Membuat grafik responsif
                        maintainAspectRatio: false, // Tidak mempertahankan rasio aspek
                        plugins: {
                            legend: {
                                display: true,
                            },
                        },
                        scales: {
                            // x: {
                            //     title: {
                            //         display: true,
                            //         text: 'Date'
                            //     }
                            // },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Amount (Rp.)'
                                },
                                suggestedMin: adjustedMinValue,
                                suggestedMax: adjustedMaxValue,
                                ticks: {
                                    callback: function(value) {
                                        return "Rp. " + value.toLocaleString(); // Format dengan "Rp."
                                    }
                                }
                            }
                        }
                    }
                });

                // Update grafik saat ukuran layar berubah
                window.addEventListener('resize', function() {
                    transactionChart.resize(); // Menyesuaikan ukuran grafik
                });
            </script>

            <div class="col-md-6 col-lg-5">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <h4 class="card-title mb-0">Quantity Perhari</h4>
                            {{-- <div class="ms-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Tempat Grafik Chart.js -->
                        <div class="pl-4"> <!-- Adjusted margin-bottom here -->
                            <div id="column-chart" style="height: 350px;"></div>
                        </div>

                        <!-- Keterangan Grafik -->
                        <ul class="list-inline text-center mt-2 mb-0"> <!-- Adjusted margin-top here -->
                            <li class="list-inline-item text-muted fst-italic">Days of the Week</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const apiUrl = "http://192.168.43.45/api/getWeeklyData"; // Ganti dengan endpoint API Anda.

                    // Fetch data from API
                    fetch(apiUrl)
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.status) {
                                // Extract data from the JSON response
                                let days = data.data.days; // Days of the week
                                const quantityS = data.data.data.S; // Data for status 'S'
                                const quantityP = data.data.data.P; // Data for status 'P'

                                // Shorten the days to 3-letter abbreviations
                                days = days.map(day => day.substring(0, 3));

                                // Configure chart options
                                const chartOptions = {
                                    chart: {
                                        type: "bar",
                                        height: 350
                                    },
                                    title: {
                                        align: 'center',
                                        style: {
                                            fontSize: '16px',
                                            fontWeight: 'bold',
                                            color: '#333'
                                        }
                                    },
                                    xaxis: {
                                        categories: days, // Days of the week (abbreviated)
                                        title: {
                                            style: {
                                                fontSize: '12px',
                                                fontWeight: 'bold',
                                                color: '#666'
                                            }
                                        }
                                    },
                                    yaxis: {
                                        title: {
                                            text: "Quantity",
                                            style: {
                                                fontSize: '12px',
                                                fontWeight: 'bold',
                                                color: '#666'
                                            }
                                        }
                                    },
                                    series: [{
                                            name: "Quantity Status Sukses",
                                            data: quantityS,
                                            color: "#1A56DB" // Blue color
                                        },
                                        {
                                            name: "Quantity Status Pending",
                                            data: quantityP,
                                            color: "#FDBA8C" // Orange color
                                        }
                                    ],
                                    tooltip: {
                                        shared: true,
                                        intersect: false
                                    },
                                    legend: {
                                        position: 'top',
                                        horizontalAlign: 'center'
                                    }
                                };

                                // Render the chart
                                const chartContainer = document.getElementById("column-chart");
                                if (chartContainer && typeof ApexCharts !== "undefined") {
                                    const chart = new ApexCharts(chartContainer, chartOptions);
                                    chart.render();
                                } else {
                                    console.error("ApexCharts library not loaded or chart container not found.");
                                }
                            } else {
                                console.error("Error fetching data:", data.message);
                            }
                        })
                        .catch((error) => console.error("Fetch error:", error));
                });
            </script>
        </div>
    </div>
@endsection
