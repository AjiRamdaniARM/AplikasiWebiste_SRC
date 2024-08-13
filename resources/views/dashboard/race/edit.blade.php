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
        Edit Race
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('race.update', $race->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="name" 
                            label="name"
                            value="{{ $race->name }}"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="point" 
                            label="point"
                            help="Ex: 70"
                            value="{{ $race->point }}"
                        />
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="duration" 
                            label="duration"
                            type="time"
                            value="{{ $race->duration->format('H:i') }}"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="session" 
                            label="session"
                            help="Ex: 20"
                            value="{{ $race->session }}"
                        />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="date_race" 
                            label="date race"
                            type="datetime-local"
                            value="{{ $race->date_race }}"
                        />
                    </div>
                    <div class="col">
                        <x-forms.input name="price" 
                            label="price"
                            help="Ex: 100000"
                            value="{{ $race->price }}"
                        />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.input name="deadline_reg" 
                            label="deadline registration"
                            value="{{ $race->deadline_reg }}"
                            type="date"
                        />
                    </div>
                    <div class="col">
                        <x-forms.select name="category" class="select2" label="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category', $race->category_id) == $category->id ? "selected" :""}}>{{ $category->name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>
                    <x-forms.input name="juknis_lomba"
                label="juknis_lomba"
                value="{{ $race->juknis_lomba }}"
            />
                <x-forms.text-area name="description" class="editor" 
                    label="description"
                    value="{{ $race->description }}"
                />
                <x-forms.checkbox name="team" 
                    label="team"
                    required="false"
                    value="{{ $race->team }}"
                />
                <x-forms.checkbox name="document" 
                    label="Need upload document ?"
                    required="false"
                    value="{{ $race->document }}"
                />
                <div class="d-none" id="wrapper-team">
                    <x-forms.input name="max_people"
                        label="Max Member"
                        required="false"
                        type="text"
                        value="{{ $race->max_people }}"
                    />
                </div>
                <label>
                    <strong>Cover</strong>
                    <span class="text-danger">*</span>
                </label>
                <br>
                <a href="{{ asset($race->image) }}" target="_blank">See image</a>
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

            if($('#checkbox-team').is(':checked')){ 
                $('#wrapper-team').removeClass('d-none').addClass('d-inline')
            }
            else{ 
                $('#wrapper-team').addClass('d-none').removeClass('d-inline')
            }
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