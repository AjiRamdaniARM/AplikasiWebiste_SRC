<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.panel.header')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/globalFont.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        .slide-top {
            -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @-webkit-keyframes slide-top {
            0% {
                -webkit-transform: translateY(4);
                transform: translateY(4);
            }

            100% {
                -webkit-transform: translateY(1rem);
                transform: translateY(1rem);
            }
        }

        @keyframes slide-top {
            0% {
                -webkit-transform: translateY(4);
                transform: translateY(4);
            }

            100% {
                -webkit-transform: translateY(1rem);
                transform: translateY(1rem);
            }
        }


        /* modal diskon */
        .modal-window {
            position: fixed;
            background-color: rgba(255, 255, 255, 0.25);
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s;
        }

        .modal-window:target {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }

        .modal-window>div {
            width: 800px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 7em;
        }

        @media (max-width: 480px) {
            .modal-window>div {
                width: 550px;
            }
        }

        .modal-window header {
            font-weight: bold;
        }

        .modal-window h1 {
            font-size: 150%;
            margin: 0 0 15px;
        }

        .modal-close {
            position: absolute;
            top: 100px;
            /* Atur jarak dari atas */
            right: 100px;
            /* Atur jarak dari kanan */
            background: blue;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 100%;
            z-index: 1000;
            /* Pastikan tombol close berada di depan gambar */
        }

        .modal-close:hover {
            color: black;
        }

        /* Demo Styles */

        .modal-window>div {
            border-radius: 1rem;
        }

        .modal-window div:not(:last-of-type) {
            margin-bottom: 15px;
        }

        small {
            color: lightgray;
        }

        .btn {
            background-color: white;
            padding: 1em 1.5em;
            border-radius: 0.5rem;
            text-decoration: none;
        }

        .btn i {
            padding-right: 0.3em;
        }
    </style>
</head>

