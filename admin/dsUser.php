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
                    <h3>Danh Sách User</h3>
                    <table id="tblUser" class="display">
                        <thead>
                            <tr>
                                <th>Mã User</th>
                                <th>Tên </th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Avtive 1</th>
                                <th>Active 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `user` where role <> 99 ORDER BY id DESC";

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
                                        <th><?php echo $row['full_name']; ?></th>
                                        <th><?php echo $row['user_name']; ?></th>
                                        <th><?php echo $row['email']; ?></th>
                                        <th><?php echo $row['phone']; ?></th>
                                        <th><?php

                                            if ($row['active1'] == 0) {
                                                echo "Tài Khoản Chưa Kích Hoạt";
                                            } else {
                                                echo "Đã Active 1";
                                            }

                                            ?></th>
                                        <th><?php

                                            if ($row['active2'] == 0) {
                                                echo 'Chưa Active 2';
                                            } else if ($row['active2'] == 1) {
                                                echo 'Đang Chờ Duyệt';
                                            } else if ($row['active2'] == 2) {
                                                echo 'Bị Hủy';
                                            } else if ($row['active2'] == 3) {
                                                echo 'Active 2 thành công';
                                            }
                                            ?></th>
                                       
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