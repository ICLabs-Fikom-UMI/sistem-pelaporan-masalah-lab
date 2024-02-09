<div class="w-full ps-4 md:ps-10 form hidden " id="buatLaporanForm">
                <p class="text-2xl lg:text-3xl font-bold mt-6">Buat Laporan</p>
                <div class="mt-7 w-full lg:w-[calc(100vw-300px)]">
                    <div id="buatLaporanIsi" class="mt-16 mr-0 md:mr-16 ">
                        <div
                            class="w-full h-[71vh] bg-[#F9F9FB] p-4 md:p-16 rounded-md border-white border-4 shadow-lg ">
                            <form id="formBuatLaporan" action="">
                                <table class="w-full" id="buat-laporan-table">
                                    <tr class="flex justify-start items-center">
                                        <th class="font-semibold w-80 p-5 mb-2s  text-start">Nama Ruangan</th>
                                        <td class="font-normal w-full"><select name="id_lab" id="nama-lab"
                                                class="border border-gray-300 w-full p-3 bg-[#F9F9FB] rounded-md" required>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="flex justify-start items-center mb-2">
                                        <th class="font-semibold w-80 p-5 text-start">Jenis Barang</th>
                                        <td class="font-normal w-full  text-start">
                                            <select name="id_aset" id="jenis-barang"
                                                class="border p-3 border-gray-300 w-full bg-[#F9F9FB] rounded-md" required>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="flex justify-start items-center mb-3">
                                        <th class="font-semibold w-80 p-5 text-start">Nomor</th>
                                        <td class="font-normal w-full "><input
                                                class="w-full border border-gray-300 p-3 rounded-md" type="text"
                                                placeholder="Masukkan nomor unit. Contohnya: 1,2 atau 1-5" name="no_unit"></td>
                                    </tr>
                                    <tr class="flex justify-start items-center ">
                                        <th class="font-semibold w-80 p-5 text-start">Deskripsi</th>
                                        <td class="font-normal w-full  text-start"><textarea name="deskripsi" id="deskripsi"
                                                cols="20" rows="3" class="border border-gray-300 w-full p-3 rounded-md"
                                                placeholder="Masukkan detail permasalahan"></textarea>
                                        </td>
                                    </tr>
                                    <tr class="flex justify-start items-center mt-10">
                                        <th class="font-semibold  p-5 text-center  w-full" colspan="2">
                                            <button
                                                class="py-3 px-8 bg-[#C2C2C2] rounded-md me-5 hover:bg-[#8A8888] hover:text-white"
                                                type="reset">Reset</button>
                                            <button class="py-3 px-8 bg-[#375679] hover:bg-[#273C54] text-white rounded-md"
                                                type="submit">kirim</button>
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script src="app/views/templates/js/ajax/buat-laporan.js"></script>
            <script src="app/views/templates/js/ajax/utility/jenis-barang.js"></script>
            <script src="app/views/templates/js/ajax/utility/nama-lab.js"></script>
