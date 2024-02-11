
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
       #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 99;
    }
      .popup-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        z-index: 100;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
    }
</style>
<body>
<div id="overlay" style="display: none;"></div>
      <div id="popupDiv" class="fixed popup-container w-11/12  md:w-[40%] h-[70%] overflow-y-auto" style="display: none;">
        <!-- x mark -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 384 512" onclick="closePopup()"><path fill="currentColor" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7L86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256L41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256z"/></svg>
        <!-- Popup Content Here -->
        <div class="flex justify-center mt-5 px-4 md:px-14">
            <table id="detailTable" class="w-full  text-sm md:text-base">
            <!-- Tabel akan diisi dengan data di sini -->
            </table>
        </div>
</div>

<script>
     //   pop up
     function showPopup() {
        var popupDiv = document.getElementById("popupDiv");
        var overlay = document.getElementById("overlay");

        if (popupDiv.style.display === "none") {
            popupDiv.style.display = "block";
            overlay.style.display = "block";
        } else {
            popupDiv.style.display = "none";
            overlay.style.display = "none";
        }
    }
    function closePopup() {
        var table = document.getElementById("detailTable");
        table.innerHTML = ""; // Mengosongkan isi dari elemen dengan id "detailTable"
        var popupDiv = document.getElementById("popupDiv");
        var overlay = document.getElementById("overlay");
        popupDiv.style.display = "none";
        overlay.style.display = "none";
    }
</script>
</body>
</html>
