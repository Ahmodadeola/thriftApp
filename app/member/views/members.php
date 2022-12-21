<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrifty - Register Member</title>
   
    <!-- styles and fonts -->
    <link rel="stylesheet" href="/thriftapp/public/css/index.css">
    <link rel="stylesheet" href="/thriftapp/public/css/members.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">  
    
    <!-- js scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php require_once "../app/partials/header.php"?>
    <main class="flex w-full py-4">
        <sectio class="w-3/5 mx-auto py-5">
            <h1 class="text-center text-2xl text-[#A555EC] font-bold">All Group Members</h1>
            <table class="members">
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>is Admin</th>
                    <th>Thrift member</th>
                    <th>Date Created</th>
                </thead>
                <tbody>
                    <?php foreach($data['members'] as $member): ?>
                        <tr>
                            <td><?=$member['firstName'] ?></td>
                            <td><?=$member['lastName'] ?></td>
                            <td><?=$member['email'] ?></td>
                            <td><?= $member['isAdmin'] ?></td>
                            <td><?=$member['doesThrift'] ?></td>
                            <td><?=$member['dateCreated'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </sectio>
    </main>
    <script src="/thriftapp/public/js/create.js"></script>
</body>
</html>