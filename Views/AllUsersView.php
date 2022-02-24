<link rel="stylesheet" href="<?= $this->app_name ?>/Views/Styles/allUsersViewStyle.css">
<div class="mainContainer m-5 p-3">
    <div class="containerHead row m-0">
        <div class="col-2 d-flex justify-content-end align-items-center">
            Number of Rows:
        </div>
        <div class="form-group col-4">
            <select name="num_rows" id="input_num_rows" class="form-select">
                <option value="10" <?= ($num_rows == 10) ? "selected" : "" ?>>10</option>
                <option value="20" <?= ($num_rows == 20) ? "selected" : "" ?>>20</option>
                <option value="30" <?= ($num_rows == 30) ? "selected" : "" ?>>30</option>
                <option value="40" <?= ($num_rows == 40) ? "selected" : "" ?>>40</option>
                <option value="50" <?= ($num_rows == 50) ? "selected" : "" ?>>50</option>
                <option value="100" <?= ($num_rows == 100) ? "selected" : "" ?>>100</option>
                <option value="200" <?= ($num_rows == 200) ? "selected" : "" ?>>200</option>
            </select>
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search .." id="input_search" name="search" value="<?= $search ?>">
                <button class="btn btn-outline-secondary" type="button" id="search_button">Search</button>
            </div>
        </div>
    </div>
    <div class="mt-5 px-5 tableContainer">
        <table class="table">
            <tr class="noselect">
                <th <?php
                    if ($sort_column == 'first_name') {
                        if ($sort_direction == 'ASC') {
                            echo "onclick='sort(\"first_name\", \"DESC\")'";
                        } else {
                            echo "onclick='sort(\"first_name\", \"ASC\")'";
                        }
                    } else {
                        echo "onclick='sort(\"first_name\", \"ASC\")'";
                    }

                    ?>>First Name
                    <?php
                    if ($sort_column == 'first_name') {
                        if ($sort_direction == 'ASC') {
                            echo "<i class=\"fa\">&#xf063;</i>";
                        } else {
                            echo "<i class=\"fa\">&#xf062;</i>";
                        }
                    } 
                    ?>
                </th>
                <th <?php
                    if ($sort_column == 'last_name') {
                        if ($sort_direction == 'ASC') {
                            echo "onclick='sort(\"last_name\", \"DESC\")'";
                        } else {
                            echo "onclick='sort(\"last_name\", \"ASC\")'";
                        }
                    } else {
                        echo "onclick='sort(\"last_name\", \"ASC\")'";
                    }

                    ?>>Last Name
                    <?php
                    if ($sort_column == 'last_name') {
                        if ($sort_direction == 'ASC') {
                            echo "<i class=\"fa\">&#xf063;</i>";
                        } else {
                            echo "<i class=\"fa\">&#xf062;</i>";
                        }
                    } 
                    ?></th>
                <th <?php
                    if ($sort_column == 'email') {
                        if ($sort_direction == 'ASC') {
                            echo "onclick='sort(\"email\", \"DESC\")'";
                        } else {
                            echo "onclick='sort(\"email\", \"ASC\")'";
                        }
                    } else {
                        echo "onclick='sort(\"email\", \"ASC\")'";
                    }

                    ?>>Email <?php
                    if ($sort_column == 'email') {
                        if ($sort_direction == 'ASC') {
                            echo "<i class=\"fa\">&#xf063;</i>";
                        } else {
                            echo "<i class=\"fa\">&#xf062;</i>";
                        }
                    } 
                    ?></th>
            </tr>
            <?php
            if (count($users) <= 0) {
                echo "<tr><td> No User Found </td></tr>";
            }
            foreach ($users as $user) {
            ?>
                <tr>
                    <td style="width: 20%;"><?= $user['first_name'] ?></td>
                    <td style="width: 20%;"><?= $user['last_name'] ?></td>
                    <td style="width: 20%;"><?= $user['email'] ?></td>
                </tr>

            <?php
            }
            ?>

        </table>
        <nav>
            <ul class="pagination noselect">
                <li class="page-item <?= ($num_location <= 1) ? "disabled" : "" ?>"><a class="page-link" onclick="update_location(<?= $num_location - 1 ?>)">&laquo; Previous</a></li>

                <?php
                for ($i = 1; $i <= $num_tabs; $i++) {
                ?>
                    <li class="page-item <?= ($num_location == $i) ? "active" : "" ?>"><a class="page-link" onclick="update_location(<?= $i ?>)"><?= $i ?></a></li>
                <?php
                }
                ?>





                <li class="page-item <?= ($num_location >= $num_tabs) ? "disabled" : "" ?>"><a class="page-link" onclick="update_location(<?= $num_location + 1 ?>)">Next &raquo;</a></li>
            </ul>
        </nav>

    </div>
</div>
<script>
    $("#input_num_rows").on("change", function(e) {
        current_url = window.location.href;
        var url = new URL(current_url);

        // changing num_rows, and resetting num location
        url.searchParams.set('num_rows', e.target.value);
        url.searchParams.set('num_location', 1);
        document.location = url.href;


    });


    function search(e) {
        search_string = $("#input_search").val();
        var url = new URL(window.location.href);
        url.searchParams.set('search', search_string);

        // resetting num location
        url.searchParams.set('num_location', 1);
        document.location = url.href;
    }

    $("#search_button").click(search);
    $('#input_search').keydown(function(event) {
        var keyCode = (event.keyCode ? event.keyCode : event.which);
        if (keyCode == 13) {
            search(event);
        }
    });


    function update_location(num) {
        var url = new URL(window.location.href);
        url.searchParams.set('num_location', num);
        document.location = url.href;
    }


    function sort(column_name, direction) {
        var url = new URL(window.location.href);
        url.searchParams.set('sort_column', column_name);
        url.searchParams.set('sort_direction', direction);
        document.location = url.href;
    }
</script>