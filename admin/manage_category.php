<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_manage_categories.php'; ?>

<?php
$pageDetails = [
    'title' => "Manage Category"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>


<body class="app">
    <header class="app-header fixed-top">
        <?php Includes::custom_include('includes/navbar.php', [], true);    ?>
        <!--//app-header-inner-->
        <?php Includes::custom_include('includes/sidebar.php', [], true);    ?>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Manage Categories</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//table-utilities-->
                    </div>
                    <!--//col-auto-->
                </div>
                <!--//row-->

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Category ID</th>
                                        <th class="cell">Category    Title</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    while ($result = mysqli_fetch_array($cat_results)) : ?>

                                        <tr>
                                            <td class="cell">#<?php echo $result['id'] ?></td>
                                            <td class="cell"><?php echo $result['title'] ?></td>
                                            <td class="cell">
                                                <a class="btn btn-sm text-white btn-success" href="edit_category.php?edit=<?php echo $result['id'] ?>">Edit</a>
                                                <a class="btn btn-sm text-white btn-danger" href="?del=<?php echo $result['id'] ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <?php mysqli_stmt_close($category_data_stmt);
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>

            </div>
            <!--//container-fluid-->
        </div>
    </div>
    <!--//app-content-->


    <?php Includes::custom_include('includes/footer.php', [], true);    ?>