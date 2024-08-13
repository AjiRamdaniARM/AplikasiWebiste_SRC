<x-panel.app>
    <x-slot name="title">
        Manage Category
    </x-slot>

    <x-modal.button-triger modalId="createCategory" modalName="Create"/>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Name</th>
                            <th class="text-capitalize">Slug</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <x-modal modalId="createCategory" modalTitle="Create Category">
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <x-forms.input name="name" 
            label="name"
            />

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editCategory" modalTitle="Edit Category">
        <form action="" method="post" id="formEditCategory">
            @csrf
            @method('PUT')
            <x-forms.input name="nameEdit" 
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
                ajax: '{!! route('category.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editCategory').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditCategory").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#nameEdit").val(button.data('name'));
            });
        });
    </script>
    @endpush
</x-panel.app>