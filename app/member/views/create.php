<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Register Member</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="stylesheet" href="/thriftapp/public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once "../app/partials/header.php"?>
    <main class="flex w-full h-[100vh] py-4">
        <!-- Registration form -->
        <section class="mx-auto w-2/3 h-full">
            <form action="/thriftapp/public/member/login" method="post">
                <div class="form-inputs">
                 <h2 class="text-2xl font-bold text-[#5a185a]">Register member</h2>
                 <?php if(isset($data['error'])): ?>
                    <div class="error">
                        <p><?= $data['error'] ?></p>
                    </div>
                 <?php endif ?>
                <div class="input-div">
                    <label for="email">Email</label>
                    <input type="email" placeholder="john@doe.com" name="email" required>
                </div>
                <div class="input-div">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>
                <input type="submit" value="Login" name="submit" >
                </div>
               
            </form>
        </section>
    </main>
</body>
</html>