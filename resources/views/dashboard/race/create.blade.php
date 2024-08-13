<x-panel.app>
    @push('extra-css')
        <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap4.css') }}">

        {{-- filephone --}}
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
        {{-- end filepond --}}
    @endpush
    <x-slot name="title">
        Create Race
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('race.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="name" 
                            label="name"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="point" 
                            label="point"
                            help="Ex: 70"
                        />
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="duration" 
                            label="duration"
                            type="time"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="session" 
                            label="session"
                            help="Ex: 20"
                        />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="date_race" 
                            label="date race"
                            type="datetime-local"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="price" 
                            label="price"
                            help="Ex: 100000"
                        />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="deadline_reg" 
                            label="deadline registration"
                            type="datetime-local"
                        />
                    </div>
                    <div class="col">
                        <x-forms.select name="category" class="select2" label="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? "selected" :""}}>{{ $category->name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
                    <x-forms.input name="juknis_lomba"
                label="juknis_lomba"
              
            />
                <x-forms.text-area name="description" class="editor" 
                    label="description"
                />
                <x-forms.checkbox name="team" 
                    required="false"
                    label="team"
                />
                <x-forms.checkbox name="document" 
                    required="false"
                    label="Need upload document ?"
                />
                <div class="d-none" id="wrapper-team">
                    <x-forms.input name="max_people"
                        label="Max Member"
                        type="text"
                        required="false"
                        help="Ex: 4"
                    />
                </div>
                <label>
                    <strong>Cover</strong>
                    <span class="text-danger">*</span>
                </label>
                <input type="text" name="path" id="path" class="mb-0" value="{{ old('path') }}">
                <span class="d-block mb-3"><small>Format: JPG/JPEG/PNG; Max File: 1Mb</small></span>
                @error('path')
                    <div class="invalid-feedback">{{ $message }}.</div>
                @enderror
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    

    @push('extra-script')
        <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
        <script src={{ asset('vendor/select2/select2.min.js') }}></script>
        <script>
        ClassicEditor
				.create( document.querySelector( '.editor' ), {			
					licenseKey: '',
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: 9anxkq51kepp-pjdkkbjc0ekq' );
					console.error( error );
				} );
        </script>
        <script>
        $(function(){
            $('.select2').select2(
            {
                theme: 'bootstrap4',
            });

            $("#description").prop('required',false);

            $('#checkbox-team').on('click', function(){
                isChecked = $(this).is(':checked')
                if(isChecked){ 
                    $('#wrapper-team').removeClass('d-none').addClass('d-inline')
                }
                else{ 
                    $('#wrapper-team').addClass('d-none').removeClass('d-inline')
                }
            })
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
            const inputElement = document.querySelector('input[id="path"]');
            const pond = FilePond.create(inputElement, {
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
        </script>
        {{--  end filepond --}}
    @endpush
</x-panel.app>