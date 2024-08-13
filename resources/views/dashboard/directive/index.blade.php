<x-panel.app>



    <div class="container py-10 flex justify-between items-center">
        <div class="grup-tools">
            <h1 class="poppins-bold text-4xl text-[#34364A]">Directive Manage</h1>
            <p class="rela">manage admin</p>
        </div>
        <x-modal.button-triger  modalId="createDirective" modalName="Create"/>
    </div>


    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables " id="dataTable">
                    <thead class="bg-blue-500 text-white ">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Name</th>
                            <th class="text-capitalize">Link</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <x-modal modalId="createDirective" modalTitle="Create Directive">
        <form action="{{ route('directive.store') }}" method="post">
            @csrf
            <x-forms.input name="name"
                label="name"
            />
            <x-forms.input name="link"
                label="link"
            />

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editDirective" modalTitle="Edit Directive">
        <form action="" method="post" id="formEditDirective">
            @csrf
            @method('PUT')
            <x-forms.input name="nameEdit"
                label="name"
            />
            <x-forms.input name="linkEdit"
                label="name"
            />

            <x-modal.footer buttonName="Edit"/>
        </form>
    </x-modal>

    @push('extra-script')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('directive.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'link', name: 'link', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editDirective').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditDirective").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#nameEdit").val(button.data('name'));
                $("#linkEdit").val(button.data('link'));
            });
        });
    </script>
    @endpush
</x-panel.app>
