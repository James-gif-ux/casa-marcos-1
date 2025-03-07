<?php
    include 'nav/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu - Casa Marcos</title>
    <style>
     
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 2.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 2rem;
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        input[type="text"] {
            width: calc(50% - 10px);
            padding: 15px;
            margin: 8px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        input[type="text"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52,152,219,0.3);
            outline: none;
        }

        textarea {
            width: 100%;
            height: 180px;
            padding: 15px;
            margin: 8px 0;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            resize: vertical;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52,152,219,0.3);
            outline: none;
        }

        .upload-btn {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: block;
            margin: 1.5rem auto;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(52,152,219,0.3);
        }

        .upload-btn:hover {
            background: linear-gradient(135deg, #2980b9, #2573a7);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52,152,219,0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Food Menu</h1>
        <form>
            <div class="form-group">
                <input type="text" placeholder="Food Menu Item" id="foodMenu" required> 
                <input type="text" placeholder="Price" id="price" required>
            </div>
            <div class="form-group">
                <textarea name="food" placeholder="Enter food description..." required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="upload-btn">Upload Photo</button>
            </div>
        </form>
    </div>
</body>
</html>