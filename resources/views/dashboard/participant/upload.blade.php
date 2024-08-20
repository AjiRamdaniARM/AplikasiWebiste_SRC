<x-panel.app>

    <section class=" py-8 px-3 ">
        <div class="block py-5 text-center">
            <h1 id="upload-message" class="poppins-bold text-4xl text-blue-800 ">Upload File Perlombaan</h1>
            <p id="deks">dimohon untuk upload karya atau project kamu untuk melanjutkan perlombaan</p>
        </div>
        <form class="space-y-4" action="{{ url('particpants/upload/project/' . $datas->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full">

                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2  border-dashed rounded-2xl cursor-pointer    bg-gray-700 dborder-gray-600 hover:border-gray-500 hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input type="text" name="id_participants" value="{{ $datas->id }}" hidden>
                    <input id="dropzone-file" type="file" name="name_project" class="w-full hidden" required>
                </label>
                <br>


            </div>
            <button class="w-full bg-blue-900 py-3 rounded-lg text-white font-bold focus:bg-blue-400"> Upload File
            </button>
        </form>
    </section>

</x-panel.app>

<script>
    document.getElementById('dropzone-file').addEventListener('change', function(event) {
        const uploadMessage = document.getElementById('upload-message');
        const deks = document.getElementById('deks');

        if (event.target.files.length > 0) {
            uploadMessage.innerText = 'Anda sudah mengunggah file';
            uploadMessage.style.color = 'green';

            deks.innerText = 'Silahkan untuk tap button UPLOAD FILE';
        } else {
            uploadMessage.innerText = 'Upload File Perlombaan';
            deks.innerText = 'dimohon untuk upload karya atau project kamu untuk melanjutkan perlombaan';
        }
    });
</script>

{{-- modal upload project --}}
{{-- <div id="authentication-modal-upload{{$datas->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 ">
                                                        {{$datas->name}} <span>( {{$datas->IdCard}} )</span>
                                                    </h3>
                                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    <form class="space-y-4" action="{{url('particpants/project')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="flex justify-between">
                                                            <div class="flex items-start">
                                                                <input type="text" name="id_participants" value="{{$datas->id}}" hidden>
                                                                <input type="file" name="name_project" class="w-full" required>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-blue-800">Upload Project</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
{{-- akhir modal upload --}}
