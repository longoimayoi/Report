<?php

namespace App\Http\Controllers;

use App\CTPhieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;

class ReportController extends Controller
{
    public function getDS(){
        $a=1;
        $dsphieu=DB::table('tblhoadon as hd')
            ->leftJoin('tbltaikhoan as tk','tk.MaTK','hd.MaTK')
            ->leftJoin('monhoc as mh','mh.MaMon','hd.MonHoc')
            ->leftJoin('tblhocky as hk','hk.MaHK','hd.HocKy')
            ->leftJoin('namhoc as nh','nh.id','hd.NamHoc')
            ->select('hd.MaHD','hd.TrangThai','hd.NgayLapPhieu','nh.NamHoc','mh.TenMon','hk.TenHK','tk.TenDangNhap','hd.NhomLop')
            ->get();
        return view('Report',compact('dsphieu','a'));
    }
    public function postReport(Request $request)
    {
        $a=1;
        $MaHD=$request->input('id');
        $vattu=CTPhieu::where('MaHD','=',$MaHD)->get();
        $phieu=DB::table('tblhoadon as hd')
            ->leftJoin('tbltaikhoan as tk','tk.MaTK','hd.MaTK')
            ->leftJoin('tblkhoa as k','k.MaKhoa','hd.MaKhoa')
            ->leftJoin('monhoc as mh','mh.MaMon','hd.MonHoc')
            ->leftJoin('tblhocky as hk','hk.MaHK','hd.HocKy')
            ->leftJoin('namhoc as nh','nh.id','hd.NamHoc')
            ->select('hd.SLSV','mh.HeSoK','mh.SoTinChi','tk.HoTen','hd.MonHoc','hd.GhiChu','k.TenKhoa','hd.MaHD','hd.TrangThai','hd.NgayLapPhieu','nh.NamHoc','mh.TenMon','hk.TenHK','tk.TenDangNhap','hd.NhomLop')
            ->where('hd.MaHD',$MaHD)
            ->get();
        $result = json_decode($phieu, true);
        $item=array();
        $item2=array();
        $item3=array();
        $item4=array();
        $item5=array();
        $item6=array();
        $item7=array();
        $item8=array();
        $item9=array();
        $item10=array();
        $item11=array();
        $item12=array();
        $item13=array();
        $item14=array();
        $item15=array();
        $item16=array();
        $item17=array();

        foreach($vattu as $key=> $row)
        {
            $item[]=$row['TenVatTu'];
            $item2[]=$row['DVT'];
            $item3[]=$row['SL'];
            $item4[]=$row['DonGia'];
            $item5[]=$row['ThanhTien'];
            $item6[]=$row['GhiChu'];
            $item16[]=$row['XuatXu'];
            $item17[]=$a++;
        }
        foreach($result as $key=> $value)
        {
            $item7=$value['TenKhoa'];
            $item8=$value['GhiChu'];
            $item9[]=$value['MonHoc'];
            $item10[]=$value['TenMon'];
            $item11[]=$value['SoTinChi'];
            $item12[]=$value['NhomLop'];
            $item13[]=$value['HeSoK'];
            $item14[]=$value['SLSV'];
            $item15[]=$value['HoTen'];

        }
        $params = [
            '[TenVatTu]' => $item,
            '[DVT]' => $item2,
            '[SL]' => $item3,
            '[DonGia]' => $item4,
            '[ThanhTien]' => $item5,
            '[GhiChu]' => $item6,
            '{TenKhoa}' =>$item7,
            '{GhiChuHD}' =>$item8,
            '[MonHoc]'=>$item9,
            '[TenMon]'=>$item10,
            '[SoTinChi]'=>$item11,
            '[NhomLop]'=>$item12,
            '[HeSoK]'=>$item13,
            '[SLSV]'=>$item14,
            '[HoTen]'=>$item15,
            '[XuatXu]'=>$item16,
            '[STT]'=>$item17,
        ];
        //PhpExcelTemplator::saveToFile('./template.xlsx', './reportphieu.xlsx', $params);
        PhpExcelTemplator::outputToFile('./template.xlsx', './reportphieu.xlsx', $params);
        return redirect('dsphieu')->with('thongbao','report thành công');
    }
}
