const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
}); 

// --------------------------------------------------------------------------------

const date = new Date();
const hari = date.getDay();
const bulan = date.getMonth();
const tahun = date.getFullYear();
let tanggal = date.getDate();
const arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
const arrHari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];

if(tanggal < 10){
    tanggal = "0" + date.getDate();
}else {
    tanggal = date.getDate();
}
const WaktuTerkini = `${arrHari[hari]}, ${tanggal}  ${arrBulan[bulan]} ${tahun}`;

document.getElementById("Date_Time").innerHTML = WaktuTerkini;

// --------------------------------------------------------------------------------

let inputTanggal = document.getElementById("tgl_pinjam");
let tanggalHariIni = date.toISOString().split('T')[0];

inputTanggal.value = tanggalHariIni;