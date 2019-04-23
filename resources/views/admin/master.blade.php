<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> @yield('title') </title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets') }}/font-awesome/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Datatable styles -->
  <link href="{{ asset('assets') }}/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets') }}/css/sb-admin-2.css" rel="stylesheet">

  {{-- Laravel Toastr --}}
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> WEB UNI </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>
            Users
            <span class="badge-danger pl-1 pr-1" id="pending-users"></span>
          </span>
        </a>
      </li>
      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true" aria-controls="category">
          <i class="fas fa-fw fa-folder"></i>
          <span>Category</span>
        </a>
        <div id="category" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.all-category') }}"> <i class="fa fa-list"></i> Categories</a>
            <a class="collapse-item" href="{{ route('admin.add-category') }}"> <i class="fa fa-plus-square"></i> Add Category</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#course" aria-expanded="true" aria-controls="course">
          <i class="fas fa-fw fa-folder"></i>
          <span>
            Course  
            <span class="badge-danger pl-1 pr-1" id="pending-courses"></span>
          </span>
        </a>
        <div id="course" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.all-course') }}"> <i class="fa fa-list"></i> Courses</a>
            <a class="collapse-item" href="{{ route('admin.add-course') }}"> <i class="fa fa-plus-square"></i> Add Course</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#section" aria-expanded="true" aria-controls="section">
          <i class="fas fa-fw fa-folder"></i>
          <span>Section</span>
        </a>
        <div id="section" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.all-section') }}"> <i class="fa fa-list"></i> Sections</a>
            <a class="collapse-item" href="{{ route('admin.add-section') }}"> <i class="fa fa-plus-square"></i> Add Section</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lesson" aria-expanded="true" aria-controls="lesson">
          <i class="fas fa-fw fa-folder"></i>
          <span>Lesson</span>
        </a>
        <div id="lesson" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.all-lesson') }}"> <i class="fa fa-list"></i> Lessons</a>
            <a class="collapse-item" href="{{ route('admin.add-lesson') }}"> <i class="fa fa-plus-square"></i> Add Lesson</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Contacts -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contacts') }}">
          <i class="fas fa-fw fa-envelope"></i>
          <span>
            Contacts 
            <span class="badge-danger pl-1 pr-1" id="pending-contacts"></span> 
          </span>
        </a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Web Uni - 2019</span>
          </div>
        </div>
      </footer>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets') }}/jquery/jquery-3.3.1.js"></script>
  <script src="{{ asset('assets') }}/bootstrap/bootstrap.bundle.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets') }}/jquery-easing/jquery.easing.js"></script>

  <!-- Chart JavaScript-->
  <script src="{{ asset('assets') }}/chart.js/Chart.bundle.js"></script>
  <script src="{{ asset('assets') }}/demo/chart-area-demo.js"></script>
  <script src="{{ asset('assets') }}/demo/chart-pie-demo.js"></script>

  <!-- Datatable JavaScript-->
  <script src="{{ asset('assets') }}/datatables/jquery.dataTables.js"></script>
  <script src="{{ asset('assets') }}/datatables/dataTables.bootstrap4.js"></script>
  <script src="{{ asset('assets') }}/demo/datatables-demo.js"></script>

  {{-- Ckeditor js --}}
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets') }}/js/sb-admin-2.js"></script>

  {{-- Laravel Toastr --}}
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
  
  @stack('js')

  <script>

    setInterval(function(){
      pendingCourse()
      pendingContact();
      pendingUsers();
    }, 500);
    
    function pendingContact() {
      $.ajax({
        url: "{{ route('admin.pending-contact') }}",
        method: 'GET',
        success: function(data) {
          $('#pending-contacts').html(data);
        }
      });
    }
    
    function pendingCourse() {
      $.ajax({
        url: "{{ route('admin.pending-course') }}",
        method: 'GET',
        success: function(data) {
          $('#pending-courses').html(data);
        }
      });
    }
    
    function pendingUsers() {
      $.ajax({
        url: "{{ route('admin.pending-users') }}",
        method: 'GET',
        success: function(data) {
          $('#pending-users').html(data);
        }
      });
    }
  </script>

</body>

</html>
