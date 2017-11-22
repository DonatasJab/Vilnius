<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-miestas</title>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/css/dashboard.css" rel="stylesheet">
    <link href="template/css/select2.min.css" rel="stylesheet">
  </head>
  <body>
    <?php include('template/navigation.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('template/sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Miestiečių įrašai</h1>

          <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['msg']; ?></div>
          <?php
          unset($_SESSION['msg']); 
          endif; 

          $total = $db->query('SELECT id FROM people')->rowCount();
          $rec_limit = 10;
          $pages = ceil($total / $rec_limit);

          if (isset($_GET['page'])) {
            $page = $_GET['page'] - 1;
            $offset = $rec_limit * $page;
          } else {
            $page = 0;
            $offset = 0;
          }

          $max = 7;
          if($page < $max) {
              $sp = 1;
          } elseif($page >= ($pages - floor($max / 2))) {
              $sp = $pages - $max + 1;
          } elseif($page >= $max) {
              $sp = $page - floor($max / 2);
          }

          $stmt = $db->query('SELECT id, GIMIMO_METAI, GIMIMO_VALSTYBE, LYTIS, SEIMOS_PADETIS, KIEK_TURI_VAIKU, SENIUNIJA, GATVE FROM people LIMIT '.$offset.', '.$rec_limit.'');
          ?>
          <div class="table-responsive filterable">
            <table class="table table-striped table-hover">
              <thead>
                <tr class="filters">
                  <th><input type="text" class="form-control" placeholder="Gimimo metai"></th>
                  <th>Gimimo valstybė</th>
                  <th><input type="text" class="form-control" placeholder="Lytis"></th>
                  <th>Seimos padetis</th>
                  <th>Vaikų kiekis</th>
                  <th>Seniunija</th>
                  <th>
                    <select id="street">
                      <option value="">Gatvė</option>
                      <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $row['GATVE']; ?>"><?php echo $row['GATVE']; ?></option>
                      <?php endwhile;
                      $stmt = $db->query('SELECT id, GIMIMO_METAI, GIMIMO_VALSTYBE, LYTIS, SEIMOS_PADETIS, KIEK_TURI_VAIKU, SENIUNIJA, GATVE FROM people LIMIT '.$offset.', '.$rec_limit.''); ?>
                    </select>
                  </th>
                  <th></th>
                  <th><input type="checkbox" id="select_all"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                  <tr id="<?php echo $row['id']; ?>">
                    <td><?php echo $row['GIMIMO_METAI']; ?></td>
                    <td><?php echo $row['GIMIMO_VALSTYBE']; ?></td>
                    <td><?php echo $row['LYTIS']; ?></td>
                    <td><?php echo $row['SEIMOS_PADETIS']; ?></td>
                    <td><?php echo $row['KIEK_TURI_VAIKU']; ?></td>
                    <td><?php echo $row['SENIUNIJA']; ?></td>
                    <td><?php echo $row['GATVE']; ?></td>
                    <td>
                      <a href="edit.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button></a>
                    </td>
                    <td><input type="checkbox" class="checkbox" data-id="<?php echo $row["id"]; ?>"></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <a type="button" id="delete" class="btn btn-danger pull-right">Trinti pasirinktus</a>
          <nav id="pagination" aria-label="Page navigation">
            <ul class="pagination">
                <?php if($page >= $max): ?>
                  <li>
                    <a href="?page=1">1</a>
                    <li><a href="#">..</a></li>
                  </li>
                <?php endif;

                for($i = $sp; $i <= ($sp + $max); $i++):

                    if($i > $pages) {
                        continue;
                    }

                    if($page + 1 == $i): ?>
                        <li class='active'><a href="#"><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li><a href='?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php endif; ?>

                <?php endfor; ?>

                <?php if($page < ($pages - floor($max / 2))): ?>

                    <li><a href="#">..</a></li>
                <?php endif;

                if($page + 1 < $pages) : ?>
                    <li><a href='?page=<?php echo $pages; ?>'><?php echo $pages; ?></a>
                <?php endif; ?>
                 <li>
                    <a>
                        <input required type="text" class="form-control input-xs" id="page" size="4" placeholder="Puslapis">
                    </a>
                </li>
                <li><a><button id="changePage" class="btn btn-default btn-xs" type="button">Go!</button></li></a>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <?php include('template/footer.php'); ?>
  </body>
</html>