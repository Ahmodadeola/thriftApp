<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Log pay</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="stylesheet" href="/thriftapp/public/css/logpay.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once "../app/partials/header.php"?>
    <main class="flex w-full py-4">
        <!-- Log pay form -->
        <section class="mx-auto w-2/3 h-full mt-[2rem]">

        <h2 class="text-2xl font-bold text-[#5a185a] text-center mb-[2rem]">Log Thrift Pay</h2>
        
        <!-- render server side  errors if present-->
        <?php if(isset($data['errors'])): ?>
                <div class="error">
                    <p><?= join(", ", array_slice($data['errors'], 0, 2)) ?></p>
                        </div>
            <?php endif ?>

        <!-- Member search form -->
        <form action="" id="search">
                     <div class="input-div name">
                        <label for="name">Find member</label>
                        <input type="text" value="<?= isset($data['key'])? $data['key'] :''?>"  placeholder="keyword" name="key" required>
                        <div>
                            <input type="submit" value="find" class="" id="find">
                        </div>
                    </div>
        </form>

        <?php if(isset($data['searchResults'])): ?>
            <form action="/thriftapp/public/member/logpay">
                 <!-- this hidden input is neeeded to maintain the exisiting url queries after form has been sent -->
                <input type="text" value="<?= isset($data['key'])? $data['key'] :''?>"  class="hidden" name="key" required>
                 <div class="input-div my-[2rem]" id="member">
                   <label>Select option</label>
                     <select name="member" value="<?= isset($data['member'])? $data['member'] :''?>" value="" required>
                        <option value="">Choose member</option>
                        <?php foreach($data['searchResults'] as $member): ?>
                            <option <?= isset( $data['member']) && $data['member'] === $member['userId']? 'selected' : ''?> value="<?=$member['userId']?>">
                                    <?=$member['fullName'] ?>
                            </option>
                        <?php endforeach ?>
                        </select>
                        <div>
                            <input type="submit" value="set" class="" id="set">
                        </div>
                    </div>
             </form>
        <?php endif ?>

         <div class="form-inputs mt-5">    
            <!-- Thrift form -->
            <form id="thriftpay" method="POST" action="/thriftapp/public/member/logpay" onsubmit="return validateFields()">
                <div class="input-div" id="groups">
                    <div id="groups-wrapper">
                        <?php if(count($data['groups']) > 0): ?>
                        <p for="group" class="text-gray-600">Select Group(s)</p>
                        <div class="grid grid-cols-3 gap-y-2 mt-3" >
                            <?php foreach($data['groups'] as $label=>$value): ?>
                               
                                <div>
                                    <input type="checkbox" name="<?=$label?>" class="group-class" value="<?=$value?>"/>
                                    <label for="<?=$label?>" class="text-[#828282]"><?=$label?></label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <?php endif ?>
                    </div>
                </div>
                <div class="input-div mt-[1rem]">
                        <label for="paymentDate">Payment Date</label>
                        <input type="date" name="paymentDate" required/>
                     <input type="submit" value="Submit" name="submit">
                </div>
                <!-- Just used to send some form state to server, doesn't need to display, it's value is set in the js file-->
                <div class="hidden">
                        <input type="text" id="selected-groups" name="groups">
                        <input type="text" id="selected-member" name="member" value="<?=isset($data['member'])? $data['member'] : ''?>"> 
                </div>
            </form>
         </div>
        </section>
    </main>
    <script src="/thriftapp/public/js/index.js"></script>
    <script src="/thriftapp/public/js/logpay.js"></script>
</body>
</html>