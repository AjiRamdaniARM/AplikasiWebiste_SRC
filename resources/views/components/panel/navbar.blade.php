<nav class="navbar justify-around bg-white items-center  top-0 left-0 right-0 z-50 p-3 shadow-md ">
    <div class="flex items-center gap-10">
        <div class="logo flex items-center">
            <a href="{{ url('/') }}">
                <img class="logo-src" src="{{ asset('assets/logo-src.png') }}" width="90" alt="logo">
            </a>
        </div>
        <ul class="hidden lg:flex justify-center items-center font-medium gap-14 inter text-[17px] text-black">
            <li><a style="text-decoration:none"
                    class="page-scroll  hover:font-bold {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white px-3 rounded-sm ' : '' }}"
                    href="{{ route('dashboard') }}">Dashboard</a></li>
            @role('admin')
                <li><a class="{{ request()->routeIs('invoice.index') ? 'bg-blue-500 text-white px-3 rounded-sm ' : '' }}"
                        style="text-decoration: none" href="{{ route('invoice.index') }}">Invoice</a></li>
                <div class="relative">
                    <button id="dropdownButton" class="px-4 py-2"> Directive & Faqs </button>
                    {{-- dropdownmenu --}}
                    <ul id="dropdownMenu"
                        class="absolute hidden mt-2 bg-white border border-gray-200 rounded shadow-lg w-48">
                        <li>
                            <a href="{{ route('directive.index') }}"
                                class="{{ request()->routeIs('directive.index') ? 'bg-blue-500 text-white px-3 rounded-sm transition-all' : '' }} block px-4 py-2  hover:bg-gray-200">
                                Directive
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq.index') }}"
                                class="block px-4 py-2  hover:bg-gray-200 {{ request()->routeIs('faq.index') ? 'bg-blue-500 text-white px-3 rounded-sm transition-all' : '' }}">
                                FAQs
                            </a>
                        </li>
                    </ul>
                    {{-- akhir dropdownmenu --}}
                </div>
                <li><a class="{{ request()->routeIs('organized.index') ? 'bg-blue-500 text-white px-3 rounded-sm' : '' }}"
                        style="text-decoration: none" href="{{ route('organized.index') }}">Organize</a></li>
                <li><a class="{{ request()->routeIs('participant.show.admin') ? 'bg-blue-500 text-white px-3 rounded-sm' : '' }}"
                        style="text-decoration: none" href="{{ route('participant.show.admin') }}">Participants</a></li>
                <li><a class="{{ request()->routeIs('race.index') ? 'bg-blue-500 text-white px-3 rounded-sm' : '' }}"
                        style="text-decoration: none" href="{{ route('race.index') }}">Perlombaan</a></li>
            @endrole
            @role('participant')
                <li><a style="text-decoration:none" class="page-scroll hover:font-bold"
                        href="{{ route('participant.invoice.index') }}">Invoice</a></li>
                <li><a style="text-decoration:none" class="page-scroll hover:font-bold"
                        href="{{ route('participant.show.index') }}">Participant</a></li>
                <li><a style="text-decoration:none" class="page-scroll hover:font-bold"
                        href="{{ route('participant.race.index') }}">Perlombaan</a></li>
                <li><a style="text-decoration:none" class="page-scroll hover:font-bold"
                        href="{{ url('jadwal') }}">Jadwal</a></li>
                <li><a style="text-decoration:none" class="page-scroll hover:font-bold"
                        href="{{ url('/certificate') }}">Sertifikate</a></li>
            @endrole
        </ul>
    </div>
    <div class="relative flex items-center gap-4">
        <button class="lg:hidden w-full hover:scale-125 " onclick="modalNav()">
            <img class="w-5" src="{{ asset('assets/humburger.png') }}" alt="">
        </button>
        @auth
            <ul class="navbar-nav lg:block hidden ">
                <li>
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="text-blue-500 font-bold bg-white border rounded-full text-sm px-4 py-2.5 text-center inline-flex items-center "
                        type="button"> Hello, {{ auth()->user()->name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    {{-- dropdown menu --}}
                    <div id="dropdownInformation"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div> {{ auth()->user()->name }}</div>
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
                    class="text-white no-underline rounded-full  gradient-blue px-4 py-1">Masuk</a>
                <a href="{{ route('register') }}" style="text-decoration: none"
                    class="text-black rounded-full  gradient-yellow px-4 py-1">Register</a>
            </div>

        @endauth
    </div>
</nav>

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
</style>

<div id="modal-nav-bg" class="absolute  lg:hidden hidden bg-modal-nav -top-10 bg-black/40  w-full h-full z-50"></div>
<div id="modal-nav"
    class="lg:hidden hidden slide-top  fixed inset-x-0 bottom-0 h-[40em] rounded-t-[50px] z-50  bg-white shadow-md">
    <button onclick="deleteModal()" class="dismiss relative right-10 -bottom-10 w-full flex justify-end items-endr ">
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
    @auth
        <ul class="relative flex mb-5  justify-center inset-x-0 -bottom-20">
            <li class="nav-item dropdown  px-5 py-2 bg-blue-700  rounded-2xl ">
                <a class="dropdown-toggle text-white" role="button" data-toggle="dropdown" aria-expanded="false">
                    Hello, {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
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
                class="text-white no-underline rounded-full  gradient-blue px-4 py-1">Masuk</a>
            <a href="{{ route('register') }}" style="text-decoration: none"
                class="text-black rounded-full  gradient-yellow px-4 py-1">Register</a>
        </div>
    @endauth
    <div class="flex justify-around items-center py-2">
        <ul
            class="lg:hidden relative -bottom-10 grid grid-cols-2 gap-4 md:grid-cols-4  font-medium  inter text-[17px] text-black">
            <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                    class="flex flex-col justify-center items-center" href="{{ url('dashboard') }}">
                    <?xml version="1.0" encoding="utf-8"?>
                    <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.33537 7.87495C1.79491 9.00229 1.98463 10.3208 2.36407 12.9579L2.64284 14.8952C3.13025 18.2827 3.37396 19.9764 4.54903 20.9882C5.72409 22 7.44737 22 10.8939 22H13.1061C16.5526 22 18.2759 22 19.451 20.9882C20.626 19.9764 20.8697 18.2827 21.3572 14.8952L21.6359 12.9579C22.0154 10.3208 22.2051 9.00229 21.6646 7.87495C21.1242 6.7476 19.9738 6.06234 17.6731 4.69181L16.2882 3.86687C14.199 2.62229 13.1543 2 12 2C10.8457 2 9.80104 2.62229 7.71175 3.86687L6.32691 4.69181C4.02619 6.06234 2.87583 6.7476 2.33537 7.87495ZM13.45 16.5095C12.6422 15.6377 11.3581 15.6377 10.5503 16.5095C10.2688 16.8134 9.79427 16.8315 9.49041 16.55C9.18656 16.2684 9.16845 15.7939 9.44996 15.4901C10.8514 13.9775 13.1489 13.9775 14.5503 15.4901C14.8318 15.7939 14.8137 16.2684 14.5099 16.55C14.206 16.8315 13.7315 16.8134 13.45 16.5095ZM8.55029 14.3505C10.4626 12.2864 13.5376 12.2864 15.4499 14.3505C15.7315 14.6544 16.206 14.6725 16.5098 14.391C16.8137 14.1095 16.8318 13.6349 16.5503 13.3311C14.0443 10.6262 9.9559 10.6262 7.44995 13.3311C7.16844 13.6349 7.18655 14.1095 7.4904 14.391C7.79425 14.6725 8.26878 14.6544 8.55029 14.3505ZM17.4499 12.192C14.433 8.93571 9.56716 8.93571 6.55027 12.192C6.26876 12.4959 5.79423 12.514 5.49038 12.2325C5.18653 11.951 5.16842 11.4764 5.44993 11.1726C9.06046 7.27552 14.9397 7.27552 18.5503 11.1726C18.8318 11.4764 18.8137 11.951 18.5098 12.2325C18.206 12.514 17.7314 12.4959 17.4499 12.192Z"
                            fill="#1C274C" />
                    </svg>
                    Dashboard
                </a>
            </li>
            @role('admin')
                <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                        class="flex flex-col justify-center items-center" href="{{ route('invoice.index') }}">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 14H17M14 10H17M9 9.5V8.5M9 9.5H11.0001M9 9.5C7.20116 9.49996 7.00185 9.93222 7.0001 10.8325C6.99834 11.7328 7.00009 12 9.00009 12C11.0001 12 11.0001 12.2055 11.0001 13.1667C11.0001 13.889 11.0001 14.5 9.00009 14.5M9.00009 14.5L9 15.5M9.00009 14.5H7.0001M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z"
                                stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Inovice
                    </a>
                </li>
                <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                        class="flex flex-col justify-center items-center" href="{{ route('directive.index') }}">
                        <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 18V12M12 12L14 14M12 12L10 14M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V9M13 3L19 9M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19"
                                stroke="#1C274C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Directive</a>
                </li>
                <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                        class="flex flex-col justify-center items-center" href="{{ route('organized.index') }}">
                        <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" viewBox="0 0 32 32"
                            xml:space="preserve">
                            <style type="text/css">
                                .feather_een {
                                    fill: #1C274Cx;
                                }
                            </style>
                            <path class="feather_een"
                                d="M10,19H4c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1v-7
                            C11,19.448,10.552,19,10,19z M10,27H4v-7h6V27z M10,11H4c-0.552,0-1,0.448-1,1v5c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1v-5
                            C11,11.448,10.552,11,10,11z M10,17H4v-5h6V17z M19,4h-6c-0.552,0-1,0.448-1,1v8c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1V5
                            C20,4.448,19.552,4,19,4z M19,13h-6V5h6V13z M19,15h-6c-0.552,0-1,0.448-1,1v4c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1v-4
                            C20,15.448,19.552,15,19,15z M19,20h-6v-4h6V20z M28,20h-6c-0.552,0-1,0.448-1,1v6c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1v-6
                            C29,20.448,28.552,20,28,20z M28,27h-6v-6h6V27z M28,4h-6c-0.552,0-1,0.448-1,1v5c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1V5
                            C29,4.448,28.552,4,28,4z M28,10h-6V5h6V10z M11,4.5C11,4.776,10.776,5,10.5,5h-7C3.224,5,3,4.776,3,4.5S3.224,4,3.5,4h7
                            C10.776,4,11,4.224,11,4.5z M11,6.5C11,6.776,10.776,7,10.5,7h-7C3.224,7,3,6.776,3,6.5S3.224,6,3.5,6h7C10.776,6,11,6.224,11,6.5z
                            M11,8.5C11,8.776,10.776,9,10.5,9h-7C3.224,9,3,8.776,3,8.5S3.224,8,3.5,8h7C10.776,8,11,8.224,11,8.5z M20,23.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C19.776,23,20,23.224,20,23.5z M20,25.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C19.776,25,20,25.224,20,25.5z M20,27.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C19.776,27,20,27.224,20,27.5z M29,13.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C28.776,13,29,13.224,29,13.5z M29,15.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C28.776,15,29,15.224,29,15.5z M29,17.5
                            c0,0.276-0.224,0.5-0.5,0.5h-7c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h7C28.776,17,29,17.224,29,17.5z" />
                        </svg>
                        Organize</a>
                </li>
                <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                        class="flex flex-col justify-center items-center" href="{{ route('participant.show.admin') }}">
                        <img width="60px" src="{{ asset('assets/people-grup.svg') }}" alt="">
                        Participants</a>
                </li>
                <li class=" bg-white border-black flex flex-col justify-start items-center  rounded-lg text-black py-2"><a
                        class="flex flex-col justify-center items-center" href="{{ route('race.index') }}">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg width="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.9201 12.8959L19.2583 8.89003C19.533 8.5604 19.6704 8.39557 19.7681 8.21065C19.8548 8.0466 19.9183 7.87128 19.9567 7.68973C20 7.48508 20 7.27053 20 6.84144V6.2C20 5.07989 20 4.51984 19.782 4.09202C19.5903 3.71569 19.2843 3.40973 18.908 3.21799C18.4802 3 17.9201 3 16.8 3H7.2C6.0799 3 5.51984 3 5.09202 3.21799C4.71569 3.40973 4.40973 3.71569 4.21799 4.09202C4 4.51984 4 5.07989 4 6.2V6.84144C4 7.27053 4 7.48508 4.04328 7.68973C4.08168 7.87128 4.14515 8.0466 4.23188 8.21065C4.32964 8.39557 4.467 8.5604 4.74169 8.89003L8.07995 12.8959M13.4009 11.1989L19.3668 3.53988M10.5991 11.1989L4.6394 3.53414M6.55673 6H17.4505M17 16C17 18.7614 14.7614 21 12 21C9.23858 21 7 18.7614 7 16C7 13.2386 9.23858 11 12 11C14.7614 11 17 13.2386 17 16Z"
                                stroke="#1C274C" stroke-width="2" stroke-linejoin="round" />
                        </svg>
                        Perlombaan
                    </a>
                </li>
            @endrole
            @role('participant')
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="{{ route('participant.invoice.index') }}"
                        class="flex flex-col gap-2 justify-center items-center">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg fill="#1C274C" width="60px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12,1A11,11,0,1,0,23,12,11.013,11.013,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9.011,9.011,0,0,1,12,21Zm1-4.5v2H11v-2Zm3-7a3.984,3.984,0,0,1-1.5,3.122A3.862,3.862,0,0,0,13.063,15H11.031a5.813,5.813,0,0,1,2.219-3.936A2,2,0,0,0,13.1,7.832a2.057,2.057,0,0,0-2-.14A1.939,1.939,0,0,0,10,9.5,1,1,0,0,1,8,9.5V9.5a3.909,3.909,0,0,1,2.319-3.647,4.061,4.061,0,0,1,3.889.315A4,4,0,0,1,16,9.5Z" />
                        </svg>
                        Invoice
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="{{ route('participant.show.index') }}"
                        class="flex flex-col gap-2 justify-center items-center">
                        <img width="60px" src="{{ asset('assets/people-grup.svg') }}" alt="">
                        Participants
                    </a>
                </li>
                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="{{ route('participant.race.index') }}" class="flex flex-col justify-center items-center">
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
                    <a href="{{ url('jadwal') }}" class="flex flex-col justify-center items-center">
                        <img width="60px" src="{{ asset('assets/jadwal.svg') }}" alt="">
                        Jadwal
                    </a>
                </li>

                <li class=" bg-white border-black   rounded-lg text-black py-2">
                    <a href="{{ url('certificate') }}" class="flex flex-col gap-2 justify-center items-center">
                        <?xml version="1.0" encoding="utf-8"?>
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="45px" viewBox="0 0 23 32"
                            enable-background="new 0 0 23 32" xml:space="preserve">
                            <g>
                                <path fill="#1C274C"
                                    d="M11.5,4.727c-3.584,0-6.5,2.916-6.5,6.5s2.916,6.5,6.5,6.5s6.5-2.916,6.5-6.5S15.084,4.727,11.5,4.727z
                                    M11.5,16.727c-3.032,0-5.5-2.467-5.5-5.5s2.468-5.5,5.5-5.5s5.5,2.467,5.5,5.5S14.532,16.727,11.5,16.727z" />
                                <path fill="#1C274C"
                                    d="M21.617,7.226c0.22-0.921,0.116-1.727-0.306-2.349c-0.419-0.617-1.121-1.008-2.045-1.145
                                    c-0.277-1.862-1.624-2.797-3.493-2.35c-0.979-1.637-2.665-1.984-4.273-0.851C9.891-0.602,8.207-0.255,7.227,1.383
                                    C5.354,0.936,4.01,1.871,3.733,3.733C2.81,3.87,2.107,4.261,1.688,4.877C1.267,5.499,1.163,6.305,1.383,7.226
                                    C0.578,7.707,0.072,8.343-0.09,9.084c-0.168,0.769,0.047,1.598,0.622,2.416c-0.575,0.818-0.79,1.647-0.622,2.416
                                    c0.162,0.741,0.668,1.377,1.473,1.858c-0.22,0.921-0.116,1.727,0.306,2.349c0.419,0.617,1.121,1.008,2.045,1.145
                                    c0.276,1.862,1.621,2.796,3.493,2.35c0.982,1.638,2.666,1.985,4.273,0.851c0.638,0.449,1.275,0.677,1.899,0.677
                                    c0.95,0,1.782-0.539,2.374-1.528c1.869,0.446,3.216-0.488,3.493-2.35c0.924-0.137,1.626-0.528,2.045-1.145
                                    c0.422-0.622,0.525-1.427,0.306-2.349c0.805-0.481,1.311-1.117,1.473-1.858c0.168-0.769-0.047-1.598-0.622-2.416
                                    c0.575-0.818,0.79-1.647,0.622-2.416C22.928,8.343,22.422,7.707,21.617,7.226z M21.453,11.817c0.554,0.675,0.781,1.327,0.659,1.886
                                    c-0.148,0.681-0.791,1.123-1.304,1.373c-0.225,0.109-0.334,0.368-0.257,0.605c0.18,0.547,0.313,1.318-0.068,1.88
                                    c-0.379,0.558-1.135,0.717-1.702,0.751c-0.252,0.015-0.453,0.216-0.469,0.468c-0.055,0.889-0.384,1.949-1.642,1.949
                                    c-0.299,0-0.632-0.06-0.99-0.177c-0.239-0.08-0.496,0.031-0.605,0.256c-0.298,0.61-0.83,1.337-1.676,1.337
                                    c-0.483,0-1.03-0.239-1.582-0.692c-0.093-0.076-0.205-0.113-0.317-0.113s-0.225,0.038-0.317,0.113
                                    c-0.552,0.453-1.099,0.691-1.582,0.692c-0.846,0-1.378-0.727-1.676-1.337c-0.11-0.225-0.366-0.335-0.605-0.256
                                    c-0.358,0.118-0.691,0.177-0.99,0.177c-1.258,0-1.587-1.06-1.642-1.949c-0.016-0.252-0.217-0.453-0.469-0.468
                                    c-0.567-0.035-1.323-0.193-1.702-0.751c-0.382-0.562-0.248-1.333-0.068-1.88c0.077-0.237-0.032-0.496-0.257-0.605
                                    c-0.513-0.25-1.155-0.692-1.304-1.373c-0.122-0.559,0.105-1.211,0.659-1.886c0.151-0.184,0.151-0.45,0-0.634
                                    c-0.554-0.675-0.781-1.327-0.659-1.886c0.148-0.681,0.791-1.123,1.304-1.373c0.225-0.109,0.334-0.368,0.257-0.605
                                    c-0.18-0.547-0.313-1.318,0.068-1.88c0.379-0.558,1.135-0.717,1.702-0.751c0.252-0.015,0.453-0.216,0.469-0.468
                                    C4.742,3.33,5.071,2.271,6.329,2.271c0.299,0,0.632,0.06,0.99,0.177c0.238,0.077,0.495-0.032,0.605-0.256
                                    c0.298-0.61,0.83-1.337,1.676-1.337c0.483,0,1.03,0.239,1.582,0.692c0.186,0.151,0.449,0.151,0.635,0
                                    c0.552-0.453,1.099-0.692,1.582-0.692c0.846,0,1.378,0.727,1.676,1.337c0.109,0.224,0.366,0.333,0.605,0.256
                                    c0.358-0.118,0.691-0.177,0.99-0.177c1.258,0,1.587,1.06,1.642,1.949c0.016,0.252,0.217,0.453,0.469,0.468
                                    c0.567,0.035,1.323,0.193,1.702,0.751c0.382,0.562,0.248,1.333,0.068,1.88c-0.077,0.237,0.032,0.496,0.257,0.605
                                    c0.513,0.25,1.155,0.692,1.304,1.373c0.122,0.559-0.105,1.211-0.659,1.886C21.302,11.367,21.302,11.633,21.453,11.817z" />
                                <path fill="#1C274C" d="M5,23c-0.276,0-0.5,0.224-0.5,0.5v6.946c0,0.571,0.324,1.088,0.86,1.35
                                    c0.588,0.286,1.262,0.217,1.768-0.179l4.337-3.39l4.378,3.422c0.299,0.234,0.658,0.354,1.023,0.354
                                    c0.252,0,0.517-0.058,0.757-0.175c0.536-0.261,0.878-0.779,0.878-1.35V23.5c0-0.276-0.224-0.5-0.5-0.5s-0.5,0.224-0.5,0.5v6.977
                                    c0,0.272-0.224,0.406-0.317,0.452c-0.189,0.091-0.461,0.122-0.704-0.068L14.5,29.303V25.57c0-0.276-0.224-0.5-0.5-0.5
                                    s-0.5,0.224-0.5,0.5v2.952l-1.712-1.324c-0.18-0.142-0.438-0.142-0.617,0L9.5,28.501V25.57c0-0.276-0.224-0.5-0.5-0.5
                                    s-0.5,0.224-0.5,0.5v3.713l-1.985,1.546c-0.243,0.189-0.524,0.16-0.713,0.068C5.709,30.852,5.5,30.717,5.5,30.446V23.5
                                    C5.5,23.224,5.276,23,5,23z" />
                                <path fill="#1C274C"
                                    d="M14.297,8.355l-3.458,4.598l-2.15-2.206c-0.194-0.198-0.511-0.201-0.707-0.009
                                    c-0.198,0.193-0.202,0.509-0.01,0.707l2.558,2.513C10.624,14.056,10.753,14,10.888,14c0.011,0,0.021,0,0.032,0
                                    c0.146,0,0.279,0.027,0.367-0.089l3.809-5.01c0.166-0.221,0.122-0.507-0.099-0.672C14.778,8.062,14.463,8.133,14.297,8.355z" />
                            </g>
                        </svg>

                        Certificate
                    </a>
                </li>
            @endrole

        </ul>
    </div>



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

<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
        dropdownMenu.classList.toggle('transition');
        dropdownMenu.classList.toggle('duration-300');
    });

    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
