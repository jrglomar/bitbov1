

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">

  <title>List of Weights and Measure </title>
  <div align="center">
    <figure>
    <img src="{{ public_path() }}/upload/barangay/{{session('session_barangay_logo')}}" alt="Republic of the Philippines" width="100px" />
      <figcaption>Republic of the Philippines</figcaption>
      <figcaption style="text-align: center"><b style="text-decoration: underline;">Barangay Information System</b></figcaption><br>
      <figcaption>List of Weights and Measure Generated By The System.</figcaption>
    </figure>

  </div>
  <div class="row" style="padding:4px; background-color: #666666; margin-bottom: 4px; "></div>
  <style>
  .text-right {
    text-align: right;
  }
  
  </style>


</head>



<body style="background: white">

  <div class="panel-body">
    <!-- FIRST ROW -->
    <p style="font-size: 18px">

    </p>

    <style>
    table, td, th{
      border: 1px solid black;
      border-collapse: collapse;
    }
    .borderless{
      border-bottom: 0px;
      border-left: 0px;
      border-right: 0px;
      border-top:0px;
      border-collapse: separate;
    }
    </style>

    <table style="width: 100%; font-size: 15px">
      <tr>
      
        <td class="borderless" style="width: 70%">Barangay Name:  <b >{{session('session_barangay_name')}}</b></td>
        <td class="borderless" style="width: 30%">Year: <?php echo date('F d, Y');?><b style="text-decoration: underline;"></b></td>
      </tr>

    </table>
    <br>
    <table style="font-size: 15px; width: 100%;" border="1" cellpadding="5">
      <thead>
            <tr>
                <th colspan="1"> No.</th>
                <th colspan="2">Business Name </th>
                <th colspan="2">Device Type</th>
                <th colspan="2">Device Number</th>

                <th colspan="2">Capacity</th>
                <th colspan="2">Status</th>
                <th colspan="2">Date Registered</th>
                <th colspan="2">Active/Inactive</th>
                
            </tr>
        </thead>
        <tbody>
            @php $i = 1 ; $y = 1 @endphp

            @foreach( $DisplayTable as $wmInfo )
            <tr>
                
                <td colspan="1" style=" text-align: center; width:8%">{{ $i++ }}</td>
                <td colspan="2">{{$wmInfo->BI_BUSINESS_NAME}}</td>
                <td colspan="2">
                
                @if($wmInfo->DEVICE_TYPE == "LM")
                Linear Measure (Tape Measure, Yardstick, Caliper, Gauge, etc)
                @elseif($wmInfo->DEVICE_TYPE == "MC")
                Measure of Capacity (Fuel Dispensing Pump, calibration bucket, etc) 
                @elseif($wmInfo->DEVICE_TYPE == "GS")
                Graduated Scale Balance (Weighing Scales, etc)
                @elseif($wmInfo->DEVICE_TYPE == "AB")
                Apothecary Balances (Mineral and Medicinal Uses)
                @else
                @endif
                
                </td>
                <td colspan="2">{{$wmInfo->DEVICE_NUMBER}}</td>

                <td colspan="2">{{$wmInfo->CAPACITY}}</td>
                <td colspan="2">{{$wmInfo->WM_NEW_RENEW_STATUS}}</td>
                <td colspan="2">{{$wmInfo->WM_CREATED_AT}}</td>
                <td colspan="2">
                @if($wmInfo->WM_ACTIVE_FLAG == 1)
                Active
                @elseif($wmInfo->WM_ACTIVE_FLAG == 0)
                Inactive
                @else
                @endif
                </td>
                
            </tr>
            @endforeach
        </tbody>                               
    </table>
  </div><br>
  <div class="row" style="padding:4px; background-color: #666666; margin-bottom: 4px; "></div>
  <div class="" style="font-size: 17px; font-family: arial; text-align: center">
    <br>
    <br>

  </div>
  <!-- end panel-body -->
  <div class="panel" style="text-align: center">
    <b>Generated by</b><br><br>
    <p style="font-family: arial">
    <u>{{session('session_full_name')}}</u><br>
      Name and Signature<br><br>
      <u><?php echo date('F d, Y');?></u>
      <br>
      Date
    </p>
  </div>
</div>
<!-- END TABLE -->

</body>
</html>

<script type="text/javascript"> 
</script>
<!--  <label><b>CERTIFICATION</b></label>
        <p style="margin: 20px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        I hereby certify on my official oath that the foregoing is a correct and complete record of all residents.
        </p> -->