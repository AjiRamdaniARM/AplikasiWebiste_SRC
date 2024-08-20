<x-panel.app>
    <div class=" py-5">
        <h1 class="text-center text-style-gradient inter font-bold bebas-neue-regular text-7xl lg:text-8xl ">
            WELCOME TO
            SRC
            2024</h1>
        <div class="grid lg:grid-cols-2 grid-cols-1  gap-10 py-5 justify-center ">
            @role('admin')
                <div class="grup-card flex flex-col  gap-4">
                    {{-- === card all user === --}}
                    <a style="text-decoration:none; list-style:none "
                        class="hover:text-gray-700 hover:scale-105 transition-all" href="{{ route('user.index') }}">
                        <div style="border: 1px solid black" class="bg-white p-6  rounded-lg shadow-sm ">
                            <div class="flex items-baseline">
                                <span
                                    class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                    Data
                                </span>
                                <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                    User | All
                                </div>
                            </div>
                            <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">
                                {{ $lv2 }}</h4>
                            <div class="mt-1">
                                User Total
                            </div>
                        </div>
                    </a>
                    {{-- === card all participants === --}}
                    <a style="text-decoration: none; list-style:none;"></a>
                    <div style="border: 1px solid black" class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-baseline">
                            <span
                                class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                Data
                            </span>
                            <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                Participant | All
                            </div>
                        </div>

                        <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">{{ $participants }}
                        </h4>

                        <div class="mt-1">
                            Participant Total
                        </div>
                    </div>
                    {{-- === card all perlombaan === --}}
                    <div style="border: 1px solid black" class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-baseline">
                            <span
                                class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                Data
                            </span>
                            <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                Perlombaan | All
                            </div>
                        </div>

                        <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">{{ $data2 }}
                        </h4>

                        <div class="mt-1">
                            Perlombaan Total
                        </div>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('myChart').getContext('2d');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['User All', 'Participant', 'Perlombaan', ],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [{{ $lv2 }}, {{ $itemAll }}, {{ $data2 }}],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
            </div>
        @endrole
        @role('participant')
            <div class="grup flex flex-col gap-4">
                <div class="bg-white p-6 border-2 border-black rounded-lg shadow-sm">
                    <div class="flex items-baseline">
                        <span
                            class="bg-blue-800 text-white text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                            Data
                        </span>
                        <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                            Perlombaan | All
                        </div>
                    </div>
                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">{{ $dataUser }}
                    </h4>
                    <div class="mt-1">
                        Perlombaan yang kamu miliki
                    </div>
                </div>
                <div class="bg-white p-6 border-2 border-black rounded-lg shadow-sm">
                    <div class="flex items-baseline">
                        <span
                            class="bg-blue-800 text-white text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                            Data
                        </span>
                        <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                            Participants | All
                        </div>
                    </div>

                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">
                        {{ $participantsUser }}</h4>

                    <div class="mt-1">
                        Sertificate yang kamu miliki
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
            {{-- === script chart js === --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('myChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Participant', 'Perlombaan', ],
                            datasets: [{
                                label: '# of Votes',
                                data: [{{ $participantsUser }}, {{ $dataUser }}],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
            {{-- === script chart js === --}}

            {{-- === buat kondisi ===  --}}
            @if (is_null($notif))
                <h1>tidak ada data</h1>
            @else
                @if ($notif->status == 'ada')
                    <img src="{{ asset('assets/seleksi_lulius_1.png') }}" class="w-full rounded-lg" alt="">
                    <img src="{{ asset('assets/informan.png') }}" class="w-full rounded-lg" alt="">
                @endif
            @endif
        </div>
        @if ($getParticipantSeleksi2 && $getParticipantSeleksi2->invoice_seleksi_2 == null)
            <h1>halo</h1>
        @elseif ($getParticipantSeleksi2)
            <div class="container-content-body-upload py-10">
                <div class="upload bg-blue-500 w-full flex flex-col justify-center items-center p-10 rounded-lg">
                    <div class="head text-white poppins-bold">
                        <h2 class="uppercase text-3xl" id="deks">Upload File Project Seleksi 2</h2>
                        <div id="upload-message-text">untuk perlombaan online</div>
                    </div>
                    <div class="body-content-upload py-3">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="upload-message" name="file" hidden />

                            <div class="grup flex flex-wrap gap-2">
                                <button type="button" id="dropzone-fil"
                                    class="text-blue-500 bg-white px-5 py-2 rounded-lg hover:scale-105 focus:scale-105 transition-all hover:shadow-md focus:shadow-md hover:font-bold focus:font-bold">
                                    Pilih File
                                </button>
                                <button type="button" onclick="window.dialogOnlineUpload.show();"
                                    class="text-blue-500 bg-white px-5 py-2 rounded-lg hover:scale-105 focus:scale-105 transition-all hover:shadow-md focus:shadow-md hover:font-bold focus:font-bold">
                                    Kirim File
                                </button>
                            </div>
                        </form>
                        <script>
                            document.getElementById('dropzone-fil').addEventListener('click', function() {
                                document.getElementById('upload-message').click();
                            });

                            document.getElementById('upload-message').addEventListener('change', function(event) {
                                const uploadMessageText = document.getElementById('upload-message-text');
                                const deks = document.getElementById('deks');

                                if (event.target.files.length > 0) {
                                    uploadMessageText.innerText = 'Anda sudah mengunggah file';
                                    deks.style.color = 'yellow';
                                    deks.innerText = 'Silahkan untuk tap button KIRIM FILE';
                                } else {
                                    uploadMessageText.innerText = 'Upload File Perlombaan';
                                    deks.innerText = 'Dimohon untuk upload karya atau project kamu untuk melanjutkan perlombaan';
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        @endif


    @endrole
    @role('participant')

        <div id="perlombaan" class="w-full">
            <div id="competition" class="perlombaan">
                <div class="label font-bold inter mb-3 leading-[36px] text-black lg:text-[24px] text-[20px] ">
                    ⭐Perlombaan Lainnya
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
                                                        class="font-bold">{{ $datas->deadline_reg }}</span>
                                                </span>
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
        </div>
    @endrole
    @role('admin')

        <div class="flex h-full flex-col justify-center">
            <!-- Table -->
            <div class="mx-auto w-full  border-2 border-black rounded-sm bg-white shadow-md">
                <div class="overflow-x-auto p-3">
                    <header class="border-b border-gray-100  py-4 flex justify-between items-center">
                        <div class="font-semibold text-gray-800">Manage Perlombaan Online</div>
                        <div class="grup-container-button flex gap-2">
                            <button onclick="window.dialogOnline.showModal();"
                                class="font-semibold text-white px-3 py-1  rounded-sm hover:scale-105 hover:bg-blue-800 bg-blue-500 text-[10px] lg:text-[15px] ">
                                Payment Seleksi</button>
                            <button onclick="window.location.href='{{ route('upload.index') }}'"
                                class="font-semibold text-white px-3 py-1  rounded-sm hover:scale-105 hover:bg-blue-800 bg-blue-500 text-[10px] lg:text-[15px] ">
                                Semua Upload</button>
                        </div>

                    </header>
                    <table class="w-full table-auto">
                        <thead class="bg-yellow-500 text-xs font-semibold uppercase text-black">
                            <tr>
                                <th class="p-2">No</th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Product Name</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Kelas</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Seleksi</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Status</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-center font-semibold">Action</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-sm">
                            <!-- record 1 -->
                            @foreach ($pesertaOnline as $pesertaOnlines)
                                <tr>
                                    <td class="p-2">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-2">
                                        <div class="font-medium text-gray-800">{{ $pesertaOnlines->name }}
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">{{ $pesertaOnlines->kelas }}</div>
                                    </td>
                                    <td class="p-2">
                                        @if ($pesertaOnlines->id_seleksi == 0)
                                            <div class="text-left font-medium text-blue-500">prosses</div>
                                        @elseif ($pesertaOnlines->id_seleksi == 1)
                                            <div class="text-left font-medium text-green-500">lolos</div>
                                        @elseif ($pesertaOnlines->id_seleksi == 2)
                                            <div class="text-left font-medium text-red-500">tidak lolos</div>
                                        @endif
                                    </td>
                                    <td class="p-2">
                                        @if ($pesertaOnlines->status == 'sudah upload')
                                            <div class="text-left font-medium text-green-500">
                                                {{ $pesertaOnlines->status }}</div>
                                        @elseif ($pesertaOnlines->id_seleksi == 'belum upload')
                                            <div class="text-left font-medium text-red-500">
                                                {{ $pesertaOnlines->status }}</div>
                                        @endif
                                    </td>
                                    <td class="p-2 flex justify-center gap-2">
                                        <form id="seleksi-form-lolos{{ $pesertaOnlines->id }}"
                                            action="{{ url('/dashboard/seleksi/' . $pesertaOnlines->id_peserta) }}"
                                            method="POST">
                                            @csrf
                                            <div class="flex justify-center gap-5">
                                                <input name="seleksi" type="text" value="1" hidden>
                                                <input type="text" name="races"
                                                    value="{{ $pesertaOnlines->race_id }}" hidden>
                                                <input type="text" name="id_user"
                                                    value="{{ $pesertaOnlines->id_user }}" hidden>
                                                <button type="submit"
                                                    class="bg-green-500 hover:scale-105 text-white px-2">Lolos</button>
                                            </div>
                                        </form>
                                        <form id="seleksi-form-tidak-lolos{{ $pesertaOnlines->id }}"
                                            action="{{ url('dashboard/seleksi/' . $pesertaOnlines->id_peserta) }}"
                                            method="POST">
                                            @csrf
                                            <div class="flex justify-center gap-5">
                                                <input name="seleksi" type="text" value="2" hidden>
                                                <input type="text" name="races"
                                                    value="{{ $pesertaOnlines->race_id }}" hidden>
                                                <input type="text" name="id_user"
                                                    value="{{ $pesertaOnlines->id_user }}" hidden>
                                                <button type="submit"
                                                    class="bg-red-500 hover:scale-105 text-white px-2 ">Tidak
                                                    Lolos</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- total amount -->
                <div class="flex justify-end space-x-4 border-t border-gray-100 px-5 py-4 text-1xl font-bold">
                    <div>Data Participants Online</div>
                </div>

                <div class="flex justify-end">
                    <!-- send this data to backend (note: use class 'hidden' to hide this input) -->
                    <input type="hidden" class="border border-black bg-gray-50" x-model="selected" />
                </div>
            </div>
        </div>

        <main>
            @include('dashboard.elements.voucher')
        </main>
    @endrole
    </div>
    {{-- === modal pay seleksi 2 === --}}
    <dialog id="dialogOnline">
        <form method="POST" action="{{ route('paySeleksi.post') }}">
            @csrf
            <h2 class="poppins-bold">Perlombaan Online </h2>
            <div style="border: 2px solid #0080ff" class="block bg-white shadow-md rounded-2xl px-10 py-3 ">
                <h1 class="poppins-semibold text-start">Hanya untuk seleksi <span>

                    </span></h1>
            </div>
            <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
                <h6 class=" text-2xl text-blue-800 font-bold">Lomba Online</h6>
                <select name="race_id" id="race_id" class="relative mt-2 w-full p-2 rounded-xl">
                    <option value="">Pilih Lomba</option>
                    @foreach ($getRaceOnline as $online)
                        <option value="{{ $online->id }}">{{ $online->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="block p-5 bg-blue-300 rounded-2xl relative mt-4">
                <h6 class=" text-2xl text-blue-800 font-bold">Harga Pembelian</h6>
                <input type="number" name="pay_idr" class="relative mt-2 rounded-xl" required>
            </div>
            <button type="submit"
                class="block bg-blue-400 relative mt-4 rounded-xl w-full py-3 text-white font-bold hover:bg-blue-300 ">
                Input Data
            </button>
        </form>
        <button onclick="window.dialogOnline.close();" aria-label="close" class="x">❌</button>
    </dialog>
    {{-- === akhir  modal pay seleksi 2 === --}}



    {{-- === style dashboard internal === --}}
    <style>
        .text-style-gradient {
            background: linear-gradient(to right, #5f97ff, #7d7bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;

        }

        #splash-screen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 100);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 2em;
        }

        /* === style modal dialog ===  */
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
            max-width: 390px;
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
    {{-- === style dashboard internal === --}}


    {{-- === script internal === --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('participants'))
                document.getElementById('dialog').showModal();
            @endif
        });
    </script>


</x-panel.app>
