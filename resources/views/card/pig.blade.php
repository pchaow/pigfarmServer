
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
      
        <div class="w3-row">
            <div class="w3-col m4">
              <h4 class="fs">เบอร์แม่พันธ์ุ : {{$pig->pig_id}} </h4>
              <h4 class="fs">สายพันธ์ุ : {{$pig->blood_line}}</h4>
              <h4 class="fs">วันเกิด : {{$pig->birth_date}}</h4>
            </div>
            <div class="w3-col m4">
              <h4 class="fs">ฟาร์ม : {{$pig->pig_id}}</h4>
              <h4 class="fs">วันที่เข้าฟาร์ม :{{$pig->entry_date}} </h4>
              <h4 class="fs">เต้านม : {{$pig->left_breast+$pig->right_breast}}</h4>  
            </div> 
            <div class="w3-col m4">
              <h4 class="fs">พ่อพันธ์ุ : {{$pig->male_breeder_pig_id}}</h4>
              <h4 class="fs">แม่พันธุ์ : {{$pig->female_breeder_pig_id}}</h4>
              <h4 class="fs">แหล่งที่มา : {{$pig->source}}</h4>
            </div>  
        </div>
      

         
          <table border="1" class="br">
             <tr> 
                    <th>การผสมพันธ์ุ</th> 
                    <th>การคลอด</th>
                    <th>หย่านม</th> 
                  </tr>
               
                  <tr> 
                          <th valign="top" >
                                  <table border="1"   class="br">
                                  <tr>
                                            <th>ชุดผสม</th>
                                            <th>วันที่ผสม</th> 
                                            <th>พ่อพันธุ์ 1</th>
                                            <th>พ่อพันธุ์ 2</th>
                                            <th>พ่อพันธุ์ 3</th>
                                          </tr>
                                       
                                    @foreach ($cycle->breeders as $breeder)
                                    <tr>
                                          <td>{{$breeder->breed_week}}</td>
                                          <td>{{$breeder->breed_date}}</td> 
                                          <td>{{$breeder->breeder_a}}</td>
                                          <td>{{$breeder->breeder_b}}</td>
                                          <td>{{$breeder->breeder_c}}</td>
                                        </tr> 
                                  @endforeach 
                                        
                                        </table>
                          </th>
      
                          <th valign="top">
                                      <table   border="1"  class="br"  >
                                            <tr>
                                                        <th> วันที่</th>  
                                                        <th>ตาย</th>
                                                        <th>พิการ</th>
                                                        <th>มัมมี่</th>
                                                        <th>มีชีวิต</th>
                                                        <th>น้ำหนักเฉลี่ย</th> 
                                                      </tr>
                                              
                                                    @foreach ($cycle->birth as $birth)
                                                      <tr>
                                                              <td>{{$birth->birth_date}}</td>
                                                              <td>{{$birth->dead}}</td> 
                                                              <td>{{$birth->deformed}}</td> 
                                                              <td>{{$birth->mummy}}</td>
                                                              <td>{{$birth->life}}</td> 
                                                              <td>{{$birth->pig_weight_avg}}</td> 
                                                            </tr> 
                                                      @endforeach  
                                      </table>
      
                          </th>
      
                          <th valign="top" >
                              <table  border="1" class="br">
                                   <tr style="height:auto;">
                                        <th> วันที่หย่านม</th> 
                                        <th>จำนวนหมู</th>
                                        <th>น้ำหนักเฉลี่ย</th> 
                                      </tr>
                                  
                                   @foreach ($cycle->milk as $milk)
                                      <tr>
                                              <td>{{$milk->milk_date}}</td>
                                              <td>{{$milk->pig_count}}</td> 
                                              <td>{{$milk->pig_weight_avg}}</td> 
                                            </tr> 
                                      @endforeach  

                              </table>
                          </th>
                  
                        </tr>
                 
                </table>
         
         </div>
                
                   
                                   
                
</body>
</html>


