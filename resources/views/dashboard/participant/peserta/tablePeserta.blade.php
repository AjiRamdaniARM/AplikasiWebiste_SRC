<x-panel.app>
    {{-- === akhir style dan script internal === --}}
    <div id="team" class="section relative pt-20 pb-8 md:pt-16">
        <div class="container mx-auto px-1 lg:px-4">
            <header class="text-start mx-auto mb-12">
                <h2 class="text-7xl text-center bebas-neue-regular mb-2 font-bold text-gray-800 ">
                    Table Participants Perlombaan
                </h2>
                <div class="text-center">
                    {{ $race->name }}
                </div>
                <br>
                <div class="grup-import-data flex" style="justify-content: center ; items-align:center; gap:5px">
                    <button onclick="window.location.href='{{ route('export.excel', ['id' => $race->id]) }}'"
                        class="bg-green-500 text-white px-3 py-1 rounded">Excel</button>
                    <button onclick="window.location.href='{{ route('export.pdf', ['id' => $race->id]) }}'"
                        class="bg-red-500 text-white px-3 py-1 rounded">Pdf</button>
                </div>
            </header>
            {{-- === data peserta perlombaan === --}}
            <div id="participantsContainer" class="flex flex-wrap  flex-row -mx-4 justify-center">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Wrapper untuk tabel dengan scroll horizontal -->
                        <div class="overflow-x-auto">
                            <table class="table datatables min-w-full" id="dataTable">
                                <thead class="bg-blue-500 text-white">
                                    <tr>
                                        <th class="text-capitalize">No</th>
                                        <th class="text-capitalize">Sekolah</th>
                                        <th class="text-capitalize">Alamat</th>
                                        <th class="text-capitalize">Peserta</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- === akhir data peserta perlombaan === --}}
        </div>
    </div>

    @push('extra-script')
        <script>
            $(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('table.participants', ['id' => $race->id]) !!}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'community',
                            name: 'community'
                        },
                        {
                            data: 'maps',
                            name: 'maps'
                        },

                        {
                            data: 'peserta',
                            name: 'peserta'
                        },


                    ]
                });
            });
        </script>
    @endpush
</x-panel.app>
