        <x-panel.app>
            <div class=" py-5">
                <h1 class="text-center inter font-bold bebas-neue-regular lg:text-5xl text-4xl text-blue-800">WELCOME TO
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

                        {{-- <div class="grup">
                            <div class="label font-bold inter mb-3 leading-[36px] text-black lg:text-[24px] text-[20px] ">
                                ⭐Notifikasi
                            </div>
                            <div class="h-64 overflow-y-auto ">

                                @foreach ($notif as $notifs)
                                    <div
                                        class="w-full h-[70px] border-2 border-black p-3 mt-3 bg-white rounded flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div tabindex="0" aria-label="heart icon" role="img"
                                                class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.30325 12.6667L1.33325 15V2.66667C1.33325 2.48986 1.40349 2.32029 1.52851 2.19526C1.65354 2.07024 1.82311 2 1.99992 2H13.9999C14.1767 2 14.3463 2.07024 14.4713 2.19526C14.5963 2.32029 14.6666 2.48986 14.6666 2.66667V12C14.6666 12.1768 14.5963 12.3464 14.4713 12.4714C14.3463 12.5964 14.1767 12.6667 13.9999 12.6667H4.30325ZM5.33325 6.66667V8H10.6666V6.66667H5.33325Z"
                                                        fill="#4338CA" />
                                                </svg>
                                            </div>
                                            <div class="pl-3">
                                                <p tabindex="0" class="focus:outline-none text-sm leading-none"><span
                                                        class="text-indigo-700">{{ $notifs->pesan }}</span></p>
                                                <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-700">
                                                    {{ $notifs->time_ago }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <form id="deleteNotifForm" action="{{ url('notif/' . $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" tabindex="0" aria-label="delete icon" role="button"
                                                    class="focus:outline-none w-6 h-6 flex items-center justify-center text-red-600 hover:text-red-800 hover:scale-105">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                        </div> --}}
                    @endrole

                </div>
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

                                                        <h4
                                                            class="mt-1 text-xl font-semibold uppercase leading-tight truncate">
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
                                                                <button
                                                                    onclick="window.location.href='{{ $datas->juknis_lomba }}'"
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
                        <div class="mx-auto w-full max-w-full border-2 border-black rounded-sm   bg-white shadow-md">
                            <header class="border-b border-gray-100 px-5 py-4 flex justify-between items-center">
                                <div class="font-semibold text-gray-800">Manage Perlombaan Online</div>
                                <button onclick="window.location.href='{{ route('upload.index') }}'"
                                    class="font-semibold text-white px-3 py-1  rounded-sm hover:scale-105 hover:bg-blue-800 bg-blue-500 text-[10px] lg:text-[15px] ">
                                    Semua Upload</button>
                            </header>

                            <div class="overflow-x-auto p-3">
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
                                                            <input type="text" name="id_user"
                                                                value="{{ $pesertaOnlines->id_user }}" hidden>
                                                            <button type="submit"
                                                                class="bg-red-500 hover:scale-105 text-white px-2 ">Tidak
                                                                Lolos</button>
                                                        </div>
                                                    </form>
                                                    <script>
                                                        // Function to handle form submission with splash screen
                                                        function handleFormSubmission(formId) {
                                                            document.getElementById(formId).addEventListener('submit', function(event) {
                                                                event.preventDefault(); // Mencegah form dikirim langsung
                                                                document.getElementById('splash-screen').style.display = 'flex'; // Menampilkan splash screen

                                                                // Kirim form setelah menampilkan splash screen
                                                                setTimeout(() => {
                                                                    event.target.submit();
                                                                }, 900); // Waktu delay dalam milidetik, sesuaikan jika diperlukan
                                                            });
                                                        }

                                                        // Menambahkan event listener untuk kedua form
                                                        handleFormSubmission('seleksi-form-lolos{{ $pesertaOnlines->id }}');
                                                        handleFormSubmission('seleksi-form-tidak-lolos{{ $pesertaOnlines->id }}');
                                                    </script>
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

            <style>
                /* Style untuk splash screen */
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
            </style>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#deleteNotifForm').on('submit', function(e) {
                        e.preventDefault(); // Mencegah form dari pengiriman default

                        var form = $(this);
                        var url = form.attr('action');

                        $.ajax({
                            type: 'GET',
                            url: url,
                            data: form.serialize(), // Mengirim data form termasuk _method dan _token
                            success: function(response) {
                                alert('Notifikasi berhasil dihapus');
                                form.closest('.w-full')
                                    .remove(); // Menghapus elemen HTML setelah berhasil dihapus
                            },
                            error: function(xhr) {
                                alert('Gagal menghapus notifikasi');
                            }
                        });
                    });
                });
            </script>



        </x-panel.app>
