<div class="row" id="load" style="position: relative;">
    @foreach ($technologies as $key => $item)
    <div class="col-md-12" style="background-image: url({{ asset('storage/uploads/' . $item->path . '/picture/' . $item->picture_name) }}); background-size: 100% 100%; background-repeat: no-repeat; min-height: 400px; width: 100%; margin-bottom: 10px;">
        @php $layer = 1 @endphp
        @for ($i = 1; $i <= 4; $i++)
            <div class="row">
            @for ($j = 1; $j <= 12; $j++)
                <div class="col-md-1 col-xs-1" style="min-height: 98px;">
                    <div class="row" @if (!empty($item->equipment_assignment[$layer]))data-toggle="tooltip" data-html="true" title="<h3>{{ $item->equipment_assignment[$layer]['equipment_name'] }}</h3> {{ $item->equipment_assignment[$layer]['equipment_detail'] }}"@endif>
                        @if (!empty($item->equipment_assignment[$layer]))
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

            $('#modal-gallery-title').text('Technology: {{ $technologies[0]->name }}');
        })
    </script>
{{-- {{ $equipment_assignment->links() }} --}}