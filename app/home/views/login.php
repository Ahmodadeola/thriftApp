<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Login</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/login.css">
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="flex w-full h-[100vh] py-4">
        <!-- Login Image -->
        <section class="h-[100vh] w-[45vw] fixed">
            <p class="text-4xl font-black mx-4 text-[#A555EC]">Thrifty</p>
            <img src="/thriftapp/public/assets/images/login.jpg" alt="login-img" class="side-img">
        </section>

        <!-- Login form -->
        <section class="ml-[45vw] w-full h-full">
            <form action="/thriftapp/public/home/login" method="post" onsubmit="return validateFields()">
                <div class="form-inputs">
                    <p class="text-lg">Welcome Back!</p>
                 <h2 class="text-2xl font-bold text-[#5a185a]">Admin Login</h2>
                 <?php if(isset($data['errors'])): ?>
                    <div class="error">
                        <p><?= join(", ", array_slice($data['errors'], 0, 2)) ?></p>
                    </div>
                 <?php endif ?>
                <div class="input-div email">
                    <label for="email">Email</label>
                    <input type="email" placeholder="john@doe.com" name="email" required>
                </div>
                <div class="input-div password">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <input type="submit" value="Login" name="submit" >
                </div>
               
            </form>
        </section>
    </main>
    <script src="/thriftapp/public/js/index.js"></script>
    <script src="/thriftapp/public/js/login.js"></script>
</body>
</html>