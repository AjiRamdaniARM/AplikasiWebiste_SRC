<x-panel.app>

    {{-- library internal --}}
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/Material
 Design-Webfont/5.3.45/css/materialdesignicons.min.css);
    </style>
    <script src="./node_modules/preline/dist/preline.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <style>
        .slide-top {
            -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940)
        }

        @-webkit-keyframes slide-top {
            0% {
                -webkit-transform: translateY(-10px);
                transform: translateY(-10px);
            }

            100% {
                -webkit-transform: translateY(20px);
                transform: translateY(20px);
            }
        }

        @keyframes slide-top {
            0% {
                -webkit-transform: translateY(-10px);
                transform: translateY(-10px);
            }

            100% {
                -webkit-transform: translateY(20px);
                transform: translateY(20px);
            }
        }

        :root {
            --vs-primary: 29 92 255;
        }

        /*Dialog Styles*/
        dialog {
            padding: 1rem 3rem;
            background: white;
            max-width: 400px;
            padding-top: 2rem;
            border-radius: 20px;
            border: 0;
            box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.1);
            -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
        }

        dialog::-webkit-backdrop {
            -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
            background: rgba(255, 255, 255, 0.4);
            z-index: 2;
            -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
        }

        dialog::backdrop {
            -webkit-animation: fadeIn 1s ease both;
            animation: fadeIn 1s ease both;
            background: rgba(255, 255, 255, 0.4);
            z-index: 2;
            -webkit-backdrop-filter: blur(20px);
            backdrop-filter: blur(20px);
        }

        dialog .x {
            filter: grayscale(1);
            border: none;
            background: none;
            position: absolute;
            top: 15px;
            right: 10px;
            transition: ease filter, transform 0.3s;
            cursor: pointer;
            transform-origin: center;
        }

        dialog .x:hover {
            filter: grayscale(0);
            transform: scale(1.1);
        }

        dialog h2 {
            font-weight: 600;
            font-size: 2rem;
            padding-bottom: 1rem;
        }

        dialog p {
            font-size: 1rem;
            line-height: 1.3rem;
            padding: 0.5rem 0;
        }

        dialog p a:visited {
            color: rgb(var(--vs-primary));
        }


        button.primary {
            display: inline-block;
            font-size: 0.8rem;
            color: #fff !important;
            background: rgb(var(--vs-primary)/100%);
            padding: 13px 25px;
            border-radius: 17px;
            transition: background-color 0.1s ease;
            box-sizing: border-box;
            transition: all 0.25s ease;
            border: 0;
            cursor: pointer;
            box-shadow: 0 10px 20px -10px rgb(var(--vs-primary)/50%);
        }

        button.primary:hover {
            box-shadow: 0 20px 20px -10px rgb(var(--vs-primary)/50%);
            transform: translateY(-5px);
        }

        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    {{-- modal message --}}

    @if (session()->has('message'))
        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="fixed overflow-y-auto overflow-x-hidden  top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full modal-show ">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-white border-black border-2">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between">
                        <button type="button"
                            class="end-2.5 text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <img src="{{ asset('assets/approved.gif') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- akhir modal message --}}
    <div id="team" class="section relative pt-20 pb-8 md:pt-16">
        <div class="container xl:max-w-6xl mx-auto px-4">
            <!-- section header -->
            <header class="text-center mx-auto mb-12">
                <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100">
                    <span class="font-light">Participants</span> Perlombaans
                </h2>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 100 60" style="margin: 0 auto;height: 35px;" xml:space="preserve">
                    <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                        style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                    <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary"
                        style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                    <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary"
                        style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                </svg>
            </header>
            <!-- end section header -->
            <!-- row -->
            <div class="flex flex-wrap flex-row -mx-4 justify-center">
                @if ($hasParticipants)
                    @foreach ($data as $datas)
                        <div class="flex-shrink max-w-full px-4 w-2/3 sm:w-1/2 md:w-5/12 lg:w-1/4 xl:px-6">
                            <div class="relative overflow-hidden bg-white dark:bg-gray-800 mb-12 hover-grayscale-0 wow fadeInUp rounded-2xl p-5"
                                data-wow-duration="1s"
                                style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                                <!-- team block -->
                                <div class="relative overflow-hidden px-6">
                                    <img src="{{ asset('assets/animasi2.gif') }}"
                                        class="max-w-full h-auto mx-auto rounded-full bg-gray-50 " alt="title image">
                                </div>
                                <div class="pt-6 text-center">
                                    <div class="flex flex-col justify-center items-center">
                                        <p class="text-lg leading-normal font-bold mb-1">{{ $datas->name }}</p>
                                        <p class=" leading-normal text-[13px] font-normal mb-1">Kelas :
                                            {{ $datas->kelas }}</p>
                                    </div>

                                    <p class="text-gray-500 leading-relaxed font-normal">{{ $datas->IdCard }}</p>
                                    <div class=" flex flex-col gap-2">
                                        <button data-modal-target="authentication-modal{{ $datas->id }}"
                                            data-modal-toggle="authentication-modal{{ $datas->id }}"
                                            class="relative bg-blue-500 text-white mt-2 hover:scale-105 transition-all hover:bg-blue-800 px-2 rounded-sm">Edit
                                            Data</button>
                                        @if ($datas->race && $datas->race->category && $datas->race->category->name == 'online')
                                            @if ($datas->projectonlines && $datas->projectonlines && $datas->projectonlines->status == 'sudah upload')
                                                <button type="button"
                                                    class="bg-green-500 text-white hover:scale-105 hover:bg-green-700 focus:bg-green-700 transition-all rounded-sm"
                                                    onclick="alert('Mohon Menunggu Tahap Selanjunya')">Sudah
                                                    Upload</button>
                                            @else
                                                <button type="button"
                                                    class="bg-yellow-500 hover:bg-yellow-300 hover:scale-105 transition-all text-black rounded-sm"
                                                    onclick="alert('dalam prosses perbaikan')">Upload
                                                    Projects</button>
                                                <!--<button type="button"-->
                                                <!--    class="bg-yellow-500 hover:bg-yellow-300 hover:scale-105 transition-all text-black rounded-sm"-->
                                                <!--    data-modal-target="authentication-modal-rules{{ $datas->id }}"-->
                                                <!--    data-modal-toggle="authentication-modal-rules{{ $datas->id }}">Upload-->
                                                <!--    Projects</button>-->
                                            @endif
                                        @endif

                                        @if ($datas->name == 'Aji Ramdani')
                                            <button type="button"
                                                class="bg-yellow-500 hover:bg-yellow-300 hover:scale-105 transition-all text-black rounded-sm"
                                                data-modal-target="authentication-modal-rules{{ $datas->id }}"
                                                data-modal-toggle="authentication-modal-rules{{ $datas->id }}">Upload
                                                Projects</button>
                                        @endif


                                        {{-- modal upload rules --}}
                                        <div id="authentication-modal-rules{{ $datas->id }}" tabindex="-1"
                                            aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 ">
                                                            {{ $datas->name }} <span>( {{ $datas->IdCard }} )</span>
                                                        </h3>
                                                        <button type="button"
                                                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                            data-modal-hide="authentication-modal-rules{{ $datas->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-4 md:p-5">
                                                        <div class="body py-2">
                                                            <h1 class="poppins-bold text-blue-500 text-2xl">
                                                                Pemberitahuan</h1>
                                                            <p>
                                                                Untuk mengunggah file proyek, pengguna diharuskan
                                                                memastikan file berformat ZIP atau RAR. Format ini
                                                                dipilih karena beberapa alasan penting. Pertama, format
                                                                ZIP dan RAR adalah format kompresi yang sangat efisien,
                                                                yang berarti file akan lebih kecil dan lebih cepat untuk
                                                                diunggah atau diunduh. Kedua, format ini memungkinkan
                                                                pengguna untuk menggabungkan banyak file dan folder
                                                                menjadi satu file arsip, membuat pengelolaan dan
                                                                distribusi file proyek menjadi lebih mudah dan teratur
                                                            </p>
                                                        </div>

                                                        <form action="{{ url('particpants/upload/' . $datas->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-blue-800">Lanjutkan</button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- akhir modal rules --}}
                                    </div>




                                    <div id="authentication-modal{{ $datas->id }}" tabindex="-1"
                                        aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative rounded-lg shadow bg-white">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-black">
                                                    <h3 class="text-xl font-bold text-black ">
                                                        Edit Participants {{ $datas->name }}
                                                    </h3>
                                                    <button type="button"
                                                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="authentication-modal{{ $datas->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    <form class="space-y-4"
                                                        action="{{ url('particpants/' . $datas->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div>
                                                            <label for="email"
                                                                class="block mb-2 text-sm font-medium text-black">Nama
                                                                Peserta</label>
                                                            <input type="text" name="name"
                                                                value="{{ $datas->name }}"
                                                                class=" border  text-white bg-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                required />
                                                        </div>
                                                        <div>
                                                            <label for="password"
                                                                class="block mb-2 text-sm font-medium text-black">Kelas
                                                                Peserta</label>
                                                            <input type="text" name="kelas"
                                                                value="{{ $datas->kelas }}"
                                                                class=" border  text-white bg-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                required />
                                                        </div>
                                                        <button type="submit"
                                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
                                                            Data</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end team block -->
                        </div>
                    @endforeach
                @else
                    <div class="grup px-10">
                        <div class="flex justify-center gap-3 flex-col items-center">
                            <img src="{{ asset('assets/question.png') }}" width="300" alt="">
                            <h1 class="montserrat font-bold text-black">Ooops - Data Participants Belum Di input 500
                            </h1>
                            <button onclick="window.dialog.showModal();"
                                class="bg-blue-500 px-5 text-white rounded-sm py-2 hover:scale-105 transition-all hover:bg-blue-700">Input
                                Data Participants</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <dialog id="dialog">
            <h2 class="poppins-bold">Participants</h2>
            <div>

                <form action="{{ route('invoice.participants', ['id' => $getInvoice->invoice_id]) }}" method="POST"
                    class="flex flex-col justify-start items-center gap-5">
                    @csrf
                    <label for="price" class="block text-sm font-medium  text-gray-900">Daftarkan Peserta</label>
                    @php
                        $multiplier = $getInvoice->max_people;
                        $totalParticipants = $getInvoice->jumlah * $multiplier;
                    @endphp

                    @for ($i = 0; $i < $totalParticipants; $i++)
                        <div class="relative rounded-md">
                            <div class="flex shadow-md">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                    </svg>
                                </span>
                                <input type="text" name="invoice_id[]" hidden
                                    value="{{ $getInvoice->invoice_id }}" required>
                                <input type="text" name="race_id[]" hidden value="{{ $getInvoice->race_id }}"
                                    required>
                                <div class="group flex justify-center items-center gap-2">
                                    <input type="text" name="name[]" id="website-admin"
                                        class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                        placeholder="Nama Peserta {{ $i + 1 }} " required>
                                    <input type="text" name="kelas[]" id="website-admin"
                                        class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                        placeholder="Kelas Peserta {{ $i + 1 }} " required>
                                    <input type="text" name="id_user[]" id="website-admin"
                                        class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                        hidden value="{{ $user->id }}">
                                </div>
                            </div>
                        </div>
                    @endfor
                    <button class="bg-blue-500 w-full h-10 text-white font-bold rounded-2xl"
                        type="submit">Daftar</button>
                </form>
            </div>
            <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
        </dialog>

    </div>


</x-panel.app>
