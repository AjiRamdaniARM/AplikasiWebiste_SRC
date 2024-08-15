<x-home.app>
    <style>
        .slide-top {
            -webkit-animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: slide-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940)
        }

        @-webkit-keyframes slide-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            100% {
                -webkit-transform: translateY(-5px);
                transform: translateY(-5px);
            }
        }

        @keyframes slide-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            100% {
                -webkit-transform: translateY(-5px);
                transform: translateY(-5px);
            }
        }

        :root {
            --vs-primary: 29 92 255;
        }

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



    {{-- modal --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('participants'))
                document.getElementById('dialog').showModal();
            @endif
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('diskon'))
                var modalId = "{{ session('diskon') }}";
                var modal = document.getElementById(modalId);
                if (modal) {
                    window.location.href = '#' + modalId
                }
            @endif
        });
    </script>

    {{-- modal check diskon --}}
    @include('components.user.modalCheckDiskon')
    {{-- akhir modal chech diskon --}}



    {{-- model participants --}}
    <dialog id="dialog">
        <h2 class="poppins-bold">Participants</h2>
        <div>
            <form action="{{ route('payment.participants', ['id' => $invoice->id]) }}" method="POST"
                class="flex flex-col justify-start items-center gap-5">
                @csrf
                <label for="price" class="block text-sm font-medium  text-gray-900">Daftarkan Peserta</label>

                @php
                    $multiplier = $data->max_people;
                    $totalParticipants = $invoice->jumlah * $multiplier;
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
                            <input type="text" name="invoice_id[]" hidden value="{{ $invoice->id }}">
                            <input type="text" name="race_id[]" hidden value="{{ $data->id }}">
                            <div class="group flex justify-center items-center gap-2">
                                <input type="text" name="name[]" id="website-admin"
                                    class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="Nama Peserta {{ $i + 1 }} ">
                                <input type="text" name="kelas[]" id="website-admin"
                                    class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="Kelas Peserta {{ $i + 1 }} ">
                                <input type="text" name="id_user[]" id="website-admin"
                                    class="rounded-none rounded-e-lg bg-gray-50 border text-black focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    hidden value="{{ $user->id }}">
                            </div>
                        </div>
                    </div>
                @endfor
                <button class="bg-blue-500 w-full h-10 text-white font-bold rounded-2xl">Daftar</button>
            </form>
        </div>
        <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
    </dialog>

    {{-- akhir modal participants --}}

    <section class="bg-white py-8 relative mt-20 antialiased md:py-16">
        {{-- <button onclick="window.dialog.showModal();" aria-label="close" class="x">cubaa</button> --}}
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                {{-- alert payment succes --}}
                @if (session()->has('message'))
                    <div style="border: 1px solid #000"
                        class="relative flex flex-col sm:flex-row sm:items-center bg-white  rounded-md py-4 pl-6 pr-8 gap-5 sm:pr-6 slide-top">
                        <div class="flex gap-2">
                            <div class="text-green-500">
                                <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-sm font-bold text-black "> {{ session('message') }}</div>
                        </div>
                        <div class="text-sm ">Pembayaran Anda Berhasil. Anda dapat mengecek pembayaran anda di dashboard
                            invoice</div>
                    </div>
                @endif
                {{-- akhir alert payment succes --}}

                <div class="w-full py-3">
                    <h1 class="text-4xl font-bold inter text-[#121739]">Pembayaran</h1>
                    <p>Bayar dengan cepat dan pastinya aman</p>
                </div>
                <div class="mt-1 sm:mt-8 lg:flex lg:items-start lg:gap-12">

                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div class="space-y-4 lg:p-5 p-3 rounded-lg border  border-gray-700 bg-gray-900">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Nama Lomba</dt>
                                    <dd class="text-base font-medium text-white">{{ $data->name }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Harga Lomba</dt>
                                    <dd class="text-base font-medium text-green-500">
                                        Rp.{{ number_format($jumlahPrice, 2, ',', '.') }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Atas Nama</dt>
                                    <dd class="text-base font-medium text-white">{{ $user->name }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Nomor Telephone
                                    </dt>
                                    <dd class="text-base font-medium text-white">{{ $user->phone }}</dd>
                                </dl>
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-400">Tanggal Pembayaran</dt>
                                <p id="fileStatus" class="text-sm text-white ">{{ now()->toDateString() }}</p>


                            </dl>
                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-400">Status Pembayaran</dt>
                                <p id="fileStatus" class="text-sm  font-bold bg-black px-3 p-1 rounded-lg">
                                    @if ($invoice->status == 'pending')
                                        <span class="text-yellow-500">{{ $invoice->status }}</span>
                                    @elseif($invoice->status == 'unpaid')
                                        <span class="text-red-500">Unpaid</span>
                                    @elseif($invoice->status == 'paid')
                                        <span class="text-green-500">Paid</span>
                                    @endif

                                </p>
                            </dl>
                        </div>
                        <br>
                        @if ($jumlahPrice == 0)

                            <form id="payment-form" action="{{ url('payment/' . $data->id . '/' . $invoice->name) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="transaction_result" id="transaction-result">
                                <input type="text" name="status" hidden value="paid">
                                @if ($invoice->status == 'paid')
                                    <button type="button" onclick="alert('anda sudah bayar keranjang ini')"
                                        class="flex w-full items-center justify-center rounded-lg bg-yellow-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-yellow-800 focus:outline-none focus:ring-4  focus:ring-primary-300 transition-all hover:scale-105"
                                        id="pay-button">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                            </svg>
                                        </span> &nbsp; Anda Sudah bayar</button>
                                @else
                                    <button type="submit" onclick="alert('anda sudah bayar keranjang ini')"
                                        class="flex w-full items-center justify-center rounded-lg bg-green-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-primary-300 transition-all hover:scale-105"
                                        id="pay-button">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                            </svg>
                                        </span> &nbsp; Bayar Sekarang</button>
                                @endif

                            </form>
                        @else
                            <div class="flex flex-col md:flex-row gap-3">
                                <button onclick="window.dialogVoucher.showModal();"
                                    class="flex w-full items-center justify-center rounded-lg bg-blue-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-primary-300 transition-all hover:scale-105">
                                    <span>
                                        <svg width="20px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                                            fill="#ffffff">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <g id="Layer_2" data-name="Layer 2">
                                                    <g id="invisible_box" data-name="invisible box">
                                                        <rect width="48" height="48" fill="none" />
                                                    </g>
                                                    <g id="Layer_7" data-name="Layer 7">
                                                        <g>
                                                            <path
                                                                d="M43,7H38a2,2,0,0,0-1.4.6L34,10.2,31.4,7.6A2,2,0,0,0,30,7H5a2.9,2.9,0,0,0-3,3V38a2.9,2.9,0,0,0,3,3H30a2,2,0,0,0,1.4-.6L34,37.8l2.6,2.6A2,2,0,0,0,38,41h5a2.9,2.9,0,0,0,3-3V10A2.9,2.9,0,0,0,43,7ZM42,37H38.8l-3.4-3.4a1.9,1.9,0,0,0-2.8,0L29.2,37H6V11H29.2l3.4,3.4a1.9,1.9,0,0,0,2.8,0L38.8,11H42Z" />
                                                            <path
                                                                d="M34,17a2,2,0,0,0-2,2v2a2,2,0,0,0,4,0V19A2,2,0,0,0,34,17Z" />
                                                            <path
                                                                d="M34,25a2,2,0,0,0-2,2v2a2,2,0,0,0,4,0V27A2,2,0,0,0,34,25Z" />
                                                            <circle cx="14" cy="20" r="2" />
                                                            <circle cx="22" cy="28" r="2" />
                                                            <path
                                                                d="M21.6,17.6l-10,10a1.9,1.9,0,0,0,0,2.8,1.9,1.9,0,0,0,2.8,0l10-10a2,2,0,0,0-2.8-2.8Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>

                                        </svg>
                                    </span> &nbsp; Punya Kode Voucher ?</button>
                                @include('components.user.modalVoucher')
                                <br>
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-lg bg-green-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-primary-300 transition-all hover:scale-105"
                                    id="pay-button">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                    </span> &nbsp; Bayar Sekarang</button>
                            </div>

                        @endif

                        <div class="mt-6 flex flex-wrap items-center justify-center gap-10">
                            <img class="hidden h-[60px] w-auto dark:flex"
                                src="{{ url('https://sukarobot.com/assets/img/Untitled-2.png') }}" alt="" />
                        </div>
                    </div>
                </div>

                <p class="mt-6 text-center text-gray-500 dark:text-gray-400 sm:mt-8 lg:text-left">
                    Payment processed by <a href="#"
                        class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">PT Suka
                        Teknologi Global</a> for <a href="#"
                        class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Src
                        Sukabumi</a>

                </p>
            </div>
        </div>
    </section>

    {{-- modal --}}
    <div id="qr" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative  rounded-lg shadow ">
                <div class="p-4 md:p-5 space-y-4 flex justify-center items-center">
                    <img class="w-80"
                        src="https://static.vecteezy.com/system/resources/previews/002/557/391/original/qr-code-for-scanning-free-vector.jpg"
                        alt="kode Qr">

                </div>
                <div
                    class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="downloadImage()" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Download</button>
                    <button data-modal-hide="qr" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Batal</button>
                </div>
            </div>
        </div>
    </div>


    <form id="payment-form" action="{{ url('payment/' . $data->id . '/' . $invoice->name) }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_result" id="transaction-result">
        <input type="text" name="status" hidden value="paid">
    </form>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @section('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
        </script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('{{ $snapToken }}', {
                    // Optional
                    onSuccess: function(result) {
                        document.getElementById('transaction-result').value = JSON.stringify(result);
                        document.getElementById('payment-form').submit();
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            };
        </script>
    @endsection

</x-home.app>


{{-- backup --}}

{{-- <script>
        function downloadImage() {
            const imageUrl = 'https://static.vecteezy.com/system/resources/previews/002/557/391/original/qr-code-for-scanning-free-vector.jpg';
            const fileName = 'SukarobotAcademy-BSI.jpg';
            const anchor = document.createElement('a');
            anchor.href = imageUrl;
            anchor.download = fileName;
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        }
      </script> --}}
{{-- <form action="{{url('payment/'.$data->id.'/'.$invoice->name)}}" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="mb-6 grid grid-cols-2 gap-4">
                  <div class="col-span-2 sm:col-span-1">
                    <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kode Pembelian</label>
                    <div type="text" id="full_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-white focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" >{{$invoice->name}}</div>
                  </div>

                  <div class="col-span-2 sm:col-span-1">
                    <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nomor Rekening ( Sukarobot Academy ) </label>
                    <div type="text" class=" w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-white focus:border-primary-500 focus:ring-primary-500  dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 flex justify-between" ><span id="copyText">7225018237</span>
                        <a type="button" style="text-decoration:none" class="font-bold text-end"  onclick="copyToClipboard()">Salin</a>
                    </div>
                    <script>
                        function copyToClipboard() {
                            var copyText = document.getElementById("copyText");
                            var textarea = document.createElement("textarea");
                            textarea.value = copyText.textContent;
                            document.body.appendChild(textarea);
                            textarea.select();
                            document.execCommand("copy");
                            document.body.removeChild(textarea);

                            /* Memberikan umpan balik atau pemberitahuan */
                            alert("Teks berhasil disalin: " + copyText.textContent);
                        }
                    </script>
                  </div>

                  <div>
                    <label for="card-expiration-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Masa Berlaku </label>
                    <div class="relative">
                      <div  id="card-expiration-input" type="text" class="block w-full rounded-lg border p-2.5  text-sm  bg-[#374151] text-white" >24 Jam</div>
                    </div>
                  </div>
                  <div>
                    <label for="cvv-input" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                      Tanggal Pembelian
                    </label>
                    <div class="relative">
                        <div type="number" id="cvv-input" aria-describedby="helper-text-explanation" class="block w-full rounded-lg border border-gray-300  p-2.5 text-sm text-white focus:border-primary-500 bg-[#374151] " >{{ now()->toDateString() }}</div>
                        <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center mr-3 ps-35">
                          <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                              fill-rule="evenodd"
                              d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </div>
                  </div>
                    </div>

                  <div class="col-span-2 sm:col-span-1">
                    <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">QR Rekening Sukarobot Academy</label>
                    <button type="text" data-modal-target="qr" data-modal-toggle="qr" class="block w-full text-start rounded-lg  bg-yellow-500 p-2.5 text-sm text-white focus:border-primary-500 " style="border: 1px solid #000">View QR</button>
                  </div>

                  <div class="col-span-2 sm:col-span-1">
                    <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Upload Bukti Pembayaran</label>
                    <input type="file" name="image" id="fileInput" class="hidden" required>
                      <div id="file" class="block w-full text-start rounded-lg  bg-blue-500 p-2.5 text-sm text-white focus:border-primary-500 " style="border: 1px solid #000" >Upload Bukti</div>
                  </div>
                  <script>
                          document.addEventListener('DOMContentLoaded', function() {
                            const fileInput = document.getElementById('fileInput');
                            const fileButton = document.getElementById('file');
                            const fileStatus = document.getElementById('fileStatus');

                        fileButton.addEventListener('click', function() {
                            fileInput.click();
                        });

                        fileInput.addEventListener('change', function() {
                            if (fileInput.files.length > 0) {
                                const fileName = fileInput.files[0].name;
                                fileStatus.textContent = `Sudah Upload`;
                                fileStatus.classList.add('text-green-600');
                            } else {
                                fileStatus.textContent = 'Belum Upload';
                                fileStatus.classList.add('text-red-600');
                            }
                        });
                });
                    </script>
                </div>

                <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-green-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-primary-300 " id="pay-button">Bayar Sekarang</button>
            </form> --}}
