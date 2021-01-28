<?php
include_once("libs/db.php");
error_reporting(E_ERROR);
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['username'])) {
  header('Location:index.php');
}
//get thong tin user
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "not";
$sql = "SELECT * FROM user where `user_name` = '$username'";
// echo $sql;
// exit();
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $_SESSION['username'] = $row['user_name'];
  $_SESSION['active2'] = $row['active2'];

  $id_user = $row['id'];
  $user_name = $row['user_name'];
  $tenDayDu = $row['full_name'];
  $email = $row['email'];
  $phone = $row['phone'];
  $active1 = $row['active1'];
  $active2 = $row['active2'];
  // echo $row['active2'];
  // exit();
}
//get danh sách vay tien
//get danh sách đầu tư 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include("head.php");
  ?>
</head>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<body>
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a style="font-size: 20px; color:aqua !important;" class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.php">Trang Chủ</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">

          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="chi_tiet_user.php" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="images/dummy.webp">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo isset($tenDayDu) ? $tenDayDu : ""; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <!-- <span>Settings</span> -->
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo isset($tenDayDu) ? $tenDayDu : ""; ?></h1>
            <p class="text-white mt-0 mb-5">Đây là trang hồ sơ của bạn. Bạn có thể xem tiến trình bạn đã đạt được với các khoản vay và quản lý các khoản đầu tư đã đầu tư.</p>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">

        <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Thông Tin Chi Tiết Của Bạn</h3>
                </div>
                <div class="col-4 text-right">
                  <!-- <a href="#!" class="btn btn-sm btn-primary">Settings</a -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4" style="color: #DE3163 !important;">Thông Tin Cá Nhân</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="<?php echo isset($user_name) ? $user_name : ""; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" value="<?php echo isset($email) ? $email : ""; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Full Name</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="<?php echo isset($tenDayDu) ? $tenDayDu : ""; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Phone</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo isset($phone) ? $phone : ""; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Trạng Thái Active 1</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" style="color: #233dd2;" placeholder="First name" value="<?php
                                                                                                                                                                        if ($active1 == 1) {
                                                                                                                                                                          echo 'Đã Active Bước 1 Thành Công';
                                                                                                                                                                        } else {
                                                                                                                                                                          echo 'Chưa Active Bước 1';
                                                                                                                                                                        }
                                                                                                                                                                        ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Trạng Thái Active 2 </label>
                          <?php
                          // get hàng cuối cùng của hồ sơ của khách hàng này ra 
                              $sql = "select * from `upload_xac_thuc_2` WHERE `id_user` = '$id_user' ORDER BY id DESC LIMIT 1";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                $row1 = $result->fetch_assoc();

                          ?>

                          <button style="padding: 4px 10px;margin-left: 13px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Chi Tiết
                          </button>
                          <?php 
                              }
                          ?>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" style="color: #233dd2;" placeholder="Last name" value="<?php
                                                                                                                                                                      if ($active2 == 0) {
                                                                                                                                                                        echo 'Chưa Active Bước 2';
                                                                                                                                                                      } else if ($active2 == 1) {
                                                                                                                                                                        echo 'Đang Chờ Xét Duyệt Bước 2';
                                                                                                                                                                      } else if ($active2 == 2) {
                                                                                                                                                                        echo 'Xét Duyệt Bước 2 Không Thành Công Mời Thử Lại';
                                                                                                                                                                      } else if ($active2 == 3) {
                                                                                                                                                                        echo 'Active Bước 2 Thành Công';
                                                                                                                                                                      } ?>" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Hồ Sơ Active2</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container">
                          <p style="color:#11cdef">Trạng Thái Active: <?php
                                                  if ($active2 == 0) {
                                                    echo 'Chưa Active Bước 2';
                                                  } else if ($active2 == 1) {
                                                    echo 'Đang Chờ Xét Duyệt Bước 2';
                                                  } else if ($active2 == 2) {
                                                    echo 'Xét Duyệt Bước 2 Không Thàn Công Mời Thử Lại';
                                                  } else if ($active2 == 3) {
                                                    echo 'Active Bước 2 Thành Công';
                                                  } ?></p>
                          <div class="row" style="margin-bottom: 5px;">
                            <div class="col-sm-6"><img src="<?php echo $row1['hinh_chup_selfie'];?>" alt="Chania" width="200px" height="200px"></div>
                            <div class="col-sm-6"><img src="<?php echo $row1['hinh_mat_truoc_cmnd'];?>" alt="Chania" width="200px" height="200px"></div>
                          </div>
                          <div class="row" style="margin-bottom: 5px;">
                            <div class="col-sm-6"><img src="<?php echo $row1['hinh_mat_sau_cmnd'];?>" alt="Chania" width="200px" height="200px"></div>
                            <div class="col-sm-6"><img src="<?php echo $row1['hinh_mat_truoc_bang_lai'];?>" alt="Chania" width="200px" height="200px"></div>
                          </div>
                          <div class="row" style="margin-bottom: 5px;">
                            <div class="col-sm-12"><img src="<?php echo $row1['hinh_mat_sau_bang_lai'];?>" alt="Chania" width="200px" height="200px"></div>

                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4" style="color: #DE3163 !important;">Quản Lý Hồ Sơ Gửi Tiết Kiệm</h6>
                <div class="pl-lg-4">
                  <table id="tblGuiTietKiem" class="display">
                    <thead>
                      <tr>
                        <th>Mã Hồ Sơ</th>
                        <th>Tên Người Gửi</th>
                        <th>Số MoMo Gửi Tiền</th>
                        <th>Số Tiền Đầu Tư</th>
                        <th>Loại Đầu Tư</th>
                        <th>Ngày Đầu Tư</th>
                        <th>Lãi Suất</th>
                        <th>Mã Thanh Toán</th>
                        <th>Trạng Thái Hồ Sơ</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //get danh sách gửi tiền lên
                      // Câu SQL lấy danh sách
                      $sql = "SELECT * FROM `dau_tu_so` where id_user = $id_user ";

                      // Thực thi câu truy vấn và gán vào $result
                      $result = $conn->query($sql);

                      // Kiểm tra số lượng record trả về có lơn hơn 0
                      // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                      if ($result->num_rows > 0) {
                        // Sử dụng vòng lặp while để lặp kết quả
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <tr>
                            <th><?php echo "HSDAUTU" . $row['id']; ?></th>
                            <th><?php echo $row['tenNguoiGui']; ?></th>
                            <th><?php echo $row['phoneGuiTien']; ?></th>
                            <th><?php echo $row['so_tien_dau_tu']; ?></th>
                            <th><?php

                                if ($row['loai_dau_tu'] == 1) {
                                  echo "Đầu Tư GOLD";
                                } else {
                                  echo "Đầu Tư DIAMOND";
                                }

                                ?></th>
                            <th><?php echo $row['ngay_dau_tu']; ?></th>
                            <th><?php echo $row['lai_xuat'] . "%"; ?></th>
                            <th><?php echo $row['maThanhToan']; ?></th>
                            <th><?php

                                if ($row['trang_thai'] == 0) {
                                  echo 'Đang Chờ Xét Duyệt';
                                } else if ($row['trang_thai'] == 1) {
                                  echo 'Đã Bị Hủy';
                                } else if ($row['trang_thai'] == 2) {
                                  echo 'Gửi Tiết Kiệm Thành Công';
                                }
                                ?></th>
                            <th><button type="button" name="" id="" class="btn btn-primary" btn-lg btn-block><a style="color:#fff" href="chi_tiet_lich_nhan_lai.php?maHSDauTu=<?php echo $row['id'];?>">Lịch Sử Nhận Lãi</a></button></th>
                          </tr>
                      <?php
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4" style="color: #DE3163 !important;">Quản Lý Hồ Sơ Vay Vốn</h6>
                <div class="pl-lg-4">
                  <table id="tblVayVon" class="display">
                    <thead>
                      <tr>
                        <th>Mã Hồ Sơ</th>
                        <th>Tên Người Nhận</th>
                        <th>Số MoMo Nhận</th>
                        <th>Mức Vay</th>
                        <th>Kỳ Hạn Vay</th>
                        <th>Lãi Suất</th>
                        <th>Ngày Vay Nợ</th>
                        <th>Lý Do Bị Hủy</th>
                        <th>Trạng Thái Đơn</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //get danh sách gửi tiền lên
                      // Câu SQL lấy danh sách
                      $sql = "SELECT * FROM `vay_tien` where id_user = $id_user ";

                      // Thực thi câu truy vấn và gán vào $result
                      $result = $conn->query($sql);

                      // Kiểm tra số lượng record trả về có lơn hơn 0
                      // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                      if ($result->num_rows > 0) {
                        // Sử dụng vòng lặp while để lặp kết quả
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <tr>
                            <th><?php echo "HSVAY" . $row['id']; ?></th>
                            <th><?php echo $tenDayDu; ?></th>
                            <th><?php echo $row['phone_momo']; ?></th>
                            <th><?php echo $row['muc_vay']; ?></th>
                            <th><?php echo $row['ky_han_vay']; ?></th>
                            <th><?php echo $row['laixuat']; ?></th>
                            <th><?php echo $row['ngay_vay_no']; ?></th>
                            <th>
                            <?php if($row['ly_do_bi_huy']=="0"){
                              echo "Chưa Có Lý Do";
                            } else{
                              echo $row['ly_do_bi_huy'];
                            }
                                
                                ?>
                                
                                </th>
                            <th><?php
                                if ($row['trang_thai_don_vay'] == 0) {
                                  echo 'Đang Chờ Xét Duyệt';
                                }
                                if ($row['trang_thai_don_vay'] == 1) {
                                  echo 'Bị Hủy';
                                }
                                if ($row['trang_thai_don_vay'] == 2) {
                                  echo 'Vay Thành Công Đang Góp Lãi';
                                }
                                if ($row['trang_thai_don_vay'] == 3) {
                                  echo 'Góp Hoàn Tất';
                                }
                                if ($row['trang_thai_don_vay'] == -99) {
                                  echo '<a href="dong_250k.php">Cần Đóng 250.000 vnđ phí hồ sơ</a>';
                                }

                                ?></th>
                            <th><button type="button" name="lichDongLai" id="lichDongLai" class="btn btn-primary" btn-lg btn-block>Lịch Đóng Lãi</button></th>
                          </tr>
                      <?php
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <h6 class="heading-small text-muted mb-4" style="color: #DE3163 !important;">Quản Lý Hồ Sơ Đóng 250k</h6>
                <div class="pl-lg-4">
                  <table id="tblDongLai250k" class="display">
                    <thead>
                      <tr>
                      <th>Mã Đóng 250k</th>
                                <th>Mã Hồ Sơ Vay</th>
                                <th>Ngày Đóng 250k</th>
                                <th>Mã Giao Dịch</th>
                                <th>Phone Đóng Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Id User</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //get danh sách gửi tiền lên
                      // Câu SQL lấy danh sách
                      $sql = "SELECT * FROM `phi_tao_ho_so` where `id_user` = $id_user";
                      // Thực thi câu truy vấn và gán vào $result
                      $result = $conn->query($sql);

                      // Kiểm tra số lượng record trả về có lơn hơn 0
                      // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                      if ($result->num_rows > 0) {
                        // Sử dụng vòng lặp while để lặp kết quả
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <tr>
                            <th><?php echo "HS250K" . $row['id']; ?></th>
                            <th><?php echo "HSVAY" .$row['id_vay_tien']; ?></th>
                                        <th><?php echo $row['ngay_dong_250k']; ?></th>
                                        <th><?php echo $row['ma_giao_dich']; ?></th>
                                        <th><?php echo $row['phoneDongTien']; ?></th>
                                        <th><?php

                                            if ($row['trang_thai'] == 0) {
                                                echo "Đang Chờ Xác Thực";
                                            } else if ($row['trang_thai'] == 1){
                                                echo "Bị Hủy";
                                            }
                                            else if ($row['trang_thai'] == 2){
                                                echo "Thành Công";
                                            }

                                            ?></th>
                                        <th><?php echo $row['id_user']; ?></th>
                            
                          </tr>
                      <?php
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
          <p>Made with <a href="">Code By FE Team</a></p>
        </div>
      </div>
    </div>
  </footer>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('#tblGuiTietKiem').DataTable({
        responsive: true
      });
      $('#tblVayVon').DataTable({
        responsive: true
      });
      $('#tblDongLai250k').DataTable({
        responsive: true
      });

      $("#lichDongLai").click(function() {
        alert("Chưa Có Lịch Sử Góp Lãi");
      });
      $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
      })
    });
  </script>
  <style>
    :root {
      --blue: #5e72e4;
      --indigo: #5603ad;
      --purple: #8965e0;
      --pink: #f3a4b5;
      --red: #f5365c;
      --orange: #fb6340;
      --yellow: #ffd600;
      --green: #2dce89;
      --teal: #11cdef;
      --cyan: #2bffc6;
      --white: #fff;
      --gray: #8898aa;
      --gray-dark: #32325d;
      --light: #ced4da;
      --lighter: #e9ecef;
      --primary: #5e72e4;
      --secondary: #f7fafc;
      --success: #2dce89;
      --info: #11cdef;
      --warning: #fb6340;
      --danger: #f5365c;
      --light: #adb5bd;
      --dark: #212529;
      --default: #172b4d;
      --white: #fff;
      --neutral: #fff;
      --darker: black;
      --breakpoint-xs: 0;
      --breakpoint-sm: 576px;
      --breakpoint-md: 768px;
      --breakpoint-lg: 992px;
      --breakpoint-xl: 1200px;
      --font-family-sans-serif: Open Sans, sans-serif;
      --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    html {
      font-family: sans-serif;
      line-height: 1.15;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
      -ms-overflow-style: scrollbar;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    @-ms-viewport {
      width: device-width;
    }

    figcaption,
    footer,
    header,
    main,
    nav,
    section {
      display: block;
    }

    body {
      font-family: Open Sans, sans-serif;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      margin: 0;
      text-align: left;
      color: #525f7f;
      background-color: #f8f9fe;
    }

    [tabindex='-1']:focus {
      outline: 0 !important;
    }

    hr {
      overflow: visible;
      box-sizing: content-box;
      height: 0;
    }

    h1,
    h3,
    h4,
    h5,
    h6 {
      margin-top: 0;
      margin-bottom: .5rem;
    }

    p {
      margin-top: 0;
      margin-bottom: 1rem;
    }

    address {
      font-style: normal;
      line-height: inherit;
      margin-bottom: 1rem;
    }

    ul {
      margin-top: 0;
      margin-bottom: 1rem;
    }

    ul ul {
      margin-bottom: 0;
    }

    dfn {
      font-style: italic;
    }

    strong {
      font-weight: bolder;
    }

    a {
      text-decoration: none;
      color: #5e72e4;
      background-color: transparent;
      -webkit-text-decoration-skip: objects;
    }

    a:hover {
      text-decoration: none;
      color: #233dd2;
    }

    a:not([href]):not([tabindex]) {
      text-decoration: none;
      color: inherit;
    }

    a:not([href]):not([tabindex]):hover,
    a:not([href]):not([tabindex]):focus {
      text-decoration: none;
      color: inherit;
    }

    a:not([href]):not([tabindex]):focus {
      outline: 0;
    }

    code {
      font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
      font-size: 1em;
    }

    img {
      vertical-align: middle;
      border-style: none;
    }

    caption {
      padding-top: 1rem;
      padding-bottom: 1rem;
      caption-side: bottom;
      text-align: left;
      color: #8898aa;
    }

    label {
      display: inline-block;
      margin-bottom: .5rem;
    }

    button {
      border-radius: 0;
    }

    button:focus {
      outline: 1px dotted;
      outline: 5px auto -webkit-focus-ring-color;
    }

    input,
    button,
    textarea {
      font-family: inherit;
      font-size: inherit;
      line-height: inherit;
      margin: 0;
    }

    button,
    input {
      overflow: visible;
    }

    button {
      text-transform: none;
    }

    button,
    html [type='button'],
    [type='reset'],
    [type='submit'] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type='button']::-moz-focus-inner,
    [type='reset']::-moz-focus-inner,
    [type='submit']::-moz-focus-inner {
      padding: 0;
      border-style: none;
    }

    input[type='radio'],
    input[type='checkbox'] {
      box-sizing: border-box;
      padding: 0;
    }

    input[type='date'],
    input[type='time'],
    input[type='datetime-local'],
    input[type='month'] {
      -webkit-appearance: listbox;
    }

    textarea {
      overflow: auto;
      resize: vertical;
    }

    legend {
      font-size: 1.5rem;
      line-height: inherit;
      display: block;
      width: 100%;
      max-width: 100%;
      margin-bottom: .5rem;
      padding: 0;
      white-space: normal;
      color: inherit;
    }

    progress {
      vertical-align: baseline;
    }

    [type='number']::-webkit-inner-spin-button,
    [type='number']::-webkit-outer-spin-button {
      height: auto;
    }

    [type='search'] {
      outline-offset: -2px;
      -webkit-appearance: none;
    }

    [type='search']::-webkit-search-cancel-button,
    [type='search']::-webkit-search-decoration {
      -webkit-appearance: none;
    }

    ::-webkit-file-upload-button {
      font: inherit;
      -webkit-appearance: button;
    }

    [hidden] {
      display: none !important;
    }

    h1,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h3,
    .h4,
    .h5,
    .h6 {
      font-family: inherit;
      font-weight: 600;
      line-height: 1.5;
      margin-bottom: .5rem;
      color: #32325d;
    }

    h1,
    .h1 {
      font-size: 1.625rem;
    }

    h3,
    .h3 {
      font-size: 1.0625rem;
    }

    h4,
    .h4 {
      font-size: .9375rem;
    }

    h5,
    .h5 {
      font-size: .8125rem;
    }

    h6,
    .h6 {
      font-size: .625rem;
    }

    .display-2 {
      font-size: 2.75rem;
      font-weight: 600;
      line-height: 1.5;
    }

    hr {
      margin-top: 2rem;
      margin-bottom: 2rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, .1);
    }

    code {
      font-size: 87.5%;
      word-break: break-word;
      color: #f3a4b5;
    }

    a>code {
      color: inherit;
    }

    .container {
      width: 100%;
      margin-right: auto;
      margin-left: auto;
      padding-right: 15px;
      padding-left: 15px;
    }

    @media (min-width: 576px) {
      .container {
        max-width: 540px;
      }
    }

    @media (min-width: 768px) {
      .container {
        max-width: 720px;
      }
    }

    @media (min-width: 992px) {
      .container {
        max-width: 960px;
      }
    }

    @media (min-width: 1200px) {
      .container {
        max-width: 1140px;
      }
    }

    .container-fluid {
      width: 100%;
      margin-right: auto;
      margin-left: auto;
      padding-right: 15px;
      padding-left: 15px;
    }

    .row {
      display: flex;
      margin-right: -15px;
      margin-left: -15px;
      flex-wrap: wrap;
    }

    .col-4,
    .col-8,
    .col,
    .col-md-10,
    .col-md-12,
    .col-lg-3,
    .col-lg-4,
    .col-lg-6,
    .col-lg-7,
    .col-xl-4,
    .col-xl-6,
    .col-xl-8 {
      position: relative;
      width: 100%;
      min-height: 1px;
      padding-right: 15px;
      padding-left: 15px;
    }

    .col {
      max-width: 100%;
      flex-basis: 0;
      flex-grow: 1;
    }

    .col-4 {
      max-width: 33.33333%;
      flex: 0 0 33.33333%;
    }

    .col-8 {
      max-width: 66.66667%;
      flex: 0 0 66.66667%;
    }

    @media (min-width: 768px) {

      .col-md-10 {
        max-width: 83.33333%;
        flex: 0 0 83.33333%;
      }

      .col-md-12 {
        max-width: 100%;
        flex: 0 0 100%;
      }
    }

    @media (min-width: 992px) {

      .col-lg-3 {
        max-width: 25%;
        flex: 0 0 25%;
      }

      .col-lg-4 {
        max-width: 33.33333%;
        flex: 0 0 33.33333%;
      }

      .col-lg-6 {
        max-width: 50%;
        flex: 0 0 50%;
      }

      .col-lg-7 {
        max-width: 58.33333%;
        flex: 0 0 58.33333%;
      }

      .order-lg-2 {
        order: 2;
      }
    }

    @media (min-width: 1200px) {

      .col-xl-4 {
        max-width: 33.33333%;
        flex: 0 0 33.33333%;
      }

      .col-xl-6 {
        max-width: 50%;
        flex: 0 0 50%;
      }

      .col-xl-8 {
        max-width: 66.66667%;
        flex: 0 0 66.66667%;
      }

      .order-xl-1 {
        order: 1;
      }

      .order-xl-2 {
        order: 2;
      }
    }

    .form-control {
      font-size: 1rem;
      line-height: 1.5;
      display: block;
      width: 100%;
      height: calc(2.75rem + 2px);
      padding: .625rem .75rem;
      transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
      color: #8898aa;
      border: 1px solid #cad1d7;
      border-radius: .375rem;
      background-color: #fff;
      background-clip: padding-box;
      box-shadow: none;
    }

    @media screen and (prefers-reduced-motion: reduce) {
      .form-control {
        transition: none;
      }
    }

    .form-control::-ms-expand {
      border: 0;
      background-color: transparent;
    }

    .form-control:focus {
      color: #8898aa;
      border-color: rgba(50, 151, 211, .25);
      outline: 0;
      background-color: #fff;
      box-shadow: none, none;
    }

    .form-control:-ms-input-placeholder {
      opacity: 1;
      color: #adb5bd;
    }

    .form-control::-ms-input-placeholder {
      opacity: 1;
      color: #adb5bd;
    }

    .form-control::placeholder {
      opacity: 1;
      color: #adb5bd;
    }

    .form-control:disabled,
    .form-control[readonly] {
      opacity: 1;
      background-color: #e9ecef;
    }

    textarea.form-control {
      height: auto;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-inline {
      display: flex;
      flex-flow: row wrap;
      align-items: center;
    }

    @media (min-width: 576px) {
      .form-inline label {
        display: flex;
        margin-bottom: 0;
        align-items: center;
        justify-content: center;
      }

      .form-inline .form-group {
        display: flex;
        margin-bottom: 0;
        flex: 0 0 auto;
        flex-flow: row wrap;
        align-items: center;
      }

      .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
      }

      .form-inline .input-group {
        width: auto;
      }
    }

    .btn {
      font-size: 1rem;
      font-weight: 600;
      line-height: 1.5;
      display: inline-block;
      padding: .625rem 1.25rem;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      text-align: center;
      vertical-align: middle;
      white-space: nowrap;
      border: 1px solid transparent;
      border-radius: .375rem;
    }

    @media screen and (prefers-reduced-motion: reduce) {
      .btn {
        transition: none;
      }
    }

    .btn:hover,
    .btn:focus {
      text-decoration: none;
    }

    .btn:focus {
      outline: 0;
      box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
    }

    .btn:disabled {
      opacity: .65;
      box-shadow: none;
    }

    .btn:not(:disabled):not(.disabled) {
      cursor: pointer;
    }

    .btn:not(:disabled):not(.disabled):active {
      box-shadow: none;
    }

    .btn:not(:disabled):not(.disabled):active:focus {
      box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08), none;
    }

    .btn-primary {
      color: #fff;
      border-color: #5e72e4;
      background-color: #5e72e4;
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

    .btn-primary:hover {
      color: #fff;
      border-color: #5e72e4;
      background-color: #5e72e4;
    }

    .btn-primary:focus {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(94, 114, 228, .5);
    }

    .btn-primary:disabled {
      color: #fff;
      border-color: #5e72e4;
      background-color: #5e72e4;
    }

    .btn-primary:not(:disabled):not(.disabled):active {
      color: #fff;
      border-color: #5e72e4;
      background-color: #324cdd;
    }

    .btn-primary:not(:disabled):not(.disabled):active:focus {
      box-shadow: none, 0 0 0 0 rgba(94, 114, 228, .5);
    }

    .btn-info {
      color: #fff;
      border-color: #11cdef;
      background-color: #11cdef;
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

    .btn-info:hover {
      color: #fff;
      border-color: #11cdef;
      background-color: #11cdef;
    }

    .btn-info:focus {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(17, 205, 239, .5);
    }

    .btn-info:disabled {
      color: #fff;
      border-color: #11cdef;
      background-color: #11cdef;
    }

    .btn-info:not(:disabled):not(.disabled):active {
      color: #fff;
      border-color: #11cdef;
      background-color: #0da5c0;
    }

    .btn-info:not(:disabled):not(.disabled):active:focus {
      box-shadow: none, 0 0 0 0 rgba(17, 205, 239, .5);
    }

    .btn-default {
      color: #fff;
      border-color: #172b4d;
      background-color: #172b4d;
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

    .btn-default:hover {
      color: #fff;
      border-color: #172b4d;
      background-color: #172b4d;
    }

    .btn-default:focus {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(23, 43, 77, .5);
    }

    .btn-default:disabled {
      color: #fff;
      border-color: #172b4d;
      background-color: #172b4d;
    }

    .btn-default:not(:disabled):not(.disabled):active {
      color: #fff;
      border-color: #172b4d;
      background-color: #0b1526;
    }

    .btn-default:not(:disabled):not(.disabled):active:focus {
      box-shadow: none, 0 0 0 0 rgba(23, 43, 77, .5);
    }

    .btn-sm {
      font-size: .875rem;
      line-height: 1.5;
      padding: .25rem .5rem;
      border-radius: .375rem;
    }

    .dropdown {
      position: relative;
    }

    .dropdown-menu {
      font-size: 1rem;
      position: absolute;
      z-index: 1000;
      top: 100%;
      left: 0;
      display: none;
      float: left;
      min-width: 10rem;
      margin: .125rem 0 0;
      padding: .5rem 0;
      list-style: none;
      text-align: left;
      color: #525f7f;
      border: 0 solid rgba(0, 0, 0, .15);
      border-radius: .4375rem;
      background-color: #fff;
      background-clip: padding-box;
      box-shadow: 0 50px 100px rgba(50, 50, 93, .1), 0 15px 35px rgba(50, 50, 93, .15), 0 5px 15px rgba(0, 0, 0, .1);
    }

    .dropdown-menu.show {
      display: block;
      opacity: 1;
    }

    .dropdown-menu-right {
      right: 0;
      left: auto;
    }

    .dropdown-menu[x-placement^='top'],
    .dropdown-menu[x-placement^='right'],
    .dropdown-menu[x-placement^='bottom'],
    .dropdown-menu[x-placement^='left'] {
      right: auto;
      bottom: auto;
    }

    .dropdown-divider {
      overflow: hidden;
      height: 0;
      margin: .5rem 0;
      border-top: 1px solid #e9ecef;
    }

    .dropdown-item {
      font-weight: 400;
      display: block;
      clear: both;
      width: 100%;
      padding: .25rem 1.5rem;
      text-align: inherit;
      white-space: nowrap;
      color: #212529;
      border: 0;
      background-color: transparent;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      text-decoration: none;
      color: #16181b;
      background-color: #f6f9fc;
    }

    .dropdown-item:active {
      text-decoration: none;
      color: #fff;
      background-color: #5e72e4;
    }

    .dropdown-item:disabled {
      color: #8898aa;
      background-color: transparent;
    }

    .dropdown-header {
      font-size: .875rem;
      display: block;
      margin-bottom: 0;
      padding: .5rem 1.5rem;
      white-space: nowrap;
      color: #8898aa;
    }

    .input-group {
      position: relative;
      display: flex;
      width: 100%;
      flex-wrap: wrap;
      align-items: stretch;
    }

    .input-group>.form-control {
      position: relative;
      width: 1%;
      margin-bottom: 0;
      flex: 1 1 auto;
    }

    .input-group>.form-control+.form-control {
      margin-left: -1px;
    }

    .input-group>.form-control:focus {
      z-index: 3;
    }

    .input-group>.form-control:not(:last-child) {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }

    .input-group>.form-control:not(:first-child) {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .input-group-prepend {
      display: flex;
    }

    .input-group-prepend .btn {
      position: relative;
      z-index: 2;
    }

    .input-group-prepend .btn+.btn,
    .input-group-prepend .btn+.input-group-text,
    .input-group-prepend .input-group-text+.input-group-text,
    .input-group-prepend .input-group-text+.btn {
      margin-left: -1px;
    }

    .input-group-prepend {
      margin-right: -1px;
    }

    .input-group-text {
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      display: flex;
      margin-bottom: 0;
      padding: .625rem .75rem;
      text-align: center;
      white-space: nowrap;
      color: #adb5bd;
      border: 1px solid #cad1d7;
      border-radius: .375rem;
      background-color: #fff;
      align-items: center;
    }

    .input-group-text input[type='radio'],
    .input-group-text input[type='checkbox'] {
      margin-top: 0;
    }

    .input-group>.input-group-prepend>.btn,
    .input-group>.input-group-prepend>.input-group-text {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }

    .input-group>.input-group-prepend:not(:first-child)>.btn,
    .input-group>.input-group-prepend:not(:first-child)>.input-group-text,
    .input-group>.input-group-prepend:first-child>.btn:not(:first-child),
    .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child) {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .nav {
      display: flex;
      margin-bottom: 0;
      padding-left: 0;
      list-style: none;
      flex-wrap: wrap;
    }

    .nav-link {
      display: block;
      padding: .25rem .75rem;
    }

    .nav-link:hover,
    .nav-link:focus {
      text-decoration: none;
    }

    .navbar {
      position: relative;
      display: flex;
      padding: 1rem 1rem;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .navbar>.container,
    .navbar>.container-fluid {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .navbar-nav {
      display: flex;
      flex-direction: column;
      margin-bottom: 0;
      padding-left: 0;
      list-style: none;
    }

    .navbar-nav .nav-link {
      padding-right: 0;
      padding-left: 0;
    }

    .navbar-nav .dropdown-menu {
      position: static;
      float: none;
    }

    @media (max-width: 767.98px) {

      .navbar-expand-md>.container,
      .navbar-expand-md>.container-fluid {
        padding-right: 0;
        padding-left: 0;
      }
    }

    @media (min-width: 768px) {
      .navbar-expand-md {
        flex-flow: row nowrap;
        justify-content: flex-start;
      }

      .navbar-expand-md .navbar-nav {
        flex-direction: row;
      }

      .navbar-expand-md .navbar-nav .dropdown-menu {
        position: absolute;
      }

      .navbar-expand-md .navbar-nav .nav-link {
        padding-right: 1rem;
        padding-left: 1rem;
      }

      .navbar-expand-md>.container,
      .navbar-expand-md>.container-fluid {
        flex-wrap: nowrap;
      }
    }

    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255, 255, 255, .95);
    }

    .navbar-dark .navbar-nav .nav-link:hover,
    .navbar-dark .navbar-nav .nav-link:focus {
      color: rgba(255, 255, 255, .65);
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      border: 1px solid rgba(0, 0, 0, .05);
      border-radius: .375rem;
      background-color: #fff;
      background-clip: border-box;
    }

    .card>hr {
      margin-right: 0;
      margin-left: 0;
    }

    .card-body {
      padding: 1.5rem;
      flex: 1 1 auto;
    }

    .card-header {
      margin-bottom: 0;
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid rgba(0, 0, 0, .05);
      background-color: #fff;
    }

    .card-header:first-child {
      border-radius: calc(.375rem - 1px) calc(.375rem - 1px) 0 0;
    }

    @keyframes progress-bar-stripes {
      from {
        background-position: 1rem 0;
      }

      to {
        background-position: 0 0;
      }
    }

    .progress {
      font-size: .75rem;
      display: flex;
      overflow: hidden;
      height: 1rem;
      border-radius: .375rem;
      background-color: #e9ecef;
      box-shadow: inset 0 .1rem .1rem rgba(0, 0, 0, .1);
    }

    .media {
      display: flex;
      align-items: flex-start;
    }

    .media-body {
      flex: 1 1;
    }

    .bg-secondary {
      background-color: #f7fafc !important;
    }

    a.bg-secondary:hover,
    a.bg-secondary:focus,
    button.bg-secondary:hover,
    button.bg-secondary:focus {
      background-color: #d2e3ee !important;
    }

    .bg-default {
      background-color: #172b4d !important;
    }

    a.bg-default:hover,
    a.bg-default:focus,
    button.bg-default:hover,
    button.bg-default:focus {
      background-color: #0b1526 !important;
    }

    .bg-white {
      background-color: #fff !important;
    }

    a.bg-white:hover,
    a.bg-white:focus,
    button.bg-white:hover,
    button.bg-white:focus {
      background-color: #e6e6e6 !important;
    }

    .bg-white {
      background-color: #fff !important;
    }

    .border-0 {
      border: 0 !important;
    }

    .rounded-circle {
      border-radius: 50% !important;
    }

    .d-none {
      display: none !important;
    }

    .d-flex {
      display: flex !important;
    }

    @media (min-width: 768px) {

      .d-md-flex {
        display: flex !important;
      }
    }

    @media (min-width: 992px) {

      .d-lg-inline-block {
        display: inline-block !important;
      }

      .d-lg-block {
        display: block !important;
      }
    }

    .justify-content-center {
      justify-content: center !important;
    }

    .justify-content-between {
      justify-content: space-between !important;
    }

    .align-items-center {
      align-items: center !important;
    }

    @media (min-width: 1200px) {

      .justify-content-xl-between {
        justify-content: space-between !important;
      }
    }

    .float-right {
      float: right !important;
    }

    .shadow,
    .card-profile-image img {
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
    }

    .m-0 {
      margin: 0 !important;
    }

    .mt-0 {
      margin-top: 0 !important;
    }

    .mb-0 {
      margin-bottom: 0 !important;
    }

    .mr-2 {
      margin-right: .5rem !important;
    }

    .ml-2 {
      margin-left: .5rem !important;
    }

    .mr-3 {
      margin-right: 1rem !important;
    }

    .mt-4,
    .my-4 {
      margin-top: 1.5rem !important;
    }

    .mr-4 {
      margin-right: 1.5rem !important;
    }

    .mb-4,
    .my-4 {
      margin-bottom: 1.5rem !important;
    }

    .mb-5 {
      margin-bottom: 3rem !important;
    }

    .mt--7 {
      margin-top: -6rem !important;
    }

    .pt-0 {
      padding-top: 0 !important;
    }

    .pr-0 {
      padding-right: 0 !important;
    }

    .pb-0 {
      padding-bottom: 0 !important;
    }

    .pt-5 {
      padding-top: 3rem !important;
    }

    .pt-8 {
      padding-top: 8rem !important;
    }

    .pb-8 {
      padding-bottom: 8rem !important;
    }

    .m-auto {
      margin: auto !important;
    }

    @media (min-width: 768px) {

      .mt-md-5 {
        margin-top: 3rem !important;
      }

      .pt-md-4 {
        padding-top: 1.5rem !important;
      }

      .pb-md-4 {
        padding-bottom: 1.5rem !important;
      }
    }

    @media (min-width: 992px) {

      .pl-lg-4 {
        padding-left: 1.5rem !important;
      }

      .pt-lg-8 {
        padding-top: 8rem !important;
      }

      .ml-lg-auto {
        margin-left: auto !important;
      }
    }

    @media (min-width: 1200px) {

      .mb-xl-0 {
        margin-bottom: 0 !important;
      }
    }

    .text-right {
      text-align: right !important;
    }

    .text-center {
      text-align: center !important;
    }

    .text-uppercase {
      text-transform: uppercase !important;
    }

    .font-weight-light {
      font-weight: 300 !important;
    }

    .font-weight-bold {
      font-weight: 600 !important;
    }

    .text-white {
      color: #fff !important;
    }

    .text-white {
      color: #fff !important;
    }

    a.text-white:hover,
    a.text-white:focus {
      color: #e6e6e6 !important;
    }

    .text-muted {
      color: #8898aa !important;
    }

    @media print {

      *,
      *::before,
      *::after {
        box-shadow: none !important;
        text-shadow: none !important;
      }

      a:not(.btn) {
        text-decoration: underline;
      }

      img {
        page-break-inside: avoid;
      }

      p,
      h3 {
        orphans: 3;
        widows: 3;
      }

      h3 {
        page-break-after: avoid;
      }

      @page {
        size: a3;
      }

      body {
        min-width: 992px !important;
      }

      .container {
        min-width: 992px !important;
      }

      .navbar {
        display: none;
      }
    }

    figcaption,
    main {
      display: block;
    }

    main {
      overflow: hidden;
    }

    .bg-white {
      background-color: #fff !important;
    }

    a.bg-white:hover,
    a.bg-white:focus,
    button.bg-white:hover,
    button.bg-white:focus {
      background-color: #e6e6e6 !important;
    }

    .bg-gradient-default {
      background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
    }

    .bg-gradient-default {
      background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
    }

    @keyframes floating-lg {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(15px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    @keyframes floating {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(10px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    @keyframes floating-sm {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(5px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .opacity-8 {
      opacity: .8 !important;
    }

    .opacity-8 {
      opacity: .9 !important;
    }

    .center {
      left: 50%;
      transform: translateX(-50%);
    }

    [class*='shadow'] {
      transition: all .15s ease;
    }

    .font-weight-300 {
      font-weight: 300 !important;
    }

    .text-sm {
      font-size: .875rem !important;
    }

    .text-white {
      color: #fff !important;
    }

    a.text-white:hover,
    a.text-white:focus {
      color: #e6e6e6 !important;
    }

    .avatar {
      font-size: 1rem;
      display: inline-flex;
      width: 48px;
      height: 48px;
      color: #fff;
      border-radius: 50%;
      background-color: #adb5bd;
      align-items: center;
      justify-content: center;
    }

    .avatar img {
      width: 100%;
      border-radius: 50%;
    }

    .avatar-sm {
      font-size: .875rem;
      width: 36px;
      height: 36px;
    }

    .btn {
      font-size: .875rem;
      position: relative;
      transition: all .15s ease;
      letter-spacing: .025em;
      text-transform: none;
      will-change: transform;
    }

    .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
    }

    .btn:not(:last-child) {
      margin-right: .5rem;
    }

    .btn i:not(:first-child) {
      margin-left: .5rem;
    }

    .btn i:not(:last-child) {
      margin-right: .5rem;
    }

    .input-group .btn {
      margin-right: 0;
      transform: translateY(0);
    }

    .btn-sm {
      font-size: .75rem;
    }

    [class*='btn-outline-'] {
      border-width: 1px;
    }

    .card-profile-image {
      position: relative;
    }

    .card-profile-image img {
      position: absolute;
      left: 50%;
      max-width: 180px;
      transition: all .15s ease;
      transform: translate(-50%, -30%);
      border-radius: .375rem;
    }

    .card-profile-image img:hover {
      transform: translate(-50%, -33%);
    }

    .card-profile-stats {
      padding: 1rem 0;
    }

    .card-profile-stats>div {
      margin-right: 1rem;
      padding: .875rem;
      text-align: center;
    }

    .card-profile-stats>div:last-child {
      margin-right: 0;
    }

    .card-profile-stats>div .heading {
      font-size: 1.1rem;
      font-weight: bold;
      display: block;
    }

    .card-profile-stats>div .description {
      font-size: .875rem;
      color: #adb5bd;
    }

    .main-content {
      position: relative;
    }

    .main-content .navbar-top {
      position: absolute;
      z-index: 1;
      top: 0;
      left: 0;
      width: 100%;
      padding-right: 0 !important;
      padding-left: 0 !important;
      background-color: transparent;
    }

    @media (min-width: 768px) {
      .main-content .container-fluid {
        padding-right: 39px !important;
        padding-left: 39px !important;
      }
    }

    .dropdown {
      display: inline-block;
    }

    .dropdown-menu {
      min-width: 12rem;
    }

    .dropdown-menu .dropdown-item {
      font-size: .875rem;
      padding: .5rem 1rem;
    }

    .dropdown-menu .dropdown-item>i {
      font-size: 1rem;
      margin-right: 1rem;
      vertical-align: -17%;
    }

    .dropdown-header {
      font-size: .625rem;
      font-weight: 700;
      padding-right: 1rem;
      padding-left: 1rem;
      text-transform: uppercase;
      color: #f6f9fc;
    }

    .dropdown-menu a.media>div:first-child {
      line-height: 1;
    }

    .dropdown-menu a.media p {
      color: #8898aa;
    }

    .dropdown-menu a.media:hover .heading,
    .dropdown-menu a.media:hover p {
      color: #172b4d !important;
    }

    .footer {
      padding: 2.5rem 0;
      background: #f7fafc;
    }

    .footer .nav .nav-item .nav-link {
      color: #8898aa !important;
    }

    .footer .nav .nav-item .nav-link:hover {
      color: #525f7f !important;
    }

    .footer .copyright {
      font-size: .875rem;
    }

    .form-control-label {
      font-size: .875rem;
      font-weight: 600;
      color: #525f7f;
    }

    .form-control {
      font-size: .875rem;
    }

    .form-control:focus:-ms-input-placeholder {
      color: #adb5bd;
    }

    .form-control:focus::-ms-input-placeholder {
      color: #adb5bd;
    }

    .form-control:focus::placeholder {
      color: #adb5bd;
    }

    textarea[resize='none'] {
      resize: none !important;
    }

    textarea[resize='both'] {
      resize: both !important;
    }

    textarea[resize='vertical'] {
      resize: vertical !important;
    }

    textarea[resize='horizontal'] {
      resize: horizontal !important;
    }

    .form-control-alternative {
      transition: box-shadow .15s ease;
      border: 0;
      box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
    }

    .form-control-alternative:focus {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

    .input-group {
      transition: all .15s ease;
      border-radius: .375rem;
      box-shadow: none;
    }

    .input-group .form-control {
      box-shadow: none;
    }

    .input-group .form-control:not(:first-child) {
      padding-left: 0;
      border-left: 0;
    }

    .input-group .form-control:not(:last-child) {
      padding-right: 0;
      border-right: 0;
    }

    .input-group .form-control:focus {
      box-shadow: none;
    }

    .input-group-text {
      transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
    }

    .input-group-alternative {
      transition: box-shadow .15s ease;
      border: 0;
      box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
    }

    .input-group-alternative .form-control,
    .input-group-alternative .input-group-text {
      border: 0;
      box-shadow: none;
    }

    .focused .input-group-alternative {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08) !important;
    }

    .focused .input-group {
      box-shadow: none;
    }

    .focused .input-group-text {
      color: #8898aa;
      border-color: rgba(50, 151, 211, .25);
      background-color: #fff;
    }

    .focused .form-control {
      border-color: rgba(50, 151, 211, .25);
    }

    .header {
      position: relative;
    }

    .input-group {
      transition: all .15s ease;
      border-radius: .375rem;
      box-shadow: none;
    }

    .input-group .form-control {
      box-shadow: none;
    }

    .input-group .form-control:not(:first-child) {
      padding-left: 0;
      border-left: 0;
    }

    .input-group .form-control:not(:last-child) {
      padding-right: 0;
      border-right: 0;
    }

    .input-group .form-control:focus {
      box-shadow: none;
    }

    .input-group-text {
      transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
    }

    .input-group-alternative {
      transition: box-shadow .15s ease;
      border: 0;
      box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
    }

    .input-group-alternative .form-control,
    .input-group-alternative .input-group-text {
      border: 0;
      box-shadow: none;
    }

    .focused .input-group-alternative {
      box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08) !important;
    }

    .focused .input-group {
      box-shadow: none;
    }

    .focused .input-group-text {
      color: #8898aa;
      border-color: rgba(50, 151, 211, .25);
      background-color: #fff;
    }

    .focused .form-control {
      border-color: rgba(50, 151, 211, .25);
    }

    .mask {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      transition: all .15s ease;
    }

    @media screen and (prefers-reduced-motion: reduce) {
      .mask {
        transition: none;
      }
    }

    .nav-link {
      color: #525f7f;
    }

    .nav-link:hover {
      color: #5e72e4;
    }

    .nav-link i.ni {
      position: relative;
      top: 2px;
    }

    .navbar-search .input-group {
      border: 2px solid;
      border-radius: 2rem;
      background-color: transparent;
    }

    .navbar-search .input-group .input-group-text {
      padding-left: 1rem;
      background-color: transparent;
    }

    .navbar-search .form-control {
      width: 270px;
      background-color: transparent;
    }

    .navbar-search-dark .input-group {
      border-color: rgba(255, 255, 255, .6);
    }

    .navbar-search-dark .input-group-text {
      color: rgba(255, 255, 255, .6);
    }

    .navbar-search-dark .form-control {
      color: rgba(255, 255, 255, .9);
    }

    .navbar-search-dark .form-control:-ms-input-placeholder {
      color: rgba(255, 255, 255, .6);
    }

    .navbar-search-dark .form-control::-ms-input-placeholder {
      color: rgba(255, 255, 255, .6);
    }

    .navbar-search-dark .form-control::placeholder {
      color: rgba(255, 255, 255, .6);
    }

    .navbar-search-dark .focused .input-group {
      border-color: rgba(255, 255, 255, .9);
    }

    @media (min-width: 768px) {
      .navbar .dropdown-menu {
        margin: 0;
        pointer-events: none;
        opacity: 0;
      }

      .navbar .dropdown-menu-arrow:before {
        position: absolute;
        z-index: -5;
        bottom: 100%;
        left: 20px;
        display: block;
        width: 12px;
        height: 12px;
        content: '';
        transform: rotate(-45deg) translateY(12px);
        border-radius: 2px;
        background: #fff;
        box-shadow: none;
      }

      .navbar .dropdown-menu-right:before {
        right: 20px;
        left: auto;
      }

      @keyframes show-navbar-dropdown {
        0% {
          transition: visibility .25s, opacity .25s, transform .25s;
          transform: translate(0, 10px) perspective(200px) rotateX(-2deg);
          opacity: 0;
        }

        100% {
          transform: translate(0, 0);
          opacity: 1;
        }
      }

      @keyframes hide-navbar-dropdown {
        from {
          opacity: 1;
        }

        to {
          transform: translate(0, 10px);
          opacity: 0;
        }
      }
    }

    @media (max-width: 767.98px) {
      .navbar-nav .nav-link {
        padding: .625rem 0;
        color: #172b4d !important;
      }

      .navbar-nav .dropdown-menu {
        min-width: auto;
        box-shadow: none;
      }
    }

    @keyframes show-navbar-collapse {
      0% {
        transform: scale(.95);
        transform-origin: 100% 0;
        opacity: 0;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    @keyframes hide-navbar-collapse {
      from {
        transform: scale(1);
        transform-origin: 100% 0;
        opacity: 1;
      }

      to {
        transform: scale(.95);
        opacity: 0;
      }
    }

    .progress {
      overflow: hidden;
      height: 8px;
      margin-bottom: 1rem;
      border-radius: .25rem;
      background-color: #e9ecef;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
    }

    p {
      font-size: 1rem;
      font-weight: 300;
      line-height: 1.7;
    }

    .description {
      font-size: .875rem;
    }

    .heading {
      font-size: .95rem;
      font-weight: 600;
      letter-spacing: .025em;
      text-transform: uppercase;
    }

    .heading-small {
      font-size: .75rem;
      padding-top: .25rem;
      padding-bottom: .25rem;
      letter-spacing: .04em;
      text-transform: uppercase;
    }

    .display-2 span {
      font-weight: 300;
      display: block;
    }

    @media (max-width: 768px) {
      .btn {
        margin-bottom: 10px;
      }
    }

    #navbar .navbar {
      margin-bottom: 20px;
    }
  </style>
</body>

</html>