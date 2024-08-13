<div class="flex flex-col md:flex-row">



    @if (session('success'))
        <div
            class="mr-6 md:w-1/2 w-full mt-8 py-2 flex-shrink-0 flex flex-col
        bg-green-400 rounded-lg text-white">

            <h3 class="flex items-center pt-1 pb-1 px-8 text-lg font-bold
            capitalize">
                <!-- Header -->
                <span> Voucher Diskon</span>
                <button class="ml-2">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                        0l-22.6-22.6c-9.4-9.4-9.4-24.6
                        0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6
                        0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136
                        136c9.5 9.4 9.5 24.6.1 34z"></path>
                    </svg>
                </button>
            </h3>

            <div class="flex flex-col p-5 items-center mt-12">
                <img class="w-96" src="{{ asset('assets/doneIlus.svg') }}" alt=" empty schedule" />

                <span class="font-bold mt-8">Anda sudah menambahkan 1 voucher untuk diskon perlombaan</span>

                <span class="text-black">
                    Hati - Hati dalam membuat sebuah voucher dan membagikannya
                </span>

                <button onclick="window.dialog.showModal();"
                    class="mt-3 bg-white text-black hover:scale-105 focus:scale-105 transition-all rounded-lg py-2 px-4">
                    Buat Voucher
                </button>

            </div>
        </div>
    @else
        <div class="mr-6 md:w-1/2 w-full mt-8 py-2 flex-shrink-0 flex flex-col
    bg-blue-400 rounded-lg text-white">

            <h3 class="flex items-center pt-1 pb-1 px-8 text-lg font-bold
        capitalize">
                <!-- Header -->
                <span> Voucher Diskon</span>
                <button class="ml-2">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                    0l-22.6-22.6c-9.4-9.4-9.4-24.6
                    0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6
                    0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136
                    136c9.5 9.4 9.5 24.6.1 34z"></path>
                    </svg>
                </button>
            </h3>

            <div class="flex flex-col p-5 items-center mt-12">
                <img class="w-96" src="{{ asset('assets/voucher.svg') }}" alt=" empty schedule" />

                <span class="font-bold mt-8">Buat voucher untuk diskon perlombaan</span>

                <span class="text-black">
                    Hati - Hati dalam membuat sebuah voucher dan membagikannya
                </span>

                <button onclick="window.dialog.showModal();"
                    class="mt-3 bg-white text-black hover:scale-105 focus:scale-105 transition-all rounded-lg py-2 px-4">
                    Buat Voucher
                </button>

            </div>
        </div>
    @endif


    <div
        class="mr-6 md:w-1/2 w-full mt-8 py-2 flex-shrink-0 flex flex-col bg-white
        dark:bg-gray-600 rounded-lg">
        <!-- Card list container -->

        <h3 class="flex items-center pt-1 pb-1  text-lg font-semibold
            capitalize dark:text-gray-300">
            <!-- Header -->
            <span class="text-blue-500 px-8">Daftar Voucher Diskon</span>
            <button class="ml-2">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 256 512">
                    <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9
                        0l-22.6-22.6c-9.4-9.4-9.4-24.6
                        0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6
                        0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136
                        136c9.5 9.4 9.5 24.6.1 34z"></path>
                </svg>
            </button>
        </h3>

        <div>
            <!-- List -->

            <ul class="pt-1 pb-2   px-3 overflow-y-auto h-[600px] ">

                @foreach ($voucher as $vouchers)
                 <li class="mt-2">
    <div class="px-4 py-4 sm:px-6 sm:py-6 md:px-8 md:py-8 bg-gray-200 rounded-lg">
        <span class="block text-sm sm:text-base text-gray-500">Status Kode: {{ $vouchers->status }}</span>

        <div class="flex items-center justify-between mt-2 sm:mt-3">
            <span class="block text-base sm:text-lg text-blue-500">Kode Voucher: {{ $vouchers->code }}</span>

            <div class="flex items-center mt-1 sm:mt-0">
                <svg class="h-5 w-5 fill-current text-gray-600 mr-1">
                    <path d="M14 12l-4-4v3H2v2h8v3m12-4a10 10 0 01-19.54 3h2.13a8 8 0 100-6H2.46A10 10 0 0122 12z"></path>
                </svg>
                <span class="text-sm sm:text-base">{{ $vouchers->diskon }}%</span>
            </div>
        </div>

        <div class="flex justify-between mt-2 sm:mt-3">
            <span class="block text-sm sm:text-base text-blue-500 font-semibold">Tanggal Kedaluarsa: {{ $vouchers->valid_from }} - {{ $vouchers->valid_until }}</span>
            <p class="text-sm sm:text-base text-gray-600">Diskon</p>
        </div>
    </div>
</li>

                @endforeach

            </ul>

        </div>

    </div>



</div>


{{-- model participants --}}
<dialog id="dialog">
    <form id="formId" action="{{ url('dashboard/voucher') }}" method="POST">
        @csrf
        <h2 class="poppins-bold">Buat Kode Voucher</h2>
        <div style="border: 2px solid #0080ff" class="block bg-white shadow-md rounded-2xl px-10 py-3 ">
            <h1 class="poppins-semibold text-start"> VOUCHER DISKON <span>

                </span></h1>
        </div>
        <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
            <h6 class=" text-2xl text-blue-800 font-bold">Code Voucher</h6>
            <input type="text" name="code" value="{{ $idVoucher }}" class="relative mt-2 rounded-xl" readonly
                required>
        </div>
        <div class="flex justify-between items-center p-2 relative mt-4 ">
            <h1 class="poppins-semibold text-1xl">Diskon</h1>
            <input type="number" name="diskon" style="border: 2px solid #b2b2b2"
                class="block bg-white relative  rounded-xl w-28 py-2 " />
        </div>

        <div class="relative max-w-sm p-2">
            <h1 class="poppins-semibold text-1xl">Tanggal Aktif</h1>
            <input id="datepicker-autohide" datepicker datepicker-autohide type="date" name="valid_from"
                class="block bg-white relative  rounded-xl w-full py-2 mt-2 " placeholder="Select date">
        </div>
        <div class="relative max-w-sm p-2">
            <h1 class="poppins-semibold text-1xl">Tanggal Kedaluarsa</h1>
            <input id="datepicker-autohide" datepicker datepicker-autohide type="date" name="valid_until"
                class="block bg-white relative  rounded-xl w-full py-2 mt-2 " placeholder="Select date">
        </div>


        <button type="submit"
            class="block bg-blue-400 relative mt-4 rounded-xl w-full py-3 text-white font-bold hover:bg-blue-300 ">
            Buat Voucher
        </button>

    </form>
    <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
</dialog>

{{-- akhir modal participants --}}
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
</script>
