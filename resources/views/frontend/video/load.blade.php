<div class="row" id="load" style="position: relative;">
    @foreach ($equipment_assignment as $item)
    <div class="col-md-12" style="background-image: url({{ asset('storage/uploads/' . $item->picture->path . '/picture/' . $item->picture->name) }}); background-size: 100% 100%; background-repeat: no-repeat; min-height: 390px; width: 100%; margin-bottom: 10px;">
        @php $layer = 1 @endphp
        @for ($i = 1; $i <= 3; $i++)
            <div class="row">
            @for ($j = 1; $j <= 6; $j++)
                <div class="col-md-2 col-xs-2" style="min-height: 130px;">
                    <div class="row" @if ($item->layer == $layer)data-toggle="tooltip" data-html="true" title="<h3>{{ $item->equipment->name }}</h3> {{ $item->equipment->detail }}"@endif>
                        @if ($item->layer == $layer)
                            <h3 class="text-center"><i class="fa fa-info-circle"></i></h3>
                        @endif
                    </div>
                </div>
                @php $layer++ @endphp
            @endfor
            </div>
        @endfor   
        {{-- <img src="{{ asset('storage/uploads/' . $item->picture->path . '/picture/' . $item->picture->name) }}" style="width: 100%; min-height: 390px;"> --}}
    </div>
    @endforeach
</div>
<script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                'selector': '',
                'container': 'body'
            });

            $('#modal-gallery-title').text('Technology: {{ $equipment_assignment[0]->technology->name }}');
        })
    </script>
{{-- {{ $equipment_assignment->links() }} --}}