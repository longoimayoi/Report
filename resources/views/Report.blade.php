<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
</head>
<body>
<div class="container">
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">DANH SÁCH PHIẾU ĐỀ XUẤT</strong>
                    </div>
                    @if(session('thongbao'))
                        <script>alert('Report thành công')</script>
                        @endif
                    <!--   <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">hiển thị</button> -->
                    <div class="card-body" >
                        <table  id="bootstrap-data-table-export"  class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th >Người lập phiếu</th>
                                <th >Mã môn học</th>
                                <th >Tên lớp</th>
                                <th  style="width: 150px;">Học kỳ</th>
                                <th  style="width: 150px;">Năm học</th>
                                <th style="width: 150px">Ngày lập</th>
                                <th style="width: 150px">Trạng thái</th>
                                <th scope="colo"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dsphieu as $ds)
                             <tr>
                            <td style="width: 10px">{{$a++}}</td>
                            <td style="width: 250px">{{$ds->TenDangNhap}}</td>
                            <td >{{$ds->TenMon}}</td>
                            <td >{{$ds->NhomLop}}</td>
                            <td style="width: 150px">{{$ds->TenHK}}</td>
                            <td style="width: 150px">{{$ds->NamHoc}}</td>
                            <td  style="width: 160px">{{$ds->NgayLapPhieu}}</td>
                                 @if($ds->TrangThai==0)
                                 <td style="text-align: center;"><span    style="background-color: #ba60c9;width: auto;height: auto"class="badge badge-pill badge-primary">Chờ báo giá </span></td>
                                 @elseif($ds->TrangThai==1)
                                 <td style="text-align: center;"><span    style="background-color: #cd9513;width: auto;height: auto"class="badge badge-pill badge-warning">Chờ lãnh đạo phòng  <br>quản trị duyệt</span></td>
                                 @elseif($ds->TrangThai==2)
                                 <td style="text-align: center;"><span    style="width: auto;height: auto"class="badge badge-pill badge-warning">Chờ ban giám<br> hiệu duyệt</span></td>
                                 @elseif($ds->TrangThai==3)
                                 <td style="text-align: center;"><span    style="width: auto;height: auto"class="badge badge-pill badge-success">Đã duyệt</span></td>
                                 @elseif($ds->TrangThai==5)
                                 <td style="text-align: center;"><span   style="background-color: #7ec960;width: auto;height: auto" class="badge badge-pill badge-info">Chờ thêm vật tư</span></td>
                                 @elseif($ds->TrangThai==6)
                                 <td style="text-align: center;"><span   style="background-color: #b0afab;width: auto;height: auto" class="badge badge-pill badge-warning">Chờ nhân viên<br> quản lý kho duyệt</span></td>
                                 @elseif($ds->TrangThai==7 || $ds->TrangThai==9 || $ds->TrangThai==4)
                                 <td style="text-align: center;"><span  style="width: auto;height: auto"class="badge badge-pill badge-danger">Không duyệt phiếu</span></td>
                                 @elseif($ds->TrangThai==8)
                                 <td style="text-align: center;"><span  style="width: auto;height: auto;background-color: #98979669" class="badge badge-pill badge-dark">Chờ lãnh đạo<br> đơn vị duyệt</span></td>

                                 @elseif($ds->TrangThai==10)
                                 <td style="text-align: center;"><span   style="background-color: #b7ab8a;width: auto;height: auto" class="badge badge-pill badge-dark">Chờ tổng hợp </span></td>
                                 @endif
                                 @if($ds->TrangThai==3)
                                <td>
                                    <a class="ti-eye" href="{{url('report?id='.$ds->MaHD)}}">Report</a>
                                </td>
                                     @endif


                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>