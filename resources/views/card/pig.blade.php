
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path()}}/fonts/THSarabunNew.ttf") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path()}}/fonts/THSarabunNew Bold.ttf") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path()}}/fonts/THSarabunNew Italic.ttf") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path()}}/fonts/THSarabunNew BoldItalic.ttf") format('truetype');
        }

        body, .fs {
            font-family: "THSarabunNew";
        } 

        .hg{
          height:60px!important;
        }
       .center{
        text-align: center;
       }

       .hidden{
          border-color: white;
          color:white;
       }
       .wh{
        color:white;
       }
  
 table td, table th{ border:1px solid black; } 

 .br{
  border-collapse:collapse;
 }

</style>
   

</head>
<body>
    <div class="w3-container">
        <div class="w3-row">
          
            <div class="w3-col m12">
              <center>
                <h1 class="fs">บันทึกเเม่พันธ์ุ</h1>
            </center>
            </div>
        </div>
      
        <div class="w3-row" style="margin-left:40px;">
            <div class="w3-col m4">
              <h4 class="fs">เบอร์แม่พันธ์ุ : {{$pig->pig_id}} </h4>
              <h4 class="fs">สายพันธ์ุ : {{$pig->blood_line}}</h4>
              <h4 class="fs">วันเกิด : {{$pig->birth_date}}</h4>
            </div>
            <div class="w3-col m4">
              <h4 class="fs">ฟาร์ม : {{$pig->pig_id}}</h4>
              <h4 class="fs">วันที่เข้าฟาร์ม :{{$pig->entry_date}} </h4>
              <h4 class="fs">เต้านม : {{$pig->left_breast.'/'.$pig->right_breast}}</h4>  
            </div> 
            <div class="w3-col m4">
              <h4 class="fs">พ่อพันธ์ุ : {{$pig->male_breeder_pig_id}}</h4>
              <h4 class="fs">แม่พันธุ์ : {{$pig->female_breeder_pig_id}}</h4>
              <h4 class="fs">แหล่งที่มา : {{$pig->source}}</h4>
            </div>  
        </div>

        
    <div class="w3-container">
        <style type="text/css">
          .tg  {border-collapse:collapse;border-spacing:0;}
          .tg td{font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg th{font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
          .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
          .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
          </style>
          <table class="tg">
            <tr>
              <th class="tg-0pky" colspan="5">การผสม</th>
              <th class="tg-0pky" colspan="6">การคลอด</th>
              <th class="tg-0pky" colspan="3">การอย่านม</th>
            </tr>
            <tr>
              <td class="tg-c3ow">ชุดผสม</td>
              <td class="tg-c3ow">วันที่ผสม</td>
              <td class="tg-c3ow">พ่อพันธุ์ 1</td>
              <td class="tg-c3ow">พ่อพันธุ์ 2</td>
              <td class="tg-c3ow">พ่อพันธุ์ 3</td>
              <td class="tg-c3ow">วันที่คลอด</td>
              <td class="tg-c3ow">ตาย</td>
              <td class="tg-c3ow">พิการ</td>
              <td class="tg-c3ow">มันมี่</td>
              <td class="tg-c3ow">มีชีวิต</td>
              <td class="tg-c3ow">น้ำหนักเฉลี่ย</td>
              <td class="tg-0pky">วันที่อย่านม</td>
              <td class="tg-0pky">จำนวนหมู</td>
              <td class="tg-0pky">น้ำหนักเฉลี่ย</td>
            </tr>

            @for ($i = 0; $i < $count; $i++)
            
            <tr>
              <td class="tg-0pky">{{ (count($cycle->breeders)>$i)?$cycle->breeders[$i]->breed_week:''}}</td>
              <td class="tg-0pky">{{ (count($cycle->breeders)>$i)?$cycle->breeders[$i]->breed_date:''}}</td>
              <td class="tg-0pky">{{ (count($cycle->breeders)>$i)?$cycle->breeders[$i]->breeder_a:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->breeders)>$i)?$cycle->breeders[$i]->breeder_b:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->breeders)>$i)?$cycle->breeders[$i]->breeder_c:'' }}</td>



               <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->birth_date:''}}</td>
              <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->dead:''}}</td>
              <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->deformed:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->mummy:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->life:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->birth)>$i)?$cycle->birth[$i]->pig_weight_avg:'' }}</td>

              <td class="tg-0pky">{{ (count($cycle->milk)>$i)?$cycle->milk[$i]->milk_date:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->milk)>$i)?$cycle->milk[$i]->pig_count:'' }}</td>
              <td class="tg-0pky">{{ (count($cycle->milk)>$i)?$cycle->milk[$i]->pig_weight_avg:'' }}</td>

            </tr>
                
            @endfor

            @for ($j = $count; $i < 20; $i++)
                
            <tr>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
              <td class="tg-0pky"></td>
            </tr>
           
            @endfor
          </table>
         
         </div>
                
                   
                                   
                
</body>
</html>


