<x-panel.app>

 @if($races->isEmpty())
 <div class="relative flex flex-wrap justify-center items-center  ">
    <img src="../../assets/animasi1.gif" alt="Descriptive Alt Text" class="mb-4 w-[40em]">
    <div class="grup">
        <h1 class="font-bold text-3xl inter text-black text-center">Anda belum memilik perlombaan
        </h1>
        <div class="text-center py-3">
            Silahkan untuk melakukan pembayaran perlombaan <a class="text-blue-500" href="{{url('/')}}">SRC.sukarobot.com</a>
        </div>
    </div>
</div>
  @else
   <div class="bg-waves absolute inset-0 w-[50em] lg:block hidden  lg:top-0 lg:w-full top-[60px] object-cover  -z-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ECECEC" fill-opacity="1" d="M0,256L34.3,245.3C68.6,235,137,213,206,213.3C274.3,213,343,235,411,218.7C480,203,549,149,617,154.7C685.7,160,754,224,823,256C891.4,288,960,288,1029,277.3C1097.1,267,1166,245,1234,234.7C1302.9,224,1371,224,1406,224L1440,224L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
        </svg>
    </div>
    <section class="section-container flex flex-col gap-12 py-12 2xl:py-16 max-w-screen-2xl mx-auto w-full px-3 sm:px-8 lg:px-16 xl:px-32">
            <div class="grid w-full grid-flow-row gap-x-0 gap-y-12 md:justify-items-center md:gap-6 lg:grid-cols-2">
                @foreach ($races as $race)
                @if ($race->status == 'paid')
                    <div class="flex max-w-2xl flex-col items-start gap-6 overflow-hidden">
                        <div class="flex h-[280px] w-full items-center justify-center overflow-hidden rounded-3xl bg-white md:h-[420px]">
                            <img src="{{ asset($race->image) }}" alt="" class="w-full">
                        </div>
                        <div class="flex flex-col items-start gap-5">
                            <p class="inline-flex items-center justify-start gap-2">
                                <span class="text-xs leading-none text-slate-400">{{ $race->slug }}</span>
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-700"></span>
                                <span class="text-xs leading-none text-slate-400">{{ $race->created_at }}</span>
                            </p>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-2xl text-black font-semibold">{{ $race->name }}</h3>
                            </div>
                            <div class="mb-1 flex justify-around items-center gap-5">
                                <div class="mb-1 flex items-center gap-3">
                                    <div class="relative box-content flex items-center justify-center overflow-hidden rounded-full h-8 w-8 border-2 border-white shadow-md">
                                        <img src="{{ asset('assets/profile.jpg') }}" alt="robot" class="aspect-square">
                                    </div>
                                    <div class="text-sm font-semibold leading-tight text-slate-950">Sukarobot Academy</div>
                                </div>
                                <button onclick="window.location.href='{{ $race->juknis_lomba }}'" class="button text-sm bg-blue-500 lg:px-10 px-2 text-white rounded-sm hover:bg-blue-700 py-1 hover:scale-105 transition-all">Juknis Lomba</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach


            </div>
        @endif
    </section>


</x-panel.app>
