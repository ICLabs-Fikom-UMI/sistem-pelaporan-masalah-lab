
<div class="w-full ps-4 md:ps-10 form block" id="berandaForm">
                <p class="text-2xl lg:text-3xl font-bold mt-6">Beranda</p>
                <div class="flex justify-between items-center mt-7 w-full  lg:w-[calc(100vw-300px)]">
                    <div>
                        <a href="#"
                            class="buatLaporanBtn p-3 bg-[#375679] text-white font-medium lg:font-semibold rounded-md hover:bg-[#2D4764] " onclick="loadJenisBarang(); loadNamaLab() ">Buat
                            Laporan</a>
                    </div>
                    <div class="flex items-center pe-[0px] lg:pe-[66px]">
                        <!-- search -->
                        <div class="search-container me-2">
                            <input type="text" data-table="beranda-table" placeholder="Cari Laporan.."
                                onkeyup="searchTable('beranda-table')" class="search-input w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 " />
                        </div>
                        <!-- filter -->
                        <div class="relative ">
                            <select id="myInput" onchange="myFunction(this)" data-table-id="beranda-table"
                                class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" disabled selected>Filter by</option>
                                <option value="Semua">Semua</option>
                                <option value="Dikerjakan">Dikerjakan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="isi" class="mt-4 mr-0 md:mr-16">
                    <div
                        class="w-full h-[73vh] bg-[#F9F9FB] rounded-md border-white border-4 shadow-lg overflow-x-auto" >
                        <table class="filterable-table w-full  text-center min-w-max" id="beranda-table">

                        </table>
                    </div>
                </div>
            </div>
