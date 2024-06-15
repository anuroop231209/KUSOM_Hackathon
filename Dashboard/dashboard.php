<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">


    <link rel="stylesheet" href="../Sidebar/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="body-pd">
<?php
include_once("../Sidebar/sidebar.html");
?>

    <div class="main-container">
    <div class="column-1">
        <div class="graph-row-1"><img class="graph" src="images/graph.jpg"></div>
        <div class="graph-row-2">
            <div class="pie"><img src="images/expenses.jpg"></div>
            <div class="pie"><img src="images/income.jpg"></div>
            <div class="pie"><img src="images/sales.jpg"></div>
            <div class="pie"><img src="images/profit.jpg"></div>         
        </div>
    </div>

    <div class="class=container" style=" background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    ">
        <h1>To do list</h1>
        <form id="todo-form">
<input type="text" id="todo-input" placeholder="Add new task " required>
<button type="submit">ADD</button>
        </form>
        <ul id="todo-list"></ul>
    </div>
</div>
<script src="scripts.js"></script>
<script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>