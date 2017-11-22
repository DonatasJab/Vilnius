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
  </head>
  <body>
    <?php include('template/navigation.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('template/sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Įrašo redagavimas</h1>
          <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['msg']; ?></div>
          <?php
          unset($_SESSION['msg']); 
          endif; 
          ?>

          <?php if(isset($_GET['id'])): 
            $id = $_GET['id'];
            $stmt = $db->query('SELECT * FROM people WHERE id = '.$id.'');
            $row = $stmt->fetch(PDO::FETCH_ASSOC); ?>
            <form action="update.php" class="form-horizontal" method="POST">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <div class="form-group">
                <label for="birth" class="col-sm-2 control-label">Gimimo metai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="birth" value="<?php echo $row['GIMIMO_METAI']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Gimimo valstybė</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="country" value="<?php echo $row['GIMIMO_VALSTYBE']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="sex" class="col-sm-2 control-label">Lytis</label>
                <div class="col-sm-10">
                  <select class="form-control" name="sex">
                    <option value="V"<?php echo ($row['LYTIS'] == 'V') ? ' selected' : '' ?>>Vyras</option>
                    <option value="M"<?php echo ($row['LYTIS'] == 'M') ? ' selected' : '' ?>>Moteris</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="family" class="col-sm-2 control-label">Šeimos padėtis</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="family" value="<?php echo $row['SEIMOS_PADETIS']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="kids" class="col-sm-2 control-label">Vaikų skaičius</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="kids" value="<?php echo $row['KIEK_TURI_VAIKU']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="eldership" class="col-sm-2 control-label">Seniūnija</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="eldership" value="<?php echo $row['SENIUNIJA']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="street" class="col-sm-2 control-label">Gatvė</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="street" value="<?php echo $row['GATVE']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="eldershipnr" class="col-sm-2 control-label">Seniūnijos numeris</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="eldershipnr" value="<?php echo $row['SENIUNNR']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="districtcode" class="col-sm-2 control-label">Teritorijos kodas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="districtcode" value="<?php echo $row['TER_REJ_KODAS']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="streetcode" class="col-sm-2 control-label">Gatvės kodas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="streetcode" value="<?php echo $row['GATV_K']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="streetid" class="col-sm-2 control-label">Gatvės ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="streetid" value="<?php echo $row['GAT_ID']; ?>">
                </div>
              </div>
              <div class="form-group pull-right">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success" name="update">Atnaujinti</button>
                </div>
              </div>
            </form>
          <?php else:
          header('Location: index.php');
          endif; ?>
        </div>
      </div>
    </div>
    <?php include('template/footer.php'); ?>
  </body>
</html>