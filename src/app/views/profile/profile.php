<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script>
         function enableEditing() {
            var inputs = document.querySelectorAll('.profile-input');
            var isDisabled = Array.from(inputs).some(input => input.disabled);

            if (isDisabled) {
                // Enable inputs
                inputs.forEach(function(input) {
                    input.disabled = false;
                    input.style.backgroundColor = 'white';
                });
            } else {
                // Submit form
                document.querySelector('form').submit();
            }
        }
    </script>
</head>
<body>
    <!-- navbar -->
    <?php include('/var/www/html/app/includes/navbar.php'); ?>

    <!-- isi -->
    <div class="flex justify-center items-center h-screen">
        <div class="bg-[#B2B2B2] w-full h-[70%] mx-6 lg:mx-80 mt-7 rounded-xl shadow-xl">
            <div>
                <p class="text-xl font-bold text-center p-4 text-white">PROFILE</p>
            </div>
            <div class="w-full h-full bg-[#D9D9D9] text-sm lg:text-base flex justify-center overflow-y-auto" style="max-height: 100%;">
                <form action="">
                    <table class="w-full mt-2 flex justify-center">
                        <tr>
                            <td class="font-semibold w-1/3 px-4 py-2">Nama Lengkap</td>
                            <td class="w-2/3 px-4 py-2">
                                <input type="text" class="p-2 rounded-md bg-[#D9D9D9] profile-input w-1/3 mr-2 px-2 py-1" placeholder="Nama Depan" disabled>
                                <input type="text" class="p-2 rounded-md bg-[#D9D9D9] profile-input w-1/3 px-2 py-1" placeholder="Nama Belakang" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold w-1/3 px-4 py-2">NIM :</td>
                            <td class="w-2/3 px-4 py-2"><input type="text" class="p-2 rounded-md bg-[#D9D9D9] profile-input" value="13120210008" disabled></td>
                        </tr>
                        <tr>
                            <td class="font-semibold w-1/3 px-4 py-2">Email :</td>
                            <td class="w-2/3 px-4 py-2"><input type="email" class="p-2 rounded-md bg-[#D9D9D9] profile-input" value="akbar@gmail.com" disabled></td>
                        </tr>
                        <tr>
                            <td class="font-semibold w-1/3 px-4 py-2">Peran :</td>
                            <td class="w-2/3 px-4 py-2"><input type="text" class="p-2 rounded-md bg-[#D9D9D9] profile-input" value="Asisten" disabled></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="flex justify-center mt-5">
                                    <label class="flex items-center space-x-1">
                                        <input type="checkbox" id="togglePasswordChange" onchange="togglePasswordFields()">
                                        <span>Ubah Password</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr id="newPasswordRow" style="display: none;">
                            <td class="font-semibold w-1/3 px-4 py-2">Password Baru :</td>
                            <td class="w-2/3 px-4 py-2"><input type="password" class="p-2 rounded-sm bg-[#D9D9D9] profile-input" disabled></td>
                        </tr>
                        <tr id="confirmPasswordRow" style="display: none;">
                            <td class="font-semibold w-1/3 px-4 py-2">Konfirmasi Password :</td>
                            <td class="w-2/3 px-4 py-2"><input type="password" class="p-2 rounded-sm bg-[#D9D9D9] profile-input" disabled></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <div class="flex justify-center mt-5">
                                <button type="submit" class="p-4 bg-[#AFD0BC]" onclick="event.preventDefault(); enableEditing();">
                                    Lengkapi Data
                                </button>
                            </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordFields() {
            var isChecked = document.getElementById('togglePasswordChange').checked;
            document.getElementById('newPasswordRow').style.display = isChecked ? "" : "none";
            document.getElementById('confirmPasswordRow').style.display = isChecked ? "" : "none";
        }
    </script>
</body>
</html>
