<x-panel.app>


    {{-- library internal --}}
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/Material
 Design-Webfont/5.3.45/css/materialdesignicons.min.css);
    </style>
    <script src="./node_modules/preline/dist/preline.js"></script>
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

    <div class="p-1 lg:p-20 mx-auto py-8">

        @if (session()->has('message'))
            <div style="border: 1px solid #000"
                class="relative flex flex-col sm:flex-row sm:items-center bg-white  rounded-md py-4 pl-6 pr-8 gap-5 sm:pr-6 slide-top">
                <div class="flex gap-2">
                    <div class="text-green-500">
                        <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-bold text-black"> {{ session('message') }}</div>
                </div>
                <div class="text-sm ">Pembayaran Anda Berhasil. Anda dapat memasukkan dan melihat peserta lomba</div>
            </div>
        @endif

        <br>
        <div class="p-4 max-w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <div class="grup-tools">
                    <h1 class="poppins-bold text-4xl text-[#34364A]">Invoice Manage</h1>
                    <p class="rela">data pembayaran perlombaan anda</p>
                </div>
            </div>
            <div class="flow-root">
                <ul role="list " id="invoiceList" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($invoices as $invoice)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @if (session()->has('participants'))
                                    document.getElementById('dialog').showModal();
                                @endif
                            });
                        </script>

                        <dialog id="dialog">
                            <h2 class="poppins-bold">Participants</h2>
                            <div>

                                <form action="{{ route('invoice.participants', ['id' => $invoice->invoice_id]) }}"
                                    method="POST" class="flex flex-col justify-start items-center gap-5">
                                    @csrf
                                    <label for="price" class="block text-sm font-medium  text-gray-900">Daftarkan
                                        Peserta</label>
                                    @php
                                        $multiplier = $invoice->max_people;
                                        $totalParticipants = $invoice->jumlah * $multiplier;
                                    @endphp

                                    @for ($i = 0; $i < $totalParticipants; $i++)
                                        <div class="relative rounded-md">
                                            <div class="flex shadow-md">
                                                <span
                                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                                    </svg>
                                                </span>
                                                <input type="text" name="invoice_id[]" hidden
                                                    value="{{ $invoice->invoice_id }}" required>
                                                <input type="text" name="race_id[]" hidden
                                                    value="{{ $invoice->races_id }}" required>
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
                                    <button
                                        class="bg-blue-500 w-full h-10 text-white font-bold rounded-2xl">Daftar</button>
                                </form>
                            </div>
                            <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
                        </dialog>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <h1 class="text-lg font-bold text-gray-900 truncate dark:text-white py-2">
                                        @if ($invoice->id_seleksi == 1)
                                            {{ $invoice->name }} <span class="text-blue-500">SELEKSI 2</span>
                                        @else
                                            {{ $invoice->name }}
                                        @endif
                                    </h1>
                                    <div class="text-sm text-gray-500 truncate  dark:text-gray-400 py-2">
                                        @if ($invoice->status == 'unpaid')
                                            <span class="text-white p-1 bg-red-600 px-4 rounded-full">Belum Bayar</span>
                                        @elseif ($invoice->status == 'paid')
                                            <span class="text-white p-1 bg-green-600 px-4 rounded-full">Sudah
                                                Bayar</span>
                                        @else
                                            <span class="text-white p-1 bg-gray-600 px-4 rounded-full">Status Tidak
                                                Diketahui</span>
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="inline-flex flex-col items-center text-base font-bold text-gray-900 dark:text-white">
                                    Rp.
                                    <?php

                                    if ($invoice->diskon) {
                                        $data = $invoice->price * $invoice->jumlah * ((100 - $invoice->diskon) / 100);
                                    } else {
                                        $data = $invoice->price * $invoice->jumlah;
                                    }

                                    if ($invoice->id_seleksi == 1) {
                                        echo number_format($invoice->idr_seleksi, 2, ',', '.');
                                    } else {
                                        echo number_format($data, 2, ',', '.');
                                    }
                                    ?>

                                </div>
                            </div>
                            <div
                                class="bg-blue-500 flex flex-wrap justify-between items-center py-3 rounded-lg relative mt-3 px-5">
                                <p class="text-white font-bold ">{{ $invoice->created_at_formatted }}</p>
                                <div>
                                    <form id="payment-form"
                                        action="{{ route('participant.invoice.store', ['id' => $invoice->invoice_id]) }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="transaction_result" id="transaction-result">
                                        <input type="text" name="status" hidden value="paid">
                                        <!--<button type="submit" >d</button>-->
                                    </form>
                                    @if ($invoice->status == 'unpaid')
                                        @if ($data == 0)
                                            @if ($invoice->id_seleksi > 0)
                                                <button id="pay-buttonOnline{{ $invoice->invoices_name }}"
                                                    data-product-name="{{ $invoice->name }}"
                                                    class="text-black font-bold px-3 py-1 rounded-xl bg-green-300">
                                                    Bayar Sekarang
                                                </button>
                                                <form id="payment-form-online"
                                                    action="{{ route('seleksi.invoice.store', ['id' => $invoice->invoice_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="transaction_result"
                                                        id="transaction-result">
                                                    <input type="text" name="status" hidden value="paid">
                                                    <!--<button type="submit" >d</button>-->
                                                </form>
                                                <script type="text/javascript">
                                                    document.getElementById('pay-buttonOnline{{ $invoice->invoices_name }}').onclick = function() {
                                                        // SnapToken acquired from previous step
                                                        snap.pay('{{ $invoice->snap_token }}', {
                                                            // Optional
                                                            onSuccess: function(result) {
                                                                document.getElementById('transaction-result').value = JSON.stringify(result);
                                                                document.getElementById('payment-form-online').submit();
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
                                            @else
                                                <form id="payment-form"
                                                    action="{{ route('participant.invoice.store', ['id' => $invoice->invoice_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="transaction_result"
                                                        id="transaction-result">
                                                    <input type="text" name="status" hidden value="paid">
                                                    <button type="submit"
                                                        class="text-black font-bold px-3 py-1 rounded-xl bg-green-300">
                                                        Free Pendaftaran
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <button id="pay-button{{ $invoice->invoices_name }}"
                                                data-product-name="{{ $invoice->name }}"
                                                class="text-black font-bold px-3 py-1 rounded-xl bg-green-300">
                                                Bayar Sekarang
                                            </button>
                                        @endif
                                    @elseif ($invoice->status == 'paid')
                                        @if ($invoice->id_seleksi > 0)
                                            <a href="{{ route('dashboard') }}">
                                                <button class="text-black font-bold px-3 py-1 rounded-xl bg-green-300">
                                                    Cek Dashboard
                                                </button></a>
                                        @else
                                            <a href="{{ route('particpants.show', ['id' => $invoice->invoice_id]) }}">
                                                <button class="text-black font-bold px-3 py-1 rounded-xl bg-green-300">
                                                    Participants
                                                </button></a>
                                        @endif
                                    @endif
                                </div>
                                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
                                </script>
                                <script type="text/javascript">
                                    document.getElementById('pay-button{{ $invoice->invoices_name }}').onclick = function() {
                                        // SnapToken acquired from previous step
                                        snap.pay('{{ $invoice->snap_token }}', {
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

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-panel.app>
