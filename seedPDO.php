<!-- INCLUDES -->
<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
    include "./functionsPDO.php";

    try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
            // Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";",
                        //. 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is OK ", "success");
    } catch(PDOException $e) {
		print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }
	
	// 2) Create database
	$DB_NAME = "gaetan_thomas";
    createDB($conn, $DB_NAME);
					
	// 3) Close connexion
	$conn = null;
    // 4) Connexion on dbname testdrive
    $conn = connectDataBase('gaetan_thomas');
    // Create USERS table
    $TB_NAME = "roles";
    $sql = "CREATE TABLE IF NOT EXISTS " . $TB_NAME . "(id INT(6) UNSIGNED PRIMARY KEY, 
                                          rname VARCHAR(30) NOT NULL,
                                          created_at TIMESTAMP DEFAULT NOW(),
                                          updated_at  TIMESTAMP DEFAULT NOW()
                                          )";
    try {
        $conn->query($sql);
        print_alert(" Table $TB_NAME created ", "success");

    } catch (\Throwable $th) {
        print_alert(" Table $TB_NAME cannot be created ", "danger");
    }
    
    // Create ROLES table
    $TB_NAME = "users";
    $sql = "CREATE TABLE " . $TB_NAME . "(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                                          id_role INT(6) UNSIGNED NOT NULL,
                                          fname VARCHAR(30) NOT NULL,
                                          email VARCHAR(50) NOT NULL,
                                          upassword VARCHAR(255) NOT NULL,
                                          created_at TIMESTAMP DEFAULT NOW(),
                                          uddated_at  TIMESTAMP DEFAULT NOW()
                                          )";
    try {
        $conn->query($sql);
        print_alert(" Table $TB_NAME created ", "success");

    } catch (\Throwable $th) {
        print_alert(" Table $TB_NAME cannot be created ", "danger");
    }
    $sql = "INSERT INTO roles (id , rname) VALUES (1, 'admin'),(2, 'operator'),(3, 'client')";
    try {
        $conn->query($sql);
        print_alert("Lines added 3", "success");

    } catch (\Throwable $th) {
        print_alert("Impossible to add lines in roles", "danger");
    }

// Loop admin
    for ($i=0; $i < 5; $i++) {
        $pwd = password_hash('user'.$i, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO users (id_role, fname, email, upassword) VALUES (1, 'user". $i ."', 'user".$i."@test.net', '".$pwd."')";
        try {
            $conn->query($sql);
            print_alert("Lines added 3", "success");
    
        } catch (\Throwable $th) {
            print_alert("Line add", "danger");
        }
    }
// Loop operator
    for ($i=0; $i < 10; $i++) {
        $pwd = password_hash('user'.$i, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO users (id_role, fname, email, upassword) VALUES (2, 'user". $i ."', 'user".$i."@test.net','".$pwd."')";
        try {
            $conn->query($sql);
            print_alert("admin add ", "success");
    
        } catch (\Throwable $th) {
            print_alert("Impossible to add lines in users", "danger");
        }
    }
// Loop client
    for ($i=0; $i < 20; $i++) {
        $pwd = password_hash('user'.$i, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO users (id_role, fname, email, upassword) VALUES (3, 'user". $i ."', 'user".$i."@test.net', '".$pwd."')";
        try {
            $conn->query($sql);
            print_alert("client add", "success");
    
        } catch (\Throwable $th) {
            print_alert("Impossible to add lines in users", "danger");
        }
    }
?>
<div class='col-md-1 col-sm-12'>
    <button class='btn bg-success ml-4  text-light' onclick='getDetail(0);' data-toggle='modal'>
        <strong>ADD</strong> <i class="fas fa-2x fa-plus-circle mt-2"></i> </button>
</div>
<!-- Table of USERS -->
<table class='table text-center'>

    <thead class='thead-dark'>
        <tr>
            <th scope='col'>ID</th>
            <th scope='col'>NAME</th>
            <th scope='col'>ID ROLE</th>
            <th scope='col'>MAIL</th>
            <th scope='col'>Actions</th>
        </tr>
    </thead>
    <tbody id='tableBook'>
        <?php 
        // SELECT 10 users 
                $sql = "SELECT id, fname, id_role, email FROM users ORDER BY id LIMIT 10";
                try {
                    $result = $conn->query($sql);
                    $all = $result->fetchAll();
                    // For each users we have a row
                    foreach($all as $row){
                        echo "<tr>
                                <th class='align-middle' scope=\'row\'>" . $row['id'] . "</th>
                                <td class='align-middle'><h5>" . $row['fname'] . "</h5></td>
                                <td class='align-middle'><h6>" . $row['id_role'] . "</h6></td>
                                <td class='align-middle'><h6>" . $row['email'] . "</h6></td>
                                <td class='align-middle'>
                                    <a class='btn btn-info p-3' href='userDetail.php?id=" . $row['id'] . "' >Read</a>
                                    <button class='btn btn-info p-3'  onclick='getDetail(". $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-cogs '></i></button>
                                    <button class='btn btn-danger m-2 p-3' onclick='removeConfirm(" . $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-dumpster'></i></button>
                                </td>
                            </tr>";
                    }
                } catch (PDOException $e) {
                        print_alert("Error SELECT table $TB_NAME" . $e->getMessage(), "danger");
                    }finally {
                        
                    } 
    // DROP TABLES
        // $sql = "DROP TABLE users";
        // try {
        //     $conn->query($sql);
        //     print_alert("Table USERS DROPPED", "success");
    
        // } catch (\Throwable $th) {
        //     print_alert("Impossible to drop  users", "danger");
        // }
    
        // $sql = "DROP TABLE roles";
        // try {
        //     $conn->query($sql);
        //     print_alert("Table ROLES DROPPED", "success");
    
        // } catch (\Throwable $th) {
        //     print_alert("Impossible to drop  roles", "danger");
        // }
        ?>
    </tbody>
</table>
<!-- bootstrap modal edit + add -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <input type="text" id="hiddenId" style="display:none;">
                <h4 class="modal-title w-100 font-weight-bold" id="formTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <label id="fname_label" class="labelCheck"></label>
                    <input type="text" id="fname" class="form-control validate " onchange="controlForm('fname')">
                    <label data-error="wrong" data-success="right" for="fname" name="title">Name</label>
                </div>
                <div class="md-form mb-5">
                <label id="email_label" class="labelCheck"></label>
                    <input type="email" id="email" class="form-control validate " onchange="controlForm('email')">
                    <label data-error="wrong" data-success="right" for="email" name="editor">Email</label>
                </div>

                <div class="md-form mb-4">
                    <label id="upassword_label" class="labelCheck"></label>
                    <input type="text" id="upassword" class="form-control validate " onchange="controlForm('upassword')" name="title">
                    <label data-error="wrong" data-success="right" for="upassword">Password</label>
                </div>

                <div class="md-form mb-4">
                    <label id="id_role_label" class="labelCheck"></label>
                    <input type="number" id="id_role" class="form-control validate " onchange="controlForm('id_role')" name="id_role">
                    <label data-error="wrong" data-success="right" for="id_role">Role ID</label>
                </div>

            </div>
            <button class="btn btn-success p-3 mb-3 mx-3" onclick="saveBook();"><i
                    class="fas fa-1x fa-check"></i></button>
        </div>
    </div>
</div>
<!-- bootstrap modal delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center" id="deleteMsg"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" onclick="remove();">Delete</a>
                <input type="text" id="deleteId" style="display:none;">
            </div>
        </div>
    </div>
</div>