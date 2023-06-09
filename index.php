<?php
session_start();
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/themes/prism.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.23.0/prism.min.js"></script>

  </head>
  <body>
  <style>

  table {
      font-family: Arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
  }

  td, th {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
  }

  tr:nth-child(even) {
      background-color: #f2f2f2;
  }

  tr:hover {
      background-color: #e2e2e2;
  }

  th {
      background-color: #4CAF50;
      color: white;
  }
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }

      nav {
        background-color: #4CAF50;
        overflow: hidden;
      }

      nav a {
        float: left;
        color: Black;
        text-align: center;
        /* padding: 14px 16px; */
        text-decoration: none;
        font-size: 17px;
      }

      nav a:hover {
        background-color: #ddd;
        color: black;
      }

      form {
        margin-top: 10px;
        margin-right: 10px;
        margin-left: 30px;
      }

      input[type=text] {
        background-color: white;
        padding: 12px 40px 12px 40px;
        background-position: 10px 10px;
        background-repeat: no-repeat;
      }

      button[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: auto;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      button[type=submit]:hover {
        background-color: #45a049;
      }
      h4{
        color: white;
        text-align: center;
        margin-left: 25px;

      }
      .btn_logout{
        margin-right: 10px;
        margin-left: 25px;
      }
  </style>
  <body>

    <header>
      <h1>Blog </h1>
    </header>
    <nav>
  <br>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../web/index.php">BlogName</a>
        <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="../web/index.php">Home</a></li>
        <li><a href="../web/category.php?category=doi-song">Đời Sống</a></li>
        <li><a href="../web/category.php?category=giai-tri">Giải trí</a></li>
        <li><a href="../web/category.php?category=drama">Drama</a></li>
        <li><a href="../web/category.php?category=the-thao">Thể Thao</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

      <?php
if (isset($_SESSION["username"])) {
    echo "<h4>" . "Xin chào, " . $_SESSION["username"] . "</h4>";
    echo '<form method="post" action="../web/session.php">';
    echo '<button type="submit" name="logout" class="btn_logout">Logout</button>';
    echo '</form>';

    // Add the following lines
    $connect = mysqli_connect('localhost', 'root', '', 'data') or die('Không thể kết nối tới database');
    mysqli_set_charset($connect, 'UTF8');
    $username = $_SESSION['username'];
    $query = "SELECT role FROM member WHERE username='$username'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'];
    if ($role === 'admin') {
        echo '<form method="post" action="admin/admin.php">';
        echo '<button type="submit" class="btn btn-primary">Admin Page</button>';
        echo '</form>';
    } else {
        echo '<form method="post" action="user/user.php">';
        echo '<button type="submit" class="btn btn-primary">User Page</button>';
        echo '</form>';
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('Location: ../web/index.php');
    }
} else {
    echo '<li>' . '<a href="../web/dangnhap/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>' . '</li>';
    echo '<li>' . '<a href="../web/dangky/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>' . '</li>';
}
?>
    </div>
  </nav>
  <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input class="form-control" name="search" type="text" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
  <button type="submit">Search</button>
</form>
    <table class="table table-bordered table-striped">
          <thead>
              <tr>
          <th> Tiêu đề </th>
          <th> Nội dung </th>
          <th> Danh Mục </th>
          <th> Tác Gỉa </th>
          <th> thời gian </th>
              </tr>
          </thead>
  <tbody id="myTable">
  <?php
//Kết nối tới database
$connect = mysqli_connect('localhost', 'root', '', 'data') or die('Không thể kết nối tới database');
mysqli_set_charset($connect, 'UTF8');
if ($connect === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//Determine number of records per page
$records_per_page = 5;

//Determine current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

//Calculate offset
$offset = ($current_page - 1) * $records_per_page;

//Modify SQL query to include LIMIT and OFFSET clauses
// Modify SQL query to include LIMIT and OFFSET clauses

$search_term = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';

if (!empty($search_term)) {
    $sql = "SELECT * FROM posts WHERE title LIKE '%$search_term%' OR content LIKE '%$search_term%' OR category LIKE '%$search_term%'";
} else {
    $sql = "SELECT * FROM posts";
}

$result_count = mysqli_query($connect, $sql);
$total_records = mysqli_num_rows($result_count);

// Determine number of records per page
$records_per_page = 5;

// Determine current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset
$offset = ($current_page - 1) * $records_per_page;

// Modify SQL query to include LIMIT and OFFSET clauses
if (!empty($search_term)) {
    $query = "$sql ORDER BY date DESC LIMIT $records_per_page OFFSET $offset";
} else {
    $query = "$sql ORDER BY date DESC LIMIT $records_per_page OFFSET $offset";
}

$result = mysqli_query($connect, $query);

// Calculate total number of pages
$total_pages = ceil($total_records / $records_per_page);

//Calculate total number of pages
$query = "SELECT COUNT(*) AS count FROM posts";
$result_count = mysqli_query($connect, $query);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['count'];
$total_pages = ceil($total_records / $records_per_page);

//Display navigation links

echo '</ul>';
echo '</nav>';

while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . '<a href="read_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a>' . '</td>';
    echo '<td>' . substr($row['content'], 0, 500) . '....' . '</td>';
    echo '<td>' . $row['category'] . '</td>';
    echo '<td>' . $row['author'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
        echo '<li class="active"><a href="#">' . $i . '</a></li>';
    } else {
        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
    }
}

?>
  </tbody>
  </table>

  <script>
            $(document).ready(function(){
            $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  </script>
  </body>
  </html>
