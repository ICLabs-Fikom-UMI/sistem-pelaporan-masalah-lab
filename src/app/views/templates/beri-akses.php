<!-- <div class="w-full ps-4 md:ps-10 form hidden" id="beriAksesForm">
                <p class="text-2xl lg:text-3xl font-bold mt-6">Beri Akses</p>
                <div class="mt-7 w-full lg:w-[calc(100vw-300px)]">
                    <div id="isi" class=" mt-16 mr-0 md:mr-16 ">
                        <div class="w-full h-[75vh] bg-[#F9F9FB] rounded-md  border-white border-4 shadow-lg  ">
                            <table class="w-full mt-3  text-center overflow-auto md:overflow-visible" id="beri-akses-table">

                            </table>
                        </div>
                    </div>
                </div>
            </div> -->


    <div class="w-full ps-4 md:ps-10 form hidden" id="beriAksesForm">
        <p class="text-2xl lg:text-3xl font-bold mt-6" >Beri Akses</p>
        <div class="filter-group">

        <div class="flex justify-end items-center mt-7 w-full  lg:w-[calc(100vw-300px)]">
                <div class="flex items-center pe-[0px] lg:pe-[66px]">
                            <!-- search -->
                    <div class="search-container me-2">
                        <input type="text" data-table="beri-akses-table" placeholder="Cari pengguna.."
                                onkeyup="searchTable('beri-akses-table')" class="search-input w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 " />
                    </div>
                        </div>
                    </div>
                    <div id="beri-akses-isi" class="mt-4 mr-0 md:mr-16">
                        <div
                            class="w-full h-[71vh] bg-[#F9F9FB] rounded-md border-white border-4 shadow-lg overflow-x-auto">
                            <table class="filterable-table w-full  text-center min-w-max" id="beri-akses-table">

                            </table>
                        </div>
                    </div>
        </div>
    </div>
