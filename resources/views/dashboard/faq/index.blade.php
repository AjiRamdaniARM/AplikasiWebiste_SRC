<x-panel.app>

    <div class="container py-10 flex justify-between items-center">
        <div class="grup-tools">
            <h1 class="poppins-bold text-2xl lg:text-4xl text-[#34364A]">Faqs Manage</h1>
            <p class="rela">manage admin</p>
        </div>
        <x-modal.button-triger modalId="createFaq" modalName="Create"/>
    </div>



    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">question</th>
                            <th class="text-capitalize">answare</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <br>

    <x-modal modalId="createFaq" modalTitle="Create faq">
        <form action="{{ route('faq.store') }}" method="post">
            @csrf
            <x-forms.input name="question"
                label="question"
            />
            <x-forms.text-area name="answare" class="editor"
                label="answare"
            />

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editFaq" modalTitle="Edit Category">
        <form action="" method="post" id="formEditFaq">
            @csrf
            @method('PUT')
            <x-forms.input name="questionEdit"
                label="question"
            />
            <x-forms.text-area name="answareEdit" class="editor1"
                label="answare"
            />

            <x-modal.footer buttonName="Edit"/>
        </form>
    </x-modal>

    @push('extra-script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('.editor'));

        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('faq.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'question', name: 'question' },
                    { data: 'answare', name: 'answare' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editFaq').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditFaq").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#questionEdit").val(button.data('question'));
                ClassicEditor.create(document.querySelector('.editor1')).then(function (editor) {
                    editor.setData(button.data('answare'));
                });
            });

            $("#answare").prop('required',false);
            $("#answareEdit").prop('required',false);
        });
    </script>
    @endpush
</x-panel.app>
