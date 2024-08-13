<x-panel.app>
    
    <x-slot name="title">
        Detail User
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="name" value="{{ $user->name }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="email" value="{{ $user->email }}" />
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="community" value="{{ $user->community }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="place of birth" value="{{ $user->pob }}" />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="date of birth" value="{{ $user->dob->format('d/m/Y') }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="phone" value="{{ $user->phone }}" />
                    </div>
                </div>
                <x-forms.show-data label="address" value="{{ $user->address }}" />

                @foreach ($user->roles as $role)
                    <x-forms.show-data label="role" value="{{ $role->name }}" />
                @endforeach

                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning mt-3">Edit</a>
        </div>
    </div>

</x-panel.app>