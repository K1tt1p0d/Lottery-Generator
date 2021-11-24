<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lottery Generator</title>
    <link href="{{ secure_asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div class = "container"> 
    <div class = "d-flex justify-content-center mt-5">
      <h1>Lottery Generator</h1>
    </div>
    <div class = "d-flex flex-column">
      @php
        $first_prize = $second_prize_st = $second_prize_nd = $second_prize_rd =
        $similar_first_prize_more = $similar_first_prize_less = $two_digit_prize = "";
      @endphp
      <div class="d-flex justify-content-center">
        <button id="generateBtn" type="button" class="btn btn-outline-primary mt-3" title="ดำเนินการสุ่มรางวัล">ดำเนินการสุ่มรางวัล</button>
      </div>
      @if(isset($_COOKIE["first_prize"]))
        <div id="randomNumbers">
        @php
        $first_prize = $_COOKIE["first_prize"];
        $second_prize_st = $_COOKIE["second_prize_st"];
        $second_prize_nd = $_COOKIE["second_prize_nd"];
        $second_prize_rd = $_COOKIE["second_prize_rd"];
        $similar_first_prize_more = $_COOKIE["similar_first_prize_more"];
        $similar_first_prize_less = $_COOKIE["similar_first_prize_less"];
        $two_digit_prize = $_COOKIE["two_digit_prize"];
        @endphp
      @else
        <div id="randomNumbers" class="d-none">
      @endif
      <div class="d-flex flex-column mt-4">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header p-2 pt-3 pl-3"><h5><b>รางวัลที่ 1</b></h5></div>
              <div class="card-body">
                <spam id="first_prize">{{$first_prize}}</spam>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-header p-2 pt-3 pl-3"><h5><b>รางวัลที่ 2</b></h5></div>
              <div class="card-body">
                <spam id="second_prize_st">{{$second_prize_st}}</spam>
                <spam id="second_prize_nd">{{$second_prize_nd}}</spam>
                <spam id="second_prize_rd">{{$second_prize_rd}}</spam>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <div class="card">
              <div class="card-header p-2 pt-3 pl-3"><h5><b>รางวัลข้างเคียงรางวัลที่ 1</b></h5></div>
              <div class="card-body">
                <spam id="similar_first_prize_more">{{$similar_first_prize_more}}</spam>
                <spam id="similar_first_prize_less">{{$similar_first_prize_less}}</spam>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-header p-2 pt-3 pl-3"><h5><b>รางวัลเลยท้าย 2 ตัว</b></h5></div>
              <div class="card-body">
                <spam id="two_digit_prize">{{$two_digit_prize}}</spam>
              </div>
            </div>
          </div>
        </div>
        <div class="row pt-3 d-flex justify-content-center">
          <input type="text" class="form-control w-25 mr-3" id="check_prize" placeholder="กรอกตัวเลขเพื่อตรวจรางวัล">
          <button id="confirmBtn" type="button" class="btn btn-outline-success" title="ตรวจรางวัล">ตรวจรางวัล</button>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ secure_asset('/js/app.js') }}" defer></script>
</html>