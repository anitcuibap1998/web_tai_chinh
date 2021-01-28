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
                    <h3>Danh Sách Vay Nợ</h3>
                    <table id="tblUser" class="display">
                        <thead>
                            <tr>
                                <th>Mã Hồ Sơ</th>
                                <th>Mã User</th>
                                <th>Mức Vay</th>
                                <th>Kỳ Hạn Vay</th>
                                <th>Phone Momo</th>
                                <th>Trang Thái</th>
                                <th>Lý Do Bị Hủy</th>
                                <th>Ngày Vay Nợ</th>
                                <th>Lãi Suất</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `vay_tien` ORDER BY `id` DESC";

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
                                        <th><?php echo $row['id_user']; ?></th>
                                        <th><?php echo $row['muc_vay'] * 1000000 . " VNĐ"; ?></th>
                                        <th><?php echo $row['ky_han_vay']; ?></th>
                                        <th><?php echo $row['phone_momo']; ?></th>
                                        <th><?php

                                            if ($row['trang_thai_don_vay'] == -99) {
                                                echo "Chưa Đóng Phí Làm Hồ Sơ";
                                            } else if ($row['trang_thai_don_vay'] == 0) {
                                                echo "Đang Chờ Xét Duyệt";
                                            } else if ($row['trang_thai_don_vay'] == 1) {
                                                echo "Bị Hủy";
                                            } else if ($row['trang_thai_don_vay'] == 2) {
                                                echo "Thành Công";
                                            }

                                            ?></th>
                                        <th> <?php if ($row['ly_do_bi_huy'] == "0") {
                                                    echo "Chưa Có Lý Do";
                                                } else {
                                                    echo $row['ly_do_bi_huy'];
                                                }
                                                ?></th>
                                        <th><?php echo $row['ngay_vay_no']; ?></th>
                                        <th><?php echo $row['laixuat']; ?></th>
                                        <th>
                                            <button type="button" name="tuChoiDonVay" id="tuChoiDonVay" class="btn btn-success"><a class="mauChu" href="tuChoiDonVay.php?id_DonVay=<?php echo $row['id']; ?>">Từ Chối Đơn Vay</a></button>
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