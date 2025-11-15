<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ID Card</title>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .id-card {
        width: 350px;
        height: 550px;
        background: #ffffff;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 0 12px rgba(0,0,0,0.2);
        margin: 30px auto;
        position: relative;
        text-align: center;
    }

    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-section img {
        width: 60px;
        height: 60px;
    }

    .college-name {
        font-size: 18px;
        font-weight: bold;
        margin-top: 5px;
        text-transform: uppercase;
    }

    .profile-pic {
        width: 120px;
        height: 140px;
        border-radius: 10px;
        margin: 15px auto;
        border: 2px solid #ddd;
        object-fit: cover;
    }

    .details {
        text-align: left;
        font-size: 14px;
        margin: 10px 0 0 10px;
    }

    .details p {
        margin: 4px 0;
    }

    .barcode {
        margin-top: 15px;
    }

    .barcode img {
        width: 220px;
        height: 60px;
    }

    .register-id {
        margin-top: 10px;
        font-weight: bold;
        font-size: 15px;
    }

    .signature {
        position: absolute;
        right: 15px;
        bottom: 20px;
        text-align: center;
        font-size: 13px;
    }

    .signature img {
        width: 90px;
    }
</style>

</head>
<body>

<div class="id-card">

    <!-- Top Left & Right Logos -->
    <div class="top-section">
        <img src="https://via.placeholder.com/60" alt="Left Logo">
        <img src="https://via.placeholder.com/60" alt="Right Logo">
    </div>

    <!-- College Name -->
    <div class="college-name">ABC College of Engineering</div>

    <!-- Student Photo -->
    <img src="https://via.placeholder.com/120x140" class="profile-pic" alt="Student Photo">

    <!-- Student Details -->
    <div class="details">
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Date of Birth:</strong> 15-08-2003</p>
        <p><strong>Branch:</strong> Computer Science</p>
        <p><strong>Blood Group:</strong> O+</p>
        <p><strong>Validity:</strong> 2024 - 2027</p>
    </div>

    <!-- Barcode -->
    <div class="barcode">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=123456789&code=Code128" alt="Barcode">
    </div>

    <!-- Register Number -->
    <div class="register-id">Reg ID: 123456</div>

    <!-- Principal Signature -->
    <div class="signature">
        <img src="https://via.placeholder.com/90x40" alt="Signature">
        <div>Principal</div>
    </div>

</div>

</body>
</html>
