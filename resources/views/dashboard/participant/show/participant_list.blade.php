@if ($participants->isEmpty())
    <div class="w-full text-center py-6">
        <p class="text-black">Tidak ada data participants</p>
    </div>
@else


    @foreach ($participants as $participant)
        <div class="flex-shrink max-w-full w-[100%] sm:w-1/2 md:w-5/12 lg:w-1/4 xl:px-6">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 mb-12 hover-grayscale-0 wow fadeInUp rounded-2xl p-5" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">
                <!-- team block -->
                <div class="relative overflow-hidden px-6">
                    <img src="{{ asset('assets/animasi2.gif') }}" class="max-w-full h-auto mx-auto rounded-full bg-gray-50" alt="title image">
                </div>
                <div class="pt-6 text-center">
                    <p class="text-lg text-black leading-normal font-bold mb-1">{{ $participant->name }}</p>
                     <p class=" leading-normal text-[13px] font-normal mb-1">Kelas : {{$participant->kelas}}</p>
                                 <p class="text-gray-500 leading-relaxed font-normal">{{$participant->IdCard}}</p>
                 
                    <button  class="relative bg-blue-500 text-white mt-2 px-2 rounded-md">Edit Data</button>
                </div>
            </div>
            <!-- end team block -->
        </div>
    @endforeach
@endif
