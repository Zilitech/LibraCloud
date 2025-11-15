<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ID Cards</title>

<style>
    @page { margin: 10mm; }
    body { font-family: Arial, sans-serif; margin:0; padding:0; }
    .page { width: 210mm; height: 297mm; display: flex; flex-wrap: wrap; }

    /* CARD CONTAINER */
    .id-card {
        width: 35%;
        background: #ffffff;
        border-radius: 12px;
        padding: 0;
        margin: 1%;
        text-align: center;
        display: inline-block;
        vertical-align: top;
        page-break-inside: avoid;
        box-shadow: 0 0 6px rgba(0,0,0,0.2);
        overflow: hidden;
        border: 1px solid #ccc;
    }

    /* HEADER IMAGE */
    .id-head {
        width: 100%;
        height: 60px;
    }
    .id-head img { width: 100%; height: 100%; object-fit: cover; }

    /* FRONT USER IMAGE */
    .user-image {
        width: 105px;
        height: 120px;
        margin: 5px auto;
        border: 1px solid #999;
        border-radius: 8px;
        overflow: hidden;
    }
    .user-image img { width: 100%; height: 100%; object-fit: cover; }

    /* FRONT INFO */
    .info {
        text-align: left;
        padding: 5px 15px;
        font-size: 13px;
    }
    .info p { margin: 3px 0; }

    /* QR */
    .qr-box img {
        width: 100px;
        height: 100px;
        margin-top: 5px;
    }

    /* MEMBER ID */
    .member-id {
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        margin-top: 0px;
    }

    /* FOOTER */
    /* .id-footer {
        border-top: 3px solid red;
        padding: 10px 5px;
        font-size: 20px;
        font-weight: bold;
    }
    .id-footer span:first-child { color: red; } */

    /* BACK SIDE */
    .back-info {
        text-align: left;
        padding: 10px 20px;
        font-size: 14px;
    }
    .back-info p { margin: 4px 0; }

    .barcode img {
        width: 90%;
        height: 30px;
        margin: 10px auto;
        display: block;
    }

    

</style>
</head>
<body>

<div class="page">

@foreach($members as $member)

    <!-- FRONT SIDE -->
    <div class="id-card">
<table width="100%" style="text-align:center;">
    <tr>
        <td width="20%" style="text-align:left;">
<img src="{{ public_path('uploads/logos/OIP (1).jpg') }}" width="70">
        </td>

        <td width="60%" style="text-align:center;">
            <h5 style="margin-top:0px; font-size:10px; font-weight:bold;">
                Mysore University School of Engineering
            </h5>
        </td>

        <td width="20%" style="text-align:right;">
<img src="{{ public_path('uploads/logos/OIP.jpg') }}" width="70">
        </td>
    </tr>
</table>



<div class="user-image">
   <img src="{{ public_path('profile_photos/' . $member->profilephoto) }}" width="120">

</div>



        <div class="info">
            <p><strong>Name:</strong> {{ $member->fullname }}</p>
            <p><strong>DOB:</strong> {{ $member->dateofbirth }}</p>
            <p><strong>Gender:</strong> {{ $member->gender }}</p>
            <p><strong>Department:</strong> {{ $member->departmentclass}}, {{ $member->yearsemester}}</p>
        </div>

         <div class="barcode">
            <img src="{{ public_path('uploads/logos/download-removebg-preview.png') }}">
        </div>

        <div class="member-id">
            {{ $member->memberid }}
        </div>
  

        
    </div>

    <!-- BACK SIDE -->
    <div class="id-card">
        
      <table width="100%" style="text-align:center;">
    <tr>
        <td width="20%" style="text-align:left;">
<img src="{{ public_path('uploads/logos/OIP (1).jpg') }}" width="70">
        </td>

        <td width="60%" style="text-align:center;">
            <h5 style="margin-top:0px; font-size:10px; font-weight:bold;">
                Mysore University School of Engineering
            </h5>
        </td>

        <td width="20%" style="text-align:right;">
<img src="{{ public_path('uploads/logos/OIP.jpg') }}" width="70">
        </td>
    </tr>
</table>

        <div class="back-info">
            <p><strong>Designation:</strong> {{ $member->membertype }}</p>
            <p><strong>Address:</strong> {{ $member->address }}</p>
                        <p>{{ $member->city }}, {{ $member->pincode }}</p>

            <p>{{ $member->email }}</p>
            <p><strong>Mobile No.:</strong> {{ $member->phone }}</p>
        </div>

        <div class="barcode">
            <img src="{{ public_path('uploads/logos/download-removebg-preview.png') }}">
        </div>

        <div class="member-id">
            {{ $member->member_id }}
        </div>

    </div>

    @if($loop->iteration % 6 == 0)
        </div><div class="page">
    @endif

@endforeach

</div>

</body>
</html>
