<?php 
  $html_admin_account = '';
  if(isset($_SESSION['admin_account']) && count($_SESSION['admin_account']) >0 )
  {
    extract($_SESSION['admin_account']);
    $html_admin_account = '<span class="me-3">Xin chào, '.$name.'</span>';    
  } else {
    $html_admin_account = '<span class="me-3">Xin chào, Admin</span>'; 
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin T Coffee & Tea</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <!-- Link css -->
    <link rel="stylesheet" href="layout/css/index.css" />

    <!-- Link tạo biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="layout/css/style.css">
		<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.css" crossorigin>
		<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/45.1.0/ckeditor5-premium-features.css" crossorigin>

  </head>

  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold text-dark">Trang quản trị</span>
        <div class="ms-auto">
          <?=$html_admin_account;?>
          <i class="bi bi-person-circle fs-4"></i>
        </div>
      </div>
    </nav>