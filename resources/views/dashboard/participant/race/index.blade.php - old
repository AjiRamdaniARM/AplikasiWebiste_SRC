<x-panel.app>
    <x-slot name="title">
        List Race
    </x-slot>
    <x-slot name="desc">
        Please select the race that will be followed can be more than one !!
    </x-slot>

    <button class="btn btn-success mb-3" id="reg" disabled>Buy to register</button>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                {{-- table --}}
                <table class="table datatables" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-capitalize">#</th>
                            <th class="text-capitalize">No</th>
                            <th class="text-capitalize">Name</th>
                            <th class="text-capitalize">Point</th>
                            <th class="text-capitalize">Session</th>
                            <th class="text-capitalize">Price</th>
                            <th class="text-capitalize">Image</th>
                            <th class="text-capitalize">Team</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('extra-script')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('participant.race.index') !!}',
                columns: [
                    { data: 'check', name: 'check', orderable: false, searchable: false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'point', name: 'point' },
                    { data: 'session', name: 'session' },
                    { data: 'price', name: 'price' },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'team', name: 'team', orderable: false, searchable: false },
                ]
            });

            Array.prototype.remove = function(el) {
                return this.splice(this.indexOf(el), 1);
            }

            var id = [];
            $('#dataTable').on('change', 'input#raceSelect', function() {
                if(this.checked)
                {
                    id.push($(this).val());
                }else{
                    id.remove($(this).val());
                }
                
                if(id.length > 0){
                    $('#reg').prop('disabled', false);
                }else{
                    $('#reg').prop('disabled', true);
                }

            });

            $('#reg').on('click', function(){
                $('#reg').prop('disabled', true);
                $('#reg').text('Please wait...');
                $.ajax({
                    url:"{{ route('participant.race.store') }}",
                    method:"POST",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        'races':id,
                    },
                    success:function(response)
                    {
                        if (response.success) {
                            window.location = '{!! route('participant.invoice.index') !!}'; 
                        }
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });

        });
    </script>
    @endpush
</x-panel.app>