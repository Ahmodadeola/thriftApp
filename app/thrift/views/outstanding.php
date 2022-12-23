<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Thrift Logs</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="stylesheet" href="/thriftapp/public/css/members.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once "../app/partials/header.php"?>
    <main class="flex w-full py-4">
        <section class="w-3/5 mx-auto py-5 mt-[3rem]">
            <h1 class="text-center text-2xl text-[#A555EC] font-bold">Outstanding Logs</h1>
            <table class="members">
                <thead>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th>
                    <div class="flex gap-x-1">
                        <div class="justify-center">
                            <span><</span>
                            <span>></span>
                        </div>
                         <span>Last Payment Date</span>
                    </div>    
                   </th>
                    <th>is Admin</th>
                    <!-- <th>Date Logged</th> -->
                </thead>
                <tbody>
                    <?php foreach($data['thrifts'] as $member): ?>
                        <tr>
                            <td><?=$member['fullName'] ?></td>
                            <td><?=$member['email'] ?></td>
                            <td><?=$member['groupName'] ?></td>
                            <td><?=$member['paymentDate'] ?></td>
                            <td><?= $member['isAdmin']? 'Yes':'No' ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>
    <script src="/thriftapp/public/js/create.js"></script>
</body>
</html>