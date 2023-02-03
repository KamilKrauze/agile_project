<head> 
    <link rel="stylesheet" href="./css/shoppinglist.css">
</head>

<body>
    <?php include 'header.php';?>
    
    <!-- Main container -->
    <div class="main-body" id="main-body">
    </div>
    <script>
    refreshList()
    addEventListener('storage', refreshList);
    </script>

    <?php include 'footer.php';?>
</body>