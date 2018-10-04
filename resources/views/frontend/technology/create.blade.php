@extends('frontend.frontend')

@section('frontend-title')
    เลือกประเภทบริการ/เทคโนโลยี
@endsection
@section('frontend-content')
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create New Technology</div> --}}
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route(Auth::user()->role . '-technology-post-create') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @foreach ($technology as $item)
                            <div class="box box-default box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Technology: {{ $item->name }}</h3>

                                    <div class="box-tools pull-right">
                                        <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-video" data-technology="{{ $item->id }}">
                                            <i class="fa fa-youtube-play"></i> Play video
                                        </a>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="col-md-12 col-xs-12">
                                            @php $images = explode(',', $item->picture_name); @endphp
                                            <input type="checkbox" name="technology_id[]" id="technology-id-{{ $item->id }}" value="{{ $item->id }}" {{ (isset($draft->technology_id) && in_array($item->id, $draft->technology_id)) ? "checked" : "" }}>
                                            <label for="technology-id-{{ $item->id }}" class="control-label">{{ $item->name }}</label>
                                            <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-gallery" data-technology="{{ $item->id }}">
                                                <img src="{{ asset('storage/uploads/technology/picture/' . $images[0]) }}" style="width: 100%; min-height: 390px;">
                                            </a>
                                        </div>
                                        <div class="form-group {{ $errors->has('water_need_qty.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ '*ปริมาณความต้องการใช้น้ำ' }}</label>
                                            <input type="text" name="water_need_qty[{{ $item->id }}]" id="water-need-qty-{{ $item->id }}" onchange="pipe_calculate('{{ $item->id }}'); fast_calculate('{{ $item->id }}');" value="{{ $draft->water_need_qty[$item->id] or old('water_need_qty.' . $item->id) }}" class="form-control" required>
                                            <input type="hidden" name="technology_price[{{ $item->id }}]" value="{{ $draft->technology_price[$item->id] or $item->price }}">
                                        </div>
                                        <div class="form-group {{ $errors->has('purpose.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ '*จุดประสงค์ของการใช้' }}</label>
                                            <textarea name="purpose[{{ $item->id }}]" cols="3" class="form-control" required>{{ $draft->purpose[$item->id] or old('purpose.' . $item->id) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{ 'งบประมาณ (ถ้ามี)' }}</label>
                                            <input type="text" name="budget[{{ $item->id }}]" value="{{ $draft->budget[$item->id] or old('budget.' . $item->id) }}" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('start_date.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'วันที่มีกำหนดเริ่มต้นน้ำ' }}</label>
                                                    <input type="date" name="start_date[{{ $item->id }}]" value="{{ $draft->start_date[$item->id] or old('start_date.' . $item->id) }}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('start_service_duration.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ระยะเวลารับบริการ' }}</label>
                                                    <input type="date" name="start_service_duration[{{ $item->id }}]" value="{{ $draft->start_service_duration[$item->id] or old('start_service_duration.' . $item->id) }}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('end_service_duration.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ถึง' }}</label>
                                                    <input type="date" name="end_service_duration[{{ $item->id }}]" value="{{ $draft->end_service_duration[$item->id] or old('end_service_duration.' . $item->id) }}" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{ 'อื่นๆ' }}</label>
                                            <textarea name="other[{{ $item->id }}]" cols="3" class="form-control">{{ $draft->other[$item->id] or old('other.' . $item->id) }}</textarea>
                                        </div>
                                        <div class="form-group {{ $errors->has('is_water.' . $item->id) ? 'has-error' : ''}}">
                                            <label class="control-label">{{ 'คุณต้องการติดตั้งท่อส่งน้ำหรือไม่ : ' }}</label>
                                            <input type="radio" name="is_water[{{ $item->id }}]" id="is-water-0" value="0" onclick="is_water(this.value, '{{ $item->id }}')" {{ ((!isset($draft->is_water[$item->id]) or $draft->is_water[$item->id] == 0)) ? "checked" : "" }} required>
                                            <label for="is-water-0" class="control-label">{{ 'ไม่' }}</label>
                                            <input type="radio" name="is_water[{{ $item->id }}]" id="is-water-1" value="1" onclick="is_water(this.value, '{{ $item->id }}')" {{ ((isset($draft->is_water[$item->id]) && $draft->is_water[$item->id] == 1)) ? "checked" : "" }} required>
                                            <label for="is-water-1" class="control-label">{{ 'ใช่' }}</label>
                                        </div>
                                        <div class="row {{ ((!isset($draft->is_water[$item->id]) or $draft->is_water[$item->id] == 0)) ? 'hidden' : '' }}" id="box-is-water-{{ $item->id }}">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label for="" class="control-label">{{ 'แผนที่' }}</label>
                                                  <div id="map{{ $item->id }}" style="width:100%; height: 600px;"></div>
                                                  <script type="text/javascript">
                                                      $(function () {
                                                          ymaps.ready(init{{ $item->id }});

                                                          function init{{ $item->id }}() {
                                                              var myPlacemark,
                                                                  myMap = new ymaps.Map('map{{ $item->id }}', {
                                                                      center: [13.757797803765193, 100.53866103124997],
                                                                      zoom: 5
                                                                  }, {
                                                                      searchControlProvider: 'yandex#search'
                                                                  });

                                                              // Listening for a click on the map
                                                              myMap.events.add('click', function (e) {
                                                                  var coords = e.get('coords');
                                                                  $('#latitude-{{ $item->id }}').val(coords[0]);
                                                                  $('#longitude-{{ $item->id }}').val(coords[1]);
                                                                  var distance = ymaps.coordSystem.geo.getDistance(
                                                                      // start location
                                                                      [$('#reservoir-latitude-{{ $item->id }}').val(), $('#reservoir-longitude-{{ $item->id }}').val()],
                                                                      [coords[0], coords[1]],
                                                                  );
                                                                  // alert(dis);
                                                                  $('#distance-{{ $item->id }}').val(distance.toFixed(2));

                                                                  // Moving the placemark if it was already created
                                                                  if (myPlacemark) {
                                                                      myPlacemark.geometry.setCoordinates(coords);
                                                                  }
                                                                  // Otherwise, creating it.
                                                                  else {
                                                                      myPlacemark = createPlacemark(coords);
                                                                      myMap.geoObjects.add(myPlacemark);
                                                                      // Listening for the dragging end event on the placemark.
                                                                      myPlacemark.events.add('dragend', function () {
                                                                          getAddress(myPlacemark.geometry.getCoordinates());
                                                                      });
                                                                  }
                                                                  getAddress(coords);
                                                              });

                                                              // Creating a placemark
                                                              function createPlacemark(coords) {
                                                                  return new ymaps.Placemark(coords, {
                                                                      iconCaption: 'searching...'
                                                                  }, {
                                                                      preset: 'islands#violetDotIconWithCaption',
                                                                      draggable: true
                                                                  });
                                                              }

                                                              // Determining the address by coordinates (reverse geocoding).
                                                              function getAddress(coords) {
                                                                  myPlacemark.properties.set('iconCaption', 'searching...');
                                                                  ymaps.geocode(coords).then(function (res) {
                                                                      var firstGeoObject = res.geoObjects.get(0);

                                                                      myPlacemark.properties
                                                                          .set({
                                                                              // Forming a string with the object's data.
                                                                              iconCaption: [
                                                                                  // The name of the municipality or the higher territorial-administrative formation.
                                                                                  firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                                                                  // Getting the path to the toponym; if the method returns null, then requesting the name of the building.
                                                                                  firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                                                              ].filter(Boolean).join(', '),
                                                                              // Specifying a string with the address of the object as the balloon content.
                                                                              balloonContent: firstGeoObject.getAddressLine()
                                                                          });
                                                                  });
                                                              }
                                                          }
                                                      })
                                                  </script>
                                              </div>
                                          </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{ 'แนวเส้นท่อ' }}</label>
                                                    <input type="hidden" name="reservoir[{{ $item->id }}]" id="reservoir-{{ $item->id }}" value="{{ $draft->reservoir[$item->id] or old('reservoir.' . $item->id) }}">
                                                    <input type="hidden" name="reservoir_latitude[{{ $item->id }}]" id="reservoir-latitude-{{ $item->id }}" value="{{ $draft->reservoir_latitude[$item->id] or old('reservoir_latitude.' . $item->id) }}">
                                                    <input type="hidden" name="reservoir_longitude[{{ $item->id }}]" id="reservoir-longitude-{{ $item->id }}" value="{{ $draft->reservoir_longitude[$item->id] or old('reservoir_longitude.' . $item->id) }}">
                                                    <select class="form-control" name="reservoir_id[{{ $item->id }}]" onchange="set_resercoir(this.value, '{{ $item->id }}')">
                                                        <option value=""></option>
                                                        @foreach ($reservoir as $reser)
                                                            <option value="{{ $reser->id . ',' . $reser->latitude . ',' . $reser->longitude }}" {{ ((isset($draft->reservoir[$item->id]) && $draft->reservoir[$item->id] == $reser->id)) ? "selected" : "" }}>
                                                                {{ $reser->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">{{ 'ตำแหน่งโรงงานลูกค้า' }}</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('latitude.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ละติจูด' }}</label>
                                                            <input type="text" name="latitude[{{ $item->id }}]" id="latitude-{{ $item->id }}" value="{{ $draft->latitude[$item->id] or old('latitude.' . $item->id) }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('longitude.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ลองจิจูด' }}</label>
                                                            <input type="text" name="longitude[{{ $item->id }}]" id="longitude-{{ $item->id }}" value="{{ $draft->longitude[$item->id] or old('longitude.' . $item->id) }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('distance.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ระยะทางจากอ่างเก็บน้ำ(กม.)' }}</label>
                                                    <input type="text" name="distance[{{ $item->id }}]" id="distance-{{ $item->id }}" value="{{ $draft->distance[$item->id] or old('distance.' . $item->id) }}" class="form-control" readonly>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('pipe_size_need.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ขนาดท่อที่ต้องการ(เมตร)' }}</label>
                                                            <input type="text" name="pipe_size_need[{{ $item->id }}]" id="pipe-size-need-{{ $item->id }}" value="{{ $draft->pipe_size_need[$item->id] or old('pipe_size_need.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    {{-- {{ dd($draft) }} --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('pipe_id.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ขนาดท่อที่เลือกใช้' }}</label>
                                                            <select class="form-control" name="pipe_id[{{ $item->id }}]" id="pipe-id-{{ $item->id }}" onchange="fast_calculate('{{ $item->id }}')">
                                                                <option value=""></option>
                                                                @foreach ($pipes as $pipe)
                                                                    <option value="{{ $pipe->id . ',' . $pipe->size . ',' . $pipe->price . ',' . $pipe->labor_cost }}" {{ ((isset($draft->pipe_select[$item->id]) && $draft->pipe_select[$item->id] == $pipe->id) or old('pipe_id.' . $item->id) == $pipe->id) ? "selected" : "" }}>
                                                                        {{ $pipe->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="pipe_select[{{ $item->id }}]" id="pipe-select-{{ $item->id }}" value="{{ $draft->pipe_select[$item->id] or old('pipe_select.' . $item->id) }}">
                                                            <input type="hidden" name="pipe_size[{{ $item->id }}]" id="pipe-size-{{ $item->id }}" value="{{ $draft->pipe_size[$item->id] or old('pipe_size.' . $item->id) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('fast_flow.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ความเร็วในการไหลของน้ำ(ตร.ม./วินาที)' }}</label>
                                                    <input type="text" name="fast_flow[{{ $item->id }}]" id="fast-flow-{{ $item->id }}" value="{{ $draft->fast_flow[$item->id] or old('fast_flow.' . $item->id) }}" class="form-control" readonly>
                                                    <label>{{ 'ความเร็วที่เหมาะสมคือ 1.00 - 2.50 ตร.ม./วินาที)' }}</label>
                                                </div>
                                                <div class="form-group {{ $errors->has('labor_cost.' . $item->id) ? 'has-error' : ''}}">
                                                    <label class="control-label">{{ 'ค่าแรง : ' }}</label>
                                                    <input type="radio" name="labor_cost[{{ $item->id }}]" id="is-cost-1" onclick="total_calculate('{{ $item->id }}')" value="1" {{ ((isset($draft->labor_cost) && $draft->labor_cost[$item->id] == 1)) ? "checked" : "" }}>
                                                    <label for="is-cost-1" class="control-label">{{ 'รวม' }}</label>
                                                    <input type="radio" name="labor_cost[{{ $item->id }}]" id="is-cost-0" onclick="total_calculate('{{ $item->id }}')" value="0" {{ ((isset($draft->labor_cost) && $draft->labor_cost[$item->id] == 0)) ? "checked" : "" }}>
                                                    <label for="is-cost-0" class="control-label">{{ 'ไม่รวม' }}</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('pipe_price.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ราคาท่อ(เมตร)' }}</label>
                                                            <input type="text" name="pipe_price[{{ $item->id }}]" id="pipe-price-{{ $item->id }}" value="{{ $draft->pipe_price[$item->id] or old('pipe_price.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group {{ $errors->has('pipe_cost_original.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ค่าแรง(เมตร)' }}</label>
                                                            <input type="text" name="pipe_cost_original[{{ $item->id }}]" id="pipe-cost-original-{{ $item->id }}" value="{{ $draft->pipe_cost_original[$item->id] or old('pipe_cost_original.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group {{ $errors->has('pipe_setup_price.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ราคาท่อ' }}</label>
                                                            <input type="text" name="pipe_setup_price[{{ $item->id }}]" id="pipe-setup-price-{{ $item->id }}" value="{{ $draft->pipe_setup_price[$item->id] or old('pipe_setup_size.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group {{ $errors->has('pipe_setup_price.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'ค่าแรง' }}</label>
                                                            <input type="text" name="pipe_cost[{{ $item->id }}]" id="pipe-cost-{{ $item->id }}" value="{{ $draft->pipe_cost[$item->id] or old('pipe_cost.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group {{ $errors->has('total_price.' . $item->id) ? 'has-error' : ''}}">
                                                            <label class="control-label">{{ 'รวม(บาท)' }}</label>
                                                            <input type="text" name="total_price[{{ $item->id }}]" id="total-price-{{ $item->id }}" value="{{ $draft->total_price[$item->id] or old('total_price.' . $item->id) }}" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row" align="center">
                                              <div class="col-md-4">
                                                  <div class="form-group {{ $errors->has('total_price.' . $item->id) ? 'has-error' : ''}}">
                                                      <label class="control-label">{{ 'ราคารวม' }}</label>
                                                      <input type="text" name="total_price[{{ $item->id }}]" id="total-price-{{ $item->id }}" value="{{ $draft->total_price[$item->id] or old('total_price.' . $item->id) }}" class="form-control" readonly>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.box-body -->

                            </div>

                            @endforeach
                            <a href="{{ route(Auth::user()->role . '-create-form', ['form' => 'service']) }}" class="btn btn-danger">
                                {{ 'ย้อนกลับ' }}
                            </a>
                            <input class="btn btn-primary" type="submit" value="{{ 'ถัดไป' }}">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modal-video-title">Video</h4>
                </div>
                <div class="modal-body">
                    <div id="show-thumbnail"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=en"></script>
    <script type="text/javascript">
        $(function () {
            $('#modal-video').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('technology');
                $("#modal-video #show-thumbnail").load("{{ route(Auth::user()->role . '-load-video') }}", 'id=' + id,
                function(){});
            });
        });

        function set_resercoir(value, id) {
            var reservoir = value.split(',');
            $('#reservoir-' + id).val(reservoir[0]);
            $('#reservoir-latitude-' + id).val(reservoir[1]);
            $('#reservoir-longitude-' + id).val(reservoir[2]);
        }

        function pipe_calculate(id) {
            var pipe = parseFloat($('#water-need-qty-' + id).val());
            var pipe_need = Math.sqrt(4*(pipe/(24*60*60)/(1*Math.PI)));
            $('#pipe-size-need-' + id).val(is_nan(pipe_need.toFixed(3)));
        }

        function fast_calculate(id) {
            var pipe_select = $('#pipe-id-' + id).val().split(','),
                pipe_size = parseFloat(pipe_select[1]),
                water_need = parseFloat($('#water-need-qty-' + id).val()),
                distance = parseFloat($('#distance-' + id).val());
                fast_flow = (water_need/(24*60*60))/(Math.PI*(Math.pow(pipe_size, 2)/4)),
                pipe_cost = remainder(parseFloat(pipe_select[3]) * distance);

            pipe_cost = is_nan(pipe_cost);
            fast_flow = is_nan(fast_flow);
            $('#pipe-select-' + id).val(pipe_select[0]);
            $('#pipe-price-' + id).val(pipe_select[2]);
            $('#pipe-cost-' + id).val(pipe_cost);
            $('#fast-flow-' + id).val(fast_flow.toFixed(3));
            $('#pipe-cost-original-' + id).val(pipe_select[3]);
            price_calculate(distance, pipe_select[2], id);
        }

        function price_calculate(distance, pipe_price, id) {
            var total = distance * pipe_price;
            var result = remainder(total);
            $('#pipe-setup-price-' + id).val(parseInt(result));
            // $('#pipe-setup-price-' + id).val(parseFloat(parseInt(result) + (parseFloat(total).toFixed(2) - parseInt(total))).toFixed(2));
            total_calculate(id);
        }

        function total_calculate(id) {
            var value = $("input[name='labor_cost[" + id + "]']:checked").val();
                pipe = parseFloat($('#pipe-setup-price-' + id).val()),
                distance = parseFloat($('#distance-' + id).val());
                cost = parseFloat($('#pipe-cost-' + id).val()) * value;
            $('#total-price-' + id).val(is_nan((pipe + cost).toFixed(2)));
        }

        function split_pipe(id, pipe) {
            var pipe_select = $('#pipe-id-' + id).val().split(',');
            // pipe == 1 (id), == 2 (size), == 3 (price)
            return parseFloat(pipe_select[pipe]);
        }

        function remainder(total) {
            var result = "";
            var remainder = Math.floor( (parseInt(total) / 10) );
            if((parseInt(total) % 10) <= 5)
                result = remainder + '0';
            else
                result =  Math.round( (parseInt(total) / 10) ) * 10;
            return is_nan(result);
        }

        function is_water(value, id) {
            var is_water = value;
            if (is_water == 1) {
                $('#box-is-water-' + id).removeClass('hidden');
            } else {
                $('#box-is-water-' + id).addClass('hidden');
            }
        }

        function is_nan(number) {
            if (isNaN(number)) {
                return 0;
            }
            return number;
        }

        function number_format(n, digit) {
            n = parseFloat(n);
            if (digit == 0) {
                return parseInt(n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
            }
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        }
    </script>
@endsection
