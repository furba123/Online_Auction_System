<?php include '../header.php';
if (isset($_GET['s'])) {
    $searchTerm = $_GET['s'];
    $sql = "SELECT * FROM contact_form WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if ($current_user['role'] == 'customer' || $current_user['role'] == 'seller' ):
    header("Location: " . '../');
endif;

if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM contact_form where `id` = '$message_id' ");

    if ($query) {

        $_SESSION['contact_msg'] = "Message deleted successfully.";
    } else {
        $_SESSION['status_msg'] = "Error deleting message";
    };

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
    
};


$query = "SELECT * FROM contact_form";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<main class="pb-5">

    <?php $query = "SELECT * FROM contact_form";
    $result = mysqli_query($conn, $query);

    if (isset($_GET['s'])):
        $rows = $search_results;
    else:
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    endif;


    ?>

    <?php if (isset($_SESSION['contact_msg'])): ?>
        <div class="container">
            <div class="alert alert-danger mt-3">
            <?php echo $_SESSION['contact_msg']; ?>
                </div>
            </div>
    <?php unset($_SESSION['contact_msg']); endif; ?>

    <div class="user-form my-5">
        <div class="container">
            <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom 
              pb-3 mb-3">
                <h4>Messages</h4>
                <form class="form">
                    <div class="input-group  search-wrapper">
                        <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value  = ' . $_GET['s'] . ' ' : '' ?> class="form-control " placeholder="Search..">
                        <i class="icon bi bi-search"></i>
                    </div>
                </form>
           
            </div>
            <?php if ($rows): ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($rows as $row) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $i; ?>
                                </th>
                                <td>
                                    <?php echo $row['first_name'] . ' ' . $row['last_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['email'] ?>
                                </td>
                                <td>
                                    <?php echo $row['subject'] ?>
                                </td>
                                <td>
                                    <?php echo $row['message'] ?>
                                </td>
                            
                                    <td style="white-space:nowrap">

                                        <a data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                            href="?id=<?php echo $row['id'] ?>"
                                            class="btn btn-outline-danger modal-trigger">Delete</a>
                                    </td>
                            
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            <?php else:

                if (isset($_GET['s'])):
                    ?>

                    <h3 class="text-center text-muted">Users not found.</h3>


                <?php else: ?>

                    <h5 class="text-center my-5">No messages found.</h5>
                <?php endif; endif; ?>

        </div>
    </div>
</main>
<?php include '../footer.php'; ?>