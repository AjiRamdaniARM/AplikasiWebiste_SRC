  {{-- modal upload rules --}}
  <div id="authentication-modal-rules{{$data->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    {{$data->name}} <span>( {{$data->IdCard}} )</span>
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal-rules{{$data->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="body py-2">
                    <h1 class="poppins-bold text-blue-500 text-2xl">Pemberitahuan</h1>
                    <p>
                        Untuk mengunggah file proyek, pengguna diharuskan memastikan file berformat ZIP atau RAR. Format ini dipilih karena beberapa alasan penting. Pertama, format ZIP dan RAR adalah format kompresi yang sangat efisien, yang berarti file akan lebih kecil dan lebih cepat untuk diunggah atau diunduh. Kedua, format ini memungkinkan pengguna untuk menggabungkan banyak file dan folder menjadi satu file arsip, membuat pengelolaan dan distribusi file proyek menjadi lebih mudah dan teratur
                    </p>
                </div>

                <form action="{{url('particpants/upload/'.$data->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-blue-800">Lanjutkan</button>
                </form>


            </div>
        </div>
    </div>
</div>
{{-- akhir modal rules --}}
