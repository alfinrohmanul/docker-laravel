<?php
use Illuminate\Support\Facades\DB;

if(!function_exists('rupiah')){
    function rupiah($rp){
        return number_format($rp,2,'.','');
    }
}

function rupiahtampil($rp){
    return number_format($rp,0,',','.');
}

function getaccesbutton($idsub){
    $id_user= Auth::user()->id;
    $data=DB::select("SELECT tampil,buat,ubah,hapus FROM tb_access_menu WHERE id_user='$id_user' AND id_sub_menu='$idsub'");
    

    $buton=[
        'baru'  => $data[0]->buat,
        'ubah'  => $data[0]->ubah,
        'hapus' => $data[0]->hapus
    ];
    
    return $buton;
}

function aktifbaru($index){
        if($index!='Y'){
            $aktivasi='hidden';
        }else{
            $aktivasi='';
        }
        return $aktivasi;
}

function aktifubah($index){
    if($index!='Y'){
        $aktivasiubah='hidden';
    }else{
        $aktivasiubah='';
    }
    return $aktivasiubah;
}

function aktifhapus($index){
    if($index!='Y'){
        $aktivasihapus='hidden';
    }else{
        $aktivasihapus='';
    }
    return $aktivasihapus;
}

function generatecode($kode){
    $countermu=DB::select("select udf_generateucodemt('$kode')kode");

    return $countermu[0]->kode;
}

function get_kos($urutan){
    $bnb=DB::select("SELECT REPEAT('0', 4-LENGTH($urutan))oke");

    return $bnb[0]->oke;
}
function get_fj($ids,$nano,$urutan,$tgl){
    $ten=DB::select("SELECT CONCAT('$ids.',DATE_FORMAT('$tgl','%y%m%d'),'.','$nano',$urutan)wkwk");

    return $ten[0]->wkwk;
}