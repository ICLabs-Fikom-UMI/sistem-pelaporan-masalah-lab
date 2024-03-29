<div class="w-full ps-4 md:ps-10 form hidden" id="ubahDataForm">
                <p class="text-2xl lg:text-3xl font-bold mt-6">Ubah Data</p>
                <div class="mt-7 w-full lg:w-[calc(100vw-300px)]">
                    <div id="buatLaporanIsi" class="mt-16 mr-0 md:mr-16 ">
                        <div
                            class="w-full h-[71vh] bg-[#F9F9FB] p-4 md:p-16 rounded-md border-white border-4 shadow-lg flex justify-center">
                            <table class="w-full" id="ubah-data-table" data-user-id="<?php echo $_SESSION['user_id']; ?>">
                                <tr class="flex justify-start items-center">
                                    <th class="font-semibold w-80 p-5 mb-2  text-start">Nama Pengguna</th>
                                    <td class="font-normal w-full">
                                        <input class="namaDepan bg-[#F9F9FB] border py-3 rounded-md" type="text"
                                            placeholder="Nama Depan">
                                        <input class="namaBelakang bg-[#F9F9FB] border py-3 rounded-md" type="text"
                                            placeholder="Nama Belakang">
                                    </td>
                                </tr>
                                <tr class="flex justify-start items-center mb-2">
                                    <th class="font-semibold w-80 p-5 text-start">Email</th>
                                    <td class="font-normal w-full  text-start">
                                        <input type="email" class="email w-[420px] bg-[#F9F9FB] border py-3 rounded-md"
                                            placeholder="Masukkan Email pengguna">
                                    </td>
                                </tr>
                                <tr class="flex justify-start items-center mb-3">
                                    <th class="font-semibold w-80 p-5 text-start">Nim</th>
                                    <td class="font-normal w-full ">
                                        <input type="text" class="nim w-[420px] bg-[#F9F9FB] border py-3 rounded-md"
                                            placeholder="Masukkan Nim pengguna">
                                    </td>
                                </tr>
                                <tr class="flex justify-start items-center mb-3">
                                    <th class="font-semibold w-80 p-5 text-start">Hak Akses</th>
                                    <td class="font-normal w-full ">
                                        <p id="hak-akses"></p>
                                    </td>
                                </tr>
                                <tr class="flex justify-start items-center mt-10">
                                    <th class="font-semibold  p-5 text-center  w-full" colspan="2">
                                        <button
                                            class="py-3 px-8 bg-[#C2C2C2] rounded-md me-5 hover:bg-[#8A8888] hover:text-white"
                                            type="reset" id="kembaliProfile" >Kembali</button>
                                        <a href="#"
                                            class="py-4 px-8 bg-[#375679] hover:bg-[#273C54] text-white rounded-md"
                                            id="simpanBtnUbahProfile">Simpan</a>
                                    </th>

                                </tr>
                            </table>
                            <div class="w-[600px] " id="menambahkan-foto-profile" >
                                <div class="flex justify-center flex-col items-center">
                                    <img src=""
                                        alt="foto profile" class="foto-profile w-48 h-48 rounded-full">
                                    <div class="">
                                        <!-- Input File tersembunyi -->
                                        <input type="file" id="foto_profile"  name="foto_profile">
                                        <!-- Tombol untuk memicu Input File -->
                                        <button id="uploadButton" class="mt-5 py-1 px-6 bg-[#C2C2C2] hover:bg-[#8A8888] hover:text-white rounded-md" onclick="submitFotoProfile(); ">
                                            Upload File <span id="loadingText"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
