<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>
    <?php
    include('navbar.php');  
    ?>

    <div class="profile-container">
        <h1>Welcome to Your Profile , Customer</h1>
       
        <div class="buttons-container">
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </div>

    <script>
        function logout() {
            localStorage.clear();
            window.location.href = '/login.php'; 
        }
    </script>

    <style>
        .profile-container {
            text-align: center;
            margin-top: 50px;
        }

        .buttons-container {
            margin-top: 20px;
        }

        .action-btn {
            background-color: #4CAF50; 
            color: white;
            padding: 15px 32px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .action-btn:hover {
            background-color: #45a049; 
        }

        .action-btn:active {
            background-color: #3e8e41; 
        }

        .logout-btn {
            background-color: #f44336; 
            color: white;
            padding: 15px 32px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #d32f2f; 
        }

        .logout-btn:active {
            background-color: #c62828; 
        }
    </style>
</body>
</html>
