<x-home.app>

    @include('components.style.css')


    {{-- component modal konsultasi --}}
    <dialog id="chat" class="overflow-hidden">
        <h1 class="poppins-normal text-center text-[15px] text-blue-800 font-bold">Punya pertanyaan atau kendala ?</h1>
        <h2 class="poppins-bold text-center">Konsultasi Sekarang</h2>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/c22a575e-db19-4db8-8519-421237b8098c/l6FtG2ZWUJ.json"
            background="transparent" speed="1" style="width: auto;" loop autoplay></dotlottie-player>
        <div class="contact flex flex-col gap-4">
            <button onclick="window.location.href='https://wa.link/a8nsc4'"
                class="border-2 border-black w-full h-10 rounded-2xl hover:scale-105 transition-all hover:bg-gray-200">
                Konsultasi Pembayaran
            </button>
            <button onclick="window.location.href='https://wa.link/jbqa41'"
                class="border-2 border-black w-full h-10 rounded-2xl hover:scale-105 transition-all hover:bg-gray-200">
                Konsultasi Perlombaan
            </button>
            <button onclick="window.location.href='https://wa.link/83qwpk'"
                class="border-2 border-black w-full h-10 rounded-2xl hover:scale-105 transition-all hover:bg-gray-200">
                Konsultasi Sistem Web
            </button>

        </div>
        <button onclick="window.chat.close();" aria-label="close" class="x">❌</button>
    </dialog>
    {{-- akhir component modal konsultasi --}}

    <div class="relative mt-10 "> <!-- Adjust the top margin to account for the fixed navbar height -->
        <div class="mx-auto">
            <div class="banner w-full h-96 relative">
                <div class="text absolute inset-0 m-5 flex flex-col lg:items-center justify-center lg:-bottom-10 z-10">
                    <img width="500" class="lg:block  hidden" src="{{ asset('assets/logo-src.png') }}"
                        alt="">
                    {{-- <h1 class="text-white text-4xl lg:block hidden lg:text-9xl font-bold bebas-neue-regular ">SRC</h1>
                    <h1 class="text-white text-4xl lg:hidden block lg:text-5xl font-bold bebas-neue-regular ">SUKABUMI ROBOTIC COMPETITION</h1> --}}
                    {{-- <p class="lg:text-center text-white lg:w-[60em] lg:block">SRC ( Sukabumi Robotic Competition ) merupakan salah satu salah satu ajang kompetisi robotik tingkat nasional <span class="hidden lg:block">yang di selenggarakan di sukabumi bekerjasama dengan Universitas nusa putra danhimpunan mahasiswa elektro universitas nusa putra guna menumbuhkan kecintaan anak-anak Indonesia terhadap teknologi.</span> </p> --}}
                    <!--<button onclick="window.location.href='#competition'" class="relative -bottom-20 lg:-bottom-10 text-black  lg:left-0 bg-yellow-400 border-black border-2 font-bold  hover:text-black border-2 px-10  py-2 hover:scale-105 transition-all shadow-md ">SEMUA KOMPETISI</button>-->
                </div>
                <img src="{{ asset('assets/banner2.jpg') }}" alt="banner"
                    class="banner-img w-full h-full relative top-15 object-center  object-cover lg:block hidden ">
                <img src="{{ asset('assets/Poster_Cover.jpg') }}" alt="banner"
                    class="banner-img w-full h-full  object-cover lg:hidden block ">
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-1">
        <!--    <div class="timeline container py-2 mt-3 ">-->
        <!--    <img src="{{ asset('assets/timeline.gif') }}" class="w-full rounded-lg" alt="">-->
        <!--</div>-->
        <div class="timeline container py-4 ">
            <img src="{{ asset('assets/timeline_update.gif') }}" class="w-full rounded-lg" alt="">
        </div>
    </div>


    <div class="px-4  mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="flex flex-col justify-between lg:flex-row">
            <div class="mb-12 lg:max-w-lg lg:pr-5 lg:mb-0">
                <div class="max-w-xl mb-6">
                    <h2
                        class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
                        Dukungan Penjabat Wali <br class="hidden md:block" />
                        <span class="text-blue-500">Kota Sukabumi</span>
                    </h2>
                    <p class="text-base text-gray-700 md:text-lg">
                        "SRC merupakan kompetisi tahunan yang luar biasa. Karena kegiatan ini bukan hanya tentang
                        teknologi dan robot, tetapi juga tentang kolaborasi, inovasi dan semangat untuk belajar. Selain
                        itu hadiah menarik dan penghargaan yang menanti untuk para pemenang…."
                    </p>
                </div>
                <hr class="mb-6 border-gray-300" />
                <div class="flex">
                    <a aria-label="Play Song" class="mr-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 text-white transition duration-300 transform rounded-full shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 hover:scale-110">
                            <img class="rounded-full w-full h-full object-cover"
                                src="https://upload.wikimedia.org/wikipedia/commons/f/f5/Kusmana_Hartadji.jpg"
                                alt="">
                        </div>

                    </a>
                    <div class="flex flex-col">
                        <div class="text-sm font-semibold">Drs. Bapak Kusmana Hartadji, M.M</div>
                        <div class="text-xs text-gray-700">Pj Walikota Sukabumi</div>
                    </div>
                </div>
            </div>

            <video class=" h-80 max-w-full border border-gray-200 rounded-lg dark:border-gray-700" controls>
                <source src="{{ asset('assets/video/Video Ucapan PJ Walikota Sukabumi.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </div>
    </div>


    <div class=" relative w-full mb-8  " style=" overflow:hidden ">
        <div id="competition" class="perlombaan container lg:p-[60px] p-4 lg:max-w-screen-xl">
            <div
                class="lg:text-[24px] text-[20px] relative mb-2 leading-normal font-extrabold tracking-tight text-gray-900">
                ⭐Perlombaan Robotik
            </div>

            <div class="content">
                <div class="grid lg:grid-cols-3 grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($data as $datas)
                        <div class="wrapper hover:scale-105 transition-all  antialiased text-gray-900">
                            <div>
                                <a href="{{ url('detail/' . $datas->id) }}" style="text-decoration: none">
                                    <img src="{{ $datas->image }}" alt=" random imgee"
                                        class="w-full object-cover object-center rounded-lg shadow-md">
                                </a>
                                <div class="relative px-4 -mt-16  ">
                                    <div class="bg-white p-6 rounded-lg shadow-lg">
                                        <div class="flex items-baseline">
                                            @if ($datas->category->name == 'online')
                                                <span
                                                    class="bg-yellow-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                                    {{ $datas->category->name }}
                                                </span>
                                            @else
                                                <span
                                                    class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                                    {{ $datas->category->name }}
                                                </span>
                                            @endif
                                            <div
                                                class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                                <!--{{ $datas->point }} poin  &bull; {{ $datas->session }} session-->
                                            </div>
                                        </div>

                                        <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">
                                            {{ $datas->name }}</h4>

                                        <div class="mt-1">
                                            <span class="text-gray-600 text-sm"> Biaya.</span>
                                            {{ number_format($datas->price, 2, ',', '.') }}

                                        </div>
                                        <div class="mt-4">
                                            <!--<span class="text-teal-600 text-md font-semibold">{{ $datas->max_people }} max people </span>-->
                                            <span class="text-sm text-gray-600">Masa Registrasi sampai <span
                                                    class="font-bold">{{ $datas->deadline_reg }}</span> </span>
                                            <span class="relative">
                                                <button onclick="window.location.href='{{ $datas->juknis_lomba }}'"
                                                    class="bg-blue-500 px-2 rounded text-white hover:bg-blue-800">Juknis
                                                    Lomba</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="konsultasi relative mt-5 container lg:p-[60px] p-4 lg:max-w-screen-xl ">
            <div class="bg-blue-800 rounded-2xl w-full  flex flex-wrap justify-center items-center">
                <div class="element ">
                    <img src="assets/element1.png" class="w-96" alt="konsultasi illustrasi">
                </div>
                <div class="grup lg:px-0 px-5">
                    <div class="text">
                        <h2 class="text-white font-normal">Masih punya pertanyaan?</h2>
                        <h3 class="text-white font-bold text-2xl">Tanyakan via chat ke Konsultan SRC Sukabumi</h3>
                    </div>
                    <div class="button relative mt-2 py-4  lg:block flex justify-center">
                        <button
                            class="text-black rounded-2xl font-bold gap-2  bg-white px-5 py-2 hover:scale-105 transition-all flex justify-center items-center lg:text-[17px] text-[12px]  "
                            onclick="window.chat.showModal()">
                            <img class="w-6"
                                src="https://roboguru-forum-cdn.ruangguru.com/image/ce8b0c17-4e1e-49f9-abf2-ba6c7eb3d192.png"
                                alt="icon-chat">
                            Chat Konsultan</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="directive" class="teknis relative py-5 container lg:p-[60px] p-4 lg:max-w-screen-xl ">
            <div class="lg:text-[24px] text-[20px] leading-normal font-extrabold tracking-tight text-gray-900">
                Petunjuk Teknis ⭐
            </div>
            <p class="lg:w-[700px]">File Petunjuk Teknis yang terlampir adalah untuk semua kategori. Silakan <span
                    class="text-black font-bold">download Petunjuk Teknis</span> dibawah untuk pertanyaan dapat
                menghubungi Panitia</p>
            <div class="content flex flex-wrap justify-center items-center">
                <img class="lg:w-[40%]" src="assets/element4.png" alt="illustrasi-robotik">
                <div class="grup flex flex-col gap-2">
                    @foreach ($item as $items)
                        <a href="{{ $items->link }}" style="text-decoration:none">
                            <div class="w-full bg-blue-500 text-white px-5 py-3 rounded-md">
                                {{ $items->name }}
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- faqs --}}
        @if (count($faqs) > 0)
            <div class="bg-gray-100 p-1 ">
                <div class="container  my-5 lg:max-w-screen-xl" id="faq" data-aos="fade-up">
                    <div class="text-center mb-16 ">
                        <p class="mt-4 text-sm leading-7 text-gray-500 font-regular">
                            F.A.Q
                        </p>
                        <h3 class="text-3xl sm:text-4xl leading-normal font-extrabold tracking-tight text-gray-900">
                            Frequently Asked <span class="text-blue-700">Questions</span>
                        </h3>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2">
                        <div class="col my-3 my-sm-0" data-aos-duration="1500" data-aos="fade-right">
                            <img src="{{ asset('assets/faqs.png') }}" alt="robot 3" class="img-fluid">
                        </div>
                        <div class="col my-3 my-sm-0 h-[40em] transition-all animate-none overflow-auto "
                            data-aos-duration="1500" data-aos="fade-left">
                            @foreach ($faqs as $key => $faq)
                                <div class="accordion mb-3 " id="accordion{{ $key }}">
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $key }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left px-0" type="button"
                                                    data-toggle="collapse" data-target="#collapse{{ $key }}"
                                                    aria-expanded="true" aria-controls="collapse{{ $key }}">
                                                    <strong>{{ $faq->question }}</strong>
                                                </button>
                                            </h2>
                                        </div>

                                        <div class="card-body">
                                            {!! $faq->answare !!}
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- end faqs --}}

        <link href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css" rel="stylesheet" />

        <script type="module">
            import KeenSlider from 'https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/+esm'

            const keenSlider = new KeenSlider(
                '#keen-slider', {
                    loop: true,
                    slides: {
                        origin: 'center',
                        perView: 1.25,
                        spacing: 16,
                    },
                    breakpoints: {
                        '(min-width: 1024px)': {
                            slides: {
                                origin: 'auto',
                                perView: 1.5,
                                spacing: 32,
                            },
                        },
                    },
                },
                []
            )

            const keenSliderPrevious = document.getElementById('keen-slider-previous')
            const keenSliderNext = document.getElementById('keen-slider-next')

            const keenSliderPreviousDesktop = document.getElementById('keen-slider-previous-desktop')
            const keenSliderNextDesktop = document.getElementById('keen-slider-next-desktop')

            keenSliderPrevious.addEventListener('click', () => keenSlider.prev())
            keenSliderNext.addEventListener('click', () => keenSlider.next())

            keenSliderPreviousDesktop.addEventListener('click', () => keenSlider.prev())
            keenSliderNextDesktop.addEventListener('click', () => keenSlider.next())
        </script>
        <div id="galeri"
            class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-center lg:gap-16 container lg:p-[60px] p-4 lg:max-w-screen-xl">
            <div class="max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
                <br>
                <br>
                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                <div class="bg-gradient-to-r lg:bg-gradient-to-b bg-transparent lg:from-blue-700 lg:to-blue-500"
                    style="padding: 10px; margin-left: 10px; border-radius: 10px;">
                    <dotlottie-player src="https://lottie.host/9d173aac-b801-4baf-9123-6c6d92f61074/JB6N2gudfp.json"
                        background="transparent" speed="1" style="width: 250px; height: 250px; margin: 0 auto;"
                        loop autoplay>
                    </dotlottie-player>
                    <h2
                        class="text-2xl lg:font-black font-black text-black tracking-tight lg:text-white sm:text-4xl mb-2">
                        GALLERY
                    </h2>
                    <p class="mt-0 mb-4 lg:text-white">
                        SUKABUMI ROBOTIK COMPETITION
                    </p>
                </div>
                <div class="hidden lg:mt-8 lg:flex lg:gap-4">
                </div>
            </div>

            <div class="-mx-6 lg:col-span-2 lg:mx-0">
                <div id="keen-slider" class="keen-slider">
                    <div class="keen-slider__slide">
                        <div>
                            <div class="flex gap-0.5 text-green-500">
                            </div>

                            <div class="mt-4">
                                <img src="{{ asset('assets/peserta4.jpg') }}" alt="">
                            </div>
                        </div>
                        </blockquote>
                    </div>
                    <div class="keen-slider__slide">
                        <div>
                            <div class="flex gap-0.5 text-green-500">
                            </div>

                            <div class="mt-4">
                                <img src="{{ asset('assets/peserta2.jpg') }}" alt="">
                            </div>
                        </div>
                        </blockquote>
                    </div>
                    <div class="keen-slider__slide">
                        <div>
                            <div class="flex gap-0.5 text-green-500">
                            </div>

                            <div class="mt-4">
                                <img src="{{ asset('assets/peserta5.jpg') }}" alt="">
                            </div>
                        </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="sponsor container lg:p-[60px] p-4 lg:max-w-screen-xl">
            <div class=" flex flex-col justify-center items-center">
                <h1 class="text-3xl sm:text-4xl leading-normal font-extrabold tracking-tight text-gray-900">Organizer &
                    Supporter Sukabumi <span class="text-blue-500">Robotik Competition</span></h1>
                <div class="grup py-5 flex flex-wrap gap-4 justify-center lg:justify-start">
                    @foreach ($organize as $organized)
                        <div class="flex items-center justify-center p-2 border border-gray-200">
                            <img class="lg:w-[200px] w-28" src="{{ $organized->image }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class=" flex flex-col justify-center items-center">
                <h1 class="text-3xl sm:text-4xl leading-normal font-extrabold tracking-tight text-gray-900">Media
                    Partner Sukabumi <span class="text-blue-500">Robotik Competition</span></h1>
                <div class="grup py-5 flex flex-wrap gap-4 justify-center lg:justify-start">

                    @foreach ($mediapartner as $organized)
                        <div class="flex items-center justify-center p-2 border border-gray-200">
                            <img class="max-w-52 h-auto" src="{{ $organized->image }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class=" flex flex-col justify-center items-center">
                <h1 class="text-3xl sm:text-4xl leading-normal font-extrabold tracking-tight text-gray-900">Sponsor
                    Sukabumi <span class="text-blue-500">Robotik Competition</span></h1>

                <div class="grup py-5 flex flex-wrap gap-4 justify-center lg:justify-start">
                    @foreach ($sponsor as $sponsores)
                        <div class="flex items-center justify-center p-2 border border-gray-200">
                            <img class="lg:w-[200px] w-28" src="{{ $sponsores->image }}"
                                alt="Logo {{ $sponsores->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="content-respasi-hotel py-3">
        <div class="body flex flex-col  justify-center items-center">
            <button
                class="bg-blue-500 hover:scale-105 focus:scale-105 transition-all rounded-lg hover:bg-gray-500 hover:text-black focus:bg-gray-500 focus:text-black px-10 text-white py-2"
                onclick="window.location.href='https://docs.google.com/forms/d/e/1FAIpQLSdN3vdC1cppybm55mSSTy9Rn679U78NYvx9MV5mMCKc88PgYQ/viewform'">Reserpasi
                Hotel</button>
            <br>
            <h1 class="font-medium">( Hanya Take Kamar, Untuk Pemesanan dan Pembayaran hubungi nomor ini <span><a
                        href="https://wa.link/qavgnl" class="text-blue-400">0877 7292 1119</a></span> ) </h1>
        </div>
    </div>
    <div id="lokasi" class="teknis relative w-full h-96 ">
        <div
            class="text absolute inset-0 m-5  py-38  lg:py-0 flex flex-col lg:items-center justify-center  lg:bottom-15 z-10">
            <h1 class="text-white font-bold text-4xl inter relative top-5">LOKASI</h1>
            <br>
            <p class="text-white font-semibold">Auditorium Universitas Nusa Putra</p>
            <p class="text-white text-[10px] lg:text-[15px]">Jl. Raya Cibolang Cisaat - Sukabhumi No.21, Cibolang
                Kaler, Kec. Cisaat, Kabupaten Sukabumi, Jawa Barat 43152</p>
            <div class="lg:py-4 py-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.505268770257!2d106.8736239!3d-6.9053905!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6836505836821d%3A0x619b6e8271f232cc!2sNusa%20Putra%20University!5e0!3m2!1sid!2sid!4v1717400790980!5m2!1sid!2sid"
                    class="w-full lg:w-[50em] rounded-2xl h-auto " style="border:0;" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
        <img src="assets/bgBlue.svg" class="w-full h-96 object-cover" alt="">
    </div>






</x-home.app>
