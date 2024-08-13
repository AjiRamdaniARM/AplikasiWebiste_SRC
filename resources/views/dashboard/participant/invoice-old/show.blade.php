<x-panel.app>
    @push('extra-css')
    {{-- filephone --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    {{-- end filepond --}}
    @endpush

    <x-slot name="title">
        Detail Invoice
    </x-slot>
    <x-slot name="desc">
        Contest Payment Through Account : BSI 7225018237 A/N Sukarobot Academy.
    </x-slot>

    <a href="{{ route('participant.invoice.index') }}" class="btn btn-danger mb-3">Back</a>

    <div class="card shadow">
        <div class="card-body">
            <x-forms.show-data label="Invoice Id" value="{{ $inv->name }}" />
            @foreach ($inv->itemRace as $key => $item)
                <x-forms.show-data label="Contest {{ ++$key }}" value="{{ $item->name }}" />
            @endforeach
            <x-forms.show-data label="Total" value="{{ 'Rp. ' .number_format($inv->itemRace()->sum('price'),0,',','.') }}" />
            <form action="{{ route('participant.invoice.store', $inv->name) }}" method="post">
                @csrf
                <label>
                    <strong>Upload Image Payment</strong>
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="path" id="path" class="mb-0" value="{{ old('path') }}">
                <span class="d-block mb-3"><small>Format: JPG/JPEG/PNG; Max File: 1Mb</small></span>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    @push('extra-script')
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