<table>

    <tr>
        <th>ข้อมูลการผลิต</th>
        @for($i=0;$i<5;$i++)
        <td>เป้า</td>
        <td>ทำจริง</td>
        <td>แตกต่าง</td>
        @endfor
    </tr>

    <tr>
        <th>ไตรมาสที่</th>


        @foreach($quaters as $quater)
            <?php
                $date = '';
            $data = '';
            if($quater->report_quater == 1){
                $data = "1";
                $date = "(1 ม.ค.- 31 มี.ค.)";
            }else if($quater->report_quater == 2){
                $data = "2";
                $date = "(1 เม.ย.-30 มิ.ย.)";
            }else if($quater->report_quater == 3){
                $data = "3";
                $date = "(1 ก.ค. - 30 ก.ย.)";
            }else if($quater->report_quater == 4){
                $data = "4";
                $date = "(1 ต.ค.-31 ธ.ค.)";
            }else{
                $data = "ปี";
                $date = "(ทั้งปี)";
            } ?>

                @for($i=0;$i<3;$i++)

                    <td><center> {{  $data }} <br> <h4 style="font-size:12px;">{{$date}}</h4> </center></td>
                @endfor
        @endforeach

    </tr>


        <tr>
            <th>จำนวนแม่พันธุ์ใช้งาน (เก็บเป็นจำนวนต่อวัน/แสดงเป็นXbar)</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                    $goal = '';
                    if($index == 0){
                        $goal = $goalQ1->active_breeder;
                    }else if($index == 1){
                        $goal = $goalQ2->active_breeder;
                    }
                    else if($index == 2){
                        $goal = $goalQ3->active_breeder;
                    }
                    else{
                        $goal = $goalQ4->active_breeder;
                    }
                ?>
                    <td> {{$goal}} </td>
                <td> {{$quater->active_breeder}} </td>
                    <td> {{$goal-$quater->active_breeder}} </td>
                <?php $index++ ?>
            @endforeach


        </tr>
        <tr>
            <th> จำนวนแม่ผสม (สะสม)</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->breeded_breeder;
                }else if($index == 1){
                    $goal = $goalQ2->breeded_breeder;
                }
                else if($index == 2){
                    $goal = $goalQ3->breeded_breeder;
                }
                else{
                    $goal = $goalQ4->breeded_breeder;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->breeded_breeder}} </td>
                <td> {{$goal-$quater->breeded_breeder}} </td>
                <?php $index++ ?>
            @endforeach

        </tr>


        <tr>
            <th>จำนวนแม่คลอด (สะสม)</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->delivery_breeder;
                }else if($index == 1){
                    $goal = $goalQ2->delivery_breeder;
                }
                else if($index == 2){
                    $goal = $goalQ3->delivery_breeder;
                }
                else{
                    $goal = $goalQ4->delivery_breeder;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->delivery_breeder}} </td>
                <td> {{$goal-$quater->delivery_breeder}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>อัตราเข้าคลอด/ชุดผสม</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->delivery_ratio;
                }else if($index == 1){
                    $goal = $goalQ2->delivery_ratio;
                }
                else if($index == 2){
                    $goal = $goalQ3->delivery_ratio;
                }
                else{
                    $goal = $goalQ4->delivery_ratio;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->delivery_ratio}} </td>
                <td> {{$goal-$quater->delivery_ratio}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนลูกแรกคลอดทั้งหมดต่อครอก</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_delivered_rate;
                }else if($index == 1){
                    $goal = $goalQ2->pig_delivered_rate;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_delivered_rate;
                }
                else{
                    $goal = $goalQ4->pig_delivered_rate;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_delivered_rate}} </td>
                <td> {{$goal-$quater->pig_delivered_rate}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th> เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_delivered_died_percent;
                }else if($index == 1){
                    $goal = $goalQ2->pig_delivered_died_percent;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_delivered_died_percent;
                }
                else{
                    $goal = $goalQ4->pig_delivered_died_percent;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_delivered_died_percent}} </td>
                <td> {{$goal-$quater->pig_delivered_died_percent}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนลูกแรกคลอดมีชีวิตต่อครอก</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_delivered_success_avg;
                }else if($index == 1){
                    $goal = $goalQ2->pig_delivered_success_avg;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_delivered_success_avg;
                }
                else{
                    $goal = $goalQ4->pig_delivered_success_avg;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_delivered_success_avg}} </td>
                <td> {{$goal-$quater->pig_delivered_success_avg}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>เฉลี่ยน้ำหนักแรกคลอด/ตัว</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_delivered_weight;
                }else if($index == 1){
                    $goal = $goalQ2->pig_delivered_weight;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_delivered_weight;
                }
                else{
                    $goal = $goalQ4->pig_delivered_weight;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_delivered_weight}} </td>
                <td> {{$goal-$quater->pig_delivered_weight}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_raising_failed_perent;
                }else if($index == 1){
                    $goal = $goalQ2->pig_raising_failed_perent;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_raising_failed_perent;
                }
                else{
                    $goal = $goalQ4->pig_raising_failed_perent;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_raising_failed_perent}} </td>
                <td> {{$goal-$quater->pig_raising_failed_perent}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนแม่หย่านม (สะสม)</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->ween_breeder;
                }else if($index == 1){
                    $goal = $goalQ2->ween_breeder;
                }
                else if($index == 2){
                    $goal = $goalQ3->ween_breeder;
                }
                else{
                    $goal = $goalQ4->ween_breeder;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->ween_breeder}} </td>
                <td> {{$goal-$quater->ween_breeder}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนลูกหย่านมทั้งหมด</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_ween_number;
                }else if($index == 1){
                    $goal = $goalQ2->pig_ween_number;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_ween_number;
                }
                else{
                    $goal = $goalQ4->pig_ween_number;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_ween_number}} </td>
                <td> {{$goal-$quater->pig_ween_number}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th> จำนวนลูกหย่านม/ครอก</th>
            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_ween_rate;
                }else if($index == 1){
                    $goal = $goalQ2->pig_ween_rate;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_ween_rate;
                }
                else{
                    $goal = $goalQ4->pig_ween_rate;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_ween_rate}} </td>
                <td> {{$goal-$quater->pig_ween_rate}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>เฉลี่ยน้ำหนักหย่านม/ตัว</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_ween_weight_avg;
                }else if($index == 1){
                    $goal = $goalQ2->pig_ween_weight_avg;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_ween_weight_avg;
                }
                else{
                    $goal = $goalQ4->pig_ween_weight_avg;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_ween_weight_avg}} </td>
                <td> {{$goal-$quater->pig_ween_weight_avg}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนครอก/แม่/ปี</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->delivered_breeder_rate;
                }else if($index == 1){
                    $goal = $goalQ2->delivered_breeder_rate;
                }
                else if($index == 2){
                    $goal = $goalQ3->delivered_breeder_rate;
                }
                else{
                    $goal = $goalQ4->delivered_breeder_rate;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->delivered_breeder_rate}} </td>
                <td> {{$goal-$quater->delivered_breeder_rate}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนลูกลูกหย่านม/แม่/ปี (PSY)</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_ween_breeder_rate;
                }else if($index == 1){
                    $goal = $goalQ2->pig_ween_breeder_rate;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_ween_breeder_rate;
                }
                else{
                    $goal = $goalQ4->pig_ween_breeder_rate;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_ween_breeder_rate}} </td>
                <td> {{$goal-$quater->pig_ween_breeder_rate}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->pig_khun_breeder_rate;
                }else if($index == 1){
                    $goal = $goalQ2->pig_khun_breeder_rate;
                }
                else if($index == 2){
                    $goal = $goalQ3->pig_khun_breeder_rate;
                }
                else{
                    $goal = $goalQ4->pig_khun_breeder_rate;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->pig_khun_breeder_rate}} </td>
                <td> {{$goal-$quater->pig_khun_breeder_rate}} </td>
                <?php $index++ ?>
            @endforeach

        </tr>


        <tr>
            <th>% สุกรสาวทดแทน</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->breeder_replace_number;
                }else if($index == 1){
                    $goal = $goalQ2->breeder_replace_number;
                }
                else if($index == 2){
                    $goal = $goalQ3->breeder_replace_number;
                }
                else{
                    $goal = $goalQ4->breeder_replace_number;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->breeder_replace_number}} </td>
                <td> {{$goal-$quater->breeder_replace_number}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>% แม่สุกรคัดทิ้ง</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->breeder_drop_percent;
                }else if($index == 1){
                    $goal = $goalQ2->breeder_drop_percent;
                }
                else if($index == 2){
                    $goal = $goalQ3->breeder_drop_percent;
                }
                else{
                    $goal = $goalQ4->breeder_drop_percent;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->breeder_drop_percent}} </td>
                <td> {{$goal-$quater->breeder_drop_percent}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>


        <tr>
            <th>+/- แม่ทดแทนกับแม่คัดทิ้ง</th>

            <?php $index=0; ?>
            @foreach($quaters as $quater)
                <?php
                $goal = '';
                if($index == 0){
                    $goal = $goalQ1->breeder_replace_drop_sum;
                }else if($index == 1){
                    $goal = $goalQ2->breeder_replace_drop_sum;
                }
                else if($index == 2){
                    $goal = $goalQ3->breeder_replace_drop_sum;
                }
                else{
                    $goal = $goalQ4->breeder_replace_drop_sum;
                }
                ?>
                <td> {{$goal}} </td>
                <td> {{$quater->breeder_replace_drop_sum}} </td>
                <td> {{$goal-$quater->breeder_replace_drop_sum}} </td>
                <?php $index++ ?>
            @endforeach
        </tr>
        
        
  
</table>

<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
    }
    td {
        width:250px;
    }
    th {
        width:900px!important;
    }
</style>