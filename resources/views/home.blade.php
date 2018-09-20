
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ config('app.name', 'Laravel') }}</div>

                <div class="card-body">
                    <table class="table tablebordered table-striped">
                        <tbody>
                            <tr>
                                <th>เลขที่</th><td>{{ $draft->draft_id }}</td>
                            </tr>
                            <tr>
                                <th>วันที่สร้าง</th><td>{{ date('Y-m-d', strtotime($draft->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>ลุกค้า</th><td>{{ $draft->company }}</td>
                            </tr>
                            <tr>
                                <th>จัดทำโดย</th><td>{{ $draft->sale_name }}</td>
                            </tr>
                            <tr>
                                <th>ปริมาณความต้องการใช้น้ำ</th><td>{{ $draft->water_need_qty }}</td>
                            </tr>
                            <tr>
                                <th>จุดประสงค์ของการใช้</th><td>{{ $draft->purpose }}</td>
                            </tr>
                            <tr>
                                <th>งบประมาณ</th><td>{{ $draft->budget }}</td>
                            </tr>
                            <tr>
                                <th>วันที่กำหนดเริ่มรับน้ำ</th><td>{{ $draft->start_date }}</td>
                            </tr>
                            <tr>
                                <th>ระยะเวลารับบริการ</th><td>{{ $draft->start_service_duration }}</td>
                            </tr>
                            <tr>
                                <th>ถึง</th><td>{{ $draft->end_service_duration }}</td>
                            </tr>
                            <tr>
                                <th>อื่นๆ</th><td>{{ $draft->other }}</td>
                            </tr>
                            <tr>
                                <th>ความต้องการใช้น้ำ East water</th><td>{{ $draft->cork_water }}</td>
                            </tr>
                            <tr>
                                <th>ขนาดท่อ</th><td>{{ $draft->pipe_size_need }}</td>
                            </tr>
                            <tr>
                                <th>ราคาค่าวางท่อ</th><td>{{ $draft->pipe_setup_price }}</td>
                            </tr>
                            <tr>
                                <th>ราคารวม</th><td>{{ number_format($draft->total_price) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
