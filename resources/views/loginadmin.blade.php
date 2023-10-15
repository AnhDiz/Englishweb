<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">  
    <title>Lựa chọn</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .button-container {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 20px;
            display: inline-block;
            text-align: center;
        }

        .button-container button {
            margin-right: 10px;
        }
        .avtar{
            width:100%;
        }
        
        .avtar i {
            font-size: 3rem; /* Thay đổi kích thước biểu tượng */
        }
      
    </style>
</head>
<body>
    <div class="container">
        <div class="button-container">
            <div class="avtar">
                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                    <i class="bi bi-bootstrap"></i>
                    <h2 class="fs-1">Welcome English!!!</h2>
                </div>
            </div>  
            <br>
            <button onclick="window.location.href='{{ route('home') }}'">home</button>
            <button onclick="window.location.href='{{ route('admin.dashboard') }}'">admin.dashboard</button>
        </div>
    </div>
</body>
</html>