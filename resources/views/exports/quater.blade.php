<table>
    
        @foreach($quaters as $quater)
      
        <tr>
            <th>ไตรมาสที่</th>
            <?php
            $data = '';
            if($quater->report_quater == 1){
                $data = "ไตรมาสที่ 1(1 ม.ค.- 31 มี.ค.)";
            }else if($quater->report_quater == 1){
                $data = "ไตรมาสที่ 2 (1 เม.ย.-30 มิ.ย.)";
            }else if($quater->report_quater == 1){
                $data = "ไตรมาสที่ 3 (1 ก.ค. - 30 ก.ย.)";
            }else{
                $data = "ไตรมาสที่ 4 (1 ต.ค.-31 ธ.ค.)";
            } ?>

            <td> {{  $data }} </td>
        </tr>
        <tr>
            <th>ปี</th>
            <td> {{$quater->report_year}} </td>
        </tr>
        <tr>
            <th>จำนวนแม่พันธุ์ใช้งาน (เก็บเป็นจำนวนต่อวัน/แสดงเป็นXbar)</th>
            <td> {{$quater->active_breeder}} </td>
        </tr>
        <tr>
            <th> จำนวนแม่ผสม (สะสม)</th>
            <td> {{$quater->breeded_breeder}} </td>
        </tr>
        <tr>
            <th>จำนวนแม่คลอด (สะสม)</th>
            <td> {{$quater->delivery_breeder}} </td>
        </tr>
        <tr>
            <th>อัตราเข้าคลอด/ชุดผสม</th>
            <td> {{$quater->delivery_ratio}} </td>
        </tr>
        <tr>
            <th>จำนวนลูกแรกคลอดทั้งหมดต่อครอก</th>
            <td> {{$quater->pig_delivered_rate}} </td>
        </tr>
        <tr>
            <th> เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)</th>
            <td> {{$quater->pig_delivered_died_percent}} </td>
        </tr>
        <tr>
            <th>จำนวนลูกแรกคลอดมีชีวิตต่อครอก</th>
            <td> {{$quater->pig_delivered_success_avg}} </td>
        </tr>
        <tr>
            <th>เฉลี่ยน้ำหนักแรกคลอด/ตัว</th>
            <td> {{$quater->pig_delivered_weight}} </td>
        </tr>
        <tr>
            <th>เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)</th>
            <td> {{$quater->pig_raising_failed_perent}} </td>
        </tr>
        <tr>
            <th>จำนวนแม่หย่านม (สะสม)</th>
            <td> {{$quater->ween_breeder}} </td>
        </tr>
        <tr>
            <th>จำนวนลูกหย่านมทั้งหมด</th>
            <td> {{$quater->pig_ween_number}} </td>
        </tr>
        <tr>
            <th> จำนวนลูกหย่านม/ครอก</th>
            <td> {{$quater->pig_ween_rate}} </td>
        </tr>
        <tr>
            <th>เฉลี่ยน้ำหนักหย่านม/ตัว</th>
            <td> {{$quater->pig_ween_weight_avg}} </td>
        </tr>
        <tr>
            <th>จำนวนครอก/แม่/ปี</th>
            <td> {{$quater->delivered_breeder_rate}} </td>
        </tr>
        <tr>
            <th>จำนวนลูกลูกหย่านม/แม่/ปี (PSY)</th>
            <td> {{$quater->pig_ween_breeder_rate}} </td>
        </tr>
        <tr>
            <th>จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)</th>
            <td> {{$quater->pig_khun_breeder_rate}} </td>
        </tr>
        <tr>
            <th>% สุกรสาวทดแทน</th>
            <td> {{$quater->breeder_replace_number}} </td>
        </tr>
        <tr>
            <th>% แม่สุกรคัดทิ้ง</th>
            <td> {{$quater->breeder_drop_percent}} </td>
        </tr>
        <tr>
            <th>+/- แม่ทดแทนกับแม่คัดทิ้ง</th>
            <td> {{$quater->breeder_replace_drop_sum}} </td>
        </tr>
        
        @endforeach
  
</table>