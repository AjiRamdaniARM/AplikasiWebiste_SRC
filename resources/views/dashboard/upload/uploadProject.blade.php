<x-panel.app>
    <div
        class="container-content-upload flex flex-col justify-center items-center text-3xl text-center md:text-5xl py-5">
        <div class="head-content-container py-2">
            <h1 class="bebas bebas-neue-regular text-style-gradient">File Uploaded Lomba Online</h1>
        </div>
        <div class="container-content-body w-full bg-white shadow-lg rounded-sm border border-gray-200">
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Participants</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Perlombaan</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Aksi</div>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($pesertaOnline as $online)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full"
                                                    src="{{ asset('assets/animasi2.gif') }}" width="40"
                                                    height="40" alt="Alex Shatov"></div>
                                            <div class="font-medium text-gray-800">{{ $online->name }}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-no    wrap">
                                        <div class="text-left">
                                            <span
                                                class="bg-green-300 text-green-700 p-1 rounded   ">{{ $online->nama_lomba }}</span>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <button onclick="downloadFile('{{ $online->name_project }}')">
                                            <div class="download text-left font-medium text-blue-500 ">Download</div>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script></script>
</x-panel.app>
