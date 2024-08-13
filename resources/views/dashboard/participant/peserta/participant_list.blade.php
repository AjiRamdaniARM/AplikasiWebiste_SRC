<!--@if ($participants->isEmpty())-->
<!--    <div class="w-full text-center py-6">-->
<!--        <p class="text-black">Tidak ada data participants</p>-->
<!--    </div>-->
<!--@else-->
<!--    @foreach ($participants as $participant)-->
<!--        <div class="flex-shrink max-w-full px-4 w-2/3 sm:w-1/2 md:w-5/12 lg:w-1/4 xl:px-6">-->
<!--            <div class="relative overflow-hidden bg-white dark:bg-gray-800 mb-12 hover-grayscale-0 wow fadeInUp rounded-2xl p-5" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp;">-->
                <!-- team block -->
<!--                <div class="relative overflow-hidden px-6">-->
<!--                    <img src="{{ asset('assets/animasi2.gif') }}" class="max-w-full h-auto mx-auto rounded-full bg-gray-50" alt="title image">-->
<!--                </div>-->
<!--                <div class="pt-6 text-center">-->
<!--                    <p class="text-lg text-black leading-normal font-bold mb-1">{{ $participant->name }}</p>-->
<!--                    <p class="leading-normal text-[13px] font-normal mb-1">Kelas : {{ $participant->kelas }}</p>-->
<!--                    <p class="text-gray-500 leading-relaxed font-normal">{{ $participant->IdCard }}</p>-->
<!--                    <button data-modal-target="authentication-modal-{{ $participant->name }}" data-modal-toggle="authentication-modal-{{ $participant->name }}" class="relative bg-blue-500 text-white mt-2 px-2 rounded-md">Edit Data</button>-->


<!--                    <div id="authentication-modal-{{ $participant->name }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">-->
<!--                        <div class="relative p-4 w-full max-w-md max-h-full">-->
                            <!-- Modal content -->
<!--                            <div class="relative rounded-lg shadow bg-gray-900">-->
                                <!-- Modal header -->
<!--                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">-->
<!--                                    <h3 class="text-xl font-bold text-white">-->
<!--                                        Edit Participants-->
<!--                                    </h3>-->
<!--                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $participant->id }}">-->
<!--                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">-->
<!--                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>-->
<!--                                        </svg>-->
<!--                                        <span class="sr-only">Close modal</span>-->
<!--                                    </button>-->
<!--                                </div>-->
                                <!-- Modal body -->
<!--                                <div class="p-4 md:p-5">-->
<!--                                    <form class="space-y-4" method="POST" action="{{url('particpants/'.$participant->id)}}">-->
<!--                                        @csrf-->
<!--                                        @method('PUT')-->
<!--                                        <div>-->
<!--                                            <label for="name" class="block mb-2 text-sm font-medium text-white">Nama Peserta</label>-->
<!--                                            <input type="text" name="name" value="{{ $participant->name }}" class="border text-white bg-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />-->
<!--                                        </div>-->
<!--                                        <div>-->
<!--                                            <label for="kelas" class="block mb-2 text-sm font-medium text-white">Kelas Peserta</label>-->
<!--                                            <input type="text" name="kelas" value="{{ $participant->kelas }}" class="border text-white bg-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />-->
<!--                                        </div>-->
<!--                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Data</button>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <form action="{{ url('particpants/admin/delete/'. $participant->id)}}" >-->
<!--                        @csrf-->
<!--                        @method('DELETE')-->
<!--                        <button type="submit" class="relative bg-red-500 text-white mt-2 px-2 rounded-md">Delete Data</button>-->
<!--                    </form>-->




<!--                </div>-->
<!--            </div>-->
            <!-- end team block -->
<!--        </div>-->
<!--    @endforeach-->
<!--@endif-->

<!-- Include necessary scripts -->
<!--<script>-->
<!--    document.querySelectorAll('[data-modal-toggle]').forEach((button) => {-->
<!--        button.addEventListener('click', () => {-->
<!--            const modalId = button.getAttribute('data-modal-target');-->
<!--            document.getElementById(modalId).classList.toggle('hidden');-->
<!--        });-->
<!--    });-->

<!--    document.querySelectorAll('[data-modal-hide]').forEach((button) => {-->
<!--        button.addEventListener('click', () => {-->
<!--            const modalId = button.closest('.fixed').id;-->
<!--            document.getElementById(modalId).classList.add('hidden');-->
<!--        });-->
<!--    });-->
<!--</script>-->
