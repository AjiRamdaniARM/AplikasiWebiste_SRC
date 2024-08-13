<x-home.app>
    @push('extra-css')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            .product-wrap {
                position: relative;
                height: 30vh;
                overflow: hidden;
            }

            .product-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            #competition{
                background-image: linear-gradient(190deg,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 21%),url(https://zaib.sandbox.etdevs.com/divi/wp-content/uploads/sites/2/2020/06/robotics-04.jpg)!important;
                background-size: 100%;
                background-size: cover;
            }

            .contact-me{
                right:25px;
                bottom:25px;
                max-width: 250px;
                position: fixed;
            }
        </style>
    @endpush

    <x-slot name="title">
        {{ $race->name }}
    </x-slot>

    <div class="container-fluid my-5" id="competition">
        <h1 class="text-center text-dark py-5"><strong>PERLOMBAAN</strong></h1>
        <div class="card shadow">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <div class="product-wrap">
                            <img src="{{ asset($race->image) }}" alt="{{ $race->slug }}">
                        </div>
                    </div>
                    <div class="col">
                        <x-forms.show-data label="name" class="text-capitalize" value="{{ $race->name }}" />
                        <x-forms.show-data label="point" value="{{ $race->point }}" />
                        <x-forms.show-data label="duration" value="{{ $race->duration->format('H:i') }}" />
                        <x-forms.show-data label="session" value="{{ $race->session }}" />
                        <x-forms.show-data label="date race" value="{{ $race->date_race->format('d/m/Y H:i') }}" />
                        <x-forms.show-data label="price" value="{{ $race->price() }}" />
                        <x-forms.show-data label="deadline register" value="{{ $race->deadline_reg->format('d/m/Y') }}" />
                        <x-forms.show-data label="category" value="{{ $race->category->name }}" />
                        <x-forms.show-data label="description" value="{{ $race->description }}" />
                        <x-forms.show-data label="team" class="text-capitalize" value="{{ $race->team ? 'true' : 'false' }}" />
                        @if($race->team == true)
                            <x-forms.show-data label="Max member" value="{{ $race->max_people }}" />
                        @endif
                        <x-forms.show-data label="need upload document ??" class="text-capitalize" value="{{ $race->document ? 'true' : 'false' }}" />
                        <div class="d-flex">
                            <a href="{{ url('/') }}" class="btn btn-outline-success">Back</a>
                            <a href="{{ route('participant.race.index') }}" class="btn btn-outline-primary ml-3">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- contact me --}}
    @if(!is_null($con))
        <div class="contact-me">
            <a href="{{ url('https://api.whatsapp.com/send?phone='.$con->number.'&text=' . str_replace(' ', '%20', $con->message)) }}" class="btn btn-success">Whatsapp Me</a>
        </div>
    @endif
    {{-- end contact me --}}
    @push('extra-script')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <script>
            $(document).ready(function(){
                $('.page-scroll').on('click', function(e){
                    var tujuan = $(this).attr('href')
                    var elemenTujuan = $(tujuan)

                    $('html, body').animate({
                        scrollTop: elemenTujuan.offset().top - 130
                        }, 'slow');
                    return false;

                    e.preventDefault()
                })
            });
        </script>
    @endpush
</x-home.app>