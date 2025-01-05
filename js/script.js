const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
}); 



const date = new Date();
const hari = date.getDay();
const bulan = date.getMonth();
const tahun = date.getFullYear();
let tanggal = null;
const arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
const arrHari = ["Minggu","Senin","Selasa","Rabu","Kamis","Juma'at","Sabtu"];

if(tanggal <= 10){
    tanggal = "0" + date.getDate();
}else {
    tanggal = date.getDate();
}
const WaktuTerkini = `${arrHari[hari]}, ${tanggal}  ${arrBulan[bulan]} ${tahun}`;

document.getElementById("Date_Time").innerHTML = WaktuTerkini;
