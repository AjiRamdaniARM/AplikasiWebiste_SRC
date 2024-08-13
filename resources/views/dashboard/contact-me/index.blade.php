<x-panel.app>
    <x-slot name="title">
        Manage contact me
    </x-slot>

    <x-slot name="desc">
        Only one contact will be displayed, namely the first
    </x-slot>

    <x-modal.button-triger modalId="createContactMe" modalName="Create"/>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Number</th>
                            <th class="text-capitalize">Message</th>
                            <th class="text-capitalize">Author</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <x-modal modalId="createContactMe" modalTitle="Create contact me">
        <form action="{{ route('contact-me.store') }}" method="post">
            @csrf
            <x-forms.input name="number" 
                label="number"
                help="Ex: 628xxxxxxxxxx"
            />
            <x-forms.input name="message" 
                label="message"
            />

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editContactMe" modalTitle="Edit contact me">
        <form action="" method="post" id="formEditContactMe">
            @csrf
            @method('PUT')
            <x-forms.input name="numberEdit" 
                label="number"
                help="Ex: 628xxxxxxxxxx"
            />
            <x-forms.input name="messageEdit" 
                label="message"
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
                ajax: '{!! route('contact-me.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'number', name: 'number' },
                    { data: 'message', name: 'message' },
                    { data: 'user', name: 'user.name' },
                    { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editContactMe').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditContactMe").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#numberEdit").val(button.data('number'));
                $("#messageEdit").val(button.data('message'));
            });
        });
    </script>
    @endpush
</x-panel.app>