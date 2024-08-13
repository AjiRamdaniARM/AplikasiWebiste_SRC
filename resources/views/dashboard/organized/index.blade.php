<x-panel.app>
    @push('extra-css')
        {{-- filephone --}}
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
        {{-- end filepond --}}
    @endpush

    <div class="container py-10 flex justify-between items-center">
        <div class="grup-tools">
            <h1 class="poppins-bold text-4xl text-[#34364A]">Organize Manage</h1>
            <p class="rela">manage admin</p>
        </div>
        <x-modal.button-triger modalId="createOrgaized" modalName="Create"/>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Name</th>
                            <th class="text-capitalize">Type</th>
                            <th class="text-capitalize">Logo</th>
                            <th class="text-capitalize">Author</th>
                            <th class="text-capitalize">created at</th>
                            <th class="text-capitalize">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <x-modal modalId="createOrgaized" modalTitle="Create organized">
        <form action="{{ route('organized.store') }}" method="post">
            @csrf
            <x-forms.input name="name"
                label="name"
            />

            <x-forms.select name="type" label="type">
                <option value="organize" {{ old('type') == 'organize' ? "selected" :""}}>Organize</option>
                <option value="media_partner" {{ old('type') == 'media_partner' ? "selected" :""}}>Media Partner</option>
                <option value="sponsor" {{ old('type') == 'sponsor' ? "selected" :""}}>Sponsor</option>
            </x-forms.select>

            <label>
                <strong>Logo</strong>
                <span class="text-danger">*</span>
            </label>
            <input type="text" name="path" id="path" class="mb-0" value="{{ old('path') }}" required>
            <span class="d-block mb-3"><small>Format: JPG/JPEG/PNG; Max File: 1Mb</small></span>

            <x-modal.footer />
        </form>
    </x-modal>

    <x-modal modalId="editOrganized" modalTitle="Edit organized">
        <form action="" method="post" id="formEditOrganized">
            @csrf
            @method('PUT')
            <x-forms.input name="nameEdit"
                label="name"
            />

            <x-forms.select name="typeEdit" label="typeEdit">
                <option value="organize" {{ old('typeEdit') == 'organize' ? "selected" :""}}>Organize</option>
                <option value="media_partner" {{ old('typeEdit') == 'media_partner' ? "selected" :""}}>Media Partner</option>
                <option value="sponsor" {{ old('typeEdit') == 'sponsor' ? "selected" :""}}>Sponsor</option>
            </x-forms.select>

            <label>
                <strong>Logo</strong>
                <span class="text-danger">*</span>
            </label>
            <br>
            <a href="#" target="_blank" id="img">See Image ...</a>
            <input type="text" name="path" id="path" class="mb-0" value="{{ old('path') }}">
            <span class="d-block mb-3"><small>Format: JPG/JPEG/PNG; Max File: 1Mb</small></span>


            <x-modal.footer buttonName="Edit"/>
        </form>
    </x-modal>

    @push('extra-script')
        <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('organized.index') !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'image', name: 'image' },
                    { data: 'user', name: 'user.name' },
                    { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $('#editOrganized').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                $("#formEditOrganized").attr('action', $(location).attr('href')+'/'+button.data('id'));
                $("#nameEdit").val(button.data('name'));
                $("#typeEdit").val(button.data('type'));
                $("#img").attr('href', '/'+ button.data('image'));
            });
        });
    </script>

    {{-- filepond --}}
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );

        const inputElements = document.querySelectorAll('input[id="path"]');

        Array.from(inputElements).forEach(inputElement => {
            const pond = FilePond.create(inputElement,{
                allowImagePreview: true,
                allowImageFilter: false,
                allowImageExifOrientation: false,
                allowImageCrop: false,
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                maxFileSize: '1MB',
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise
                    resolve(type);
                })
            });
            FilePond.setOptions({
                server: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        const request = new XMLHttpRequest();
                        request.open('POST', '/utilities/upload');
                        request.setRequestHeader("X-CSRF-TOKEN", '{{ csrf_token() }}');
                        request.onload = function () {
                            if (request.status == 200 && this.readyState === XMLHttpRequest.DONE) {
                                // the load method accepts either a string (id) or an object
                                load(request.responseText);
                            } else {
                                // Can call the error method if something is wrong, should exit after
                                error('oh no');
                            }
                        };
                        request.send(formData);
                        return {
                            abort: () => {
                                // This function is entered if the user has tapped the cancel button
                                request.abort();
                                // Let FilePond know the request has been cancelled
                                abort();
                            },
                        };
                    },
                    revert: {
                        url: '/utilities/reverse',
                        onload: function (response) {
                            const name = JSON.parse(response);
                        },
                    }
                },
            });
        })
    </script>
    {{--  end filepond --}}
    @endpush
</x-panel.app>