<body>
    <!--popupiklan-->
    <style type="text/css">
        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .popup-iklan {
            max-width: 100%;
            position: absolute;
            z-index: 100;
            left: 50%;
            transform: translateX(-50%);
            top: 100px;
        }

        .popup-iklan .body {
            width: 100%;
            height: auto;

            background-color: black 50%;
        }

        .popup-iklan .dismis {
            color: white;
            position: absolute;
            top: 10px;
            font-size: 20px;
            right: 10px;
            cursor: pointer;
            border-radius: 100%;
            width: 30px;
            text-align: center;
            height: auto;
            background-color: blue;
            box-shadow: black 10%;

        }

        .dismis:hover {
            transform: scale(1.0)
        }

        .popup-iklan .body .content img {
            width: 26em;
            border-radius: 10px
        }

        .bg {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -100px;

            background-color: rgba(0, 0, 0, 0.7);
            padding: 100em;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .popup-iklan {
                left: 45%;
            }

            .popup-iklan .dismis {
                right: -15px;


            }

            .popup-iklan .body {
                width: 120%;
            }

            .popup-iklan .body .content img {
                width: 100%;
                height: auto;
            }
        }
    </style>
    <script>
        function hideElements() {
            document.getElementById("iklan").style.display = "none";
            document.getElementById("iklan2").style.display = "none";
        }
    </script>
    {{-- banner iklan --}}
    <div class="grup-header fixed top-0 left-0 right-0 z-50 ">
        <div id="iklan" class="popup-iklan">

            <div class="body">
                <button onclick="hideElements()" style="border: none" class="dismis">
                    X
                </button>
                <a>
                    <div class="content">
                        <!--<img src="assets/img/iklan-1.jpeg" alt="">-->
                        <img src="{{ asset('assets/iklan/new-iklan.png') }}" alt="">
                    </div>
                </a>

            </div>
        </div>
        <div id="iklan2" class="bg"></div>
        <!-- Banner Ads -->
        <div class="flex justify-around w-full bg-[#173966] ">
            <img src="{{ asset('assets/Coming Soon.png') }}" class="w-[40em]" alt="">
            {{-- <div class="logo">
                <img src="{{asset('assets/logo-src.png')}}" width="100" alt="">
            </div>
            <div class="block text-center">
                <h1 class="text-white font-bold text-2xl inter">COMING SOON</h1>
                <h2 class="text-white">On August, 25 2024</h2>
            </div>
            <div class="logo">
                <img src="{{asset('assets/logo-src.png')}}" width="100" alt="">
            </div> --}}

        </div>

        <nav class="navbar justify-around bg-white items-center px-3 py-2 shadow-sm">
            <div class="flex items-center gap-10">
                <div class="logo flex items-center">
                    <a href="{{ url('/') }}">
                        <img class="logo-src" src="{{ asset('assets/logo-src.png') }}" width="100" alt="logo">
                    </a>
                </div>
                <ul class="hidden lg:flex justify-center items-center font-medium gap-14 inter text-[17px] text-black">
                    <li><a class="page-scroll" href="{{ url('/') }}">Beranda</a></li>
                    <li><a class="page-scroll" href="#competition">Perlombaan</a></li>
                    <li><a class="page-scroll" href="#directive">Petunjuk Teknis</a></li>
                    <li><a class="page-scroll" href="#galeri">Galeri</a></li>
                    <li><a class="page-scroll" href="#lokasi">Lokasi</a></li>
                </ul>
            </div>
            <div class="relative flex items-center gap-4">
                <button class="lg:hidden w-full" onclick="modalNav()">
                    <img class="w-5" src="{{ asset('assets/humburger.png') }}" alt="">
                </button>
                @auth
                    <ul class="navbar-nav lg:block hidden">
                        <li>
                            <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                                class="text-blue-500 font-bold bg-white border rounded-full text-sm px-4 py-2.5 text-center inline-flex items-center"
                                type="button">
                                Hello, {{ auth()->user()->name }}
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            {{-- dropdown menu --}}
                            <div id="dropdownInformation"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    <div>{{ auth()->user()->name }}</div>
                                    <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownInformationButton">
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                                    </li>
                                </ul>
                                <div class="py-2">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="POST">
                                        <button type="submit"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                @else
                    <div class="grup lg:block hidden">
                        <a href="{{ route('login') }}" style="text-decoration: none"
                            class="text-white no-underline rounded-full gradient-blue px-4 py-1">Masuk</a>
                        <a href="{{ route('register') }}" style="text-decoration: none"
                            class="text-black rounded-full gradient-yellow px-4 py-1">Register</a>
                    </div>
                @endauth
            </div>
        </nav>
    </div>


    <div id="modal-nav-bg" class="absolute lg:hidden hidden bg-modal-nav bg-black/40 w-full h-full z-50 -top-10"></div>


    <div id="modal-nav"
        class="lg:hidden hidden slide-top  fixed inset-x-0 bottom-0 h-[40em] rounded-t-[80px] z-50  bg-white shadow-md">
        <button onclick="deleteModal()"
            class="dismiss relative right-10 -bottom-10 w-full flex justify-end items-endr ">
            <?xml version="1.0" encoding="UTF-8"?>
            <svg width="30px" viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <title>ic_fluent_dismiss_28_regular</title>
                <desc>Created with Sketch.</desc>
                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="ic_fluent_dismiss_28_regular" fill="#212121" fill-rule="nonzero">
                        <path
                            d="M3.52499419,3.71761187 L3.61611652,3.61611652 C4.0717282,3.16050485 4.79154862,3.13013074 5.28238813,3.52499419 L5.38388348,3.61611652 L14,12.233 L22.6161165,3.61611652 C23.1042719,3.12796116 23.8957281,3.12796116 24.3838835,3.61611652 C24.8720388,4.10427189 24.8720388,4.89572811 24.3838835,5.38388348 L15.767,14 L24.3838835,22.6161165 C24.8394952,23.0717282 24.8698693,23.7915486 24.4750058,24.2823881 L24.3838835,24.3838835 C23.9282718,24.8394952 23.2084514,24.8698693 22.7176119,24.4750058 L22.6161165,24.3838835 L14,15.767 L5.38388348,24.3838835 C4.89572811,24.8720388 4.10427189,24.8720388 3.61611652,24.3838835 C3.12796116,23.8957281 3.12796116,23.1042719 3.61611652,22.6161165 L12.233,14 L3.61611652,5.38388348 C3.16050485,4.9282718 3.13013074,4.20845138 3.52499419,3.71761187 L3.61611652,3.61611652 L3.52499419,3.71761187 Z"
                            id="🎨-Color">

                        </path>
                    </g>
                </g>
            </svg>
        </button>
        <div class="flex justify-around items-center py-2">
            <ul
                class="lg:hidden relative -bottom-10 grid grid-cols-2 gap-4 md:grid-cols-4  font-medium  inter text-[17px] text-black">
                <li
                    class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2">
                    <a href="{{ url('/') }}" style="text-decoration:none">
                        <?xml version="1.0" encoding="utf-8"?>
                        <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.33537 7.87495C1.79491 9.00229 1.98463 10.3208 2.36407 12.9579L2.64284 14.8952C3.13025 18.2827 3.37396 19.9764 4.54903 20.9882C5.72409 22 7.44737 22 10.8939 22H13.1061C16.5526 22 18.2759 22 19.451 20.9882C20.626 19.9764 20.8697 18.2827 21.3572 14.8952L21.6359 12.9579C22.0154 10.3208 22.2051 9.00229 21.6646 7.87495C21.1242 6.7476 19.9738 6.06234 17.6731 4.69181L16.2882 3.86687C14.199 2.62229 13.1543 2 12 2C10.8457 2 9.80104 2.62229 7.71175 3.86687L6.32691 4.69181C4.02619 6.06234 2.87583 6.7476 2.33537 7.87495ZM13.45 16.5095C12.6422 15.6377 11.3581 15.6377 10.5503 16.5095C10.2688 16.8134 9.79427 16.8315 9.49041 16.55C9.18656 16.2684 9.16845 15.7939 9.44996 15.4901C10.8514 13.9775 13.1489 13.9775 14.5503 15.4901C14.8318 15.7939 14.8137 16.2684 14.5099 16.55C14.206 16.8315 13.7315 16.8134 13.45 16.5095ZM8.55029 14.3505C10.4626 12.2864 13.5376 12.2864 15.4499 14.3505C15.7315 14.6544 16.206 14.6725 16.5098 14.391C16.8137 14.1095 16.8318 13.6349 16.5503 13.3311C14.0443 10.6262 9.9559 10.6262 7.44995 13.3311C7.16844 13.6349 7.18655 14.1095 7.4904 14.391C7.79425 14.6725 8.26878 14.6544 8.55029 14.3505ZM17.4499 12.192C14.433 8.93571 9.56716 8.93571 6.55027 12.192C6.26876 12.4959 5.79423 12.514 5.49038 12.2325C5.18653 11.951 5.16842 11.4764 5.44993 11.1726C9.06046 7.27552 14.9397 7.27552 18.5503 11.1726C18.8318 11.4764 18.8137 11.951 18.5098 12.2325C18.206 12.514 17.7314 12.4959 17.4499 12.192Z"
                                fill="#1C274C" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="#competition" class="flex flex-col justify-center items-center  "
                        style="text-decoration:none">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.5 6.5L18.5 4.5M9.5 2.5H13.5M7.2 12.2143L9.2 10.5V16.5M19.5 13.5C19.5 17.9183 15.9183 21.5 11.5 21.5C7.08172 21.5 3.5 17.9183 3.5 13.5C3.5 9.08172 7.08172 5.5 11.5 5.5C15.9183 5.5 19.5 9.08172 19.5 13.5ZM13.7 16.5C12.8716 16.5 12.2 15.8284 12.2 15V12C12.2 11.1716 12.8716 10.5 13.7 10.5C14.5284 10.5 15.2 11.1716 15.2 12V15C15.2 15.8284 14.5284 16.5 13.7 16.5Z"
                                stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Perlombaan
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="#directive" class="flex flex-col gap-2 justify-center items-center"
                        style="text-decoration:none">
                        <?xml version="1.0" encoding="utf-8"?>
                        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg fill="#1C274C" width="60px" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>paper-roll</title>
                            <path
                                d="M0 32h20v-17.088q1.92 1.088 4 1.088 3.328 0 5.664-2.336t2.336-5.664-2.336-5.632-5.664-2.368h-16q-3.296 0-5.664 2.368t-2.336 5.632v24zM4 28v-20q0-1.632 1.184-2.816t2.816-1.184h9.12q-1.12 1.92-1.12 4v20h-12zM6.016 26.016h8v-2.016h-8v2.016zM6.016 20h8v-1.984h-8v1.984zM6.016 14.016h8v-2.016h-8v2.016zM6.016 8h8v-1.984h-8v1.984zM20 8q0-1.632 1.184-2.816t2.816-1.184 2.816 1.184 1.184 2.816-1.184 2.848-2.816 1.152-2.816-1.152-1.184-2.848z">
                            </path>
                        </svg>
                        Petunjuk Teknis
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="#galeri" class="flex flex-col gap-2 justify-center items-center  "
                        style="text-decoration:none">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="60px" fill="#1C274C" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#1C274C">
                            <g id="SVGRepo_bgCarrier" stroke-width="60px"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>image-picture</title>
                                <desc>Created with Sketch Beta.</desc>
                                <defs> </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                        transform="translate(-362.000000, -101.000000)" fill="#1C274C">
                                        <path
                                            d="M392,129 C392,130.104 391.104,131 390,131 L384.832,131 L377.464,123.535 L386,114.999 L392,120.999 L392,129 L392,129 Z M366,131 C364.896,131 364,130.104 364,129 L364,128.061 L371.945,120.945 L382.001,131 L366,131 L366,131 Z M370,105 C372.209,105 374,106.791 374,109 C374,111.209 372.209,113 370,113 C367.791,113 366,111.209 366,109 C366,106.791 367.791,105 370,105 L370,105 Z M390,101 L366,101 C363.791,101 362,102.791 362,105 L362,129 C362,131.209 363.791,133 366,133 L390,133 C392.209,133 394,131.209 394,129 L394,105 C394,102.791 392.209,101 390,101 L390,101 Z M370,111 C371.104,111 372,110.104 372,109 C372,107.896 371.104,107 370,107 C368.896,107 368,107.896 368,109 C368,110.104 368.896,111 370,111 L370,111 Z"
                                            id="image-picture" sketch:type="MSShapeGroup"> </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        Galeri
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="#lokasi" class="flex flex-col gap-2 justify-center items-center"
                        style="text-decoration:none">
                        <?xml version="1.0" encoding="UTF-8"?>
                        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="60px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>about</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="about-white" fill="#1C274C" transform="translate(42.666667, 42.666667)">
                                    <path
                                        d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51168 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.154987,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51168 331.154987,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.44,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.44,384 213.333333,384 Z M240.04672,128 C240.04672,143.46752 228.785067,154.666667 213.55008,154.666667 C197.698773,154.666667 186.713387,143.46752 186.713387,127.704107 C186.713387,112.5536 197.99616,101.333333 213.55008,101.333333 C228.785067,101.333333 240.04672,112.5536 240.04672,128 Z M192.04672,192 L234.713387,192 L234.713387,320 L192.04672,320 L192.04672,192 Z"
                                        id="Shape">

                                    </path>
                                </g>
                            </g>
                        </svg>
                        Lokasi
                    </a>
                </li>
            </ul>
        </div>

        @auth
            <ul class="relative flex  justify-center inset-x-0 -bottom-20">
                <li class="nav-item dropdown  px-5 py-2 bg-blue-700  rounded-2xl ">
                    <a class="dropdown-toggle text-white" role="button" data-toggle="dropdown" aria-expanded="false">
                        Hello, {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right absolute z-100">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="POST">
                            <button type="submit" class="dropdown-item show_confirm">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        @else
            <div class="relative flex  justify-center inset-x-0 -bottom-20 gap-3 ">
                <a href="{{ route('login') }}" style="text-decoration: none"
                    class="text-white no-underline rounded-full  gradient-blue px-5 py-2">Masuk</a>
                <a href="{{ route('register') }}" style="text-decoration: none"
                    class="text-black rounded-full  gradient-yellow px-5 py-2">Register</a>
            </div>
        @endauth

    </div>

    <script>
        function modalNav() {
            document.getElementById('modal-nav').classList.remove('hidden');
            document.getElementById('modal-nav-bg').classList.remove('hidden');
        }

        function deleteModal() {
            document.getElementById('modal-nav').classList.add('hidden')
            document.getElementById('modal-nav-bg').classList.add('hidden')
        }
    </script>

    {{ $slot }}

    </div>
    @include('components.panel.footer')

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: "Are you sure to logout ???",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes !!',
                confirmButtonColor: '#dc3545',
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>
