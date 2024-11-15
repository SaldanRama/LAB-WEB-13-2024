<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            const newPassword = document.getElementById("new_password").value;
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            
            if (!regex.test(newPassword)) {
                alert("Password baru harus memiliki minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan karakter khusus.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center justify-center min-h-screen bg-blue-400 p-4">
    <h1 class="text-gray-800 text-[3rem] md:text-[5rem] font-bold">GANTI PASSWORD <br><span class="bg-blue-700 bg-clip-text text-transparent">MAHASISWA</span></h1>
    <div class="w-full max-w-xl">
        <form method="POST" class="bg-transparent shadow-md rounded px-8 pt-6 pb-8 mb-4" onsubmit="return validateForm()">
            <div class="mb-4">
                <label class="block text-black text-lg md:text-xl font-bold mb-2" for="username">Username</label>
                <input class="bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-white w-full py-2 px-3 text-black text-base md:text-lg focus:outline-none focus:border-b-2" id="username" name="username" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-black text-lg md:text-xl font-bold mb-2" for="old_password">Password Lama</label>
                <input class="bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-white w-full py-2 px-3 text-black text-base md:text-lg focus:outline-none focus:border-b-2" id="old_password" name="old_password" type="password" required>
            </div>
            <div class="mb-6">
                <label class="block text-black text-lg md:text-xl font-bold mb-2" for="new_password">Password Baru</label>
                <input class="bg-transparent shadow-[0px_4px_10px_rgba(0,0,0,0.5)] appearance-none border-b-2 border-white w-full py-2 px-3 text-black text-base md:text-lg focus:outline-none focus:border-b-2" id="new_password" name="new_password" type="password" required>
            </div>
            <?php if (isset($message)) { echo "<p class='mb-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded'>$message</p>"; } ?>
            <div class="flex flex-col md:flex-row gap-3 md:gap-5 items-center justify-between">
                <button class="w-full md:text-center bg-yellow-700 hover:bg-yellow-900 hover:border-yellow-500 text-white font-bold py-2 px-4 rounded" type="submit" name="change_password">Ganti Password</button>
                <a class="w-full md:text-center bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" href="login.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
