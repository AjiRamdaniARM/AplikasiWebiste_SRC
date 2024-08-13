<x-panel.app>
    @push('extra-css')
        <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap4.css') }}">
    @endpush
    <x-slot name="title">
        Create Invoice
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('invoice.store') }}" method="post">
                @csrf
                <x-forms.select name="user" class="select2" label="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user') == $user->id ? "selected" :""}}>{{ $user->name }}</option>
                    @endforeach
                </x-forms.select>
                @foreach ($races as $race)
                <div class="form-check mb-3">
                    <input type="checkbox" value="{{ $race->id }}" class="form-check-input" id="checkbox-{{ $race->id }}" name="races[]" @checked(old('races') == $race->id)>
                    <label class="form-check-label text-capitalize" for="checkbox-{{ $race->id }}">
                            <strong>{{ $race->name }}</strong>
                    </label>
                </div>
                @endforeach
                @error('races[]')
                    <div class="invalid-feedback">"{{ $message }}"</div>
                @enderror
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    @push('extra-script')
    <script src={{ asset('vendor/select2/select2.min.js') }}></script>
    <script>
    $(function(){
        $('.select2').select2(
        {
            theme: 'bootstrap4',
        });
    });
    </script>
    @endpush
</x-panel.app>