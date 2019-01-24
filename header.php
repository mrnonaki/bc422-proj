<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Rent Computer Parts System</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/daterangepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-datepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-colorpicker.css" rel="stylesheet" />
  <!-- date picker -->

  <!-- color picker -->

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />


</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->

    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.html" class="logo">Rent Computer Parts<span class="lite"> System</span></a>
      <!--logo end-->


    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="home.php">
                          <i class="icon_house_alt"></i>
                          <span>หน้าหลัก</span>
                      </a>
		  </li>
          <li class="sub-menu ">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>เช่าสินค้า</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="order_add_1.php">บันทึกการเช่า</a></li>
              <li><a class="" href="order_list_1.php">รายการเช่า</a></li>
            </ul>
          </li>					  
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>คืนสินค้า</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="receive_add_1.php">รับคืน</a></li>
			  <li><a class="" href="receive_list_1.php">รายการรับคืน</a></li>
			  <li><a class="" href="fine_add_1.php">ออกใบปรับ</a></li>
			  <li><a class="" href="fine_list_1.php">รายการปรับ</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>จัดการข้อมูล</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
			  <li><a class="" href="ma_customer_1.php">บันทึก / แก้ไข ลูกค้า</a></li>
              <li><a class="" href="ma_type_1.php">บันทึก / แก้ไข ประเภท</a></li>
			  <li><a class="" href="ma_product_1.php">บันทึก / แก้ไข สินค้า</a></li>
			  <li><a class="" href="ma_staff_1.php">บันทึก / แก้ไข พนักงาน</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>รายงาน</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
			  <li><a class="" href="invoice_list_1.php">ใบเสร็จรับเงิน</a></li>
            </ul>
          </li>
          <li class="">
            <a class="" href="" target="_blank">
                          <i class="icon_document_alt"></i>
                          <span>คู่มือ</span>
                      </a>
		  </li>
          <li class="">
            <a class="" href="index.php">
                          <i class="icon_document_alt"></i>
                          <span>ออกจากระบบ</span>
                      </a>
		  </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->