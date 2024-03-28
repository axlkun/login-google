<?php

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- component -->
    <div class="flex items-center h-screen w-full justify-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="bg-white shadow-xl rounded-lg py-3">
                <div class="photo-wrapper p-2">
                    <img class="w-24 h-24 rounded-full mx-auto" src="https://www.gravatar.com/avatar/bfcb1d6a22d7098499771d3bcec5a8c4?d=identicon&f=y&s=128" alt="Profile imgae">
                </div>
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8">Axel Cruz</h3>
                    <div class="text-center text-gray-400 text-xs font-semibold">
                        <p>Usuario</p>
                    </div>
                    <table class="text-xs my-3 mx-auto">
                        <tbody>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-bold">ID</td>
                                <td class="px-2 py-2">977 9955221114</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-bold">Email</td>
                                <td class="px-2 py-2">john@exmaple.com</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center my-3">
                        <a class="text-xs text-indigo-500 italic hover:underline hover:text-indigo-600 font-medium" href="logout.php">Logout</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</body>

</html>