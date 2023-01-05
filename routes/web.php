<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CsController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PelunasanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PembayaranLainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('ceklogin', [LoginController::class, 'ceklogin'])->name('ceklogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');
Route::get('Home', [DashboardController::class, 'index'])->name('Home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('Pengguna', [DashboardController::class, 'Pengguna'])->name('Pengguna')->middleware('auth');
Route::get('TablePengguna', [DashboardController::class, 'TablePengguna'])->name('TablePengguna')->middleware('auth');
Route::get('UsrCreate', [DashboardController::class, 'UsrCreate'])->name('UsrCreate')->middleware('auth');
Route::get('GetKaryawan/{id}', [DashboardController::class, 'GetKaryawan'])->name('GetKaryawan')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
 
 Route::post('access', [DashboardController::class, 'access'])->name('access');
 Route::post('createusermn', [DashboardController::class, 'createusermn'])->name('createusermn');
 Route::get('privilage/{id}', [DashboardController::class, 'privilage'])->name('privilage');
 Route::get('OpenTiket', [TiketController::class, 'OpenTiket'])->name('OpenTiket');
 
 Route::any('Profile', [DashboardController::class, 'Profile'])->name('Profile');
 Route::any('Bantuan', [DashboardController::class, 'Bantuan'])->name('Bantuan');
 //MASTER PRODUCT
 Route::any('DataBarang', [BarangController::class, 'index'])->name('index');
 Route::any('ItmCreate', [BarangController::class, 'ItmCreate'])->name('ItmCreate');
 Route::get('TableBarang', [BarangController::class, 'TableBarang'])->name('TableBarang.data');
 Route::post('Test/ImportBarang', [BarangController::class, 'ImportBarang'])->name('ImportBarang');
 Route::any('EditView/{any}', [BarangController::class, 'EditView'])->name('EditView');
 Route::post('destroybarang/{id}', [BarangController::class, 'destroybarang'])->name('destroybarang');
 Route::get('ExporBarang/', [BarangController::class, 'export_excel'])->name('export_excel');
 Route::post('Barang/SaveB', [BarangController::class, 'SaveB'])->name('SaveB');
 Route::post('SaveItmCreate', [BarangController::class, 'SaveItmCreate'])->name('SaveItmCreate');
 Route::get('/autocomplete-search', [BarangController::class, 'autocompleteSearch']);
 Route::get('export-data', [BarangController::class, 'Template']);
 
 // MASTER SUPPLIER
 Route::any('Supplier', [SupplierController::class, 'index'])->name('index');
 Route::get('TableSupp', [SupplierController::class, 'TableSupp'])->name('TableSupp.data');
 Route::post('SimpanSupp', [SupplierController::class, 'SimpanSupp'])->name('SimpanSupp');
 Route::any('SuppUpdate/{id}/Edit', [SupplierController::class, 'SuppUpdate'])->name('SuppUpdate.data');
 Route::any('UpdateSupp/{id}/Update', [SupplierController::class, 'UpdateSupp'])->name('UpdateSupp');
 Route::get('exportSupp', [SupplierController::class, 'exportSupp'])->name('exportSupp');
 Route::any('destroysupp/{any}', [SupplierController::class, 'destroysupp'])->name('destroysupp');
 
 //MASTER KONSUMEN
 Route::get('Konsumen', [KonsumenController::class, 'index'])->name('index')->middleware('auth');
 Route::get('TableCustomer', [KonsumenController::class, 'TableCustomer'])->name('TableCustomer.data');
 Route::get('CustCreate', [KonsumenController::class, 'CustCreate'])->name('CustCreate');
 Route::post('SaveKonsumen', [KonsumenController::class, 'SaveKonsumen'])->name('SaveKonsumen');
 Route::get('Custupdate/{any}', [KonsumenController::class, 'Custupdate'])->name('Custupdate');
 Route::post('Custupdate/UpdatKonsumen', [KonsumenController::class, 'UpdatKonsumen'])->name('UpdatKonsumen');
 Route::get('Exkonsumen', [KonsumenController::class, 'Exkonsumen'])->name('Exkonsumen');
 Route::any('Konsumen/ubah_status', [KonsumenController::class, 'ubahStatus'])->name('Konsumen.ubah_status');

 //MASTER SALES
 Route::get('Sales', [SalesController::class, 'index'])->name('index')->middleware('auth');
 Route::get('TableSales', [SalesController::class, 'TableSales'])->name('TableSales.data');
 Route::get('SalesCreate', [SalesController::class, 'SalesCreate'])->name('SalesCreate');
 Route::post('SaveSales', [SalesController::class, 'SaveSales'])->name('SaveSales');
 Route::get('Salesupdate/{any}', [SalesController::class, 'Salesupdate'])->name('Salesupdate');
 Route::post('Salesupdate/UpdateSales', [SalesController::class, 'UpdateSales'])->name('UpdateSales');
 
 //MASTER BANK
 Route::get('Bank', [BankController::class, 'index'])->name('index')->middleware('auth');
 Route::get('TableBank', [BankController::class, 'TableBank'])->name('TableBank.data');
 Route::get('CreateBank', [BankController::class, 'CreateBank'])->name('CreateBank');
 Route::post('SaveBank', [BankController::class, 'SaveBank'])->name('SaveBank');
 Route::get('BankUpdate/{any}', [BankController::class, 'BankUpdate'])->name('BankUpdate');
 Route::post('BankUpdate/UpdateBank', [BankController::class, 'UpdateBank'])->name('UpdateBank');
 
 //MASTER AKUN
 Route::get('Akun', [AkunController::class, 'index'])->name('index')->middleware('auth');
 Route::get('TableAkun', [AkunController::class, 'TableAkun'])->name('TableAkun.data');
 Route::get('AkunCreate', [AkunController::class, 'AkunCreate'])->name('AkunCreate');
 Route::post('SaveAkun', [AkunController::class, 'SaveAkun'])->name('SaveAkun');
 Route::get('AkunUpdate/{any}', [AkunController::class, 'AkunUpdate'])->name('AkunUpdate');
 Route::post('AkunUpdate/UpdateAkun', [AkunController::class, 'UpdateBank'])->name('UpdateBank');
 Route::any('destroyakun/{any}', [AkunController::class, 'destroyakun'])->name('destroyakun');
 
 //MASTER KATEGORI
 Route::get('Kategori', [KategoriController::class, 'index'])->name('index');
 Route::get('TableKategori', [KategoriController::class, 'TableKategori'])->name('TableKategori.data');
 Route::get('CreateKategori', [KategoriController::class, 'CreateKategori'])->name('CreateKategori');
 Route::post('SaveKategori', [KategoriController::class, 'SaveKategori'])->name('SaveKategori');
 Route::get('KategoriUpdate/{any}', [KategoriController::class, 'KategoriUpdate'])->name('KategoriUpdate');
 Route::post('KategoriUpdate/UpdateKategori', [KategoriController::class, 'UpdateKategori'])->name('UpdateKategori');
 Route::any('DestroyKategori/{id}', [KategoriController::class, 'destroy'])->name('destroy');

 Route::any('Subkategori/store', [KategoriController::class, 'store'])->name('store');
 Route::get('GetSubkateg/{id}', [KategoriController::class, 'Getdata'])->name('Getdata');
 //MASTER PENJUALAN
 Route::get('Penjualan', [PenjualanController::class, 'index'])->name('index')->middleware('auth');
 Route::get('Penjualan/transaksibaru', [PenjualanController::class, 'TransaksiBaru'])->name('TransaksiBaru');
 Route::get('TableBarangjual', [PenjualanController::class, 'TableBarangjual'])->name('TableBarangjual.data');
 Route::get('Penjualan/GetKonsumen/{any}', [PenjualanController::class, 'GetKonsumen'])->name('GetKonsumen');
 Route::post('Penjualan/TransaksiBaru/', [PenjualanController::class, 'TransaksiBaru'])->name('TransaksiBaru');
 Route::get('Penjualan/Updtransaksi/{any}', [PenjualanController::class, 'Updtransaksi'])->name('Updtransaksi');
 Route::match(['get', 'post'],'Penjualan/insertDetailTransaksi', [PenjualanController::class, 'insertDetailTransaksi'])->name('insertDetailTransaksi');
 Route::get('Penjualan/TampilkanTransaksiDetail/{any}', [PenjualanController::class, 'TampilkanTransaksiDetail'])->name('TampilkanTransaksiDetail');
 Route::post('Penjualan/hapusDetailTransaksi/{any}', [PenjualanController::class, 'hapusDetailTransaksi'])->name('hapusDetailTransaksi');
 Route::post('Penjualan/updateNamaFileKeranjang/{any}', [PenjualanController::class, 'updateNamaFileKeranjang'])->name('updateNamaFileKeranjang');
 Route::match(['get', 'post'],'Penjualan/actionUbahDetailTransaksi/{any}', [PenjualanController::class, 'actionUbahDetailTransaksi'])->name('actionUbahDetailTransaksi');
 Route::any('Penjualan/updatedatacart/{any}', [PenjualanController::class, 'updatedatacart'])->name('updatedatacart');
 Route::any('Penjualan/transaksiBelumDiambil/{any}', [PenjualanController::class, 'transaksiBelumDiambil'])->name('transaksiBelumDiambil');
 Route::any('Penjualan/transaksiBelumLunas/{any}', [PenjualanController::class, 'transaksiBelumLunas'])->name('transaksiBelumLunas');
 Route::any('Penjualan/ListTransaksi/{id}', [PenjualanController::class, 'ListTransaksi'])->name('ListTransaksi.data');
 Route::any('Penjualan/ListTransaksiBelumlunas/{id}', [PenjualanController::class, 'ListTransaksiBelumlunas'])->name('ListTransaksiBelumlunas.data');
 Route::any('Penjualan/AllPenjualan', [PenjualanController::class, 'AllPenjualan'])->name('AllPenjualan.data');
 Route::get('Penjualan/detailTransaksi/{any}', [PenjualanController::class, 'detailTransaksi'])->name('detailTransaksi');
 Route::post('Penjualan/actionUbahPembayaran/{any}', [PenjualanController::class, 'actionUbahPembayaran'])->name('actionUbahPembayaran');
 Route::any('Penjualan/actionHutang/{any}', [PenjualanController::class, 'actionHutang'])->name('actionHutang');
 Route::any('Penjualan/actionAmbil/{any}', [PenjualanController::class, 'actionAmbil'])->name('actionAmbil');
 Route::any('Penjualan/printNotaBesar/{any}', [PenjualanController::class, 'printNotaBesar'])->name('printNotaBesar');
 Route::any('Penjualan/printNotaKecil/{any}', [PenjualanController::class, 'printNotaKecil'])->name('printNotaKecil');
 Route::any('Penjualan/GetPO', [PenjualanController::class, 'GetPO'])->name('GetPO');
 //Permintaan Order
 // Route::any('PermintaanOrder', [PenjualanController::class, 'PermintaanOrder'])->name('PermintaanOrder');
 Route::any('Penjualan/addRowBarangKeluar', [PenjualanController::class, 'addRowBarangKeluar'])->name('addRowBarangKeluar');
 //Penerimaan Barang
 Route::any('PenerimaanBarang', [PenerimaanController::class, 'index'])->name('index');
 Route::get('TablePenerimaan', [PenerimaanController::class, 'TablePenerimaan'])->name('TablePenerimaan.data');
 Route::get('CreatePenerimaan', [PenerimaanController::class, 'CreatePenerimaan'])->name('CreatePenerimaan');
 Route::get('GetBarang', [PenerimaanController::class, 'GetBarang'])->name('GetBarang');
 Route::any('Penerimaan/addRowBarangMasuk', [PenerimaanController::class, 'addRowBarangMasuk'])->name('addRowBarangMasuk');
 Route::any('Penerimaan/convertHargaSatuan', [PenerimaanController::class, 'convertHargaSatuan'])->name('convertHargaSatuan');
 Route::any('Penerimaan/Simpanpenerimaan', [PenerimaanController::class, 'Simpan'])->name('Simpan');
 Route::any('Penerimaan/Detail/{any}', [PenerimaanController::class, 'Detail'])->name('Detail');
 //LAPORAN
 Route::any('Laporan/LapCetak', [LaporanController::class, 'Laporancetak'])->name('Laporancetak');
 Route::any('Laporan/Piutang', [LaporanController::class, 'LaporanPiutang'])->name('LaporanPiutang');
 Route::any('Laporan/Kas', [LaporanController::class, 'LaporanKas'])->name('LaporanKas');
 Route::any('Laporan/tampilDataTransaksi/', [LaporanController::class, 'tampilDataTransaksi'])->name('tampilDataTransaksi');
 Route::any('Laporan/Getlaporanpiutang/', [LaporanController::class, 'Getlaporanpiutang'])->name('Getlaporanpiutang');
 Route::any('Laporan/Getkas/', [LaporanController::class, 'Getkas'])->name('Getkas');
 Route::any('Laporan/exlaporan/{any}/{des}/{bet}', [LaporanController::class, 'exlaporan'])->name('exlaporan');
 Route::any('Laporan/exlaporandetail/{any}/{des}/{bet}', [LaporanController::class, 'exlaporandetail'])->name('exlaporandetail');
 Route::any('Laporan/expiutang', [LaporanController::class, 'expiutang'])->name('expiutang');
 Route::get('Laporan/Penerimaan/{any}/{des}', [LaporanController::class, 'Penerimaan'])->name('Penerimaan');
 Route::any('Laporan/Cetakhariini/{any}/{des}', [LaporanController::class, 'Cetakhariini'])->name('Cetakhariini');

 //PELUNASAN
 Route::any('PelunasanPiutang', [PelunasanController::class, 'PelunasanPiutang'])->name('PelunasanPiutang');
 Route::any('CreatePelunasan', [PelunasanController::class, 'CreatePelunasan'])->name('CreatePelunasan');
 Route::any('Pelunasan/Transaksi/{any}', [PelunasanController::class, 'Transaksi'])->name('Transaksi');
 Route::any('Pelunasan/Bayar', [PelunasanController::class, 'Bayar'])->name('Bayar');
 Route::any('Pelunasan/GetLunas', [PelunasanController::class, 'GetLunas'])->name('GetLunas');
 Route::any('TablePembayaran', [PelunasanController::class, 'TablePembayaran'])->name('TablePembayaran.data');
 Route::any('PelunasanUpdate/{any}', [PelunasanController::class, 'PelunasanU'])->name('PelunasanU');
 Route::any('Tester', [PelunasanController::class, 'Tester'])->name('Tester');


//MASTER Penerimaan Order
Route::any('PermintaanOrder', [PermintaanController::class, 'index'])->name('index');
Route::any('OrderanBaru', [PermintaanController::class, 'Baru'])->name('Baru');
Route::any('Permintaan/StoreProses', [PermintaanController::class, 'StoreProses'])->name('StoreProses');
Route::any('Permintaan/UpdateProses', [PermintaanController::class, 'UpdateProses'])->name('UpdateProses');
Route::any('Permintaan/addRowBarangKeluar', [PermintaanController::class, 'addRowBarangKeluar'])->name('addRowBarangKeluar');
Route::any('Po/{any}/Edit', [PermintaanController::class, 'EditPo'])->name('EditPo');
Route::any('DetailPO/{any}', [PermintaanController::class, 'DataDetail'])->name('DataDetail');
Route::any('Permintaan/GetPO', [PermintaanController::class, 'GetPO'])->name('GetPO');
 
 //Pembayaran Lain
 Route::any('PembayaranLain', [PembayaranLainController::class, 'index'])->name('index');

 //SPK
 Route::any('CetakSpk/{any}/{id}', [SpkController::class, 'Printspk'])->name('Printspk');
 Route::any('Spk/GetSpk/{any}', [SpkController::class, 'GetSpk'])->name('GetSpk');
});

