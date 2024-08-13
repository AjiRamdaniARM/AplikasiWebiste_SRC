<x-home.app>

    {{-- library internal --}}
    <style>@import url(https://cdnjs.cloudflare.com/ajax/libs/Material
    Design-Webfont/5.3.45/css/materialdesignicons.min.css);</style>
    <script src="./node_modules/preline/dist/preline.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
    dialog {
        padding: 3rem 1rem;
        background: white;
        max-width: 400px;
        padding-top: 2rem;
        border-radius: 20px;
        border: 0;
        text-align: center;
        box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.1);
        -webkit-animation: fadeIn 1s ease both;
                animation: fadeIn 1s ease both;
      }</style>
    {{-- akhir library --}}



    <div class="w-full ">
        <div class="relative mt-10 lg:p-10 py-20 px-10">
            <div class="grup flex flex-wrap justify-center items-center gap-5">
                <div class="sub-grup-text">
                    <h1 style="line-height:60px" class="inter font-bold lg:w-96 text-[3em] text-black lg:text-[4em]">Sukabumi Robotik <span class="text-blue-500">Competition</span></h1>
                    <p class="py-2 lg:w-96">Lakukan Pembayaran dengan benar, kami selalu menjaga keamanan data anda</p>
                </div>
                <div class="sub-grup-image">
                    <img class="w-[30em] object-cover" src="{{asset('assets/robot2.png')}}" alt="robot png">
                </div>
            </div>
        </div>




        {{-- element card --}}
        <div class="container py-10">
            <div style=" border: 2px solid rgb(0, 85, 255);" class="w-full  max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
                <div class="md:flex items-center -mx-10">
                    <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                        <div class="relative">
                            <img src="{{ asset($data->image) }}" class="w-full relative z-10" alt="">
                            <div class="border-4 border-yellow-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-10">
                        <div class="mb-10">
                            <h1 class="font-bold uppercase text-2xl mb-5">{{$data->name}}</h1>
                           <p>Pingin lihat deskripsi dari lomba {{$data->name}} . silahkan untuk klik tombol ini  <button
                           data-modal-target="static-modal"
                           data-modal-toggle="static-modal"
                            class="font-bold text-blue-500"
                            type="button"
                            >DESKRIPSI</button>
                        </p>
                        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                        <h3 class="text-xl font-semibold  text-black">
                                            Deskripsi perlombaan
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent   rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center bg-gray-600 hover:text-white" data-modal-hide="static-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <p>{!! $data->description !!}</p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-600">
                                        <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none bg-blue-500 rounded-lg border border-gray-200 hover:bg-blue-800 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        </div>
                        <div>
                            <div class="inline-block align-bottom mr-5">
                                <span class="text-2xl leading-none align-baseline">Biaya.</span>
                                <span class="font-bold text-2xl lg:text-5xl leading-none align-baseline">{{ number_format($data->price, 2, ',', '.') }}</span>
                            </div>

                            <div class="inline-block align-bottom py-3">

                                @if ($data->category->name == 'online')
                                <button style="text-decoration: none" type="submit" onclick="window.dialogOnline.showModal();" class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold"><i class="mdi mdi-cart -ml-2 mr-2"></i> Free Pendaftaran Lomba</button>
                                     {{-- modal bayar online --}}
                                     <dialog id="dialogOnline">
                                        <form action="{{url('detail/online/'.$data->id)}}" id="myForm" method="POST">
                                        @csrf
                                            <h2 class="poppins-bold">Keranjang</h2>
                                            <div style="border: 2px solid #0080ff" class="block bg-white shadow-md rounded-2xl px-10 py-3 ">
                                                <h1 class="poppins-semibold text-start">{{ $data->name}} online <span>
                                                @if ($data->team == '0')
                                                    <h1>(Individu)</h1>
                                                    @else
                                                    <h1>(Team)</h1>
                                                @endif
                                                </span></h1>
                                            </div>
                                         <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
                                            <h6 class=" text-2xl text-blue-800 font-bold">Jumlah Pembelian</h6>
                                            <input type="number"  name="jumlah" class="relative mt-2 rounded-xl"  required>
                                         </div>
                                         <div style="border: 2px solid #b2b2b2" class="block bg-white relative mt-4 rounded-xl px-4 py-3 ">
                                            <div class="flex justify-between items-center">
                                                <h1 class="poppins-semibold">Harga</h1>
                                                <div class="poppins-semibold" >{{$data->price}}</div>
                                            </div>
                                        </div>
                                        <div  class="block bg-white relative mt-4 rounded-xl px-4 py-3 ">
                                            <div class="flex justify-between items-center">
                                                <h1 class="poppins-semibold">Total</h1>
                                                <div class="poppins-semibold" >Rp.{{$data->price}} </div>
                                            </div>
                                         </div>

                                            <input type="text" name="user" id="user" value="{{$user->id}}" hidden>
                                            <input type="text" id="id_race" name="races" value="{{$data->id}}" hidden>
                                        <button type="submit" class="block bg-blue-400 relative mt-4 rounded-xl w-full py-3 text-white font-bold hover:bg-blue-300 ">
                                            Bayar Sekarang
                                         </button>
                                        </form>
                                            <button onclick="window.dialogOffline.close();" aria-label="close" class="x">❌</button>
                                    </dialog>
                                @else
                                <button style="text-decoration: none" type="submit" onclick="window.dialog.showModal();" class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold"><i class="mdi mdi-cart -ml-2 mr-2"></i> Checkout Sekarang</button>
                                  {{-- modal bayar offline --}}
                                  <dialog id="dialog">
                                    <form action="{{url('detail/'.$data->id)}}" id="myForm" method="POST">
                                    @csrf
                                        <h2 class="poppins-bold">Keranjang</h2>
                                        <div style="border: 2px solid #0080ff" class="block bg-white shadow-md rounded-2xl px-10 py-3 ">
                                            <h1 class="poppins-semibold text-start">{{ $data->name}} <span>
                                            @if ($data->team == '0')
                                                <h1>(Individu)</h1>
                                                @else
                                                <h1>(Team)</h1>
                                            @endif
                                            </span></h1>
                                        </div>
                                    <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
                                        <h6 class=" text-2xl text-blue-800 font-bold">Jumlah Pembelian</h6>
                                        <input type="number" id="jumlah" name="jumlah" class="relative mt-2 rounded-xl"  required>
                                    </div>
                                    <div style="border: 2px solid #b2b2b2" class="block bg-white relative mt-4 rounded-xl px-4 py-3 ">
                                        <div class="flex justify-between items-center">
                                            <h1 class="poppins-semibold">Harga</h1>
                                            <div class="poppins-semibold" id="price">{{$data->price}}</div>
                                        </div>
                                    </div>
                                    <div  class="block bg-white relative mt-4 rounded-xl px-4 py-3 ">
                                        <div class="flex justify-between items-center">
                                            <h1 class="poppins-semibold">Total</h1>
                                            <div class="poppins-semibold" id="total">Rp. </div>
                                        </div>
                                    </div>

                                        <input type="text" name="user" id="user" value="{{$user->id}}" hidden>
                                        <input type="text" id="id_race" name="races" value="{{$data->id}}" hidden>
                                    <button type="submit" class="block bg-blue-400 relative mt-4 rounded-xl w-full py-3 text-white font-bold hover:bg-blue-300 ">
                                        Bayar Sekarang
                                    </button>
                                    </form>
                                <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
                            </dialog>
                                 {{-- modal bayar offline --}}
                                @endif








                                {{-- <form action="{{url('detail/'.$data->id)}}" id="checkout" method="POST">
                                    @csrf
                                    <input type="text" name="user" id="user" value="{{$user->id}}" hidden>
                                    <input type="text" id="id_race" name="races" value="{{$data->id}}" hidden>
                                    <button style="text-decoration: none"   type="submit" class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold"><i class="mdi mdi-cart -ml-2 mr-2"></i> Checkout Sekarang</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
          document.getElementById('myForm').addEventListener('submit', function(event) {
            var jumlah = document.getElementById('jumlah').value;
            if (jumlah === '' || jumlah <= 0) {
                event.preventDefault();
                alert('Nilai tidak boleh kosong atau 0.');
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const priceElement = document.getElementById('price');
    const jumlahInput = document.getElementById('jumlah');
    const totalElement = document.getElementById('total');

    const price = parseFloat(priceElement.innerText);

    jumlahInput.addEventListener('input', function () {
        const jumlah = parseFloat(jumlahInput.value);
        const total = price * jumlah;

        if (!isNaN(total)) {
            totalElement.innerText = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).replace('IDR', 'Rp'); // Mengganti IDR dengan Rp
        } else {
            totalElement.innerText = 'Rp 0';
        }
    });
});
    </script>

</x-home.app>

