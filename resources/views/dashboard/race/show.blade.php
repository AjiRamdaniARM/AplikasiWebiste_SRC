<x-panel.app>
    
    <x-slot name="title">
        Detail Race
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="name" value="{{ $race->name }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="point" value="{{ $race->point }}" />
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="duration" value="{{ $race->duration->format('H:i') }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="session" value="{{ $race->session }}" />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="date race" value="{{ $race->date_race }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="price" value="{{ $race->price() }}" />
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <x-forms.show-data label="deadline register" value="{{ $race->deadline_reg }}" />
                    </div>
                    <div class="col">
                        <x-forms.show-data label="category" value="{{ $race->category->name }}" />
                    </div>
                </div>

                <x-forms.show-data label="description" value="{{ $race->description }}" />
                <label>
                    <strong>Cover</strong>
                    <span class="text-danger">*</span>
                </label>
                <br>
                <a href="{{ asset($race->image) }}" target="_blank">See image</a>
                <br>
                <a href="{{ route('race.edit', $race->id) }}" class="btn btn-warning mt-3">Edit</a>
        </div>
    </div>

</x-panel.app>