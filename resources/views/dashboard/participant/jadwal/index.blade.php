<x-panel.app>
    <div class="flex flex-col mx-3 mt-6 lg:flex-row py-5">

        {{-- == form input team for jadwal == --}}
        <div class="w-full lg:w-1/3 m-1">
            <form class="w-full bg-white shadow-md p-6" id="teamForm">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2"
                            htmlFor="category_name">Team Generate</label>
                        <input
                            class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#1D87C0]"
                            type="text" name="name" placeholder="Nama Team | Cth: Team 1 Subot" required />
                    </div>
                    <div class="w-full px-3 mb-6">
                        <label for="peserta">Peserta 1</label>
                        <select
                            class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#1DA5C0]"
                            name="id_participants_1" placeholder="Nama Team | Cth: Team 1 Subot" required>
                            <option value="">Select Participants</option>
                            @foreach ($getPeserta as $peserta)
                                <option value="{{ $peserta->id_peserta }}">{{ $peserta->name_peserta }}</option>
                            @endforeach

                        </select>
                        <br>
                        <label for="peserta">Peserta 2</label>
                        <select
                            class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#1DA5C0]"
                            name="id_participants_2" placeholder="Nama Team | Cth: Team 1 Subot" required>
                            <option value="">Select Participants</option>
                            @foreach ($getPeserta as $peserta)
                                <option value="{{ $peserta->id_peserta }}">{{ $peserta->name_peserta }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="w-full md:w-full px-3 mb-6">
                        <button
                            class="appearance-none block w-full bg-blue-700 text-gray-100 font-bold border border-blue-200 rounded-lg py-3 px-3 leading-tight hover:bg-blue-600 focus:outline-none  focus:border-gray-500">Kirim
                            Team</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- == form input team for jadwal == --}}

        {{-- == view body table team ==  --}}
        <div class="w-full lg:w-2/3 m-1 bg-white shadow-lg text-lg rounded-sm border border-gray-200">
            <div class="overflow-x-auto rounded-lg p-3">
                <table class="table-auto w-full border-collapse border border-gray-300" id="teamTable">
                    <thead>
                        <tr class="bg-gray-50 text-gray-800 text-sm font-semibold uppercase">
                            <th class="p-2 border border-gray-300">No</th>
                            <th class="p-2 border border-gray-300 text-left">Nama Team</th>
                            <th class="p-2 border border-gray-300 text-left">Peserta 1 </th>
                            <th class="p-2 border border-gray-300 text-left">Peserta 2</th>
                            <th class="p-2 border border-gray-300 text-center">Lomba</th>
                            <th class="p-2 border border-gray-300 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded here dynamically -->
                    </tbody>
                </table>

            </div>
        </div>
        {{-- == end view body table team == --}}

        {{-- == internal script javascript == --}}
        <script>
            $(document).ready(function() {
                // Load initial data
                loadTeams();

                // Handle form submission
                $('#teamForm').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: '{{ route('team.index') }}', // Ganti dengan nama route yang sesuai
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#teamForm')[0].reset();
                            loadTeams(); // Reload teams
                        }
                    });
                });

                function loadTeams() {
                    $.ajax({
                        url: '{{ route('jadwal.index') }}',
                        type: 'GET',
                        success: function(response) {
                            let rows = '';
                            $.each(response, function(index, team) {
                                if (team.race_mismatch) {
                                    // Tampilkan alert jika race tidak sesuai
                                    alert('Participant tidak sesuai dengan race pada tim ' + team
                                        .nama_team);
                                }
                                rows += `<tr>
                    <td class="p-2 border border-gray-300">${index + 1}</td> <!-- Nomor urut -->
                    <td>${team.nama_team}</td>
                    <td>${team.participant1_name}</td>
                    <td>${team.participant2_name}</td>
                    <td class="p-2 border border-gray-300 text-center">
                        ${team.race_name}
                    </td>
                    <td class="p-2 border border-gray-300 text-center">
                        <div class="flex justify-center">
                            <button class="rounded-md hover:bg-red-100 text-red-600 p-2 flex justify-between items-center deleteTeam" data-id="${team.id}">
                                <span>
                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </span> Delete
                            </button>
                        </div>
                    </td>
                </tr>`;
                            });
                            $('#teamTable tbody').html(rows);
                        }
                    });
                }



                $(document).on('click', '.deleteTeam', function() {
                    const teamId = $(this).data('id');

                    $.ajax({
                        url: 'jadwal/team/delete/' + teamId, // Menggunakan ID dari team untuk menghapus
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Jangan lupa untuk menambahkan token CSRF
                        },
                        success: function(response) {
                            console.log(response.success); // Tampilkan pesan sukses di console
                            loadTeams(); // Reload the table after deletion
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText); // Jika ada error, tampilkan di console
                        }
                    });
                });

            });
        </script>
        {{-- == end internal script == --}}

    </div>
</x-panel.app>
