<div class="text-center">
    <h2><u>Your Posts</u></h2>
    <hr>

    <?php if (isset($view)) : ?>
        <h2>You Haven't Created Any Post yet</h2>
        <h1 style="margin-top:12%;">
            <a href="posts.php?source=add_post"><i class="fas fa-plus-circle"></i></a>
        </h1>
        <h2>CREATE POST</h2>
    <?php else : ?>

        <table class="table table-hover table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">TAGS</th>
                    <th scope="col">COMMENT</th>
                    <th scope="col">DATE</th>
                    <th scope="col">VIEW POST</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>



            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php                                    //delete posts
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);

    $query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);

    header("Location:posts.php");
}
?>