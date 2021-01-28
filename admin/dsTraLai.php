<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("libs/db.php");
include("common/common.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("head.php");
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("sidebar.php");
        ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("topbar.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h3>Danh Sách Trả Lãi</h3>
                    <table id="tblUser" class="display">
                        <thead>
                            <tr>
                                <th>Mã HS TRả Lãi</th>
                                <th>Mã HS Đầu Tư</th>
                                <th>Ngày Trải Lãi</th>
                                <th>Ngày Trả Lãi Tiếp Theo</th>
                                <th>Ngày Trả Lãi Thực Tế</th>
                                <th>Hình Ảnh Giao Dịch</th>
                                <th>Số Tiền Cần Gửi</th>
                                <th>Trạng Thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `chi_tiet_gui_lai_dau_so` ORDER BY `id` DESC ";

                            // Thực thi câu truy vấn và gán vào $result
                            $result = $conn->query($sql);

                            // Kiểm tra số lượng record trả về có lơn hơn 0
                            // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                            if ($result->num_rows > 0) {
                                // Sử dụng vòng lặp while để lặp kết quả
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th><?php echo $row['id']; ?></th>
                                        <th><?php echo $row['id_dau_tu_so']; ?></th>
                                        <th><?php echo $row['ngay_trai_lai']; ?></th>
                                        <th><?php echo $row['ngay_tra_lai_tiep_theo']; ?></th>
                                        <th><?php echo $row['ngay_tra_lai_thuc_te']; ?></th>
                                        <th><img src="<?php echo $row['hinh_anh_giao_dich']; ?>" alt="ảnh trả lãi" width="200px" height="200px"></th>
                                        <th><?php echo  $row['so_tien_phai_gui'] ?></th>
                                        <th><?php

                                            if ($row['trang_thai_tra_lai'] == 0) {
                                                echo "Đang Chờ Xác Thực";
                                            } else if ($row['trang_thai_tra_lai'] == 1) {
                                                echo "Đang Chờ Được Trã Lãi";
                                            } else if ($row['trang_thai_tra_lai'] == 2) {
                                                echo "Đã Gửi Lãi";
                                            }

                                            ?></th>

                                        <th>
                                            <?php

                                            if ($row['trang_thai_tra_lai'] != 2) {
                                            ?>
                                                <button type="button" name="active2XuLy" id="active2XuLy" class="btn btn-success"><a class="mauChu" href="tra_lai.php?id_tra_lai=<?php echo $row['id']; ?>&id_vay_von=<?php echo $row['id_dau_tu_so']; ?>">Trả Lãi</a></button>
                                            <?php
                                            }else{
                                                echo "Đã Trả Lãi";
                                            }
                                            ?>
                                        </th>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- datatable.js -->

                <script>
                    $(document).ready(function() {
                        $('#tblUser').DataTable({
                            responsive: true
                        });
                    });
                </script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include("footer.php");
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Xử lý khi bạn muốn thoát khỏi trang admin  -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng Suất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Đăng Suất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>