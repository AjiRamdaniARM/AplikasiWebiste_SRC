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

    <a href="{{ route('invoice.index') }}" class="btn btn-danger mb-3">Back</a>

    <div class="card shadow">
        <div class="card-body">
            <x-forms.show-data label="name" value="{{ $inv->user->name }}" />
            <x-forms.show-data label="Invoice Id" value="{{ $inv->name }}" />
            @foreach ($inv->itemRace as $key => $item)
                <x-forms.show-data label="Contest {{ ++$key }}" value="{{ $item->name }}" />
            @endforeach
            <x-forms.show-data label="Total" value="{{ 'Rp. ' .number_format($inv->itemRace()->sum('price'),0,',','.') }}" />

            @if(!is_null($inv->image))
                <img src="{{ asset($inv->image) }}" alt="{{ $inv->name }}" class="img-fluid w-50">
            @endif

            <form action="{{ route('invoice.update', $inv->id) }}" method="post">
                @csrf
                @method('put')
                <x-forms.select name="status" label="status">
                    <option value="reject" {{ old('status', $inv->status) == 'reject' ? "selected" :""}}>Reject</option>
                    <option value="pending" {{ old('status', $inv->status) == 'pending' ? "selected" :""}}>Pending</option>
                    <option value="paid" {{ old('status', $inv->status) == 'paid' ? "selected" :""}}>Paid</option>
                    <option value="unpaid" {{ old('status', $inv->status) == 'unpaid' ? "selected" :""}}>Unpaid</option>
                </x-forms.select>
                <label>
                    <strong>Screenshot Struck payment</strong>
                    <span class="text-danger">*</span>
                </label>
                <br>
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