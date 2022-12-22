<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Register Member</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="stylesheet" href="/thriftapp/public/css/create.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once "../app/partials/header.php"?>
    <main class="flex w-full py-4">
        <!-- Registration form -->
        <section class="mx-auto w-2/3 h-full mt-[2rem]">
            <form action="/thriftapp/public/member/create" method="post" onsubmit="return validateFields()">
                <div class="form-inputs mt-5">
                 <h2 class="text-2xl font-bold text-[#5a185a] text-center">Register member</h2>
                 <?php if(isset($data['errors'])): ?>
                    <div class="error">
                        <p><?= join(", ", array_slice($data['errors'], 0, 2)) ?></p>
                    </div>
                 <?php endif ?>
                 <div class="flex justify-between w-[400px] mx-auto">
                    <div>
                        <input type="checkbox" name="isAdmin" value="true"/>
                        <label for="isAdmin" class="text-[#828282]">is admin</label>
                    </div>
                    <div class="hidden" id="doesThrift">
                        <input type="checkbox" name="doesThrift" value="true"/>
                        <label for="doesThrift" class="text-[#828282]">will participate</label>
                    </div>
                </div>
                <div class="input-div firstName">
                    <label for="firstName">First Name</label>
                    <input type="firstName" placeholder="first name" name="firstName" required>
                </div>
                <div class="input-div lastName">
                    <label for="lastName">Last Name</label>
                    <input type="text" placeholder="last name" name="lastName" required>
                </div>
                <div class="input-div email">
                    <label for="email">Email</label>
                    <input type="email" placeholder="john@doe.com" name="email" required>
                </div>
                <div class="input-div" id="groups">
                    <p for="group" class="text-gray-600">Select Group(s)</p>
                    <div class="grid grid-cols-3 gap-y-2 mt-3" id="groups-wrapper">
                    <?php foreach($data['groups']=[] as $label=>$value): ?>
                        <div>
                            <input type="checkbox" name="<?=$label?>" class="group-class" value="<?=$value?>"/>
                            <label for="<?=$label?>" class="text-[#828282]"><?=$label?></label>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div id="password" class="hidden">
                    <div class="input-div" id="password">
                        <label for="password">Password</label>
                        <input type="password" name="password">
                    </div>
                    <div class="input-div mt-5" id="confirmPassword">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="confirmPassword">
                    </div>
                </div>
                
                <input type="submit" value="Submit" name="submit" >
                </div>
                <!-- Just used to send some form state to server, doesn't need to display, it's value is set with js -->
                <div class="hidden">
                        <input type="text" id="selected-groups" name="groups">
                </div>
            </form>
        </section>
    </main>
    <script src="/thriftapp/public/js/index.js"></script>
    <script src="/thriftapp/public/js/create.js"></script>
</body>
</html>